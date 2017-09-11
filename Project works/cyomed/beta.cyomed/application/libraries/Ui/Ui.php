<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package			
 * @author			
 * @copyright		
 * @license			
 * @link				
 * @since				
 * @filesource	
 */

// ------------------------------------------------------------------------

/**
 * Euni UI Class
 *
 * @package			
 * @subpackage	
 * @category		
 * @author			
 * @link				
 */
class Ui extends CI_Driver_Library {

	protected $valid_drivers = array(
		'ui_base', 
		'ui_html', 
		'ui_mc', 
		'ui_tile', 
		'ui_title', 
		'ui_tab', 
		'ui_tabs', 
		'ui_pie_chart', 
		'ui_feed_item', 
	);

	public static $bs_tname = 'mvpr110';

	// ------------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct($config = array())
	{
		if ( ! empty($config))
		{
			$this->_initialize($config);
		}

		// $this->base;

		$_ci =& get_instance();

		if ($_ci->session->userdata('mvprt'))
		{
			self::$bs_tname = 'mvpr110';
		}
		else
		{
			# WE ONLY USE MVPR110 now, not sa103
			if ($_ci->session->userdata('sa103t')) {
				self::$bs_tname = 'sa103';
			}
		}

		log_message('debug', "Ui Class Initialized");
	}

	// ------------------------------------------------------------------------

	/**
	 * Initialize
	 *
	 * Initialize class properties based on the configuration array.
	 *
	 * @param		array
	 * @return 	void
	 */
	private function _initialize($config)
	{
		$this_object =& $this;
		foreach ($config as $key => $value)
		{
			if (property_exists($this, $key))
			{
				$this->$key = $value;
			}
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * UI base class init
	 *
	 */
	public function init()
	{
		$this->base;
		return $this;
	}

	// ------------------------------------------------------------------------

	/**
	 * convert_options
	 *
	 * @param array $options
	 * @param array $func_arr
	 */
	public function convert_options($options, $func_arr = array())
	{
		return array_map(function($option) use ($func_arr) {
			foreach ($func_arr as $func_name => $func_value)
			{
				if (is_closure($func_value))
				{
					$deal_func = $func_value;
					$deal_args = array($option, );
					$test_args = array($option, );
				}
				elseif (isset($func_value['deal_func']) && is_closure($func_value['deal_func']))
				{
					$deal_func = $func_value['deal_func'];
					unset($func_value['deal_func']);

					$deal_args = NULL;
					if (isset($func_value['deal_args']))
					{
						$deal_args = $func_value['deal_args'];
						unset($func_value['deal_args']);
					}

					$test_args = NULL;
					if (isset($func_value['test_args']))
					{
						$test_args = $func_value['test_args'];
						unset($func_value['test_args']);
					}

					$deal_args = array_merge(array($option, ), $deal_args ? $deal_args : $func_value);
					$test_args = array_merge(array($option, ), $test_args ? $test_args : $func_value);
				}
				else continue;

				if ($func_name == 'default' || call_user_func_array($func_name, $test_args))
				{
					return call_user_func_array($deal_func, $deal_args);
				}
			}
		}, $options);
	}

	// ------------------------------------------------------------------------

	/**
	 * convert_arr
	 *
	 * @param array $options
	 * @param array $func_arr
	 */
	public function convert_arr($driver_object, $attr, $field = NULL)
	{
		return ($converted = $this->convert_options(
			$field === NULL ? $attr : array($field => $attr[$field], ),
			array(
				'is_array' => function($option) {
					return implode(' ', array_map(function($key, $value) {
				    return is_numeric($key) ? $value : ($key.'="'.$value.'"');
				  }, array_keys($option), $option));
				},
				'is_closure' => array(
					'deal_func' => function($option, $ui){
						return call_user_func_array($option, array($ui, ));
					},
					$driver_object, 
					'test_args' => array(),
				),
				'is_a' => array(
					'deal_func' => function($option){
						return $option->output();
					},
					'deal_args' => array( ),
					'test_args' => array('Ui_base', ),
				),
				'default' => function($option) {
					return $option;
				},
			)
		)) ? ($field === NULL ? $converted : $converted[$field]) : $converted;
	}

}

/* End of file Ui.php */
/* Location: ./system/libraries/Ui/Ui.php */