<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moterm extends CI_Model {

  private $_terms = array();
  private $_terms_namehash = array();
  private $_count_all = 0;

  private $_modals = array();

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $alert = '';

    $this->mod->port->p->db_select();

    if (!$this->mod->port->p->table_exists('terms'))
    {
      $alert .= '<p>';
      $alert .= 'DB Error: terms table not found.';
      $alert .= '</p>';
    }

    if ($alert)
    {
      echo $alert;
      exit();
    }

    $this->_count_all = $this->mod->port->p->count_all('terms');
  }

  /**
   *
   */
  public function get_id($id)
  {
    if (isset($this->_terms[$id]))
    {
      return $this->_terms[$id];
    }

    $this->mod->port->p->db_select();

    $query = $this->mod->port->p->get_where('terms', array('id' => $id, ), 1);

    if ($query->num_rows() > 0)
    {
      $row = $query->row();

      $fields = $this->mod->port->p->field_data('terms');

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

      $this->_terms[$row->id] = $row;
      $this->_terms_namehash[$row->name] = $row;

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
    if (isset($this->_terms_namehash[$name]))
    {
      return $this->_terms_namehash[$name];
    }

    $this->mod->port->p->db_select();

    $query = $this->mod->port->p->get_where('terms', array('name' => $name, ), 1);

    if ($query->num_rows() > 0)
    {
      $row = $query->row();

      $fields = $this->mod->port->p->field_data('terms');

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

      $this->_terms[$row->id] = $row;
      $this->_terms_namehash[$row->name] = $row;

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
    if (count($this->_terms) == $this->_count_all)
    {
      return $this->_terms;
    }

    $this->mod->port->p->db_select();

    $query = $this->mod->port->p->get('terms');

    if ($query->num_rows() > 0)
    {
      $result = $query->result();

      $fields = $this->mod->port->p->field_data('terms');

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

      foreach ($result as $row)
      {
        $this->_terms[$row->id] = $row;
        $this->_terms_namehash[$row->name] = $row;
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
  public function update_term()
  {
    $id     = $this->input->post('term_id');
    $name   = $this->input->post('term_name');
    $title  = $this->input->post('term_title');
    $intro  = $this->input->post('term_intro');
    
    $insert = $this->input->post('insert');
    $update = $this->input->post('update');
    $delete = $this->input->post('delete');

    if ($insert || $update)
    {
      $this->mod->port->p->db_select();

      $this->mod->port->p->set('name'  , $name );
      $this->mod->port->p->set('title' , $title );
      $this->mod->port->p->set('intro' , $intro );

      if ($id)
      {
        $this->mod->port->p->where('id', $id );
        $this->mod->port->p->limit(1);
        $db_result = $this->mod->port->p->update('terms');
      }
      else
      {
        $db_result = $this->mod->port->p->insert('terms');
      }
    }
    if ($delete)
    {
      if ($id)
      {
        $this->mod->port->p->where('id', $id );
        $db_result = $this->mod->port->p->delete('terms');
      }
    }

    $this->get_list();
    return $db_result;
  }

  /**
   *
   */
  public function reset_modals()
  {
    $this->_modals = array();
  }

  /**
   *
   */
  public function modal_attr($id)
  {
    if (is_numeric($id))
    {
      $term = $this->get_id($id);

      if ($term)
      {
        $this->_modals[$term->id] = $term;
        return 'data-toggle="modal" data-target="#modal'.(ucfirst($term->name).$term->id).'"';
      }
      else
      {
        return '';
      }
    }

    if (is_string($id))
    {
      $term = $this->get_name($id);

      if ($term)
      {
        $this->_modals[$term->id] = $term;
        return 'data-toggle="modal" data-target="#modal'.(ucfirst($term->name).$term->id).'"';
      }
      else
      {
        return '';
      }
    }
  }

  /**
   *
   */
  public function modal_output($in = FALSE, $print = FALSE)
  {
    $str = '';
    $str .= ($in ? '<div class="bs-example-modal">' : '');
    foreach ($this->_modals as $term)
    {
      $str .= '
        <!-- Modal '.ucfirst($term->name).' -->
        <div class="modal fade '.($in ? 'in' : '').'" id="modal'.(ucfirst($term->name).$term->id).'" role="dialog" aria-labelledby="modalLabel'.(ucfirst($term->name).$term->id).'" aria-hidden="true" >
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Schließen</span></button>
                <h3 class="modal-title" id="modalLabel'.(ucfirst($term->name).$term->id).'">'.$term->title.'</h3>
              </div>
              <div class="modal-body">
              '.$term->intro.'
              </div>
              <div class="modal-footer">
                '.($in ? '' : '<button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>').'
                <button type="button" class="btn btn-primary" '.($in ? ($print ? 'data-toggle="print-ready"' : 'data-toggle="print"') : 'data-toggle="print-redirect" data-target="'.$term->name.'/'.$term->id.'"').'>
                  <span class="icomoon i-print-2"></span> Drucken
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal '.ucfirst($term->name).' ends -->
      ';
    }
    $str .= ($in ? '</div>' : '');
    return $str;
  }

}

/* End of file moterm.php */
/* Location: ./application/models/moterm.php */