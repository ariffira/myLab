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
 * Euni UI tile Class
 *
 * @package			
 * @subpackage	
 * @category		
 * @author			
 * @link				
 */
class Ui_title extends Ui_base {

	protected $options = array(
		'ui_type' => 'tag',
		'tag' => 'h4',
		'attr' => '',
		'class' => array('block-title', ),
	);
	protected $structure = array(
		'content' => 'Block Title',
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
		log_message('debug', "Ui_title Class Initialized");
	}

	/**
	 * Function output
	 */
	public function output($echo = FALSE)
	{
		$converted_class = $this->convert_arr($this, $this->options, 'class');

		if (strpos($converted_class, 'block-title') === FALSE)
		{
			if (is_string($this->options['class']))
			{
				$this->options['class'] .= ' block-title';
			}

			if (is_array($this->options['class']))
			{
				$this->options['class'][] = 'block-title';
			}
		}

		return parent::output($echo);
	}

}

/* End of file Ui_title.php */
/* Location: ./system/libraries/Eui/drivers/Ui_title.php */