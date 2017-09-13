<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller {

  /**
   *
   */
  public function index($active_tab='')
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
  	$this->ui->mc->base_init();
    $this->load->model('insurance_provider');
    $insurance_provider = $this->insurance_provider->get()->result();
            
    /*** for adding header***/
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    {
     
    }
    else
    {
     $this->config->load('ia24ui', TRUE, TRUE);
     $this->ui->html
                ->base_init()
                ->load_config('html');
     $this->ui->html
                    ->set_active_url('akte/profile');
    }
    /***end here***/
    //loading languages
    $_ci->load->language('global/general_text',$this->m->user_value('language'));
    $_ci->load->language('pwidgets/my_account', $this->m->user_value('language'));
    $_ci->load->language('pwidgets/profile', $this->m->user_value('language'));
    //$_ci->load->language('termin/language/calendar', $this->m->user_value('language'));
    //$_ci->load->language('termin/language/appointment', $this->m->user_value('language'));
    
    $output = '';
    Modules::run('akte/access/index');
    $output .= $this->output->get_output();
          
    if ($this->m->user_role() == M::ROLE_DOCTOR)
	    $doctors = $this->modoc->get_me();
    else 
        $doctors = array();
        
    /*echo "Doctor Details<pre>";
    print_r($doctors);
    die;*/
  	$this->ui->mc->title->content = 'Profile';
   
   
        
    $this->ui->mc->content->content = $this->load->view('profile/profile_view',
            array(
                'insurance_provider' => $insurance_provider,
                'last_tab'=>$output,
//                'doctor_connect'=>$doctor_connect,
                'active_tab'=>$active_tab
                ), TRUE);

    /**displaying for output***/
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    {
       $this->output->set_output($this->ui->mc->output());
    }
    else
    {
     $this->output->set_output($this->ui->html->output());
    }
    /****end here***/

  }

  public function update_profile(){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

      $result = $this->m->role_diff(function() use ($_ci) {
      if (!$_ci->m->user_id()) return FALSE;

      $_ci->load->model('modoc');

      $specs = $_ci->input->post('specialization');

      $specs = !empty($specs) && is_array($specs) ? implode(',', array_filter(array_map(function($item) use ($_ci) {
        return !empty($item) && array_key_exists($item, $_ci->speciality->get_assoc()) ? $item : NULL;
      }, $specs) ) )  : '';

      $specs = empty($specs) ? '' : $specs;
      $race=implode(',',$_ci->input->post('race'));
      $update_data = array(
        'name'                  => $_ci->input->post('name'),
        'surname'               => $_ci->input->post('surname'),
		'email'               	=> $_ci->input->post('email'),
      	'academic_grade'        => $_ci->input->post('academic_grade'),
        'language'              => $_ci->input->post('language'),
        'address'               => $_ci->input->post('address'),
        'prac_address'          => $_ci->input->post('prac_address'),
        'zip'                   => $_ci->input->post('zip'),
        'city'                  => $_ci->input->post('city'),
        'region'                => $_ci->input->post('region'),
        'country'               => $_ci->input->post('country'),
        'telephone'             => $_ci->input->post('telephone'),
        'fax'                   => $_ci->input->post('fax'),
        'ethnicity'             => $_ci->input->post('ethnicity'),
        'occupation'            => $_ci->input->post('occupation'),
        'relationship_status'   => $_ci->input->post('relationship_status'),
        'race'                  => $race,
        'mobile'                => $_ci->input->post('mobile'),
        'emergency_number'      => $_ci->input->post('emergency_number'),
        'website'               => $_ci->input->post('website'),
        'specialization1'       => $specs,
        'insurance_provider'    => $_ci->input->post('insurance_provider'),
        'insurance_type'        => $_ci->input->post('insurance_type'),
        'subscriber_id'         => $_ci->input->post('subscriber_id'),
  	
      );    
      $result = $_ci->modoc->update_records(
        array(
          'id' => $_ci->m->user_id(),
        ),
        $update_data
      );
      
      $languages = $_ci->input->post('languages') && is_array($_ci->input->post('languages')) ? implode(',', $_ci->input->post('languages')) : '';
      
      $update_data = array(
        'languages'				=> $languages,
		'text_description'		=> $_ci->input->post('text_description'),
		'text_vet'				=> $_ci->input->post('text_vet'),
		'text_more_for_patient'	=> $_ci->input->post('text_more_for_patient'),
		'text_membership'		=> $_ci->input->post('text_membership'),
      	'street_additional'		=> $_ci->input->post('street_additional'),
      	'coordinate_lat'		=> $_ci->input->post('coordinate_lat'),
      	'coordinate_lng'		=> $_ci->input->post('coordinate_lng'),
      );

      $result = $_ci->modoc->update_termin_profile(
        array(
          'doctor_id' => $_ci->m->user_id(),
        ),
        $update_data
      );
     
      if ($result && $_ci->m->user_id())
      {
        $_ci->load->model('document/mdoc');

        if ($result = $_ci->mdoc->do_upload($_ci->m->user_id(), 'doctor'))
        {
          if (empty($result->error))
          {
            $doc = $result[0];

            $this->m->port->p->db_select();
            $this->m->port->p->limit(1);
            $result = $_ci->modoc->update_records(
              array('id' => $_ci->m->user_id(), ),
              array('profile_image' => $doc->id, )
            );
          }
          else
          {
            # Error from upload lib
          }
        }
      }

      return $result;
    }, function() use ($_ci) {
        $race=implode(',',$_ci->input->post('race'));
      $update_data = array(
        'name'                      => $_ci->input->post('name'),
        'surname'                   => $_ci->input->post('surname'),
        'birthname'                 => $_ci->input->post('birthname'),
        'dob'                       => date("Y-m-d", strtotime($_ci->input->post('dob'))),
        'gender'                    => $_ci->input->post('gender'),
        'language'                  => $_ci->input->post('language'),
        'zip'                       => $_ci->input->post('zip'),
        'city'                      => $_ci->input->post('city'),
        'region'                    => $_ci->input->post('region'),
        'country'                   => $_ci->input->post('country'),
        'address'                   => $_ci->input->post('address'),
        'telephone'                 => $_ci->input->post('telephone'),
        'fax'                       => $_ci->input->post('fax'),
        'ethnicity'                       => $_ci->input->post('ethnicity'),
        'race'                       => $race,
        'occupation'                       => $_ci->input->post('occupation'),
        'relationship_status'                       => $_ci->input->post('relationship_status'),
        'mobile'                    => $_ci->input->post('mobile'),
        'emergency_name'            => $_ci->input->post('emergency_name'),
        'emergency_doctor_id'       => $_ci->input->post('emergency_doctor_id'),
        'emergency_telephone'       => $_ci->input->post('emergency_telephone'),
        'family_doctor_name'        => $_ci->input->post('family_doctor_name'),
        'family_doctor_telephone'   => $_ci->input->post('family_doctor_telephone'),
        'family_doctor_id'          => $_ci->input->post('family_doctor_id'), 
          'insurance_provider'               => $_ci->input->post('insurance_provider'),
          'insurance_type'               => $_ci->input->post('insurance_type'),
          'subscriber_id'               => $_ci->input->post('subscriber_id'),
      );

      $_ci->load->model('mopat');
      $result = $_ci->mopat->update_records(
        array(
          'id' => $_ci->m->user_id(),
        ),
        $update_data
      );

      if ($result && $_ci->m->user_id())
      {
        $_ci->load->model('document/mdoc');

        if ($result = $_ci->mdoc->do_upload($_ci->m->user_id()))
        {
          if (empty($result->error))
          {
            $doc = $result[0];

            $this->m->port->p->db_select();
            $this->m->port->p->limit(1);
            $result = $_ci->mopat->update_records(
              array('id' => $_ci->m->user_id(), ),
              array('profile_image' => $doc->id, )
            );
          }
          else
          {
            # Error from upload lib
          }
        }
      }

      return $result;
    });

    ajax_redirect('akte/profile');
  }

    public function update_password($ajax_redirect=1){

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    echo $result = $this->m->role_diff(function() use ($_ci) {
      if (!$_ci->m->user_id()) return FALSE;

      $_ci->load->model('modoc');
      
      $result = $_ci->modoc->set_new_password();

      return $result;

    }, function() use ($_ci) {
      
      $_ci->load->model('mopat');
      $result = $_ci->mopat->set_new_password();
      
      return $result;
    });
    if($ajax_redirect==1)
    {
      ajax_redirect('akte/profile');
    }
   
  }
  
  public function doctor_connect_insert(){
     
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    $doctor_id=trim($this->input->post('doctor_id'));
    if(!empty($doctor_id)){ 
//        print_R($doctor_id);
//                die();
//         $_ci->load->model('modoc');      
        $doctor_id = $_ci->m->modoc->doctor_existance($doctor_id);
//        print_R($doctor);die;
       if((isset($doctor_id) || !$doctor_id )&& $doctor_id!=$this->m->user_id()){
            $query = $this->m->port->p->get_where('doctors_connect', array('sender_id' => $_ci->m->user_id(), 'receiver_id' => $doctor_id,'delete_status'=>'0' ), 1);
            if ($query->num_rows() <= 0){

                $insert_params = array(
                  'sender_id'          => $_ci->m->user_id(), 
//                  'doctor_inserted_id' => $doctor->id, 
                  'receiver_id'        => $doctor_id,
//                  'doctor_name'        => $doctor->name.' '.$doctor->surname,
//                  'access_rights'      => $_ci->input->post('my_doctor_access') ? $_ci->input->post('my_doctor_access') : 0, 
                  'date_added'         => TRUE, 
                );
                $this->m->db_set('p', $insert_params, array('id', 'sender_id', 'receiver_id', ), array('date_added', ), array());
                $this->m->port->p->db_select();
                $result=$this->m->port->p->insert('doctors_connect');
//                echo $this->m->port->p->last_query();die;
                if($this->m->port->p->insert_id()>0){
                    
                }
            }          
        }

    }
    ajax_redirect('akte/profile/index/connect');
  }
