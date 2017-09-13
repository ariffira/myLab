<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cyomed
 *
 *
 * @package		Cyomed
 * @author		
 * @copyright	
 * @license		
 * @link			
 * @since			
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Cyomed Language Helpers
 *
 * @package			Cyomed
 * @subpackage	Helpers
 * @category		Helpers
 * @author			
 * @link				
 */

// ------------------------------------------------------------------------

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */
if ( ! function_exists('lang_list'))
{
	function lang_list($tag_name = '', $selected = NULL, $skip = TRUE, $selected_attr = array())
	{
		static $CI;
		
		empty($CI) && $CI =& get_instance();
	
		$selected = $selected ? $selected : $CI->m->user_value('language');
		if ( ! $selected)
		{
			$config =& get_config();
			$selected = isset($config['language']) ? $config['language'] : 'en';
		}

		$ll = $CI->lang->load('language_list', 'en', TRUE);
		$CI->lang->load('language_list', $selected);

    $CI->m->port->p->db_select();
    $al = array_filter( array_map ( function($field) {
    	return ! in_array( $field, array('id', 'key', 'relpath', 'pathname', 'filename', 'basename', 'module', ) ) ? 
				( substr($field, 0, strlen('lang_')) == 'lang_' ? substr($field, strlen('lang_')) : $field ) : NULL;
    }, $CI->m->port->p->list_fields('lang') ) );

		$selected_attr = implode(' ', array_map(function($value, $key) {
			return $key.'="'.$value.'"';
		}, $arr = array_merge(array('selected' => 'selected', ), $selected_attr), array_keys($arr)));

		$return = '';

		foreach ($ll as $key => $text)
		{
			$key = substr($key, strlen('language_list_'));
			
			if ($skip && ! in_array($key, $al) ) continue;

			$return .= '<'.$tag_name.'';

			$return .= ' value="'.$key.'"';
			$return .= $selected && $selected == $key ? ' '.$selected_attr : '';
			$return .= in_array($key, $al) ? '' : 'disabled="disabled"';

			$return .= '>';

			$return .= $CI->lang->line('language_list_'.$key).' ('.$text.')';

			$return .= '</'.$tag_name.'>';
		}

		return $return;
	}
}

// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */