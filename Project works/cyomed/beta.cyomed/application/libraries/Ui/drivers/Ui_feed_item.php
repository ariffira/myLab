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
class Ui_feed_item extends Ui_base {

  protected $options = array();
  protected $structure = array();

  // ------------------------------------------------------------------------

  /**
   * Constructor
   *
   * @param array
   */
  public function __construct()
  {
    parent::__construct();
    $this->_diff_bs_tname();
    log_message('debug', "Ui_feed_item Class Initialized");
  }

  /**
   * Function _diff_bs_tname
   */
  private function _diff_bs_tname()
  {
    switch (Ui::$bs_tname) {
      case 'sa103':
        break;

      case 'mvpr110':
        break;
      
      default:
        # code...
        break;
    }

    $this->options = array(
      'ui_type' => 'tag',
      'tag' => 'div',
      'attr' => '',
      'class' => array('feed-item', ($arr = array('idea', 'image', 'file', 'bookmark', 'question', )) ? ('feed-item-'.$arr[mt_rand(0, count($arr) - 1)]) : 'feed-item-idea', ),
    );

    $this->structure = array(
      'icon' => ($arr = array('lightbulb-o', 'picture-o', 'cloud-upload', 'bookmark', 'question', )) ? ('fa fa-'.$arr[mt_rand(0, count($arr) - 1)]) : 'fa fa-lightbulb-o',
      'title' => array(
        'options' => array(
          'ui_type' => 'tag',
          'tag' => 'div',
          'attr' => '',
          'class' => 'feed-subject'
        ),
        'structure' => array(
          'content' => 'Feed Title',
        ),
      ),
      'content' => array(
        'options' => array(
          'ui_type' => 'tag',
          'tag' => 'div',
          'attr' => '',
          'class' => 'feed-content',
        ),
        'structure' => array(
          'content' => 'Feed content',
        ),
      ),
      'actions' => array(
        'options' => array(
          'ui_type' => 'tag',
          'tag' => 'div',
          'attr' => '',
          'class' => 'feed-actions',
        ),
        'structure' => array(),
      ),
    );
  }

  /**
   *
   */
  public function rebase($options = array(), $structure = array())
  {
    $return = parent::rebase($options, $structure);

    $this->options['class'] = array('feed-item', ($arr = array('idea', 'image', 'file', 'bookmark', 'question', )) ? ('feed-item-'.$arr[mt_rand(0, count($arr) - 1)]) : 'feed-item-idea', );
    $this->structure['icon'] = ($arr = array('lightbulb-o', 'picture-o', 'cloud-upload', 'bookmark', 'question', )) ? ('fa fa-'.$arr[mt_rand(0, count($arr) - 1)]) : 'fa fa-lightbulb-o';

    return $return;
  }

  /**
   * Function output
   */
  public function output($echo = FALSE)
  {
    switch (Ui::$bs_tname) {
      case 'sa103':
        break;

      case 'mvpr110':
        break;
      
      default:
        # code...
        break;
    }

    $converted_class = $this->convert_arr($this, $this->options, 'class');
    if (strpos($converted_class, 'feed-item') === FALSE)
    {
      if (is_string($this->options['class']))
      {
        $this->options['class'] .= ' feed-item';
      }

      if (is_array($this->options['class']))
      {
        $this->options['class'][] = 'feed-item';
      }
    }

    if ( ! empty( $this->structure['icon'] ) ) {
      $converted_icon = $this->convert_arr($this, $this->structure, 'icon');

      $this->structure['icon'] = '<div class="feed-icon">'.'<i class="'.$converted_icon.'"></i>'.'</div>';
    }

    $converted_title = $this->convert_arr($this->title, $this->title->options, 'class');
    if (strpos($converted_title, 'feed-subject') === FALSE)
    {
      if (is_string($this->options['class']))
      {
        $this->options['class'] .= ' feed-subject';
      }

      if (is_array($this->options['class']))
      {
        $this->options['class'][] = 'feed-subject';
      }
    }

    $converted_content = $this->convert_arr($this->content, $this->content->options, 'class');
    if (strpos($converted_content, 'feed-content') === FALSE)
    {
      if (is_string($this->options['class']))
      {
        $this->options['class'] .= ' feed-content';
      }

      if (is_array($this->options['class']))
      {
        $this->options['class'][] = 'feed-content';
      }
    }

    return parent::output($echo);

  }

}

/* End of file Ui_feed_item.php */
/* Location: ./system/libraries/Eui/drivers/Ui_feed_item.php */