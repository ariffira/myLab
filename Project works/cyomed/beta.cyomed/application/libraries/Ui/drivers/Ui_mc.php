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
 * Euni UI mc Class
 *
 * @package     
 * @subpackage  
 * @category    
 * @author      
 * @link        
 */
class Ui_mc extends Ui_base {

  protected $options = array(
    'ui_type' => 'bare',
  );
  protected $structure = array(
    'messages' => array(
      'options' => array(
        'ui_type' => 'tag',
        'tag' => 'div',
        'attr' => '',
        'id' => 'messages',
        'class' => 'tile drawer animated',
      ),
      'structure' => array(
        'content' => array(
          'options' => array(
            'ui_type' => 'view',
            'location' => 'partials/sa103/drawers/messages_view',
            'data' => array(),
          ),
        ),
      ),
    ),
    'notifications' => array(
      'options' => array(
        'ui_type' => 'tag',
        'tag' => 'div',
        'attr' => '',
        'id' => 'notifications',
        'class' => 'tile drawer animated',
      ),
      'structure' => array(
        'content' => array(
          'options' => array(
            'ui_type' => 'view',
            'location' => 'partials/sa103/drawers/notifications_view',
            'data' => array(),
          ),
        ),
      ),
    ),
    'breadcrumb' => array(
      'options' => array(
        'ui_type' => 'tag',
        'tag' => 'ol',
        'attr' => '',
        'class' => 'breadcrumb hidden-xs',
      ),
      'structure' => array(
        'li0' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => '      ' ), 'structure' => array( 'content' => array('options' => array('ui_type' => 'tag', 'tag' => 'a', 'attr' => '', 'href' => '#' ), 'structure' => array('Home',    ), ), ), ),
        'li1' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => '      ' ), 'structure' => array( 'content' => array('options' => array('ui_type' => 'tag', 'tag' => 'a', 'attr' => '', 'href' => '#' ), 'structure' => array('Library', ), ), ), ),
        'li2' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => 'active' ), 'structure' => array( 'Data', ), ),
      ),
    ),
    'title' => array(
      'options' => array(
        'ui_type' => 'tag',
        'tag' => 'h4',
        'attr' => '',
        'class' => 'page-title',
      ),
      'structure' => array(
        'content' => 'DASHBOARD',
      ),
    ),
    'content' => array(
      'options' => array(
        'ui_type' => 'tag',
        'tag' => 'div',
        'attr' => '',
        'class' => 'block-area m-b-15',
        'id' => 'main-content',
      ),
      'structure' => array(
        'content' => 'Content Inside',
      ),
    ),
    'hr' => array(
      'options' => array(
        'ui_type' => 'tag',
        'tag' => 'hr',
        'attr' => '',
        'class' => 'whiter',
      ),
    ),
    'chat' => array(
      'options' => array(
        'ui_type' => 'tag',
        'tag' => 'div',
        'attr' => '',
        'class' => 'chat',
      ),
      'structure' => array(
        'content' => array(
          'options' => array(
            'ui_type' => 'view',
            'location' => 'partials/sa103/chat_view',
            'data' => array(),
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
    $this->_diff_bs_tname();
    log_message('debug', "Ui_mc Class Initialized");
  }

  // ------------------------------------------------------------------------

  /**
   * Function _diff_bs_tname
   */
  private function _diff_bs_tname()
  {
    switch (Ui::$bs_tname) {
      case 'sa103':
        $this->structure = array(
          'messages' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'div',
              'attr' => '',
              'id' => 'messages',
              'class' => 'tile drawer animated',
            ),
            'structure' => array(
              'content' => array(
                'options' => array(
                  'ui_type' => 'view',
                  'location' => 'partials/sa103/drawers/messages_view',
                  'data' => array(),
                ),
              ),
            ),
          ),
          'notifications' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'div',
              'attr' => '',
              'id' => 'notifications',
              'class' => 'tile drawer animated',
            ),
            'structure' => array(
              'content' => array(
                'options' => array(
                  'ui_type' => 'view',
                  'location' => 'partials/sa103/drawers/notifications_view',
                  'data' => array(),
                ),
              ),
            ),
          ),
          'breadcrumb' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'ol',
              'attr' => '',
              'class' => 'breadcrumb hidden-xs',
            ),
            'structure' => array(
              'li0' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => '      ' ), 'structure' => array( 'content' => array('options' => array('ui_type' => 'tag', 'tag' => 'a', 'attr' => '', 'href' => '#' ), 'structure' => array('Home',    ), ), ), ),
              'li1' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => '      ' ), 'structure' => array( 'content' => array('options' => array('ui_type' => 'tag', 'tag' => 'a', 'attr' => '', 'href' => '#' ), 'structure' => array('Library', ), ), ), ),
              'li2' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => 'active' ), 'structure' => array( 'Data', ), ),
            ),
          ),
          'title' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'h4',
              'attr' => '',
              'class' => 'page-title',
            ),
            'structure' => array(
              'content' => 'DASHBOARD',
            ),
          ),
          'content' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'div',
              'attr' => '',
              'class' => 'block-area m-b-15',
              'id' => 'main-content',
            ),
            'structure' => array(
              'content' => 'Content Inside',
            ),
          ),
          'hr' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'hr',
              'attr' => '',
              'class' => 'whiter',
            ),
          ),
          'chat' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'div',
              'attr' => '',
              'class' => 'chat',
            ),
            'structure' => array(
              'content' => array(
                'options' => array(
                  'ui_type' => 'view',
                  'location' => 'partials/sa103/chat_view',
                  'data' => array(),
                ),
              ),
            ),
          ),
        );
        break;

      case 'mvpr110':
        $this->structure = array(
          'breadcrumb' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'ol',
              'attr' => '',
              'class' => 'breadcrumb hidden-xs pull-right',
              'enabled' => FALSE, 
            ),
            'structure' => array(
              'li0' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => '      ' ), 'structure' => array( 'content' => array('options' => array('ui_type' => 'tag', 'tag' => 'a', 'attr' => '', 'href' => '#' ), 'structure' => array('Home',    ), ), ), ),
              'li1' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => '      ' ), 'structure' => array( 'content' => array('options' => array('ui_type' => 'tag', 'tag' => 'a', 'attr' => '', 'href' => '#' ), 'structure' => array('Library', ), ), ), ),
              'li2' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => 'active' ), 'structure' => array( 'Data', ), ),
            ),
          ),
          'title' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'h2',
              'attr' => '',
              'class' => 'page-title',
            ),
            'structure' => array(
              'content' => 'PAGE TITLE',
            ),
          ),
          'content' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'div',
              'attr' => '',
              'class' => 'block-area m-b-15',
              'id' => 'main-content',
            ),
            'structure' => array(
              'content' => 'Content Inside',
            ),
          ),
        );
        break;
      
      default:
        # code...
        break;
    }
  }  

  // ------------------------------------------------------------------------

  /**
   * Function append_content
   */
  public function output($echo = FALSE)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $this->breadcrumb->structure = array();
    $segs = $_ci->uri->segment_array();
    foreach ($segs as $seg_index => $segment)
    {
      $this->breadcrumb->structure['li'.$seg_index] = array(
        'options' => array(
          'ui_type' => 'tag',
          'tag' => 'li',
          'attr' => '',
          'class' => '',
        ),
        'structure' => array(
          'content' =>
            $seg_index < count($segs) ?
            array(
              'options' => array(
                'ui_type' => 'tag',
                'tag' => 'a',
                'attr' => '',
                'href' => '#',
              ),
              'structure' => array(implode(' ', array_map(function ($item) { return ucfirst($item); }, explode('_', $segment) ) ), ),
            ) :
            implode(' ', array_map(function ($item) { return ucfirst($item); }, explode('_', $segment) ) ),
        ),
      );
    }
    
    $this->breadcrumb->base_init();

    return parent::output($echo);
  }

  // ------------------------------------------------------------------------

  /**
   * Function append_content
   */
  public function &append_content($name, $content = NULL)
  {
    static $_ci;

    if (!empty($this->structure['chat']))
    {
      $chat = $this->structure['chat'];
      unset($this->structure['chat']);
    }

    if ($content === NULL)
    {
      $this->structure[$name] =& $this->sub(array(
        'ui_type' => 'tag',
        'tag' => 'div',
        'attr' => '',
        'class' => 'block-area m-b-15',
        'id' => 'main-content',
      ), array(
        'content' => 'Content Inside',
      ));

      // $this->structure['hr_'.$name] = clone $this->structure['hr'];
      if(!empty($chat))
        $this->structure['chat'] =& $chat;

      return $this->structure[$name];
    }

    $this->structure[$name] = $content;

    // $this->structure['hr_'.$name] = clone $this->structure['hr'];
    if(!empty($chat))
      $this->structure['chat'] =& $chat;

    return $this;
  }

  // ------------------------------------------------------------------------

  /**
   * Function remove_content
   */
  public function remove_content($to_remove = NULL)
  {
    static $_ci;

    if (empty($to_remove))
    {
      $to_remove = 'content';
    }

    if (!empty($this->structure[$to_remove]))
    {
      // $to_remove =& $this->structure[$to_remove];
      unset($this->structure[$to_remove]);
    }

    return $this;
  }

}

/* End of file Ui_mc.php */
/* Location: ./system/libraries/Eui/drivers/Ui_mc.php */