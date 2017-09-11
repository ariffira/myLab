<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modlang extends CI_Model {

  public $lines = array();

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  /**
   *
   */
  public function from_file_system()
  {
    $dirs = array(
      '..'.DIRECTORY_SEPARATOR.'beta.cyomed'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR,
      '..'.DIRECTORY_SEPARATOR.'beta.cyomed'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'akte'.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR,
      '..'.DIRECTORY_SEPARATOR.'beta.cyomed'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'portal'.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR,
      '..'.DIRECTORY_SEPARATOR.'beta.cyomed'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'rezept'.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR,
      '..'.DIRECTORY_SEPARATOR.'beta.cyomed'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'tarif'.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR,
      '..'.DIRECTORY_SEPARATOR.'beta.cyomed'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'termin'.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR,
      '..'.DIRECTORY_SEPARATOR.'beta.cyomed'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'video'.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR,
    );

    $lines = array(); 

    foreach ($dirs as $dir)
    {
      $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

      foreach ($rii as $file) {

        if ($file->isDir()){ 
          continue;
        }

        $pathname = $file->getPathname();
        $filename = $file->getFilename();
        $basename = $file->getBasename();
        if (($pos1 = strpos($pathname, 'language'.DIRECTORY_SEPARATOR)) !== FALSE)
        {
          $language = substr($pathname, strpos($pathname, 'language'.DIRECTORY_SEPARATOR) + strlen('language'.DIRECTORY_SEPARATOR));
          
          if (($pos1 = strpos($language, DIRECTORY_SEPARATOR)) !== FALSE)
          {
            $relpath = substr($language, strpos($language, DIRECTORY_SEPARATOR) + 1);
            $language = substr($language, 0, strpos($language, DIRECTORY_SEPARATOR));
          }
          else
          {
            $relpath = $filename;
            $language = 'none';
          }
        }
        else
        {
          $relpath = $filename;
          $language = 'none';
        }

        if (($pos1 = strpos($pathname, 'application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR)) !== FALSE)
        {
          $module = substr($pathname, strpos($pathname, 'application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR) + strlen('application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR));
          $module = substr($module, 0, strpos($module, DIRECTORY_SEPARATOR));
        }
        else
        {
          $module = '-';
        }

        if (strpos($filename, '_lang.php') === FALSE) {
          continue;
        }

        $prev_lang = isset($lang) ? $lang : array();
        unset($lang);

        $lang = array();

        @include ($pathname);

        foreach ($lang as $key => $value)
        {
          if ( ! isset($lines[$key]))
            $lines[$key] = array(
              'key' => $key, 
            );

          // if (isset($lines[$key]['relpath'])) {
          //   $prev_line = $lines[$key];

          //   $prev_filename = $prev_line['filename'];

          //   if (is_array($prev_filename) && count($prev_filename) > 0) {
          //     if (count($prev_filename) > 1) {
          //       exit('modules/admin/controllers/language_pack fatal error.');
          //     }

          //     $prev_filename = $prev_filename[0];
          //   }

          //   if (is_string($prev_filename)) {
          //     $prev_filename = substr($prev_filename, 0, strpos($prev_filename, '_lang'));
          //   } else {
          //     exit('modules/admin/controllers/language_pack fatal error.');
          //   }

          //   $lines[$prev_filename.'_'.$key] = $prev_line;

          //   $cut_filename = substr($filename, 0, strpos($filename, '_lang'));
          //   $key = $cut_filename.'_'.$key;

          //   $lines[$key] = array(
          //     'key' => $key, 
          //   );
          // }

          foreach (array('relpath', 'pathname', 'filename', 'basename', 'module', ) as $var) {
            if ( ! isset($lines[$key][$var]))
            {
              $lines[$key][$var] = array();
            }

            if ( ! in_array($$var, $lines[$key][$var]))
              $lines[$key][$var][] = $$var;
          }

          // $lines[$key]['module'] = $module;
          $lines[$key]['lang_'.$language] = $value;

        }

        $lang = $prev_lang;
        unset($prev_lang);

      }
    }

    return $this->lines = $lines;
  }

  /**
   *
   */
  public function file_system_to_db($lines = array(), $hidden_fields = array())
  {
    if ( empty($lines))
      $lines = $this->lines;

    if ( empty($lines))
      return $this->lines = $lines;

    $hidden_fields = ! empty($hidden_fields) && is_array($hidden_fields) ? $hidden_fields : 
      array('id', 'key', 'relpath', 'pathname', 'filename', 'basename', 'module', );

    $this->mod->port->p->db_select();
    $table_fields = $this->mod->port->p->list_fields('lang');
    $this->load->dbforge($this->mod->port->p);

    foreach ($lines as $key => $line_data)
    {
      $key_rel = FALSE;

      if (is_array($line_data['relpath']))
      {
        if (count($line_data['relpath']) > 1)
        {
          // Step 1. Get the candidates.
          // 
          // global\general_text_lang.php      candidates: global_general_text, general_text
          // global\blah\general_text_lang.php candidates: global_blah_general_text, blah_general_text, general_text
          $pref_candidates = array();
          foreach ($line_data['relpath'] as $rel)
          {
            $pref_candidates[$rel] = array();

            // termin_lang.php                   => termin (for sure will be candidates)
            // global\general_text_lang.php      => global_general_text, general_text (if has slash or backslash)
            // global\blah\general_text_lang.php => global_blah_general_text, blah_general_text, general_text (if has more..)
            $prep = str_replace('\\', '/', substr($rel, 0, strlen($rel) - strlen('_lang.php') ) );
            $pref_candidates[$rel][] = str_replace('/', '_', $prep);
            while ( ( $pos = strpos($prep, '/') ) !== FALSE )
            {
              $prep = substr($prep, $pos + 1);
              $pref_candidates[$rel][] = str_replace('/', '_', $prep);
            }

            // Sanitize and remove duplicated values (not so likely now, very possible before tho)
            $pref_candidates[$rel] = array_values(array_unique($pref_candidates[$rel]));
          }

          $key_rel = array();

          // Step 2. Check relpaths' candidates for hits
          $hit_found = FALSE;
          foreach ($pref_candidates as $rel => $candidates)
          {
            foreach ($candidates as $candidate)
            {
              if (strpos($key, $candidate) === 0)
              {
                $hit_found = TRUE;

                $key_rel[$key] = $rel;

                $bare_key = substr($key, strlen($candidate));

                foreach ($pref_candidates as $other_rel => $other_candidates)
                {
                  if ($other_rel !== $rel)
                  {
                    $prep_other_rel = str_replace(array('\\', '/'), '_', substr($other_rel, 0, strlen($other_rel) - strlen('_lang.php') ) );
                    $key_rel[$prep_other_rel.$bare_key] = $other_rel;
                  }
                }

                break;
              }
            }
            if ($hit_found) break;
          }

          // Step 3. If no hits, 
          // grab first relpath for original key,
          // add relpaths to beginning of key to generate new keys.
          if (!$hit_found)
          {
            $key_rel[$key] = $line_data['relpath'][0];

            foreach ($line_data['relpath'] as $rel)
            {
              $prep_rel = str_replace(array('\\', '/'), '_', substr($rel, 0, strlen($rel) - strlen('_lang.php') ) );
              $key_rel[$prep_rel.'_'.$key] = $rel;
            }
          }

        }
        elseif (count($line_data['relpath']) === 1)
        {
          $key_rel[$key] = $line_data['relpath'][0];
        }
      }

      if ($key_rel && is_array($key_rel) && count($key_rel) > 0)
      {
        foreach ($key_rel as $re_key => $relpath)
        {

          $module = is_array($line_data['module']) ? (count($line_data['module']) == 1 ? $line_data['module'][0] : '-') : $line_data['module'];

          $relpath = ($module == '-' ? '..' : $module) . '/'. $relpath;
          $relpath = str_replace('\\', '/', $relpath);

          // patients\\casehistory_lang

          $query = $this->mod->port->p->get_where('lang', array('key' => $re_key, 'relpath' => $relpath), 1);

          if ($query->num_rows() > 0)
          {
            $this->mod->port->p->where('key', $re_key);
            $this->mod->port->p->where('relpath', $relpath);
            $this->mod->port->p->limit(1);
          }
          else
          {
            $this->mod->port->p->set('key', $re_key);
            $this->mod->port->p->set('relpath', $relpath);
          }

          foreach ($line_data as $var => $value)
          {
            if ( ! in_array($var, $hidden_fields) && ! is_array($value) )
            {
              if ( ! in_array($var, $table_fields) )
              {
                $new_fields = array();
                $new_fields[$var] = array('type' => 'TEXT', 'null' => FALSE, );
                $this->dbforge->add_column('lang', $new_fields);
                
                $table_fields[] = $this->mod->port->p->data_cache['field_names']['lang'][] = $var;
              }

              $this->mod->port->p->set($var, $value);
            }
          }

          if ($query->num_rows() > 0)
          {
            $this->mod->port->p->update('lang');
          }
          else
          {
            $this->mod->port->p->insert('lang');
          }

        }
      }
    }

  }

  /**
   *
   */
  public function to_excel($lines = array(), $filename = "language.xls", $hidden_fields = array())
  {
    $filename = !empty($filename) ? $filename : "language_db.xls";

    $lines = !empty($lines) ? $lines : (!empty($this->lines) ? $this->lines : $this->modlang->from_database());
    $langs = array();

    $hidden_fields = !empty($hidden_fields) ? $hidden_fields : array();

    if ($lines && is_array($lines) && count($lines) > 0)
    {
      foreach ($lines as $row)
      {
        foreach ($row as $field => $value)
        {
          if ( ! in_array($field, $langs) && ! in_array($field, ! empty($hidden_fields) ? $hidden_fields : array() ) )
          {
            array_push($langs, $field);
          }
        }
      }
    }

    // load our new PHPExcel library
    $this->load->library('excel');

    // activate worksheet number 1
    $this->excel->setActiveSheetIndex(0);

    // 
    $this->excel->getProperties()->setTitle("Language")->setDescription("none");

    // name the worksheet
    $this->excel->getActiveSheet()->setTitle('Language');

    // Field names
    $col = 0;
    foreach ($langs as $field)
    {
      // set cell A1 content with some text
      $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);

      // change the font size
      $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, 1)->getFont()->setSize(20);

      // make the font become bold
      $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, 1)->getFont()->setBold(true);

      // set aligment to center for that cell
      $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, 1)->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // ->setWrapText(true);

      $col++;
    }

    $sheet = $this->excel->getActiveSheet();
    $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(true);
    /** @var PHPExcel_Cell $cell */
    foreach ($cellIterator as $cell) {
      $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
    }

    // Fetching the language data
    $row = 2;
    foreach ($lines as $key => $line)
    {
      $col = 0;
      foreach ($langs as $field)
      {
        $value = isset($line[$field]) ? $line[$field] : '';

        if ( ! in_array($field, ! empty($hidden_fields) ? $hidden_fields : array() ) )
        {
          if (is_array($value))
          {
            if (count($value) > 1)
            {
              // set cell A1 content with some text
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, implode("\r\n", $value));
              
              // set wrap
              $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->getAlignment()->setWrapText(true);
            }
            else
            {
              // set cell A1 content with some text
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value[0]);
            }
          }
          else
          {
            // set cell A1 content with some text
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
          }
        }

        // change the font size
        $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->getFont()->setSize(12);

        // set aligment to vertical center for that cell
        $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->getAlignment()
          ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          // ->setWrapText(true);

        $col++;
      }

      $row++;
    }

    $this->excel->setActiveSheetIndex(0);

    // mime type
    header('Content-Type: application/vnd.ms-excel');
    
    // tell browser what's the file name
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    
    // no cache
    header('Cache-Control: max-age=0');

    // save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    // if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

    // force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');
  }

  /**
   * 
   */
  public function from_excel($lines = array(), $hidden_fields = array())
  {
    if ( ! ($upload_result = $this->do_upload_excel('lang') ) )
      return FALSE;

    $full_path = $upload_result['full_path'];

    $lines = ! empty($lines) ? $lines : ( ! empty($this->lines) ? $this->lines : $this->modlang->from_database() );
    $hidden_fields = ! empty($hidden_fields) && is_array($hidden_fields) ? $hidden_fields : 
      array('id', 'key', 'relpath', 'pathname', 'filename', 'basename', 'module', );

    $import = array();

    $this->mod->port->p->db_select();
    $table_fields = $this->mod->port->p->list_fields('lang');
    $this->load->dbforge($this->mod->port->p);

    // load our new PHPExcel library
    $this->load->library('excel');

    $objPHPExcel = PHPExcel_IOFactory::load($full_path);
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
    {
      // Worksheet's Title, e.g. Language
      $worksheetTitle = $worksheet->getTitle();
      // e.g. 1435
      $numRows        = $worksheet->getHighestRow();
      // e.g. 'F'
      $highestColumn  = $worksheet->getHighestColumn();
      // e.g. 5
      $numCols        = PHPExcel_Cell::columnIndexFromString($highestColumn);

      $fields = array();

      for ($row = 1; $row <= $numRows; ++ $row)
      {
        $row_obj = (object) array();

        for ($col = 0; $col < $numCols; ++ $col)
        {
          $cell = $worksheet->getCellByColumnAndRow($col, $row);
          $val = $cell->getValue();
          $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

          if ($row === 1)
          {
            $val && $fields[$col] = $val;
          }
          else
          {
            if (isset($fields[$col]))
            {
              $row_obj->{$fields[$col]} = $val;
            }
          }
        }

        if ($row === 1) continue;
        if (empty($row_obj->key) || empty($row_obj->relpath)) continue;

        $import = array_merge($import, $this->to_database([(array) $row_obj, ], $lines, $hidden_fields) );

      }
    }

    $this->mod->port->p->reset_query();

    return $import;
  }

  /**
   *
   */
  public function do_upload_excel($type = 'lang')
  {
    $config = array();

    $config['upload_path'] = './assets/uploads/admin/'.md5($this->mod->user_id()).'/'.trim($type, '/').'/';
    $config['allowed_types'] = '*';
    $config['file_name'] = microtime(TRUE).'.xls';
    // $config['max_size'] = '100';
    // $config['max_width']  = '1024';
    // $config['max_height']  = '768';

    if (!file_exists($config['upload_path'])) {
      mkdir($config['upload_path'], 0777, true);
    }

    $permission_string = '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
    $this->load->helper('file');
    write_file($config['upload_path'].'index.html', $permission_string);

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ($this->upload->do_upload($type))
    {
      return $this->upload->data();
    }
    else
    {
      return FALSE;
    }
  }

  /**
   *
   */
  public function to_database($updates = array(), $lines = array(), $hidden_fields = array())
  {
    $lines = ! empty($lines) ? $lines : ( ! empty($this->lines) ? $this->lines : $this->modlang->from_database() );
    $hidden_fields = ! empty($hidden_fields) && is_array($hidden_fields) ? $hidden_fields : 
      array('id', 'key', 'relpath', 'pathname', 'filename', 'basename', 'module', );

    $import = array();

    $this->mod->port->p->db_select();
    $table_fields = $this->mod->port->p->list_fields('lang');
    $this->load->dbforge($this->mod->port->p);

    foreach ($updates as $row)
    {
      if (empty($row['key']) || empty($row['relpath'])) continue;

      $key = $row['key'];
      $push = FALSE;

      $this->mod->port->p->reset_query();

      if (isset($lines[$key]))
      {
        $this->mod->port->p->where('key', $key);
        $this->mod->port->p->where('relpath', $row['relpath']);
        $this->mod->port->p->limit(1);
      }
      else
      {
        $this->mod->port->p->set('key', $key);
        $this->mod->port->p->set('relpath', $row['relpath']);
        $push = TRUE;
      }

      foreach ($row as $var => $value)
      {
        if ( ! in_array($var, $hidden_fields) )
        {
          $set = FALSE;

          if (isset($lines[$key]) && isset($lines[$key][$var]) && ! is_array($lines[$key][$var]) )
          {
            $new = $value;
            $old = $lines[$key][$var];

            $new = htmlspecialchars(str_replace(array("\r\n", "\n\r", "\n", "\r"), '', nl2br(remove_invisible_characters($new))));
            $old = htmlspecialchars(str_replace(array("\r\n", "\n\r", "\n", "\r"), '', nl2br(remove_invisible_characters($old))));

            if ($new != $old)
            {
              $set = TRUE;
            }
          }
          else
          {
            $set = TRUE;
          }

          if ($set)
          {
            if ( ! in_array($var, $table_fields))
            {
              $new_fields = array();
              $new_fields[$var] = array('type' => 'TEXT', 'null' => FALSE, );
              $this->dbforge->add_column('lang', $new_fields);
              
              $table_fields[] = $this->mod->port->p->data_cache['field_names']['lang'][] = $var;
            }

            $this->mod->port->p->set($var, $value ? $value : '');
            $push = TRUE;
          }
        }
      }

      if ($push) 
      {
        $import[$key] = (array) $row;

        if (isset($lines[$key]))
        {
          $this->mod->port->p->update('lang');
        }
        else
        {
          $this->mod->port->p->insert('lang');
        }
      }

    }

    $this->mod->port->p->reset_query();

    return $import;
  }

  /**
   *
   */
  public function from_database()
  {
    $lines = array(); 

    $this->mod->port->p->db_select();

    $table_fields = $this->mod->port->p->list_fields('lang');

    $query = $this->mod->port->p->get_where('lang');
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $key = $row->key;

        if ( ! isset($lines[$key]))
          $lines[$key] = array(
            'key' => $key, 
          );

        foreach ($row as $var => $value)
        {
          if ( in_array($var, array('id', 'relpath', 'pathname', 'filename', 'basename', 'module', ) ) )
          {
            if ( ! isset($lines[$key][$var]))
            {
              $lines[$key][$var] = array();
            }

            if ( ! in_array($value, $lines[$key][$var]))
              $lines[$key][$var][] = $value;
          }
          else
          {
            $lines[$key][$var] = $value;
          }
        }

      }
    }

    return $this->lines = $lines;
  }


}

/* End of file Modlang.php */
/* Location: ./application/modules/translate/models/Modlang.php */