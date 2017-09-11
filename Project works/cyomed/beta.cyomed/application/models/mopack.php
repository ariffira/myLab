<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mopack extends CI_Model {

  private $_pack = array();
  private $_count_all = 0;

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $alert = '';

    $this->m->port->p->db_select();

    if (!$this->m->port->p->table_exists('doctors_payment'))
    {
      $alert .= '<p>';
      $alert .= 'DB Error: doctor invoice table not found.';
      $alert .= '</p>';
    }

    if (!$this->m->port->p->table_exists('patients_payment'))
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

    $this->m->port->p->set('package', 'free_doc');
    $this->m->port->p->where('package', '');
    $this->m->port->p->or_where('package', 'free');
    $this->m->port->p->or_where('package', 'not selected');
    $this->m->port->p->update('doctors_payment');

    $this->m->port->p->set('package', 'free_pat');
    $this->m->port->p->where('package', '');
    $this->m->port->p->or_where('package', 'free');
    $this->m->port->p->or_where('package', 'not selected');
    $this->m->port->p->update('patients_payment');

    $this->m->port->p->set('package', 'free_doc');
    $this->m->port->p->where('package', '');
    $this->m->port->p->or_where('package', 'free');
    $this->m->port->p->or_where('package', 'not selected');
    $this->m->port->p->update('doctors');

    $this->m->port->p->set('package', 'free_pat');
    $this->m->port->p->where('package', '');
    $this->m->port->p->or_where('package', 'free');
    $this->m->port->p->or_where('package', 'not selected');
    $this->m->port->p->update('patients');

    $this->_count_all = $this->m->port->p->count_all('packages');
  }

  /**
   *
   */
  public function get_id($id)
  {
    $this->m->port->p->db_select();

    $query = $this->m->port->p->get_where('packages', array('id' => $id, 'for' => $this->m->user_role() == 'doctor' ? 2 : 1), 1);

    if ($query->num_rows() > 0)
    {
      $row = $query->row();

      $fields = $this->m->port->p->field_data('packages');

      foreach ($fields as $field)
      {
         // echo $field->name;
         // echo $field->type;
         // echo $field->max_length;
         // echo $field->primary_key;
        if (strtoupper($field->type) == 'BLOB')
        {
          $field_name = $field->name;
          foreach ($result as $index => $row)
          {
            isset($row->$field_name) && $row->$field_name ? ($row->$field_name = $this->aes_encrypt->de($row->$field_name)) : NULL;
          }
        }
      }

      $row->no_buffers = $row->no_buffers ? explode(',', $row->no_buffers) : array();
      $row->activating_modules = $row->activating_modules ? explode(',', $row->activating_modules) : array();

      $query = $this->m->port->p->get_where('packages_terms', array('for' => $row->id, ));
      if ($query->num_rows() > 0)
      {
        $row->terms = $query->result();
      }
      else
      {
        $row->terms = array();
      }

      return $row;
    }
    else
    {
      return FALSE;
    }
  }

  /**
   *
   */
  public function get_name($name)
  {
    if (isset($this->_pack[$name]))
    {
      return $this->_pack[$name];
    }

    $this->m->port->p->db_select();

    switch ($this->m->user_role()) {
      case 'doctor':
        $query = $this->m->port->p->get_where('packages', array('name' => $name, 'for' => 2, ), 1);
        break;

      case 'patient':
        $query = $this->m->port->p->get_where('packages', array('name' => $name, 'for' => 1, ), 1);
        break;
      
      default:
        $query = $this->m->port->p->get_where('packages', array('name' => $name, ), 1);
        break;
    }

    

    if ($query->num_rows() > 0)
    {
      $row = $query->row();

      $fields = $this->m->port->p->field_data('packages');

      foreach ($fields as $field)
      {
         // echo $field->name;
         // echo $field->type;
         // echo $field->max_length;
         // echo $field->primary_key;
        if (strtoupper($field->type) == 'BLOB')
        {
          $field_name = $field->name;
          foreach ($result as $index => $row)
          {
            isset($row->$field_name) && $row->$field_name ? ($row->$field_name = $this->aes_encrypt->de($row->$field_name)) : NULL;
          }
        }
      }

      $row->no_buffers = $row->no_buffers ? explode(',', $row->no_buffers) : array();
      $row->activating_modules = $row->activating_modules ? explode(',', $row->activating_modules) : array();

      $query = $this->m->port->p->get_where('packages_terms', array('for' => $row->id, ));
      if ($query->num_rows() > 0)
      {
        $row->terms = $query->result();
      }
      else
      {
        $row->terms = array();
      }


      $this->_pack[$row->name] = $row;

      return $row;
    }
    else
    {
      return FALSE;
    }
  }

  /**
   *
   */
  public function get_list()
  {
    if (count($this->_pack) == $this->_count_all)
    {
      return $this->_pack;
    }

    $this->m->port->p->db_select();
    $this->m->port->p->order_by('visual_order', 'ASC');

    $query = $this->m->port->p->get('packages');

    if ($query->num_rows() > 0)
    {
      $result = $query->result();

      $fields = $this->m->port->p->field_data('packages');

      foreach ($fields as $field)
      {
         // echo $field->name;
         // echo $field->type;
         // echo $field->max_length;
         // echo $field->primary_key;
        if (strtoupper($field->type) == 'BLOB')
        {
          $field_name = $field->name;
          foreach ($result as $index => $row)
          {
            isset($row->$field_name) && $row->$field_name ? ($result[$index]->$field_name = $this->aes_encrypt->de($row->$field_name)) : NULL;
          }
        }
      }

      foreach ($result as $index => $row)
      {
        $result[$index]->no_buffers = $row->no_buffers ? explode(',', $row->no_buffers) : array();
        $result[$index]->activating_modules = $row->activating_modules ? explode(',', $row->activating_modules) : array();

        $query = $this->m->port->p->get_where('packages_terms', array('for' => $row->id, ));
        if ($query->num_rows() > 0)
        {
          $result[$index]->terms = $query->result();
        }
        else
        {
          $result[$index]->terms = array();
        }

        if ($this->m->user_role() == 'doctor' && $row->for == 2 || $this->m->user_role() == 'patient' && $row->for == 1)
        {
          $this->_pack[$row->name] = $result[$index];
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
  public function update_package()
  {
    $id                  = $this->input->post('package_id');
    $for                 = $this->input->post('package_for');
    $name                = $this->input->post('package_name');
    $display_name        = $this->input->post('package_display_name');
    $intro               = $this->input->post('package_intro');
    $intro_top_right     = $this->input->post('package_intro_top_right');
    $price_cent          = $this->input->post('package_price_cent');
    $running_time_type   = $this->input->post('package_running_time_type');
    $running_time        = $this->input->post('package_running_time');
    $running_time_quant  = $this->input->post('package_running_time_quant');
    $cancel_buffer_type  = $this->input->post('package_cancel_buffer_type');
    $cancel_buffer       = $this->input->post('package_cancel_buffer');
    $cancel_buffer_quant = $this->input->post('package_cancel_buffer_quant');
    $no_buffers          = $this->input->post('package_no_buffers');
    $activating_modules  = $this->input->post('package_activating_modules');
    $visual_order        = $this->input->post('package_visual_order');
    $visual_class        = $this->input->post('package_visual_class');
    $visual_new_row      = $this->input->post('package_visual_new_row');
    $insert              = $this->input->post('insert');
    $update              = $this->input->post('update');
    $delete              = $this->input->post('delete');
    
    $term_insert         = $this->input->post('term_insert');
    $term_delete         = $this->input->post('term_delete');
    $term_id             = $this->input->post('term_id');
    $term_for            = $this->input->post('term_for');
    $term_name           = $this->input->post('term_name');
    $term_intro          = $this->input->post('term_intro');

    if ($insert || $update)
    {
      $this->m->port->p->db_select();

      $this->m->port->p->set('for'                 , $for );
      $this->m->port->p->set('name'                , $name );
      $this->m->port->p->set('display_name'        , $display_name );
      $this->m->port->p->set('intro'               , $intro );
      $this->m->port->p->set('intro_top_right'     , $intro_top_right );
      $this->m->port->p->set('price_cent'          , $price_cent );
      $this->m->port->p->set('running_time_type'   , $running_time_type );
      $this->m->port->p->set('running_time'        , $running_time );
      $this->m->port->p->set('running_time_quant'  , $running_time_quant );
      $this->m->port->p->set('cancel_buffer_type'  , $cancel_buffer_type );
      $this->m->port->p->set('cancel_buffer'       , $cancel_buffer );
      $this->m->port->p->set('cancel_buffer_quant' , $cancel_buffer_quant );
      $this->m->port->p->set('visual_order'        , $visual_order );
      $this->m->port->p->set('visual_class'        , $visual_class );
      $this->m->port->p->set('visual_new_row'      , $visual_new_row ? 1 : 0 );

      if ($no_buffers && is_array($no_buffers))
      {
        foreach ($no_buffers as $key => $value)
        {
          $no_buffers[$key] = trim($value);
        }
        $this->m->port->p->set('no_buffers' , implode(',', $no_buffers));
      }
      else
      {
        $this->m->port->p->set('no_buffers' , '');
      }

      if ($activating_modules && is_array($activating_modules))
      {
        foreach ($activating_modules as $key => $value)
        {
          $activating_modules[$key] = trim($value);
        }
        $this->m->port->p->set('activating_modules' , implode(',', $activating_modules));
      }
      else
      {
        $this->m->port->p->set('activating_modules' , '');
      }

      if ($id)
      {
        $this->m->port->p->where('id', $id );
        $this->m->port->p->limit(1);
        $db_result = $this->m->port->p->update('packages');

        if ($term_id && is_array($term_id) && count($term_id) > 0)
        {
          foreach ($term_id as $tid => $trow)
          {
            if (!$term_for || !is_array($term_for) || count($term_for) <= 0 || !isset($term_for[$tid])) break;
            if (!$term_name || !is_array($term_name) || count($term_name) <= 0 || !isset($term_name[$tid])) break;
            if (!$term_intro || !is_array($term_intro) || count($term_intro) <= 0 || !isset($term_intro[$tid])) break;

            if ($tid)
            {
              if ($term_delete && is_array($term_delete) && count($term_delete) > 0 && isset($term_delete[$tid]) && $term_delete[$tid])
              {
                $this->m->port->p->where('id', $tid);
                $this->m->port->p->limit(1);
                $db_result = $this->m->port->p->delete('packages_terms');
              }
              else
              {
                $this->m->port->p->set('for'   , $term_for[$tid]);
                $this->m->port->p->set('name'  , $term_name[$tid]);
                $this->m->port->p->set('intro' , $term_intro[$tid]);

                $this->m->port->p->where('id', $tid );
                $this->m->port->p->limit(1);

                $this->m->port->p->update('packages_terms');
              }
            }
            else
            {
              if ($term_insert && is_array($term_insert) && count($term_insert) > 0 && isset($term_insert[$tid]) && $term_insert[$tid])
              {
                $this->m->port->p->set('for'   , $term_for[$tid]);
                $this->m->port->p->set('name'  , $term_name[$tid]);
                $this->m->port->p->set('intro' , $term_intro[$tid]);

                $this->m->port->p->insert('packages_terms');
              }
            }
          }
        }
      }
      else
      {
        $db_result = $this->m->port->p->insert('packages');
      }
    }
    if ($delete)
    {
      if ($id)
      {
        $this->m->port->p->where('for', $id );
        $this->m->port->p->delete('packages_terms');

        $this->m->port->p->where('id', $id );
        $this->m->port->p->limit(1);
        $db_result = $this->m->port->p->delete('packages');
      }
    }

    $this->get_list();
    return $db_result;
  }

  /**
   *
   */
  public function current_running_time($package = NULL, $time = NULL)
  {
    $time = ($time !== NULL ? $time : time());

    if ($package === NULL)
    {
      return $time;
    }

    if (is_string($package))
    {
      $package = $this->get_name($package);
    }

    if (!$package || !is_object($package))
    {
      return $time;
    }

    $current_running_time = $time;

    switch ($package->running_time_type)
    {
      case 'static':

        if ($package->running_time > 0)
        {
          switch ($package->running_time_quant)
          {
            case 'second'  : $current_running_time = $time + $package->running_time * 1 - 1; break;
            case 'minute'  : $current_running_time = $time + $package->running_time * 60 - 1; break;
            case 'hour'    : $current_running_time = $time + $package->running_time * 3600 - 1; break;
            case 'day'     : $current_running_time = $time + $package->running_time * 86400 - 1; break;
            case 'week'    : $current_running_time = $time + $package->running_time * 604800 - 1; break;
            case 'month'   : $current_running_time = strtotime(date('Y-m-d H:i:s', $time)." +1 month") - 1; break;
            case 'quarter' : $current_running_time = strtotime(date('Y-m-d H:i:s', $time)." +3 month") - 1; break;
            case 'year'    : $current_running_time = strtotime(date('Y-m-d H:i:s', $time)." +1 year") - 1; break;
            default        : break;
          }
        }

        break;

      case 'end_of':

        for ($i = 0, $current_running_time = $time - 1; $i <= $package->running_time; $i++)
        { 
          $current_running_time += 1;

          switch ($package->running_time_quant)
          {
            case 'second'  : $current_running_time = strtotime(date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', $current_running_time).' +1 second'))) - 1; break;
            case 'minute'  : $current_running_time = strtotime(date('Y-m-d H:i:00', strtotime(date('Y-m-d H:i:s', $current_running_time).' +1 minute'))) - 1; break;
            case 'hour'    : $current_running_time = strtotime(date('Y-m-d H:00:00', strtotime(date('Y-m-d H:i:s', $current_running_time).' +1 hour'))) - 1; break;
            case 'day'     : $current_running_time = strtotime(date('Y-m-d 00:00:00', strtotime(date('Y-m-d H:i:s', $current_running_time).' +1 day'))) - 1; break;
            case 'week'    : $current_running_time = strtotime(date('Y-m-d 00:00:00', strtotime(date('Y-m-d H:i:s', $current_running_time).' next monday'))) - 1; break;
            case 'month'   : $current_running_time = strtotime(date('Y-m-01 00:00:00', strtotime(date('Y-m-d H:i:s', $current_running_time).' +1 month'))) - 1; break;
            case 'quarter' : $current_running_time = strtotime(sprintf(date('Y-\%\s-01 00:00:00', $in_next = strtotime(date('Y-m-d H:i:s', $current_running_time).' +3 month')), ceil(date('m', $in_next) * .33) * 3 - 2)) - 1; break;
            case 'year'    : $current_running_time = strtotime(date('Y-01-01 00:00:00', strtotime(date('Y-m-d H:i:s', $current_running_time).' +1 year'))) - 1; break;
            default        : break;
          }
        }

        break;
      
      default:

        # code...
        break;
    }

    return $current_running_time;
  }

  /**
   *
   */
  public function possible_next_time($package = NULL, $time = NULL)
  {
    $time = ($time !== NULL ? $time : time());

    if ($package === NULL)
    {
      return $time;
    }

    if (is_string($package))
    {
      $package = $this->get_name($package);
    }

    if (!$package || !is_object($package))
    {
      return $time;
    }

    $possible_next_time = $time;

    $expire_time = $this->current_running_time($package, $time);

    switch ($package->cancel_buffer_type)
    {
      case 'static':

        if ($package->cancel_buffer > 0)
        {
          switch ($package->cancel_buffer_quant)
          {
            case 'second'  : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 1; break;
            case 'minute'  : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 60; break;
            case 'hour'    : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 3600; break;
            case 'day'     : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 86400; break;
            case 'week'    : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 604800; break;
            case 'month'   : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -1 month"); break;
            case 'quarter' : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -3 month"); break;
            case 'year'    : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -1 year"); break;
          }

          while ($time >= $buffer_time)
          {
            $expire_time = $this->current_running_time($package, $expire_time + 1);

            switch ($package->cancel_buffer_quant)
            {
              case 'second'  : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 1; break;
              case 'minute'  : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 60; break;
              case 'hour'    : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 3600; break;
              case 'day'     : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 86400; break;
              case 'week'    : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 604800; break;
              case 'month'   : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -1 month"); break;
              case 'quarter' : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -3 month"); break;
              case 'year'    : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -1 year"); break;
            }
          }

        }

        $possible_next_time = $expire_time + 1;

        break;

      case 'end_of': # This is currently IDENTICAL with static

        if ($package->cancel_buffer > 0)
        {
          switch ($package->cancel_buffer_quant)
          {
            case 'second'  : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 1; break;
            case 'minute'  : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 60; break;
            case 'hour'    : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 3600; break;
            case 'day'     : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 86400; break;
            case 'week'    : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 604800; break;
            case 'month'   : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -1 month"); break;
            case 'quarter' : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -3 month"); break;
            case 'year'    : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -1 year"); break;
          }

          while ($time >= $buffer_time)
          {
            $expire_time = $this->current_running_time($package, $expire_time + 1);

            switch ($package->cancel_buffer_quant)
            {
              case 'second'  : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 1; break;
              case 'minute'  : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 60; break;
              case 'hour'    : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 3600; break;
              case 'day'     : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 86400; break;
              case 'week'    : $buffer_time = $expire_time + 1 - $package->cancel_buffer * 604800; break;
              case 'month'   : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -1 month"); break;
              case 'quarter' : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -3 month"); break;
              case 'year'    : $buffer_time = strtotime(date('Y-m-d H:i:s', $expire_time + 1)." -1 year"); break;
            }
          }

        }

        $possible_next_time = $expire_time + 1;

        break;
      
      default:

        # code...
        break;
    }

    return $possible_next_time;

  }

  /**
   * @return obj result->status = ERROR|POST|PENDING
   */
  public function change_package()
  {
    $msg = new stdClass();

    $package = $this->input->post('package');

    if (!$package)
    {
      return (($msg->status = 'ERROR') && ($msg->msg = 'You must choose a package.')) ? $msg : $msg;
    }

    $package = $this->get_name($package);

    if (!$package || !isset($package->id) || !isset($package->name))
    {
      return (($msg->status = 'ERROR') && ($msg->msg = 'Invalid package.')) ? $msg : $msg;
    }

    if (!$this->m->user_role() || !$this->m->user())
    {
      return (($msg->status = 'ERROR') && ($msg->msg = 'You are not logged in.')) ? $msg : $msg;
    }

    Minvoice::$role = $this->m->user_role() == 'doctor' ? Minvoice::DOCTOR_INVOICE : Minvoice::PATIENT_INVOICE;
    $invoices = $this->minvoice->get_invoice($this->m->user());

    if (count($invoices) > 0 && count($invoices[0]) > 0)
    {
      if (strtotime($invoices[0][0]->cdate) > time())
      {
        return (($msg->status = 'ERROR') && ($msg->msg = 'You have to wait till your next package becomes active.')) ? $msg : $msg;
      }
    }

    $curr_name = $this->m->user()->package;
    $current = $this->mopack->get_name($curr_name);

    if ($current && !empty($current->no_buffers) && is_array($current->no_buffers) && in_array($package->id, $current->no_buffers))
    {
      $possible_next_time = time();
    }
    else
    {
      $possible_next_time = $this->possible_next_time($this->m->user()->package, count($invoices) > 0 && count($invoices[0]) > 0 ? strtotime($invoices[0][0]->cdate) : time());
    }

    $title              = $this->input->post('title');
    $gender             = $this->input->post('gender');
    $first_name         = $this->input->post('first_name');
    $last_name          = $this->input->post('last_name');
    $street             = $this->input->post('street');
    $street_additional  = $this->input->post('street_additional');
    $postal_code        = $this->input->post('postal_code');
    $locality           = $this->input->post('locality');
    $email              = $this->input->post('email');
    $telephone          = $this->input->post('telephone');

    $this->m->port->p->db_select();

    $this->m->port->p->set('package'                     , $package->name);
    $this->m->port->p->set('ref'                         , random_string('alnum', 20));
    $this->m->port->p->set('payment_title'               , $this->encrypt->encode($title));
    $this->m->port->p->set('payment_gender'              , $this->encrypt->encode($gender));
    $this->m->port->p->set('payment_first_name'          , $this->encrypt->encode($first_name));
    $this->m->port->p->set('payment_last_name'           , $this->encrypt->encode($last_name));
    $this->m->port->p->set('payment_street'              , $this->encrypt->encode($street));
    $this->m->port->p->set('payment_street_additional'   , $this->encrypt->encode($street_additional));
    $this->m->port->p->set('payment_postal_code'         , $this->encrypt->encode($postal_code));
    $this->m->port->p->set('payment_locality'            , $this->encrypt->encode($locality));
    $this->m->port->p->set('payment_email'               , $this->encrypt->encode($email));
    $this->m->port->p->set('payment_telephone'           , $this->encrypt->encode($telephone));
    $this->m->port->p->set('cdate'                       , date('Y-m-d H:i:s', $possible_next_time));

    if ($this->m->user_role() == 'doctor')
    {
      $this->m->port->p->set('doctor_id', $this->m->user_id());
      $this->m->port->p->insert('doctors_payment');

      $query = $this->m->port->p->get_where('doctors_payment', array('id' => $this->m->port->p->insert_id(), ), 1);
    }

    if ($this->m->user_role() == 'patient')
    {
      $this->m->port->p->set('patient_id', $this->m->user_id());
      $this->m->port->p->insert('patients_payment');

      $query = $this->m->port->p->get_where('patients_payment', array('id' => $this->m->port->p->insert_id(), ), 1);
    }

    if ($query->num_rows() > 0)
    {
      $msg->payment = $query->row();
    }
    else
    {
      return ($msg->status = 'ERROR') ? $msg : $msg;
    }

    if ($possible_next_time <= time())
    {
      // Immediate post
      return ($msg->status = 'POST') ? $msg : $msg;
    }
    else
    {
      return ($msg->status = 'PENDING') ? $msg : $msg;
    }
  }

}

/* End of file mopack.php */
/* Location: ./application/models/mopack.php */