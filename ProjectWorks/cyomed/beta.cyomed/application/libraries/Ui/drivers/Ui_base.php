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
 * UI Base Class
 *
 * @package     
 * @subpackage  
 * @category    
 * @author      
 * @link        
 */
class Ui_base extends CI_Driver {

  public static $attr_fields = array(
    'hidden', 'high', 'href', 'hreflang', 'http-equiv', 'icon', 'id', 'ismap', 'itemprop', 'keytype', 'kind', 'label', 'lang', 'language', 'list', 'loop', 'low', 'manifest', 'max', 'maxlength', 'media', 'method', 'min', 'multiple', 'name', 'novalidate', 'open', 'optimum', 'pattern', 'ping', 'placeholder', 'poster', 'preload', 'pubdate', 'radiogroup', 'readonly', 'rel', 'required', 'reversed', 'rows', 'rowspan', 'sandbox', 'spellcheck', 'scope', 'scoped', 'seamless', 'selected', 'shape', 'size', 'sizes', 'span', 'src', 'srcdoc', 'srclang', 'srcset', 'start', 'step', 'style', 'summary', 'tabindex', 'target', 'title', 'type', 'usemap', 'value', 'width', 'wrap', 'border', 'buffered', 'challenge', 'charset', 'checked', 'cite', 'class', 'code', 'codebase', 'color', 'cols', 'colspan', 'content', 'contenteditable', 'contextmenu', 'controls', 'coords', 'data', 'data-*', 'datetime', 'default', 'defer', 'dir', 'dirname', 'disabled', 'download', 'draggable', 'dropzone', 'enctype', 'for', 'form', 'formaction', 'headers', 'height', 'accept', 'accept', 'accesskey', 'action', 'align', 'alt', 'async', 'autocomplete', 'autofocus', 'autoplay', 'autosave', 'bgcolor', 
  );

  public static $direct_closing = array(
    'img', 'meta', 'link', 'hr', 'br', 
  );

  protected $options = array(
    // UI that outputs html directly
    'ui_type' => 'tag',
    'tag' => 'div',
    'attr' => '',

    // UI that loads a view file
    // 'ui_type' => 'view',
    // 'location' => '',
    // 'data' => array(),
  );
  protected $init_options = FALSE;
  protected $structure = array();
  protected $init_structure = FALSE;

  private $_comm_obj = NULL;

  // ------------------------------------------------------------------------

  /**
   * Constructor
   *
   * @param array
   */
  public function __construct()
  {
    $this->_comm_obj_init();
    log_message('debug', "Ui_base Class Initialized");
  }

  // ------------------------------------------------------------------------

  /**
   * Function _comm_obj_init
   * 
   * initialize comm object
   *
   */
  private function _comm_obj_init()
  {
    if (empty($this->_comm_obj))
    {
      $this->_comm_obj = new Ui_options_comm_obj($this, $this->options);
    }
  }

  // ------------------------------------------------------------------------

  /**
   * Function base_init
   * 
   * dealing with information within options & structure
   *
   * @param array $options
   * @param array $structure
   */
  public function base_init($options = array(), $structure = array())
  {
    $this->options   = array_merge($this->options, $options);
    $this->structure = array_merge($this->structure, $structure);

    if (empty($this->init_options)) $this->init_options = $this->options;
    if (empty($this->init_structure)) $this->init_structure = $this->structure;

    $this->structure = $this->structure_init($this->structure);

    return $this;
  }

  // ------------------------------------------------------------------------

  /**
   * Function rebase
   * 
   * using the init settings of the current ui object
   *
   * @param array $options
   * @param array $structure
   */
  public function rebase($options = array(), $structure = array())
  {
    if ($this->init_options === FALSE || $this->init_structure === FALSE)
    {
      return $this->base_init($options, $structure);
    }

    $this->options   = array_merge($this->init_options, $options);
    $this->structure = array_merge($this->init_structure, $structure);

    $this->structure = $this->structure_init($this->structure);

    return $this;
  }

  // ------------------------------------------------------------------------

  /**
   * Function sub
   * 
   * creating a new UI base object, decorating current object as parent
   *
   * @param array $options
   * @param array $structure
   */
  public function &sub($options = array(), $structure = array())
  {
    $sub = new Ui_base();
    if ( ! empty($this->parent) ) $sub->decorate($this->parent);
    $sub->base_init($options, $structure);

    return $sub;
  }

