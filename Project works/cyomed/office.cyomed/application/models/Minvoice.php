<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Minvoice extends CI_Model {

  const PATIENT_INVOICE = 'patients_payment';
  const DOCTOR_INVOICE = 'doctors_payment';

  public static $role = NULL;

  /*
  |--------------------------------------------------------------------------
  | PUBLIC VARS
  |--------------------------------------------------------------------------
  |
  |
  */

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $alert = '';

    $this->mod->port->p->db_select();

    if (!$this->mod->port->p->table_exists('doctors_payment'))
    {
      $alert .= '<p>';
      $alert .= 'DB Error: doctor invoice table not found.';
      $alert .= '</p>';
    }

    if (!$this->mod->port->p->table_exists('patients_payment'))
    {
      $alert .= '<p>';
      $alert .= 'DB Error: patient invoice table not found.';
      $alert .= '</p>';
    }

    if ($alert)
    {
      echo $alert;
      exit();
    }

    $this->mod->port->p->set('package', 'free');
    $this->mod->port->p->where('package', '');
    $this->mod->port->p->update('doctors_payment');

    $this->mod->port->p->set('package', 'free');
    $this->mod->port->p->where('package', '');
    $this->mod->port->p->update('patients_payment');

    $this->mod->port->p->set('package', 'free_doc');
    $this->mod->port->p->where('package', '');
    $this->mod->port->p->or_where('package', 'free');
    $this->mod->port->p->or_where('package', 'not selected');
    $this->mod->port->p->update('doctors');

    $this->mod->port->p->set('package', 'free_pat');
    $this->mod->port->p->where('package', '');
    $this->mod->port->p->or_where('package', 'free');
    $this->mod->port->p->or_where('package', 'not selected');
    $this->mod->port->p->update('patients');

  }

  /**
   *
   */
  public function get_payment($value, $field = NULL)
  {
    if (self::$role === NULL)
    {
      return array();
    }

    if ($field === NULL)
    {
      if (self::$role === self::PATIENT_INVOICE)
      {
        $field = 'patient_id';
      }
      if (self::$role === self::DOCTOR_INVOICE)
      {
        $field = 'doctor_id';
      }
    }

    if (is_array($value))
    {
      $condition = $value;
    }
    else
    {
      if (is_string($field))
      {
        $condition = array($field => $value, );
      }
      else
      {
        if (self::$role === self::PATIENT_INVOICE)
        {
          $field = 'patient_id';
        }
        if (self::$role === self::DOCTOR_INVOICE)
        {
          $field = 'doctor_id';
        }
        $condition = array($field => $value, ); 
      }
    }

    if (count($condition) <= 0)
    {
      return array();
    }

    $this->mod->port->p->db_select();
    foreach ($condition as $field => $value)
    {
      $this->mod->port->p->where($field, $value);
    }
    if (self::$role === self::PATIENT_INVOICE)
    {
      $table = 'patients_payment';
    }
    if (self::$role === self::DOCTOR_INVOICE)
    {
      $table = 'doctors_payment';
    }
    $this->mod->port->p->order_by('cdate', 'DESC');
    $query = $this->mod->port->p->get($table);

    if ($query->num_rows() > 0)
    {
      $result = $query->result();

      foreach ($result as $index => $row)
      {
        foreach ($row as $field => $value)
        {
          if (strpos($field, 'payment') !== FALSE && $field != 'payment')
          {
            $result[$index]->$field = $this->encrypt->decode($value);
          }
        }

        $query = $this->mod->port->p->get_where($table.'_p1meta', array('payment_id' => $result[$index]->id, ));
        if ($query->num_rows() > 0)        
        {
          $result[$index]->meta = $query->result();
        }
        else
        {
          $result[$index]->meta = array();
        }
      }

      return $result;
    }
    else
    {
      return array();
    }
  }

  /**
   *
   */
  // public function get_invoice(&$user)
  // {
  //   if (!isset($user->payment) || !is_array($user_payment) || count($user_payment) <= 0)
  //   {
  //     return FALSE;
  //   }

  //   for($user->payment_start<s>)
  //   {
  //     if ($user->next_pack)
  //     {
  //       if ($user->payment->start_time + $pack->running_time < $time)
  //       {
  //         if ($user->next_pack_time + $pack->buffer_time < $user->payment->start_time + $pack->running_time)
  //         {
  //           $user->next_pack && $user->next_pack_time = 0;
  //         }

  //         // generate invoice. for
  //         $user->payment->start_time + $pack->running_time
  //       }
  //     }
  //   }

  // }

  /**
   *
   */
  public function get_invoice(&$user)
  {
    static $count = 1;

    $user->payment = $this->get_payment($user->id);

    $result = array();
    $last_payment = NULL;
    for ($i = count($user->payment) - 1; $i >= 0; $i--)
    {
      $payment = $user->payment[$i];

      if (!$last_payment || $last_payment->package != $payment->package)
      {
        array_unshift($result, array());
      }

      array_unshift($result[0], $last_payment = $payment);
    }

    $user->invoice = $result;

    if (count($result) <= 0 || count($result[0]) <= 0)
    {
      return $result;
    }

    $top_pack       = $this->mopack->get_name($result[0][count($result[0]) - 1]->package);
    $expire_time    = strtotime($result[0][0]->cdate);

    if ($top_pack->running_time_type == 'static' && $top_pack->running_time > 0)
    {
      while (time() > $expire_time)
      {
        switch ($top_pack->running_time_quant) {
          case 'second'  : $expire_time += $top_pack->running_time * 1 - 1; break;
          case 'minute'  : $expire_time += $top_pack->running_time * 60 - 1; break;
          case 'hour'    : $expire_time += $top_pack->running_time * 3600 - 1; break;
          case 'day'     : $expire_time += $top_pack->running_time * 86400 - 1; break;
          case 'week'    : $expire_time += $top_pack->running_time * 604800 - 1; break;
          case 'month'   : $expire_time = strtotime(date('Y-m-d H:i:s', $expire_time)." +1 month") - 1; break;
          case 'quarter' : $expire_time = strtotime(date('Y-m-d H:i:s', $expire_time)." +3 month") - 1; break;
          case 'year'    : $expire_time = strtotime(date('Y-m-d H:i:s', $expire_time)." +1 year") - 1; break;
        }
        if (time() > $expire_time)
        {
          if (self::$role === self::PATIENT_INVOICE)
          {
            $query = $this->mod->port->p->get_where('patients', array('id' => $user->id, ), 1);
          }
          if (self::$role === self::DOCTOR_INVOICE)
          {
            $query = $this->mod->port->p->get_where('doctors', array('id' => $user->id, ), 1);
          }
          $user_row = $query->row();

          $this->mod->port->p->set('package'                     , $user_row->package);
          // $this->mod->port->p->set('payment_account_holder'      , $user_row->payment_account_holder);
          // $this->mod->port->p->set('payment_bank_name'           , $user_row->payment_bank_name);
          // $this->mod->port->p->set('payment_account_number'      , $user_row->payment_account_number);
          // $this->mod->port->p->set('payment_bank_code'           , $user_row->payment_bank_code);
          $this->mod->port->p->set('payment_title'               , $user_row->payment_title);
          $this->mod->port->p->set('payment_gender'              , $user_row->payment_gender);
          $this->mod->port->p->set('payment_first_name'          , $user_row->payment_first_name);
          $this->mod->port->p->set('payment_last_name'           , $user_row->payment_last_name);
          $this->mod->port->p->set('payment_street'              , $user_row->payment_street);
          $this->mod->port->p->set('payment_street_additional'   , $user_row->payment_street_additional);
          $this->mod->port->p->set('payment_postal_code'         , $user_row->payment_postal_code);
          $this->mod->port->p->set('payment_locality'            , $user_row->payment_locality);
          $this->mod->port->p->set('payment_email'               , $user_row->payment_email);
          $this->mod->port->p->set('payment_telephone'           , $user_row->payment_telephone);
          
          $this->mod->port->p->set('cdate'                       , date('Y-m-d H:i:s', $expire_time += 1));

          if (self::$role === self::PATIENT_INVOICE)
          {
            $this->mod->port->p->set('patient_id'                , $user_row->id);

            $this->mod->port->p->insert('patients_payment');
          }
          if (self::$role === self::DOCTOR_INVOICE)
          {
            $this->mod->port->p->set('doctor_id'                 , $user_row->id);
            
            $this->mod->port->p->insert('doctors_payment');
          }

        }
      }

      $user->payment = $this->get_payment($user->id);

      $result = array();
      $last_payment = NULL;
      for ($i = count($user->payment) - 1; $i >= 0; $i--)
      {
        $payment = $user->payment[$i];

        if (!$last_payment || $last_payment->package != $payment->package)
        {
          array_unshift($result, array());
        }

        array_unshift($result[0], $last_payment = $payment);
      }

      $user->invoice = $result;
    }

    return $result;
  }

  /**
   *
   */
  public function valid_payer()
  {
    foreach (array(
      // 'payment_account_holder',
      // 'payment_bank_name',
      // 'payment_account_number',
      // 'payment_bank_code',
      // 'payment_title',
      // 'payment_gender',
      'payment_first_name',
      'payment_last_name',
      'payment_street',
      // 'payment_street_additional',
      'payment_postal_code',
      'payment_locality',
      // 'payment_email',
      // 'payment_telephone',
      ) as $field)
    {
      $this->mod->port->p->where($field.' !=', '');
    }
  }


}

/* End of file minvoice.php */
/* Location: ./application/models/minvoice.php */