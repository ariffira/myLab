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
 * Euni UI tab Class
 *
 * @package     
 * @subpackage  
 * @category    
 * @author      
 * @link        
 */
class Ui_tab extends Ui_base {

  protected $options = array(
    'ui_type' => 'bare',
    'id' => '',
    'active' => FALSE,
  );
  protected $structure = array(
    'nav' => array(
      'options' => array(
        'ui_type' => 'bare',
      ),
      'structure' => array(
        'content' => 'Tab Title',
      ),
    ),
    'pane' => array(
      'options' => array(
        'ui_type' => 'bare',
      ),
      'structure' => array(
        'content' => 'Pane content',
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

    $this->options['id'] = 'tab'.random_string('alnum', 32);

    log_message('debug', "Ui_tab Class Initialized");
  }

  // ------------------------------------------------------------------------

  /**
   * Nav
   *
   * @param
   */
  public function nav($echo = FALSE)
  {
    if (empty($this->options['id']))
    {
      $this->options['id'] = 'tab'.random_string('alnum', 32);
    }

    $output = '';
    $output .= '<li class="'.($this->options['active'] ? 'active' : '').'"><a href="#'.$this->options['id'].'" role="tab" data-toggle="tab">';
    $output .= $this->nav->content;
    $output .= '</a></li>';

    if ($echo) echo $output;
    return $output;
  }

  // ------------------------------------------------------------------------

  /**
   * Pane
   *
   * @param
   */
  public function pane($echo = FALSE)
  {
    if (empty($this->options['id']))
    {
      $this->options['id'] = 'tab'.random_string('alnum', 32);
    }

    $output = '';
    $output .= '<div class="tab-pane fade '.($this->options['active'] ? 'in active' : '').'" id="'.$this->options['id'].'">';
    $output .= $this->pane->content;
    $output .= '</div>';

    if ($echo) echo $output;
    return $output;
  }

  // ------------------------------------------------------------------------

  /**
   * Output
   *
   * @param
   */
  public function output($echo = FALSE)
  {
    if (empty($this->options['id']))
    {
      $this->options['id'] = 'tab'.random_string('alnum', 32);
    }

    $output = $this->pane->content;

    if ($echo) echo $output;
    return $output;
  }

}

/* End of file Ui_tab.php */
/* Location: ./system/libraries/Eui/drivers/Ui_tab.php */