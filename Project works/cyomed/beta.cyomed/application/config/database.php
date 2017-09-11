<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'personal';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = '';
$db['default']['password'] = '';
$db['default']['database'] = '';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

$db['bare']['hostname'] = 'localhost';
$db['bare']['username'] = 'webadmin';
$db['bare']['password'] = 'wyYhj&fHrZTre!&8';
$db['bare']['database'] = 'prelaunch_ihrarzt24';
$db['bare']['dbdriver'] = 'mysql';
$db['bare']['dbprefix'] = 'ia24at_';
$db['bare']['pconnect'] = FALSE;
$db['bare']['db_debug'] = TRUE;
$db['bare']['cache_on'] = FALSE;
$db['bare']['cachedir'] = '';
$db['bare']['char_set'] = 'utf8';
$db['bare']['dbcollat'] = 'utf8_general_ci';
$db['bare']['swap_pre'] = '';
$db['bare']['autoinit'] = TRUE;
$db['bare']['stricton'] = FALSE;

$db['medical']['hostname'] = 'localhost';
$db['medical']['username'] = 'webadmin';
$db['medical']['password'] = 'wyYhj&fHrZTre!&8';
$db['medical']['database'] = 'prelaunch_ihrarzt24_medical';
$db['medical']['dbdriver'] = 'mysql';
$db['medical']['dbprefix'] = '';
$db['medical']['pconnect'] = FALSE;
$db['medical']['db_debug'] = TRUE;
$db['medical']['cache_on'] = FALSE;
$db['medical']['cachedir'] = '';
$db['medical']['char_set'] = 'utf8';
$db['medical']['dbcollat'] = 'utf8_general_ci';
$db['medical']['swap_pre'] = '';
$db['medical']['autoinit'] = TRUE;
$db['medical']['stricton'] = FALSE;

$db['personal']['hostname'] = 'localhost';
$db['personal']['username'] = 'webadmin';
$db['personal']['password'] = 'wyYhj&fHrZTre!&8';
$db['personal']['database'] = 'prelaunch_ihrarzt24_personal';
$db['personal']['dbdriver'] = 'mysql';
$db['personal']['dbprefix'] = '';
$db['personal']['pconnect'] = FALSE;
$db['personal']['db_debug'] = TRUE;
$db['personal']['cache_on'] = FALSE;
$db['personal']['cachedir'] = '';
$db['personal']['char_set'] = 'utf8';
$db['personal']['dbcollat'] = 'utf8_general_ci';
$db['personal']['swap_pre'] = '';
$db['personal']['autoinit'] = TRUE;
$db['personal']['stricton'] = FALSE;

$db['drugbank']['hostname'] = 'localhost';
$db['drugbank']['username'] = 'webadmin';
$db['drugbank']['password'] = 'wyYhj&fHrZTre!&8';
$db['drugbank']['database'] = 'prelaunch_ihrarzt24_drugbank';
$db['drugbank']['dbdriver'] = 'mysql';
$db['drugbank']['dbprefix'] = '';
$db['drugbank']['pconnect'] = FALSE;
$db['drugbank']['db_debug'] = TRUE;
$db['drugbank']['cache_on'] = FALSE;
$db['drugbank']['cachedir'] = '';
$db['drugbank']['char_set'] = 'utf8';
$db['drugbank']['dbcollat'] = 'utf8_general_ci';
$db['drugbank']['swap_pre'] = '';
$db['drugbank']['autoinit'] = TRUE;
$db['drugbank']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */