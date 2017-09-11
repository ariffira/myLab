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
class Ui_tile extends Ui_base {

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
    log_message('debug', "Ui_tile Class Initialized");
  }

  /**
   * Function _diff_bs_tname
   */
  private function _diff_bs_tname()
  {
    switch (Ui::$bs_tname) {
      case 'sa103':
        $this->options = array(
          'ui_type' => 'tag',
          'tag' => 'div',
          'attr' => '',
          'class' => array('tile', 'm-10', ),
          'accordion' => '',
          'accordion_parent' => '',
          'accordion_active' => FALSE,
        );
        $this->structure = array(
          'title' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'h2',
              'attr' => '',
              'class' => 'tile-title'
            ),
            'structure' => array(
              'content' => 'Tile Title',
            ),
          ),
          'config' => array(
            'options' => array(
              'ui_type' => 'bare',
            ),
            'structure' => array(
              
            ),
          ),
          'body' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'div',
              'attr' => '',
              'class' => 'p-10',
            ),
            'structure' => array(
              'content' => 'Tile content',
            ),
          ),
        );
        break;

      case 'mvpr110':
        $this->options = array(
          'ui_type' => 'tag',
          'tag' => 'div',
          'attr' => '',
          'class' => array('portlet', 'm-10', ),
          'accordion' => '',
          'accordion_parent' => '',
          'accordion_active' => FALSE,
        );

        $this->structure = array(
          'title' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'h4',
              'attr' => '',
              'class' => 'portlet-title'
            ),
            'structure' => array(
              'content' => 'Tile Title',
            ),
          ),
          'config' => array(
            'options' => array(
              'ui_type' => 'bare',
            ),
            'structure' => array(
              
            ),
          ),
          'body' => array(
            'options' => array(
              'ui_type' => 'tag',
              'tag' => 'div',
              'attr' => '',
              'class' => 'portlet-body',
            ),
            'structure' => array(
              'content' => 'Tile content',
            ),
          ),
        );
        break;
      
      default:
        # code...
        break;
    }
  }

  /**
   * Function output
   */
  public function output($echo = FALSE)
  {
    switch (Ui::$bs_tname) {
      case 'sa103':
        $converted_class = $this->convert_arr($this, $this->options, 'class');
        if (strpos($converted_class, 'tile') === FALSE)
        {
          if (is_string($this->options['class']))
          {
            $this->options['class'] .= ' tile';
          }

          if (is_array($this->options['class']))
          {
            $this->options['class'][] = 'tile';
          }
        }
        break;

      case 'mvpr110':
        $converted_class = $this->convert_arr($this, $this->options, 'class');
        if (strpos($converted_class, 'portlet') === FALSE)
        {
          if (is_string($this->options['class']))
          {
            $this->options['class'] .= ' portlet';
          }

          if (is_array($this->options['class']))
          {
            $this->options['class'][] = 'portlet';
          }
        }

        $this->title->structure['content'] = array(
          'options' => array(
            'ui_type' => 'tag',
            'tag' => 'u',
            'attr' => '',
          ),
          'structure' => array(
            'content' => $this->title->structure['content'],
          ),
        );
        $this->title->base_init();

        $converted_body = $this->convert_arr($this->body, $this->body->options, 'class');
        if (strpos($converted_body, 'portlet-body') === FALSE)
        {
          if (is_string($this->body->options['class']))
          {
            $this->body->options['class'] .= ' portlet-body';
          }

          if (is_array($this->body->options['class']))
          {
            $this->body->options['class'][] = 'portlet-body';
          }
        }

        break;
      
      default:
        # code...
        break;
    }

    if (!empty($this->config) && !empty($this->config->structure) && is_array($this->config->structure) && count($this->config->structure) > 0)
    {
      $config = '<div class="tile-config dropdown">';
      $config .= '<a data-toggle="dropdown" href="javascript:void(0);" class="tile-menu">'.(Ui::$bs_tname == 'mvpr110' ? '<span class="icomoon i-arrow-down"></span>' : '').'</a>';
      $config .= '<ul class="dropdown-menu pull-right text-right">';

      foreach ($this->config->structure as $key => $value)
      {
        $converted_config = $this->convert_arr($this, $value);
        
        $config .= '<li ';
        $config .= !empty($converted_config['active']) ? 'class="active"' : '';
        $config .= '>';

        $config .= '<a ';
        $config .= 'class="';
        $config .= !empty($converted_config['tile_info_toggle']) ? 'tile-info-toggle' : '';
        $config .= !empty($converted_config['class']) ? $converted_config['class'] : '';
        $config .= '" ';
        $config .= !empty($converted_config['attr']) ? $converted_config['attr'] : '';
        $config .= '>';

        $config .= !empty($converted_config['text']) ? $converted_config['text'] : '';

        $config .= '</a>';

        $config .= '</li>';
      }

      $config .= '</ul>';
      $config .= '</div>';

      $this->structure['config'] = $config;
    }

    if (!empty($this->options['accordion']))
    {
      $accordion_id = 'accordion-panel-'.random_string('alnum', 32);

      $output = '';

      $buffer = '';
      $buffer .= '<div class="panel '.(!empty($this->options['accordion_active']) ? 'is-open' : '').'">';
      $buffer .= '  <div class="panel-heading">';
      $buffer .= '    <h4 class="panel-title">';
      $buffer .= '      <a class="accordion-toggle collapsed" data-toggle="collapse" '.(!empty($this->options['accordion_parent']) ? ('data-parent="#'.$this->options['accordion_parent'].'"') : '' ).' href="#'.$accordion_id.'">';
      $buffer .= '        <i class="fa faq-accordion-caret"></i>';

      if ($echo) echo $buffer;
      $output .= $buffer;

      $buffer = $this->title->options('ui_type', 'bare')->output();
      if ($echo) echo $buffer;
      $this->title->options('ui_type', 'tag');
      $output .= $buffer;

      $buffer = '';
      $buffer .= '      </a>';
      $buffer .= '    </h4>';
      $buffer .= '  </div>';
      $buffer .= '  <div id="'.$accordion_id.'" class="panel-collapse collapse '.(!empty($this->options['accordion_active']) ? 'in' : '').'">';
      $buffer .= '    <div class="panel-body">';

      if ($echo) echo $buffer;
      $output .= $buffer;

      $buffer = parent::output($echo);
      $output .= $buffer;

      $buffer = '';
      $buffer .= '    </div>';
      $buffer .= '  </div>';
      $buffer .= '</div>';

      if ($echo) echo $buffer;
      $output .= $buffer;

      return $output;
    }
    else
    {
      return parent::output($echo);
    }

  }

}

/* End of file Ui_tile.php */
/* Location: ./system/libraries/Eui/drivers/Ui_tile.php */