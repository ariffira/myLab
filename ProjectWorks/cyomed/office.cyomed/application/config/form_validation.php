<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Form validation
| -------------------------------------------------------------------------
|
*/

$config = array(

  'auth/login' => array(
    array(
      'field' => 'email',
      'label' => 'email',
      'rules' => 'required'
    ),
    array(
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'required',
    ),
  ),

  'auth/change_password' => array(
    array(
      'field' => 'password_old',
      'label' => 'Old Password',
      'rules' => 'required',
    ),
    array(
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'required',
    ),
    array(
      'field' => 'password2',
      'label' => 'Password Repeat',
      'rules' => 'required|matches[password]',
    ),
  ),

  'admin/create_user' => array(
    array(
      'field' => 'email',
      'label' => 'email',
      'rules' => 'required'
    ),
    array(
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'required',
    ),
    array(
      'field' => 'password2',
      'label' => 'Password Repeat',
      'rules' => 'required|matches[password]',
    ),
    array(
      'field' => 'role',
      'label' => 'role',
      'rules' => 'required'
    ),
  ),

  'admin/update_profile' => array(
    array(
      'field' => 'first_name',
      'label' => 'first_name',
    ),
    array(
      'field' => 'last_name',
      'label' => 'last_name',
    ),
  ),

  'admin/package' => array(
    array(
      'field' => 'package_id',
      'label' => 'Id',
      'rules' => 'numeric',
    ),
    array(
      'field' => 'package_for',
      'label' => 'For',
      'rules' => 'numeric|greater_than[0]|less_than[3]',
    ),
    array(
      'field' => 'package_name',
      'label' => 'Name',
      'rules' => 'min_length[0]',
    ),
    array(
      'field' => 'package_intro',
      'label' => 'Intro',
      'rules' => 'min_length[0]',
    ),
    array(
      'field' => 'package_running_time_type',
      'label' => 'Running_time_type',
      'rules' => 'min_length[0]',
    ),
    array(
      'field' => 'package_running_time',
      'label' => 'Running_time',
      'rules' => 'numeric',
    ),
    array(
      'field' => 'package_running_time_quant',
      'label' => 'Running_time_quant',
      'rules' => 'min_length[0]',
    ),
    array(
      'field' => 'package_cancel_buffer_type',
      'label' => 'Cancel_buffer_type',
      'rules' => 'min_length[0]',
    ),
    array(
      'field' => 'package_cancel_buffer',
      'label' => 'Cancel_buffer',
      'rules' => 'numeric',
    ),
    array(
      'field' => 'package_cancel_buffer_quant',
      'label' => 'Cancel_buffer_quant',
      'rules' => 'min_length[0]',
    ),
    array(
      'field' => 'term_id[]',
      'label' => 'Term Id(hidden)',
      'rules' => 'numeric|required',
    ),
    array(
      'field' => 'term_for[]',
      'label' => 'Nested Package ID(hidden)',
      'rules' => 'numeric|required',
    ),
    array(
      'field' => 'term_name[]',
      'label' => 'Name',
      'rules' => 'min_length[0]',
    ),
    array(
      'field' => 'term_intro[]',
      'label' => 'Intro',
      'rules' => 'min_length[0]',
    ),
  ),

  'admin/terms' => array(
    array(
      'field' => 'term_id',
      'label' => 'Id',
      'rules' => 'numeric',
    ),
    array(
      'field' => 'term_name',
      'label' => 'Name',
      'rules' => 'min_length[0]',
    ),
    array(
      'field' => 'term_intro',
      'label' => 'Intro',
      'rules' => 'min_length[0]',
    ),
  ),

);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */