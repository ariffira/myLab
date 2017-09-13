<?php
 if (!defined('BASEPATH')) {
     exit('No direct script access allowed');
 }
/*
 * IhrArzt24
 *
 *
 * @package     IhrArzt24
 * @author      D.LEI
 * @copyright   
 * @license     http://ihrarzt24.de/api_guide/license.html
 * @link        http://ihrarzt24.de
 * @since       Version 1.0
 * @filesource  
 */

// ------------------------------------------------------------------------

/*
 * IhrArzt24 HTML Helpers
 *
 * @package     IhrArzt24
 * @subpackage  Helpers
 * @category    Helpers
 * @author      D.LEI
 * @link        http://ihrarzt24.de/api_guide/helpers/html_helper.html
 */

// ------------------------------------------------------------------------

/*
 * Text field
 */
if (!function_exists('text_field')) {
    function text_field($value, $field = null, $scope = null)
    {
        $field = $field ? $field : '';
        $scope = $scope ? $scope : '';
        $gen_id = random_string('alnum', 16);
        $ret = '';
        $ret .= '<span class="" id="'.$gen_id.'">'.form_prep($value).'</span> ';
        $ret .= '<button type="button" class="btn btn-xs '.($value ? 'btn-warning' : 'btn-info').'" ';
        $ret .= 'data-apply-field="'.$field.'" data-apply-value="'.form_prep($value).'" data-apply-scope="'.$scope.'" data-input-target="#'.$gen_id.'"';
        $ret .= '>';
        $ret .= '<span class="icomoon i-marker-2"></span> Edit';
        $ret .= '</button> ';

        return $ret;
    }
}

/*
 * Activated/deactivated field
 */
if (!function_exists('activation_field')) {
    function activation_field($value, $field = null, $scope = null)
    {
        $field = $field ? $field : '';
        $scope = $scope ? $scope : '';
        $ret = '';
        $ret .= '<span class="'.($value ? 'text-success' : 'text-danger').'">'.($value ? 'Activated' : 'Deactivated').'</span> ';
        $ret .= '<button type="button" class="btn btn-xs '.($value ? 'btn-danger' : 'btn-success').'" ';
        $ret .= 'data-apply-field="'.$field.'" data-apply-value="'.($value ? '0' : '1').'" data-apply-scope="'.$scope.'"';
        $ret .= '>';
        $ret .= $value ? 'Deactivate' : 'Activate';
        $ret .= '</button> ';

        return $ret;
    }
}

/*
 * Country field
 */
if (!function_exists('country_field')) {
    function country_field($value, $field = null, $scope = null)
    {
        static $_ci, $_info;
        $_ci = &get_instance();
        $_ci->load->model('mcountry');
        $_info = $_ci->mcountry->get();

        $ret = '';
        $ret .= '<select class="form-control input-sm" ';
        $ret .= 'data-apply-field="'.$field.'" data-apply-value="'.$value.'" data-apply-scope="'.$scope.'"';
        $ret .= '>';
        $ret .= '<option >not selected</option>';
        foreach ($_info as $row) {
            $ret .= '<option value="'.$row->id.'" '.($value == $row->id ? 'selected="selected"' : '').' >';
            $ret .= $row->country_name.' - '.$row->{'Alpha-2_code'}.' - '.$row->{'Alpha-3_code'};
            $ret .= '</option>';
        }
        $ret .= '</select>';

        return $ret;
    }
}

/*
 * Speciality field
 */
if (!function_exists('speciality_field')) {
    function speciality_field($value, $field = null, $scope = null)
    {
        static $_ci, $_info;
        $_ci = &get_instance();
        $_ci->load->model('speciality');
        $_info = $_ci->speciality->get()->result();
        $field = $field ? $field : '';
        $scope = $scope ? $scope : '';
        $value = explode(',', $value);

        $ret = '';
        $ret .= '<select class="bs-form-control chosen-select" ';
        $ret .= 'data-apply-field="'.$field.'" data-apply-value="'.implode(',', $value).'" data-apply-scope="'.$scope.'"';
        $ret .= 'multiple="multiple">';
        $ret .= '<option >not selected</option>';
        foreach ($_info as $row) {
            $ret .= '<option value="'.$row->code.'" '.(in_array($row->code, $value) ? 'selected="selected"' : '').' >';
            $ret .= $row->name;
            $ret .= '</option>';
        }
        $ret .= '</select>';

        return $ret;
    }
}

/*
 * Access permision field
 */
if (!function_exists('access_permission_field')) {
    function access_permission_field($value, $field = null, $scope = null)
    {
        $field = $field ? $field : '';
        $scope = $scope ? $scope : '';

        $ret = '';
        $ret .= '<select class="form-control input-sm" ';
        $ret .= 'data-apply-field="'.$field.'" data-apply-value="'.$value.'" data-apply-scope="'.$scope.'"';
        $ret .= '>';
        foreach (array(0 => 'Private', 1 => 'My Doctors', 2 => 'All Doctors') as $option_value => $option_text) {
            $ret .= '<option value="'.$option_value.'" '.($value == $option_value ? 'selected="selected"' : '').' >';
            $ret .= $option_text;
            $ret .= '</option>';
        }
        $ret .= '</select>';

        return $ret;
    }
}

/*
 * Access permision field: doctor
 */
if (!function_exists('doctor_package_field')) {
    function doctor_package_field($value, $field = null, $scope = null)
    {
        static $_ci, $_packs;
        $_ci = &get_instance();
        $_ci->mod->port->p->where('for', 2);
        $_packs = $_ci->mopack->get_list();
        $_ci->lang->load('package');
        $field = $field ? $field : '';
        $scope = $scope ? $scope : '';

        $ret = '';
        $ret .= '<select class="form-control input-sm" ';
        $ret .= 'data-apply-field="'.$field.'" data-apply-value="'.$value.'" data-apply-scope="'.$scope.'"';
        $ret .= '>';
        $ret .= '<option >not selected</option>';
        foreach ($_packs as $row) {
            $ret .= '<option value="'.$row->name.'" '.($value == $row->name ? 'selected="selected"' : '').' >';
            $ret .= $_ci->lang->line('package_'.$row->name) ? $_ci->lang->line('package_'.$row->name) : $row->display_name;
            $ret .= '</option>';
        }
        $ret .= '</select>';

        return $ret;
    }
}

/*
 * Access permision field: patient
 */
if (!function_exists('patient_package_field')) {
    function patient_package_field($value, $field = null, $scope = null)
    {
        static $_ci, $_packs;
        $_ci = &get_instance();
        $_ci->mod->port->p->where('for', 1);
        $_packs = $_ci->mopack->get_list();
        $_ci->lang->load('package');
        $field = $field ? $field : '';
        $scope = $scope ? $scope : '';

        $ret = '';
        $ret .= '<select class="form-control input-sm" ';
        $ret .= 'data-apply-field="'.$field.'" data-apply-value="'.$value.'" data-apply-scope="'.$scope.'"';
        $ret .= '>';
        $ret .= '<option >not selected</option>';
        foreach ($_packs as $row) {
            $ret .= '<option value="'.$row->name.'" '.($value == $row->name ? 'selected="selected"' : '').' >';
            $ret .= $_ci->lang->line('package_'.$row->name) ? $_ci->lang->line('package_'.$row->name) : $row->display_name;
            $ret .= '</option>';
        }
        $ret .= '</select>';

        return $ret;
    }
}

/* End of file MY_html_helper.php */
/* Location: ./application/helpers/MY_html_helper.php */
