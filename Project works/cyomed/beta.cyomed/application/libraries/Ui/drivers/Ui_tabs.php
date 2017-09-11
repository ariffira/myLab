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
 * Euni UI tab collection Class
 *
 * @package     
 * @subpackage  
 * @category    
 * @author      
 * @link        
 */
class Ui_tabs extends Ui_base {

  protected $options = array(
    'ui_type' => 'bare',
  );
  protected $structure = array(
    'nav' => array(
      'options' => array(
        'ui_type' => 'tag',
        'tag' => 'ul',
        'class' => array('nav', 'nav-tabs' ),
        'role' => 'tablist',
      ),
      'structure' => array(
        'content' => 'Tab Title',
      ),
    ),
    'pane' => array(
      'options' => array(
        'ui_type' => 'tag',
        'tag' => 'div',
        'class' => array('tab-content', 'm-0', ),
      ),
      'structure' => array(
        'content' => 'Pane content',
      ),
    ),
  );

  protected $_tab_collection = array();

  public $name = '';

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

    $this->name = 'tabCollection'.random_string('alnum', 32);

    log_message('debug', "Ui_tabs Class Initialized");
  }

  // ------------------------------------------------------------------------

  /**
   * Nav
   *
   * @param
   */
  public function nav($echo = FALSE)
  {
    $this->nav->content = '';

    foreach ($this->_tab_collection as $tab_index => $tab)
    {
      if (!is_a($tab, 'Ui_tab')) continue;
      $this->nav->content .= $tab->nav();
    }

    $output = $this->nav->output();

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
    $this->pane->content = '';

    foreach ($this->_tab_collection as $tab_index => $tab)
    {
      if (!is_a($tab, 'Ui_tab')) continue;
      $this->pane->content .= $tab->pane();
    }

    $output = $this->pane->output();

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
    $output = '';

    $output .= $this->nav();
    $output .= $this->pane();

    if ($echo) echo $output;
    return $output;
  }

  // ------------------------------------------------------------------------

  /**
   * New
   *
   * @param
   */
  public function &create()
  {
    $created = new Ui();
    $created = $created->init()->tab->base_init();

    $this->_tab_collection[] =& $created;

    return $created;
  }

  // ------------------------------------------------------------------------

  /**
   * append
   *
   * @param
   */
  public function append(&$tab)
  {
    $this->_tab_collection[] =& $tab;

    return $this;
  }

}

/* End of file Ui_tabs.php */
/* Location: ./system/libraries/Eui/drivers/Ui_tabs.php */