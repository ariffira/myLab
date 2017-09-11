<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ArtoGame
 *
 * 
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
 * ArtoGame Global Helpers
 *
 * @package
 * @subpackage
 * @category
 * @author
 * @link
 */

// ------------------------------------------------------------------------

/**
 * set document type
 *
 * @param string $type type of document
 */
if ( ! function_exists('set_content_type') )
{
  function set_content_type($type = 'application/json')
  {
    header('Content-Type: '.$type);
  }
}

// --------------------------------------------------------------------

/**
 * Read CSV from URL or File
 *
 * @param  string $filename  Filename
 * @param  string $delimiter Delimiter
 * @return array            [description]
 */
if ( ! function_exists('read_csv') )
{
  function read_csv($filename, $delimiter = ',')
  {
    $file_data = array();
    $handle = @fopen($filename, "r") or FALSE;
    if ($handle !== FALSE) {
      while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
        $file_data[] = $data;
      }
      fclose($handle);
    }
    return $file_data;
  }
}

// --------------------------------------------------------------------

/**
 * Print Log to the page
 *
 * @param  mixed  $var    Mixed Input
 * @param  boolean $pre    Append <pre> tag
 * @param  boolean $return Return Output
 * @return string/void     Dependent on the $return input
 */
if ( ! function_exists('plog') )
{
  function plog($var, $pre = TRUE, $return = FALSE)
  {
    $info = print_r($var, TRUE);
    $result = $pre ? "<pre>$info</pre>" : $info;
    if ($return) return $result;
    else echo $result;
  }
}

// --------------------------------------------------------------------

/**
 * Log to file
 *
 * @param  string $log Log
 * @return void
 */
if ( ! function_exists('elog') )
{
  function elog($log, $fn = "debug.log")
  {
    $fp = fopen($fn, "a");
    fputs($fp, "[".date("d-m-Y h:i:s")."][Log] $log\r\n");
    fclose($fp); 
  }
}

// --------------------------------------------------------------------

/**
 * Check if an array is associative
 *
 * @param  array $array Array to check
 * @return bool
 */
if ( ! function_exists('is_assoc') )
{
  function is_assoc($array)
  {
    foreach (array_keys((array)$array) as $k => $v)
    {
      if ($k !== $v)
        return TRUE;
    }
    return FALSE;
  }
}

// --------------------------------------------------------------------

/**
 * Check if an array is associative
 *
 * @param  string $str_value Original string
 * @param string $nl2br Whether to perform nl2br()
 * @param string
 */
if ( ! function_exists('clean_html_string') )
{
  function clean_html_string($str_value = NULL, $nl2br = TRUE)
  {
    if ($str_value === NULL) $str_value = '';
    $new_str = is_string($str_value) ? htmlentities(html_entity_decode($str_value, ENT_QUOTES)) : $str_value;
    $new_str = utf8_encode($new_str);
    return $nl2br ? nl2br($new_str) : $new_str;
  }
}

// --------------------------------------------------------------------

/**
 * Check if an object is a closure
 *
 * @param  obj $obj Object to check
 * @return bool
 */
if ( ! function_exists('is_closure') )
{
  function is_closure($obj)
  {
    return (is_object($obj) && ($obj instanceof Closure));   
  }
}

// --------------------------------------------------------------------

/**
 * Check if an object can be a string
 *
 * @param  obj $obj Object to check
 * @return bool
 */
if ( ! function_exists('can_be_string') )
{
  function can_be_string($obj)
  {
    return $obj === NULL || is_scalar($obj) || is_callable([$obj, '__toString']);
  }
}


// --------------------------------------------------------------------

/**
 * Recursively turn an array into an object
 *
 * @param  array $array Array to transform
 * @param  bool $recursive Whether recursive
 * @return object
 */
if ( ! function_exists('array_to_object') )
{
  function array_to_object($array, $recursive = FALSE)
  {
    if (!is_object($array) && !is_array($array))
      return $array;
   
    if (!$recursive) return (object)$array;

    if (is_array($array))
    {
      foreach ($array as $key => $value)
      {
        $array[$key] = array_to_object($value, $recursive);
      }
      return (object)$array;
    }
    else return $array;
  }
}

// --------------------------------------------------------------------

/**
 * Recursively turn an object into an array
 *
 * @param  object $object Object to transform
 * @param  bool $recursive Whether recursive
 * @return array
 */
if ( ! function_exists('object_to_array') )
{
  function object_to_array($object, $recursive = TRUE) {
    if (!is_object($object) && !is_array($object))
      return $object;

    if (is_object($object))
      $object = get_object_vars($object);

    if (!$recursive) return $object;

    foreach ($object as $key => $value)
    {
      $object[$key] = object_to_array($value, $recursive);
    }
    return $object;
  }
}

// --------------------------------------------------------------------

/**
 * var_dump in html-friendly way
 *
 * @param  object $object Object to perform
 * @param  bool $echo Whether to echo out directly
 * @return string
 */
if ( ! function_exists('var_dump_html') )
{
  function var_dump_html($object, $echo = TRUE) {
    ob_start();
    var_dump($object);
    $buffer = nl2br( str_replace( ' ', '&nbsp;&nbsp;', ob_get_contents() ) );
    @ob_end_clean();
    if ($echo) echo $buffer;
    return $buffer;
  }
}

// --------------------------------------------------------------------

/**
 * Convert a link with or w/o site_url
 *
 * @param  string $url url to perform
 * @return string
 */
if ( ! function_exists('smart_site_url') )
{
  function smart_site_url($url) {
    return strpos($url, 'http') === 0 || strpos($url, '//') === 0 || strpos($url, 'javascript:') === 0 ? $url : site_url($url);
  }
}

// --------------------------------------------------------------------

/**
 * Redirect for ajax pages
 *
 * @param  string $url url to perform
 * @return string
 */
if ( ! function_exists('ajax_redirect') )
{
  function ajax_redirect($redirect) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    redirect('akte/active_url?r='. rawurlencode($_ci->encrypt->encode($redirect)) );
  }
}

// --------------------------------------------------------------------

/**
 * Redirect for ajax pages
 *
 * @param  string $url url to perform
 * @return string
 */
if ( ! function_exists('ajax_site_url') )
{
  function ajax_site_url($url) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    return site_url('akte/akte/active_url?r='. rawurlencode($_ci->encrypt->encode($url)) );
  }
}

// --------------------------------------------------------------------

/**
 * Calculate BMI value from height & weight
 *
 * @param  number|string $height
 * @param  number|string $weight
 * @return number
 */
if ( ! function_exists('calculate_bmi') )
{
  function calculate_bmi($size, $weight) {
    if ($size > 100) $size /= 100;
    return round($weight / ($size * $size) * 100 ) / 100;
  }
}

/**
 * Redirect for rezept ajax pages
 *
 * @param  string $url url to perform
 * @return string
 */
if ( ! function_exists('rezept_ajax_redirect') )
{
  function rezept_ajax_redirect($redirect) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    redirect('rezept/active_url?r='. rawurlencode($_ci->encrypt->encode($redirect)) );
  }
}

if ( ! function_exists('termin_ajax_redirect') )
{
  function termin_ajax_redirect($redirect) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    redirect('termin/termin/active_url?r='. rawurlencode($_ci->encrypt->encode($redirect)) );
  }
}


/* End of file global_helper.php */
/* Location: ./application/helpers/global_helper.php */