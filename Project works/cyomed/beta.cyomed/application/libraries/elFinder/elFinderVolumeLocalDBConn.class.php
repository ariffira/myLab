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
class elFinderVolumeLocalDBConn extends elFinderVolumeLocalFileSystem {
  
  /**
   * Constructor
   * Extend options with required fields
   *
   * @return void
   * @author Dmitry (dio) Levashov
   **/
  public function __construct() {
    parent::__construct();

    $this->options['alias']    = '';              // alias to replace root dir name
    $this->options['dirMode']  = 0777;            // new dirs mode
    $this->options['fileMode'] = 0644;            // new files mode
    $this->options['quarantine'] = '.quarantine';  // quarantine folder name - required to check archive (must be hidden)
    $this->options['maxArcFilesSize'] = 0;        // max allowed archive files size (0 - no limit)
  }
  
}