  // ------------------------------------------------------------------------

  /**
   * Function structure_init
   * 
   * extract structure info
   *
   * @param object $structure
   */
  public function structure_init($structure = NULL)
  {
    if (empty($structure) || !is_object($structure) && !is_array($structure))
      return $structure;

    foreach ($structure as $key => $value)
    {
      if (is_array($value))
      {
        $o = isset($value['options']) ? $value['options'] : array();
        if (isset($value['options'])) unset($value['options']);
        $s = isset($value['structure']) ? $value['structure'] : $value;

        $structure[$key] =& $this->sub($o, $s);
      }
    }

    return $structure;
  }

  // ------------------------------------------------------------------------

  /**
   * convert_arr
   *
   * @param array $options
   * @param array $func_arr
   */
  public function convert_arr($driver_object, $attr, $field = NULL, $converting_structure = FALSE)
  {
    $converted = parent::__call('convert_arr', array($driver_object, $attr, $field, ));

    if ($field === NULL && !$converting_structure)
    {
      $to_convert_again = array_intersect_key(
        $converted,
        array_flip(array_filter(
          array_keys($attr),
          function($attr_field) {
            return $attr_field != 'attr' && (in_array($attr_field, self::$attr_fields) || strpos($attr_field, 'data-') === 0) ? TRUE : FALSE;
          }
        ))
      );

      $attr['attr'] = empty($attr['attr']) ? '' : $attr['attr'];

      if (is_array($attr['attr']))
      {
        $attr['attr'] = array_merge(
          $attr['attr'],
          $to_convert_again
        );

        return parent::__call('convert_arr', array($driver_object, $attr, $field, ));
      }

      $converted['attr'] = 
        (!empty($converted['attr']) ? $converted['attr'] : '').
        ' '.
        parent::__call('convert_arr', array($driver_object, array('to_convert_again' => $to_convert_again, ), 'to_convert_again', ));

      return $converted;
    }

    return $converted;
  }

  // ------------------------------------------------------------------------

  /**
   * Function append
   */
  public function &append($name, $content = NULL)
  {
    static $_ci;

    if ($content === NULL)
    {
      $this->structure[$name] =& $this->sub();

      return $this->structure[$name];
    }

    $this->structure[$name] = $content;

    return $this;
  }

  // ------------------------------------------------------------------------

  /**
   * Function output
   */
  public function output($echo = FALSE)
  {
    static $_ci;

    $converted_options = $this->convert_arr($this, $this->options);

    if ( isset($converted_options['enabled']) && !$converted_options['enabled'] )
    {
      return '';
    }

    if ( ! empty($converted_options['disabled']) )
    {
      return '';
    }

    $def_struct = implode("\n", $this->convert_arr($this, $this->structure, NULL, TRUE));
    $output = $def_struct;

    if (isset($converted_options['ui_type']))
    {
      switch ($converted_options['ui_type']) {
        case 'tag':
          if (isset($converted_options['tag']))
          {
            if ( ! empty($def_struct) )
            {
              $output = '';
              $output .= '<'.$converted_options['tag'].' '.$converted_options['attr'].'>';
              $output .= $def_struct;
              $output .= '</'.$converted_options['tag'].'>';
            }
            else
            {
              $output = '<'.$converted_options['tag'].' '.$converted_options['attr'].( in_array($converted_options['tag'], self::$direct_closing) ? ' />' : ('></'.$converted_options['tag'].'>') );
            }
          }
          
          break;

        case 'bare':
          $output = $def_struct;
          
          break;

        case 'view':
          if ( ! empty($converted_options['location']) )
          {
            if (empty($_ci)) $_ci =& get_instance();

            $output = $_ci->load->view($converted_options['location'], isset($this->options['data']) ? $this->options['data'] : array(), TRUE);
          }

          break;
        
        default:
          # falling back to type non-set
          break;
      }
    }

    if ($echo) echo $output;
    return $output;
  }

  // --------------------------------------------------------------------

