<?php
/**
 * CodeIgniter.
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
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 *
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH.'third_party/MX/Lang.php';

/**
 * MY_Language Class.
 *
 * @category	Language
 *
 * @author		EllisLab Dev Team
 *
 * @link		http://codeigniter.com/user_guide/libraries/language.html
 */
class MY_Lang extends MX_Lang
{
    /*
     * List of loaded language files
     *
     * @var array
     */
    public $db_is_loaded = array();

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct();
        log_message('info', 'MY_Language Class Initialized');
    }

    // --------------------------------------------------------------------

    /**
     * Load a language file.
     *
     * @param	mixed	the name of the language file to be loaded. Can be an array
     * @param	string	the language (english, etc.)
     * @param	bool	return loaded array of translations
     * @param bool	add suffix to $langfile
     * @param 	string	alternative path to look for language file
     *
     * @return mixed
     */
    public function load($langfile = '', $idiom = '', $return = false, $add_suffix = true, $alt_path = '', $_module = '')
    {
        // $ci_lang_load = parent::load($langfile, $idiom, $return, $add_suffix, $alt_path);

        $langfile = str_replace('.php', '', $langfile);

        if ($add_suffix == true) {
            $langfile = str_replace('_lang.', '', $langfile).'_lang';
        }

        $langfile .= '.php';

        if (in_array($langfile, $this->db_is_loaded, true)) {
            return;
        }

        $config = &get_config();

        if ($idiom == '') {
            $deft_lang = (!isset($config['language'])) ? 'en' : $config['language'];
            $idiom = ($deft_lang == '') ? 'en' : $deft_lang;
        }

        CI::$APP->mod->port->p->db_select();

        if (!CI::$APP->mod->port->p->table_exists('lang')) {
            CI::$APP->load->dbforge();
            CI::$APP->dbforge->db = &CI::$APP->mod->port->p;

            $fields = array(
                'id' => array(
                    'type' => 'BIGINT',
                    'unsigned' => true,
                    'auto_increment' => true,
                ),
                'key' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '128',
                ),
                'relpath' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '64',
                ),
                'lang_en' => array(
                    'type' => 'TEXT',
                ),
                'lang_de' => array(
                    'type' => 'TEXT',
                ),
            );

            CI::$APP->dbforge->add_field($fields);

            CI::$APP->dbforge->add_key('id', true);
            CI::$APP->dbforge->add_key(array('key', 'relpath'));

            CI::$APP->dbforge->create_table('lang');
        }

        $found = false;
        $lang = array();
        foreach (array('..', CI::$APP->router->fetch_module()) as $module) {
            $query = CI::$APP->mod->port->p->get_where('lang', array('relpath' => $module.'/'.ltrim($langfile, '\\/')));

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    if (isset($row->{'lang_'.$idiom})) {
                        $lang[$row->key] = $row->{'lang_'.$idiom};
                        $found ? true : ($found = true);
                    } elseif (isset($row->{$idiom})) {
                        $lang[$row->key] = $row->{$idiom};
                        $found ? true : ($found = true);
                    }
                }
            }
        }

        if (!$found) {
            log_message('error', 'Language db contains no entry on relpath: '.$langfile);

            return $ci_lang_load = call_user_func_array(array($this, 'parent::load'), func_get_args());
        }

        if ($return) {
            // return array_merge($ci_lang_load, $lang);
            return $lang;
        }

        $this->db_is_loaded[] = $langfile;
        $this->language = array_merge($this->language, $lang);
        unset($lang);

        log_message('debug', 'Language db entries loaded: '.$langfile.'; idiom: '.$idiom);

        return true;
    }

    // --------------------------------------------------------------------

    /**
     * Fetch a single line of text from the language array.
     *
     * @param string $line the language line
     *
     * @return string
     */
    public function line($line = '', $idiom = '')
    {
        $value = ($line == '' or !isset($this->language[$line])) ? false : $this->language[$line];

        if ($value === false) {
            // Try again on db with only the key
            CI::$APP->mod->port->p->db_select();
            $query = CI::$APP->mod->port->p->get_where('lang', array('key' => $line), 1);

            if ($query->num_rows() == 1) {
                if ($idiom == '') {
                    $deft_lang = (!isset($config['language'])) ? 'en' : $config['language'];
                    $idiom = ($deft_lang == '') ? 'en' : $deft_lang;
                }

                if ($idiom != '') {
                    $row = $query->row();

                    if (isset($row->{'lang_'.$idiom})) {
                        $value = $this->language[$line] = $row->{'lang_'.$idiom};
                    } elseif (isset($row->{$idiom})) {
                        $value = $this->language[$line] = $row->{$idiom};
                    }
                }
            }
        }

        // Because killer robots like unicorns!
        if ($value === false) {
            log_message('error', 'Could not find the language line "'.$line.'"');
        }

        return $value;
    }
}
