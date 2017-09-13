<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| CONFIGURATION for Cyomed UI
|--------------------------------------------------------------------------
| configuration variables
|
*/

/*
|--------------------------------------------------------------------------
| navigation array config
|--------------------------------------------------------------------------
|
| ex:
| 'dashboard' => array(
| 	'title' => 'Display Title',
| 	'url' => 'http://yoururl.com',
| 	'url_target' => '_blank',
| 	'icon' => 'fa fa-home',
| 	'label_htm' => '<span>Add your custom label/badge html here</span>',
| 	'sub' => array() //contains array of sub items with the same format as the parent
| )
|
*/

//loading languages
$_ci =& get_instance();
$_ci->load->language('eprescription/epres',$_ci->m->user_value('language'));

$config['sa103::sidenav'] = array(
	'akte' => array(
		'title' => $_ci->lang->line('epres_go_back_2_akte'),
		'class' => 'sa-side-page',
		'url' => 'akte',
		'icon'	=> '',
		'not_ajax' => TRUE, 
	),
	'rezept'	=>array(
		'title'	=> $_ci->lang->line('epres_online_eprescription'),
		'class'	=> 'sa-side-page',
		'url'	=> 'rezept',
		'icon'	=> '',
		),

);

$config['mvpr110::sidenav'] = array(
	'akte' => array(
		'title' => $_ci->lang->line('epres_go_back_2_akte'),
		'class' => 'sa-side-page',
		'url' => 'akte',
		'icon'	=> '',
		'not_ajax' => TRUE, 
	),
	'rezept'	=>array(
		'title'	=> $_ci->lang->line('epres_online_eprescription'),
		'class'	=> 'sa-side-page',
		'url'	=> 'rezept',
		'icon'	=> '',
		),

);

$config['sidenav'] = $config['sa103::sidenav'];


/* End of file ia24ui.php */
/* Location: ./application/modules/akte/config/ia24ui.php */