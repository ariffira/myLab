<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder/elFinderConnector.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder/elFinder.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder/elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder/elFinderVolumeLocalFileSystem.class.php';
// Files would have connections with DB
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder/elFinderVolumeLocalDBConn.class.php';
// Required for MySQL storage connector
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder/elFinderVolumeMySQL.class.php';
// Required for FTP connector support
// include_once APPPATH.'third_party/elFinder/elFinderVolumeFTP.class.php';

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder/elFinderLocalDBConn.class.php';

class Elfinder_lib {

  public $connector = NULL;

  /**
   * Constructor
   *
   * @access public
   */
  function __construct($opts)
  {
    $this->db_check($opts);

    $this->connector = new elFinderConnector(new elFinderLocalDBConn($opts));
    $this->connector->run();
  }

  /**
   *
   */
  public function db_check($opts)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    // $_ci->load->dbforge();
    // $_ci->dbforge->db =& $_ci->m->port->m;

    foreach ($opts['roots'] as $root)
    {

      if (!$_ci->m->port->m->table_exists( $root['files_table'] ))
      {
        $_ci->m->port->m->db_select();

        $_ci->m->port->m->query(

          'CREATE TABLE IF NOT EXISTS `'.$root['files_table'].'` (
            `id`                INT(7) UNSIGNED NOT NULL auto_increment,
            `owner_id`          INT(7) UNSIGNED NOT NULL,
            `owner_regid`       VARCHAR(256) NOT NULL,
            `owner_is_doctor`   ENUM("1", "0") NOT NULL DEFAULT "0",
            `parent_id`         INT(7) UNSIGNED NOT NULL,
            `name`              VARCHAR(256) NOT NULL,
            `hash`              VARCHAR(256) NOT NULL,
            `phash`             VARCHAR(256) NOT NULL,
            `volumeid`          VARCHAR(256) NOT NULL,
            `mime`              VARCHAR(256) NOT NULL DEFAULT "unknown",
            PRIMARY KEY (`id`),
            UNIQUE KEY  `parent_name` (`parent_id`, `name`),
            KEY         `parent_id`   (`parent_id`)
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci'

        );

        // $_ci->m->port->m->db_select();

        // $_ci->m->port->m->flush_cache();
        // $_ci->m->port->m->set('parent_id', 0);
        // $_ci->m->port->m->set('name', 'DATABASE');
        // $_ci->m->port->m->set('size', 0);
        // $_ci->m->port->m->set('mtime', 0);
        // $_ci->m->port->m->set('mime', 'directory');
        // $_ci->m->port->m->set('read', 1);
        // $_ci->m->port->m->set('write', 1);
        // $_ci->m->port->m->set('locked', 0);
        // $_ci->m->port->m->set('hidden', 0);
        // $_ci->m->port->m->set('width', 0);
        // $_ci->m->port->m->set('height', 0);

        // $_ci->m->port->m->insert('elfinder_files');
      }
      
    }

    return;
  }

}

/* End of file Elfinder_lib.php */
/* Location: ./application/libraries/Elfinder_lib.php */