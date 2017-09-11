<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH."third_party/MX/Lang.php";

/**
 * MY_Language Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Language
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/language.html
 */
class MY_Lang extends MX_Lang {

	/**
	 * List of loaded language files
	 *
	 * @var array
	 */
	var $db_is_loaded = array();

	/**
	 * Database reference
	 */
	public $_db = NULL;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		log_message('info', 'MY_Language Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get database reference / check database dbforge settings and misc items
	 *
	 * @access  protected
	 * @return	bool
	 */
	protected function &get_db()
	{
		if ( empty($this->_db))
		{
			if ( ! class_exists('CI') || ! isset(CI::$APP)) return NULL;

			if (isset(CI::$APP->m) && CI::$APP->m && isset(CI::$APP->m->port->p) && CI::$APP->m->port->p )
			{
				$this->_db =& CI::$APP->m->port->p;
			}
			elseif (isset(CI::$APP->mod) && CI::$APP->mod && isset(CI::$APP->mod->port->p) && CI::$APP->mod->port->p )
			{
				$this->_db =& CI::$APP->mod->port->p;
			}
			else
			{
				log_message('error', 'Fatal: model m|mod could not be defined');
				return NULL;
			}
		}

		$this->_db->db_select();

		if ( ! $this->_db->table_exists('lang'))
		{
			$ci =& get_instance();

			// Native CI handler &get_instance() has some conflict with CI::$APP
			// When &get_instance()->db is not set yet, however, CI:$APP->db is
			// already set with db reference. (CI 2.2, HMVC for same version)
			// 
			// While using CI::$APP->load->dbforge(), the loading function is
			// somehow looking for stuff from ci object handler &get_instance(),
			// whose attrs are very likely not set yet; therefore, we need to 
			// temporarily override the desired attrs so the native stuff works
			// properly.
			// 
			// Note: this is fxcking ugly.

			// If not set, set it, mark flag $unset;
			// If set already, remember value;
			$recover = NULL;
			$unset = FALSE;
			if ( ! isset($ci->db))
			{
				$ci->db =& $this->_db;
				$unset = TRUE;
			}
			else
			{
				$recover =& $ci->db;
				$ci->db =& $this->_db;
			}

			// Do stuff with CI::$APP (this is HMVC stuff)
			$ci->load->dbforge();

			if (isset($ci->dbforge->db))
				$ci->dbforge->db =& $this->_db;
			else
				$ci->load->dbforge($this->_db);

			// If something is done for &get_instance(),
			// revert them back.
			if ($recover)
			{
				$ci->db =& $recover;
			}
			if ($unset)
			{
				unset($ci->db);
			}

			$fields = array(
				'id' => array(
					'type' => 'BIGINT',
					'unsigned' => TRUE,
					'auto_increment' => TRUE,
				),
				'key' => array(
					'type' =>'VARCHAR',
					'constraint' => '128',
				),
				'relpath' => array(
					'type' =>'VARCHAR',
					'constraint' => '64',
				),
				'lang_en' => array(
					'type' => 'TEXT',
				),
				'lang_de' => array(
					'type' => 'TEXT',
				),
			);

			$ci->dbforge->add_field($fields);

			$ci->dbforge->add_key('id', TRUE);
			$ci->dbforge->add_key(array('key', 'relpath'));

			$ci->dbforge->create_table('lang');
		}

		return $this->_db;
	}

	// --------------------------------------------------------------------

	/**
	 * Load a language file
	 *
	 * @access	public
	 * @param	mixed	the name of the language file to be loaded. Can be an array
	 * @param	string	the language (english, etc.)
	 * @param	bool	return loaded array of translations
	 * @param 	bool	add suffix to $langfile
	 * @param 	string	alternative path to look for language file
	 * @return	mixed
	 */
	function load($langfile = '', $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '', $_module = '')
	{
		// $ci_lang_load = parent::load($langfile, $idiom, $return, $add_suffix, $alt_path);

		$langfile = str_replace('.php', '', $langfile);

		if ($add_suffix == TRUE)
		{
			$langfile = str_replace('_lang.', '', $langfile).'_lang';
		}

		$langfile .= '.php';

		if (in_array($langfile, $this->db_is_loaded, TRUE))
		{
			return;
		}

		$config =& get_config();

		if ($idiom == '')
		{
			$deft_lang = ( ! isset($config['language'])) ? 'en' : $config['language'];
			$idiom = ($deft_lang == '') ? 'en' : $deft_lang;
		}

		if (!$this->_db)
		{
			$this->get_db();
		}

		if (!$this->_db)
		{
			log_message('error', 'Fatal: database for language could not be defined');
			return $ci_lang_load = call_user_func_array(array($this, 'parent::load'), func_get_args());
		}

		$this->_db->db_select();

		$found = FALSE;
		$lang = array();
		foreach (array('..', CI::$APP->router->fetch_module(), ) as $module)
		{
			$query = $this->_db->get_where('lang', array('relpath' => $module.'/'.ltrim($langfile, '\\/'), ));

			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					if (isset($row->{'lang_'.$idiom}))
					{
						$lang[$row->key] = $row->{'lang_'.$idiom};
						$found ? TRUE : ($found = TRUE);
					}
					elseif (isset($row->{$idiom}))
					{
						$lang[$row->key] = $row->{$idiom};
						$found ? TRUE : ($found = TRUE);
					}
				}
			}
		}

		if ( ! $found)
		{
			log_message('error', 'Language db contains no entry on relpath: '.$langfile);
			return $ci_lang_load = call_user_func_array(array($this, 'parent::load'), func_get_args());
		}

		if ($return)
		{
			// return array_merge($ci_lang_load, $lang);
			return $lang;
		}

		$this->db_is_loaded[] = $langfile;
		$this->language = array_merge($this->language, $lang);
		unset($lang);

		log_message('debug', 'Language db entries loaded: '.$langfile.'; idiom: '.$idiom);
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch a single line of text from the language array
	 *
	 * @access	public
	 * @param	string	$line	the language line
	 * @return	string
	 */
	function line($line = '', $idiom = '')
	{
		$value = ($line == '' OR ! isset($this->language[$line])) ? FALSE : $this->language[$line];

		if ($value === FALSE)
		{
			// Try again on db with only the key
			if (!$this->_db)
			{
				$this->get_db();
			}

			if ( ! empty($this->_db) )
			{

				$this->_db->db_select();

				$query = $this->_db->get_where('lang', array('key' => $line, ), 1);

				if ($query->num_rows() == 1)
				{
					if ($idiom == '')
					{
						$deft_lang = ( ! isset($config['language'])) ? 'en' : $config['language'];
						$idiom = ($deft_lang == '') ? 'en' : $deft_lang;
					}

					if ($idiom != '')
					{
						$row = $query->row();

						if (isset($row->{'lang_'.$idiom}))
						{
							$value = $this->language[$line] = $row->{'lang_'.$idiom};
						}
						elseif (isset($row->{$idiom}))
						{
							$value = $this->language[$line] = $row->{$idiom};
						}
					}
				}

			}
		}

		// Because killer robots like unicorns!
		if ($value === FALSE)
		{
			log_message('error', 'Could not find the language line "'.$line.'"');
		}

		return $value;
	}

}
