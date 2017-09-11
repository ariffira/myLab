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
 * Euni UI pie chart class
 *
 * @package			
 * @subpackage	
 * @category		
 * @author			
 * @link				
 */
class Ui_pie_chart extends Ui_base {

	protected $options = array(
		'ui_type' => 'tag',
		'tag' => 'div',
		'attr' => '',
		'class' => array('pie-chart-tiny', ),
		'id' => '',
		'range' => 100,
		'value' => 50,
		'no_percent' => FALSE,
	);
	protected $structure = array(
		'percent' => '<span class="percent"></span>',
		'title' => array(
			'options' => array(
				'ui_type' => 'tag',
				'tag' => 'span',
				'attr' => '',
				'class' => array('pie-title', ),
				// 'enabled' => FALSE, 
			),
			'structure' => array(
				'content' => 'Pie Chart',
				'reload' => array(
					'options' => array(
						'ui_type' => 'tag',
						'tag' => 'i',
						'attr' => '',
						'class' => array('m-l-5', 'fa fa-retweet', ),
						'enabled' => FALSE, 
					),
				),
			),
		),
	);

	// ------------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct()
	{
		parent::__construct();
		$this->options['id'] = 'pieChart'.random_string('alnum', 32);
		$this->options['value'] = mt_rand(1, 199) - 100;
		log_message('debug', "Ui_pie_chart Class Initialized");
	}

	/**
	 * Function output
	 */
	public function output($echo = FALSE)
	{
		$converted_class = $this->convert_arr($this, $this->options, 'class');

		if (strpos($converted_class, 'pie-chart-tiny') === FALSE)
		{
			if (is_string($this->options['class']))
			{
				$this->options['class'] .= ' pie-chart-tiny';
			}

			if (is_array($this->options['class']))
			{
				$this->options['class'][] = 'pie-chart-tiny';
			}
		}

		$this->options['data-value-range'] = $this->convert_arr($this, $this->options, 'range');
		$this->options['data-value-real'] = $this->convert_arr($this, $this->options, 'value');

		$this->options['data-percent'] = $this->options['data-value-real'] / $this->options['data-value-range'] * 100;
		unset($this->options['value']);

		$this->percent = empty($this->options['no_percent']) ? $this->percent : '<span class="percent no-percent"></span>';

		return parent::output($echo);
	}

}

/* End of file Ui_pie_chart.php */
/* Location: ./system/libraries/Eui/drivers/Ui_pie_chart.php */