  /**
   * __call magic method
   *
   *
   * @access  public
   * @param   string
   * @param   array
   * @return  mixed
   */
  public function __call($method, $args = array())
  {
    if ( isset($this->structure[$method]) )
    {
      $value = $this->structure[$method];

      if (!is_string($value) && is_a($value, 'Ui_base'))
      {
        if (count($args) > 0)
        {
          $sub_prop = array_shift($args);
          return call_user_func_array(array($value, (string)$sub_prop), $args);
        }
        else
        {
          return $value;
        }
      }
      else
      {
        if (count($args) > 0)
        {
          $this->structure[$method] = count($args) == 1 ? $args[0] : $args;
          return $this;
        }
        else
        {
          return $value;
        }
      }
    }

    if ($method == 'options' || $method == 'options_array')
    {
      if (count($args) > 0)
      {
        if (count($args) == 1)
        {
          if ( isset( $this->options[ $args[0] ] ) )
          {
            return $this->options[ $args[0] ];
          }
        }
        else
        {
          if ( isset( $this->options[ $args[0] ] ) )
          {
            $this->options[ $args[0] ] = $args[1];
            return $this;
          }
        }
      }
      else
      {
        return $method == 'options_array' ? $this->options : (object) $this->options;
      }
    }

    return parent::__call($method, $args);
    // return call_user_func_array('parent::'.$method, $args);
  }

  // --------------------------------------------------------------------

  /**
   * __get magic method
   *
   *
   * @param   string
   * @return  mixed
   */
  public function __get($var)
  {
    if ( isset($this->structure[$var]) )
    {
      return $this->structure[$var];
    }

    if ($var == 'options')
    {
      $this->_comm_obj_init();
      return $this->_comm_obj;
    }

    if ($var == 'options_array')
    {
      return $this->options;
    }

    return parent::__get($var);
  }

  // --------------------------------------------------------------------

  /**
   * __set magic method
   *
   *
   * @param   string
   * @param   mixed
   * @return  mixed
   */
  public function __set($var, $val)
  {
    if ( isset($this->structure[$var]) )
    {
      return $this->structure[$var] = $val;
    }

    if ($var == 'options' || $var == 'options_array')
    {
      $this->_comm_obj->set_ref($this->options = (array)$val);

      return $val;
    }

    parent::__set($var, $val);
    return $val;
  }

  // --------------------------------------------------------------------

  /**
   * __isset magic method
   *
   *
   * @param   string
   * @return  bool
   */
  public function __isset($var)
  {
    if ( isset($this->structure[$var]) )
    {
      return TRUE;
    }

    return parent::__isset($var);
  }

  // --------------------------------------------------------------------

  /**
   * __unset magic method
   *
   *
   * @param   string
   * @return  mixed
   */
  public function __unset($var)
  {
    if ( isset($this->structure[$var]) )
    {
      unset($this->structure[$var]);
      return;
    }
  }

}


/**
 * Ui_options_comm_obj Class
 * 
 * comm object is returned when user calling
 * $this->options->some_option = 'some value'; (setter)
 * or
 * echo $this->options->some_option; (getter)
 * or
 * $this->options->some_option('some value'); (setter from __call)
 *
 * @package     
 * @subpackage  
 * @category    
 * @author      
 * @link        
 */
class Ui_options_comm_obj {
  
  public $host;

  private $ref;

  public function __construct(&$host = NULL, &$ref = NULL)
  {
    $this->host =& $host;
    $this->ref =& $ref;
  }

  public function set_ref(&$ref)
  {
    $this->ref =& $ref;
  }

  /**
   * __get magic method
   *
   *
   * @param   string
   * @return  mixed
   */
  public function __get($var)
  {
    if ( isset($this->ref[$var]) )
    {
      return $this->ref[$var];
    }

    return FALSE;
  }

  // --------------------------------------------------------------------

  /**
   * __set magic method
   *
   *
   * @param   string
   * @param   mixed
   * @return  mixed
   */
  public function __set($var, $val)
  {
    if ( isset($this->ref[$var]) )
    {
      return $this->ref[$var] = $val;
    }

    return $val;
  }

  /**
   * __call magic method
   *
   *
   * @access  public
   * @param   string
   * @param   array
   * @return  mixed
   */
  public function __call($method, $args = array())
  {
    if ( isset($this->ref[$method]) )
    {
      if (count($args) > 0)
      {
        $this->ref[$method] = $args[0];
      }
      else
      {
        return $this->ref[$method];
      }
    }

    return FALSE;
  }

}

/* End of file Ui_base.php */
/* Location: ./system/libraries/Eui/drivers/Ui_base.php */