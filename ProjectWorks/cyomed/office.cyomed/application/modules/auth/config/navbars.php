<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| 
|--------------------------------------------------------------------------
|
|
*/

$config['sidebar_9'] = array(
  array('text' => 'Dashboard', 'href' => '#auth/dashboard', 'iclass' => 'fa fa-dashboard', ),

  array('text' => 'ADMIN', 'header' => TRUE, ),

  array('text' => 'Create User', 'href' => '#admin/create_user', 'iclass' => 'fa fa-user-plus',),
  array('text' => 'Admin', 'href' => '#admin/admin', 'iclass' => 'fa fa-user-md',),
  array('text' => 'Patient', 'href' => '#admin/patient', 'iclass' => 'fa fa-wheelchair', ),
  array('text' => 'Doctor', 'href' => '#admin/doctor', 'iclass' => 'fa  fa-stethoscope', ),
  array('text' => 'Reservation', 'href' => '#admin/reservation', 'iclass' => 'fa fa-calendar', ),
  array('text' => 'Email', 'href' => '#admin/email', 'iclass' => 'fa fa-envelope',),
  array('text' => 'Invoice', 'href' => '#admin/invoice','iclass' => 'fa fa-file', ),
  array('text' => 'Template', 'href' => '#admin/template', 'iclass' => 'fa fa-list-alt',),
  array('text' => 'Package', 'href' => '#admin/package', 'iclass' => 'fa fa-euro',),
  array('text' => 'TransStatus', 'href' => '#admin/ts', 'iclass' => 'fa fa-meh-o',),
  array('text' => 'Terms &amp; Services', 'href' => '#admin/terms','iclass' => 'fa fa-book', ),
  array('text' => 'Misc.', 'href' => '#admin/misc','iclass' => 'fa fa-exchange', ),

  array('text' => 'CHATCARE', 'header' => TRUE, ),

  array('text' => 'Care Center', 'href' => '#chatservice/center', 'iclass' => 'fa fa-phone-square', ),
  array('text' => 'My Patients', 'href' => '#chatservice/my_patients', 'iclass' => 'fa fa-users', ),

  array('text' => 'TRANSLATOR', 'header' => TRUE, ),

  array('text' => 'Language Database', 'href' => '#translate/language_db', 'iclass' => 'fa fa-database', ),
  array('text' => 'Language File System', 'href' => '#translate/language_fs', 'iclass' => 'fa fa-language', ),

  array('text' => 'AZTEC', 'header' => TRUE, ),

  array('text' => 'Aztec', 'href' => '#aztec/aztec', 'iclass' => 'fa fa-qrcode', ),
);

$config['sidebar_3'] = array(
  array('text' => 'AZTEC', 'header' => TRUE, ),

  array('text' => 'Aztec', 'href' => '#aztec/aztec', 'iclass' => 'fa fa-qrcode', ),
);

$config['sidebar_2'] = array(
  array('text' => 'CHATCARE', 'header' => TRUE, ),

  array('text' => 'Care Center', 'href' => '#chatservice/center', 'iclass' => 'fa fa-phone-square', ),
  array('text' => 'My Patients', 'href' => '#chatservice/my_patients', 'iclass' => 'fa fa-users', ),
);

$config['sidebar_1'] = array(
  array('text' => 'TRANSLATOR', 'header' => TRUE, ),

  array('text' => 'Language Database', 'href' => '#translate/language_db', 'iclass' => 'fa fa-database', ),
  array('text' => 'Language File System', 'href' => '#translate/language_fs', 'iclass' => 'fa fa-language', ),
);

$config['sidebar'] = $config['sidebars'] = array(
  array('admin' => $config['sidebar_9'], ),
  array('aztec' => $config['sidebar_3'], ),
  array('chatservice' => $config['sidebar_2'], ),
  array('translate' => $config['sidebar_1'], ),
);


/* End of file navbars.php */
/* Location: ./application/config/navbars.php */