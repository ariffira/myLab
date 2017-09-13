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
$_ci->load->language('global/general_text',$_ci->m->lang);
$_ci->load->language('global/overview',$_ci->m->lang);

    
   
$config['sa103::sidenav'] = array(
	'overview' => array(
		'title' => $_ci->lang->line('overview_lang_title'),
		'class' => 'sa-side-home',
		'url' => 'akte/overview/timeline',
		'icon' => '',
	),
	// 'portal' => array(
	// 	'title' => 'Portal'
	// 	'class' => 'sa-side-typography'
	// 	'url' =>  'akte/portal'
	// 	'icon' => '',
	// ),
	'condition' => array(
		'title' => $_ci->lang->line('overview_lang_condition_title'),
		'class' => 'sa-side-widget',
		'url' => 'akte/condition',
		'icon' => '',
	),
	'diagnosis' => array(
		'title' => $_ci->lang->line('overview_lang_diagnosis_title'),
		'class' => 'sa-side-table',
		'url' => 'akte/diagnosis',
		'icon' => '',
	),
	'medication' => array(
		'title' => $_ci->lang->line('overview_lang_medication_title'),
		'class' => 'sa-side-form',
		'url' => 'akte/medication',
		'icon' => '',
	),
	// 'treatments' => array(
	// 	'title' => 'Behandlungen',
	// 	'class' => 'sa-side-ui',
	// 	'url' => 'akte/treatments',
	// 	'icon' => '',
	// ),
	'vaccination' => array(
		'title' => $_ci->lang->line('overview_lang_blood_vaccination_title'),
		'class' => 'sa-side-photos',
		'url' => 'akte/vaccination',
		'icon' => '',
	),
     
	'vital_values' => array(
		'title' => $_ci->lang->line('overview_lang_vital_signs_title'),
		'class' => 'sa-side-chart',
		'url' => 'akte/vital_values',
		'icon' => '',
		'sub' => array(
			'vital_values' => array(
				'title' => $_ci->lang->line('overview_lang_vital_signs_title'),
				'url' => 'akte/vital_values',
				'icon' => '',
			),
			'blood_pressure' => array(
				'title' => $_ci->lang->line('overview_lang_blood_pressure_title'),
				'url' => 'akte/vital_values/blood_pressure',
				'icon' => '',
			),
			'blood_sugar' => array(
				'title' => $_ci->lang->line('overview_lang_blood_sugar_title'),
				'url' => 'akte/vital_values/blood_sugar',
				'icon' => '',
			),
			'weight_bmi' => array(
				'title' => $_ci->lang->line('overview_lang_blood_bmi_title'),
				'url' => 'akte/vital_values/weight_bmi',
				'icon' => '',
			),
			'marcumar' => array(
				'title' => $_ci->lang->line('overview_lang_blood_marcumar_title'),
				'url' => 'akte/vital_values/marcumar',
				'icon' => '',
			),
		),
	),
	'document' => array(
		'title' => $_ci->lang->line('overview_lang_blood_document_title'),
		'class' => 'sa-side-folder',
		'url' => 'akte/document',
		'icon' => '',
	),

	'econsult' => array(
		'title' => $_ci->lang->line('overview_lang_blood_econsult_title'),
		'class' => 'sa-side-page',
		'url' => 'akte/econsult',
		'icon' => '',
	),
	'rezept'	=>array(
		'title'	=> $_ci->lang->line('overview_lang_blood_epres_title'),
		'class'	=> 'sa-side-page',
		'url'	=> 'akte/rezept',
		'icon'	=> '',
		),

);
 if($_ci->m->user_role() == M::ROLE_DOCTOR){
$config['mvpr110::sidenav'] = array(
	'overview' => array(
		'title' => $_ci->lang->line('overview_lang_title'),
		'class' => 'sa-side-home',
		'url' => 'akte/overview/timeline',
		'icon' => '',
		// 'sub' => array(
		// 	'condition' => array(
		// 		'title' => 'Übersicht_old',
		// 		'class' => 'sa-side-widget',
		// 		'url' => 'akte/overview/index',
		// 		'icon' => '',
		// 	),
		// 	'diagnosis' => array(
		// 		'title' => 'Übersicht_timeline',
		// 		'class' => 'sa-side-table',
		// 		'url' => 'akte/overview/timeline',
		// 		'icon' => '',
		// 	),
		// ),
	),
	'akte' => array(
		'title' => $_ci->lang->line('overview_lang_record_title'),
		'class' => 'sa-side-chart',
		'url' => '#',
		'icon' => '',
		'sub' => array(
			'condition' => array(
				'title' => $_ci->lang->line('overview_lang_condition_title'),
				'class' => 'sa-side-widget',
				'url' => 'akte/condition',
				'icon' => '',
			),
			'diagnosis' => array(
				'title' => $_ci->lang->line('overview_lang_diagnosis_title'),
				'class' => 'sa-side-table',
				'url' => 'akte/diagnosis',
				'icon' => '',
			),
			'medication' => array(
				'title' => $_ci->lang->line('overview_lang_medication_title'),
				'class' => 'sa-side-form',
				'url' => 'akte/medication',
				'icon' => '',
			),
			'vaccination' => array(
				'title' => $_ci->lang->line('overview_lang_blood_vaccination_title'),
				'class' => 'sa-side-photos',
				'url' => 'akte/vaccination',
				'icon' => '',
			),
                     
			'videochat' => array(
				'title' => $_ci->lang->line('overview_lang_chat_title'),
				'class' => 'sa-side-photos',
				'url' => 'akte/videochat',
				'icon' => '',
			), 
                ),
	),
	'vital_values' => array(
		'title' => $_ci->lang->line('overview_lang_vital_signs_title'),
		'class' => 'sa-side-chart',
		'url' => 'akte/vital_values',
		'icon' => '',
		'sub' => array(
			'vital_values' => array(
				'title' => $_ci->lang->line('overview_lang_vital_signs_title'),
				'url' => 'akte/vital_values',
				'icon' => '',
			),
			'blood_pressure' => array(
				'title' => $_ci->lang->line('overview_lang_blood_pressure_title'),
				'url' => 'akte/vital_values/blood_pressure',
				'icon' => '',
			),
			'blood_sugar' => array(
				'title' => $_ci->lang->line('overview_lang_blood_sugar_title'),
				'url' => 'akte/vital_values/blood_sugar',
				'icon' => '',
			),
			'weight_bmi' => array(
				'title' => $_ci->lang->line('overview_lang_blood_bmi_title'),
				'url' => 'akte/vital_values/weight_bmi',
				'icon' => '',
			),
			'marcumar' => array(
				'title' => $_ci->lang->line('overview_lang_blood_marcumar_title'),
				'url' => 'akte/vital_values/marcumar',
				'icon' => '',
			),
		),
	),
	'document' => array(
		'title' => $_ci->lang->line('overview_lang_blood_document_title'),
		'class' => 'sa-side-folder',
		'url' => 'akte/document',
		'icon' => '',
	),

	'econsult' => array(
		'title' => $_ci->lang->line('overview_lang_blood_econsult_title'),
		'class' => 'sa-side-page',
		'url' => 'akte/econsult',
		'icon' => '',
	),
	'rezept'	=>array(
		'title'	=> $_ci->lang->line('overview_lang_blood_epres_title'),
		'class'	=> 'sa-side-page',
		'url'	=> 'rezept',
		'icon'	=> '',
		'not_ajax' => TRUE, 
		),

);
 }
 else
 {
 $config['mvpr110::sidenav'] = array(
	'overview' => array(
		'title' => $_ci->lang->line('overview_lang_title'),
		'class' => 'sa-side-home',
		'url' => 'akte/overview/timeline',
		'icon' => '',
		// 'sub' => array(
		// 	'condition' => array(
		// 		'title' => 'Übersicht_old',
		// 		'class' => 'sa-side-widget',
		// 		'url' => 'akte/overview/index',
		// 		'icon' => '',
		// 	),
		// 	'diagnosis' => array(
		// 		'title' => 'Übersicht_timeline',
		// 		'class' => 'sa-side-table',
		// 		'url' => 'akte/overview/timeline',
		// 		'icon' => '',
		// 	),
		// ),
	),
	'akte' => array(
		'title' => $_ci->lang->line('overview_lang_record_title'),
		'class' => 'sa-side-chart',
		'url' => '#',
		'icon' => '',
		'sub' => array(
			'condition' => array(
				'title' => $_ci->lang->line('overview_lang_condition_title'),
				'class' => 'sa-side-widget',
				'url' => 'akte/condition',
				'icon' => '',
			),
			'diagnosis' => array(
				'title' => $_ci->lang->line('overview_lang_diagnosis_title'),
				'class' => 'sa-side-table',
				'url' => 'akte/diagnosis',
				'icon' => '',
			),
			'medication' => array(
				'title' => $_ci->lang->line('overview_lang_medication_title'),
				'class' => 'sa-side-form',
				'url' => 'akte/medication',
				'icon' => '',
			),
			'vaccination' => array(
				'title' => $_ci->lang->line('overview_lang_blood_vaccination_title'),
				'class' => 'sa-side-photos',
				'url' => 'akte/vaccination',
				'icon' => '',
			),
                     
			'videochat' => array(
				'title' => $_ci->lang->line('overview_lang_chat_title'),
				'class' => 'sa-side-photos',
				'url' => 'akte/videochat',
				'icon' => '',
			), 
                       'smokingstatus' => array(
		         'title' =>$_ci->lang->line('overview_lang_smoking_status_title'),
		         'class' => 'sa-side-photos',
		         'url' => 'akte/smokingstatus',
		         'icon' => '',
	                  ),
                    'familyhistory' => array(
		         'title' => $_ci->lang->line('overview_lang_family_history_status_title'),
		         'class' => 'sa-side-photos',
		         'url' => 'akte/familyhistory',
		         'icon' => '',
	                  ),
                ),
	),
	'vital_values' => array(
		'title' => $_ci->lang->line('overview_lang_vital_signs_title'),
		'class' => 'sa-side-chart',
		'url' => 'akte/vital_values',
		'icon' => '',
		'sub' => array(
			'vital_values' => array(
				'title' => $_ci->lang->line('overview_lang_vital_signs_title'),
				'url' => 'akte/vital_values',
				'icon' => '',
			),
			'blood_pressure' => array(
				'title' => $_ci->lang->line('overview_lang_blood_pressure_title'),
				'url' => 'akte/vital_values/blood_pressure',
				'icon' => '',
			),
			'blood_sugar' => array(
				'title' => $_ci->lang->line('overview_lang_blood_sugar_title'),
				'url' => 'akte/vital_values/blood_sugar',
				'icon' => '',
			),
			'weight_bmi' => array(
				'title' => $_ci->lang->line('overview_lang_blood_bmi_title'),
				'url' => 'akte/vital_values/weight_bmi',
				'icon' => '',
			),
			'marcumar' => array(
				'title' => $_ci->lang->line('overview_lang_blood_marcumar_title'),
				'url' => 'akte/vital_values/marcumar',
				'icon' => '',
			),
		),
	),
	'document' => array(
		'title' => $_ci->lang->line('overview_lang_blood_document_title'),
		'class' => 'sa-side-folder',
		'url' => 'akte/document',
		'icon' => '',
	),
	// 'timeline' => array(
	// 	'title' => 'Zeitleiste',
	// 	'class' => 'sa-side-calendar',
	// 	'url' => 'akte/timeline',
	// 	'icon' => '',
	// ),
	'econsult' => array(
		'title' => $_ci->lang->line('overview_lang_blood_econsult_title'),
		'class' => 'sa-side-page',
		'url' => 'akte/econsult',
		'icon' => '',
	),
	'rezept'	=>array(
		'title'	=> $_ci->lang->line('overview_lang_blood_epres_title'),
		'class'	=> 'sa-side-page',
		'url'	=> 'rezept',
		'icon'	=> '',
		'not_ajax' => TRUE, 
		),

);    
 }

$config['sidenav'] = $config['sa103::sidenav'];


/* End of file ia24ui.php */
/* Location: ./application/modules/akte/config/ia24ui.php */
