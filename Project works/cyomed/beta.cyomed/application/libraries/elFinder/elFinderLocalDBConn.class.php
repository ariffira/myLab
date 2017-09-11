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
 * 
 *
 * @package     
 * @subpackage  
 * @category    
 * @author      
 * @link        
 */
class elFinderLocalDBConn extends elFinder {

  // ------------------------------------------------------------------------

  /**
   * Constructor
   *
   * @param  array  elFinder and roots configurations
   * @return void
   * @author Dmitry (dio) Levashov
   **/
  public function __construct($opts)
  {
    return parent::__construct($opts);
  }

  /**
   * "Open" directory
   * Return array with following elements
   *  - cwd          - opened dir info
   *  - files        - opened dir content [and dirs tree if $args[tree]]
   *  - api          - api version (if $args[init])
   *  - uplMaxSize   - if $args[init]
   *  - error        - on failed
   *
   * @param  array  command arguments
   * @return array
   * @author Dmitry (dio) Levashov
   **/
  protected function open($args)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = parent::open($args);

    $cwd = $result['cwd'];
    $files = $result['files'];
    $init = empty($args['init']) ? TRUE : FALSE;

    // var_dump($result);

    // $_ci->m->port->m->db_select();

    // foreach ($files as $file)
    // {
    //   $_ci->m->port->m->get_where($this->options['files_table'], array(
    //     'phash' => $file['phash'],
    //     'hash' => $file['hash'],
    //   ), 1);

    //   if ($_ci->m->port->m->num_rows() <= 0)
    //   {
    //     $_ci->m->port->m->set('owner_id'          , $file['owner_id'] );
    //     $_ci->m->port->m->set('owner_regid'       , $file['owner_regid'] );
    //     $_ci->m->port->m->set('owner_is_doctor'   , $file['owner_is_doctor'] );
    //     $_ci->m->port->m->set('parent_id'         , $file['parent_id'] );
    //     $_ci->m->port->m->set('name'              , $file['name'] );
    //     $_ci->m->port->m->set('hash'              , $file['hash'] );
    //     $_ci->m->port->m->set('phash'             , $file['phash'] );
    //     $_ci->m->port->m->set('volumeid'          , $file['volumeid'] );
    //     $_ci->m->port->m->set('mime'              , $file['mime'] );
    //   }


    // }

    // $_ci->m->port->m->get_where($this->options['files_table'], array('phash' => $cwd['hash']) );


    return $result;
  }

  /**
   * Required to output file in browser when volume URL is not set 
   * Return array contains opened file pointer, root itself and required headers
   *
   * @param  array  command arguments
   * @return array
   * @author Dmitry (dio) Levashov
   **/
  protected function file($args)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = parent::file($args);

    return $result;
  }

  /**
   * Create directory
   *
   * @param  array  command arguments
   * @return array
   * @author Dmitry (dio) Levashov
   **/
  protected function mkdir($args) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = parent::mkdir($args);

    return $result;
  }
  
  /**
   * Create empty file
   *
   * @param  array  command arguments
   * @return array
   * @author Dmitry (dio) Levashov
   **/
  protected function mkfile($args) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = parent::mkfile($args);

    return $result;
  }
  
  /**
   * Rename file
   *
   * @param  array  $args
   * @return array
   * @author Dmitry (dio) Levashov
   **/
  protected function rename($args) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = parent::rename($args);

    return $result;
  }
  
  /**
   * Duplicate file - create copy with "copy %d" suffix
   *
   * @param array  $args  command arguments
   * @return array
   * @author Dmitry (dio) Levashov
   **/
  protected function duplicate($args) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = parent::duplicate($args);

    return $result;
  }
    
  /**
   * Remove dirs/files
   *
   * @param array  command arguments
   * @return array
   * @author Dmitry (dio) Levashov
   **/
  protected function rm($args) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = parent::rm($args);

    return $result;
  }
  
  /**
   * Save uploaded files
   *
   * @param  array
   * @return array
   * @author Dmitry (dio) Levashov
   **/
  protected function upload($args) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = parent::upload($args);

    return $result;
  }
    
  /**
   * Copy/move files into new destination
   *
   * @param  array  command arguments
   * @return array
   * @author Dmitry (dio) Levashov
   **/
  protected function paste($args) {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = parent::paste($args);

    return $result;
  }

}