//    
//  public function doctor_connect_update($id = NULL){
//    static $_ci;
//    if (empty($_ci)) $_ci =& get_instance();
//
// 
//
//
//        if ($id === NULL)
//        {
//          $access = $_ci->input->post('access');
//
//          $_ci->m->port->p->where('patient_id', $_ci->m->user_id());
//
//          if (!is_array($access))
//          {
//            if (!$_ci->input->post('batch'))
//            {
//              return FALSE;
//            }
//            else
//            {
//              $_ci->m->port->p->db_select();
//              $_ci->m->port->p->set('access_rights', $access);
//              return $_ci->m->port->p->update('my_doctors');
//            }
//          }
//          else
//          {
//
//            $_ci->m->port->p->where('patient_id', $_ci->m->user_id());
//            $_ci->m->port->p->set('access_rights', 1);
//            $_ci->m->port->p->update('my_doctors');
//
//            foreach ($access as $key => $value)
//            {
//              $_ci->m->port->p->where('id !=', $key);
//            }
//
//            $_ci->m->port->p->set('access_rights', 0);
//            $_ci->m->port->p->update('my_doctors');
//          }
//
//          return TRUE;
//        }
//        else
//        {
//          $access = $_ci->input->post('access');
//          if (is_array($access))
//          {
//            if (isset($access[$id]))
//            {
//              $access = $access[$id] ? 1 : 0;
//            }
//            else
//            {
//              return FALSE;
//            }
//          }
//          else
//          {
//            $access = $access ? 1 : 0;
//          }
//
//          $_ci->m->port->p->db_select();
//          $_ci->m->port->p->where('id', $id);
//          $_ci->m->port->p->where('patient_id', $_ci->m->user_id());
//          $_ci->m->port->p->set('access_rights', $access);
//
//          return $_ci->m->port->p->update('my_doctors');
//        }
//      
//// because of this module is redirect to the my profile tab index
//    ajax_redirect('akte/profile/index/connect');
//  }
//  
//  
//    public function doctor_connect_view(){
//    
//    //lang load...
//    $this->load->language('patients/my_doctors', $this->m->user_value('language')); 
//    $this->load->language('global/general_text', $this->m->user_value('language')); 
//    $this->load->language('pwidgets/my_account', $this->m->user_value('language'));
//    
//    static $_ci;
//    if (empty($_ci)) $_ci =& get_instance();
//    $this->ui->mc->base_init();
//    $this->ui->mc->title->content = '';
//
//        $this->ui->mc->content->content = $_ci->load->view('access/doctor_access_struct_view', array(
//          'v_users' => $_ci->mopat->get_doctors(),
//        ), TRUE);
//   
//    
//    $this->output->set_output($this->ui->mc->output());
//    //ajax_redirect('akte/access/?regid='.$regid);
//  }
//  
  public function doctor_connect_delete($id){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    if (empty($id)){
      $id = $this->input->get('id');
    }

    if (empty($id)){
      $id = $this->input->post('id');
    }

    $_ci->m->port->p->db_select();
    $_ci->m->port->p->where('id', $id);
    $result = $_ci->m->port->p->update('doctors_connect', array('delete_status'=>'1'));
   
    // because of this module is redirect to the my profile tab index
    ajax_redirect('akte/profile/index/connect');
  }
  
   public function doctor_connect_deleteMany(){
       
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    $ids = $this->input->post('check_doctor');
    if (!empty($ids)){
    	$ids = implode(',',array_keys($ids));
        
        $_ci->m->port->p->db_select();
        $_ci->m->port->p->where_in('id', $ids);
        $_ci->m->port->p->update('doctors_connect',  array('delete_status'=>'1'));  
    }
    
// because of this module is redirect to the my profile tab index
    ajax_redirect('akte/profile/index/connect');
  }
  public function apporve_doctor_connect($id){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    if (empty($id)){
      $id = $this->input->get('id');
    }

    if (empty($id)){
      $id = $this->input->post('id');
    }
    $_ci->m->port->p->db_select();
    $_ci->m->port->p->where('id', $id);
    $result = $_ci->m->port->p->update('doctors_connect',array('status'=>'1'));
//    echo $_ci->m->port->p->last_query();die;
    ajax_redirect('akte/profile/index/connect');
      
  }
  
  public function update_practice(){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

      $result = $this->m->role_diff(function() use ($_ci) {
      if (!$_ci->m->user_id()) return FALSE;

      $_ci->load->model('modoc');
      $update_data = array(
      	'doctorassoctext1'      => $_ci->input->post('doctorassoctext1'),
        'doctorassoctext2'      =>  $_ci->input->post('doctorassoctext2'),
        'doctorassoctext3'      => $_ci->input->post('doctorassoctext3'),             	
      );
        
      $_ci->load->model('document/mdoc');        
      for($i=1;$i<=3;$i++){
          if($_ci->m->user_id()){
        if ($doc_result = $_ci->mdoc->do_upload($_ci->m->user_id(), 'doctor',"doctorassoc$i"))
        {
          if (empty($doc_result->error))
          {
              $doc = $doc_result[0];
              $update_data["doctorassoc$i"]=$doc->id;
          }         
        }
               
          }
      }
      
      $result = $_ci->modoc->update_records(
        array(
          'id' => $_ci->m->user_id(),
        ),
        $update_data
      );
      return $result;
    }, function() use ($_ci) {
      return false;
    });

    ajax_redirect('akte/profile/index/practice');
  }

}

/* End of file profile.php */
/* Location: ./application/modules/akte/controllers/profile.php */