<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Form validation
| -------------------------------------------------------------------------
|
*/

$config = array(

  /*
  | -------------------------------------------------------------------------
  | Login & Registration
  | -------------------------------------------------------------------------
  |
  */  

  'login' => array(
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|valid_email'
    ),
    array(
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'required',
    ),
  ),

  'docreg' => array(
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|valid_email',
    ),
    array(
      'field' => 'first_name',
      'label' => 'Vorname',
      'rules' => 'required|min_length[1]',
    ),
    array(
      'field' => 'last_name',
      'label' => 'Nachname',
      'rules' => 'required|min_length[1]',
    ),
    array(
      'field' => 'gender',
      'label' => 'Geschlecht',
      'rules' => 'required|greater_than[0]|less_than[3]',
    ),
    array(
      'field' => 'academic_grade',
      'label' => 'Akademischer Grad',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'password',
      'label' => 'Passwort',
      'rules' => 'required|min_length[1]',
    ),
    array(
      'field' => 'password2',
      'label' => 'Passwort wiederholen',
      'rules' => 'required|matches[password]',
    ),
    array(
      'field' => 'speciality[]',
      'label' => 'Fachrichtung',
      'rules' => 'numeric',
    ),
    array(
      'field' => 'speciality_additional[]',
      'label' => 'Zusatzbezeichnung',
      'rules' => 'numeric',
    ),
    array(
      'field' => 'mobile',
      'label' => 'Handynummer',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'telephone',
      'label' => 'Telefonnummer',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'fax',
      'label' => 'Faxnummer',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'street',
      'label' => 'Straße',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'street_additional',
      'label' => 'Adresszusatz',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'postal_code',
      'label' => 'PLZ',
      'rules' => 'numeric|min_length[3]',
    ),
    array(
      'field' => 'locality',
      'label' => 'Stadt',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'region',
      'label' => 'Region',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'country',
      'label' => 'Land',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'website',
      'label' => 'Webseite',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'emergency_number',
      'label' => 'Notfallnummer',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'terms',
      'label' => 'Datenschutzbestimmungen',
      'rules' => 'required|greater_than[0]|less_than[2]',
    ),

  ),

  'patreg' => array(
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|valid_email',
    ),
    array(
      'field' => 'first_name',
      'label' => 'Vorname',
      'rules' => 'required|min_length[1]',
    ),
    array(
      'field' => 'last_name',
      'label' => 'Nachname',
      'rules' => 'required|min_length[1]',
    ),
    array(
      'field' => 'gender',
      'label' => 'Geschlecht',
      'rules' => 'required|greater_than[0]|less_than[3]',
    ),
    array(
      'field' => 'academic_grade',
      'label' => 'Akademischer Grad',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'password',
      'label' => 'Passwort',
      'rules' => 'required|min_length[1]',
    ),
    array(
      'field' => 'password2',
      'label' => 'Passwort wiederholen',
      'rules' => 'required|matches[password]',
    ),
    array(
      'field' => 'birthday',
      'label' => 'Geburtstag',
      'rules' => 'required',
    ),
    array(
      'field' => 'mobile',
      'label' => 'Handynummer',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'telephone',
      'label' => 'Telefonnummer',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'fax',
      'label' => 'Faxnummer',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'street',
      'label' => 'Straße',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'street_additional',
      'label' => 'Adresszusatz',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'postal_code',
      'label' => 'PLZ',
      'rules' => 'numeric|min_length[3]',
    ),
    array(
      'field' => 'locality',
      'label' => 'Stadt',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'region',
      'label' => 'Region',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'country',
      'label' => 'Land',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'website',
      'label' => 'Webseite',
      'rules' => 'min_length[1]',
    ),
    array(
      'field' => 'terms',
      'label' => 'Bestimmungen',
      'rules' => 'required|greater_than[0]|less_than[2]',
    ),

  ),


);

/* End of file form_validation.php */
/* Location: ./application/modules/portal/config/form_validation.php */