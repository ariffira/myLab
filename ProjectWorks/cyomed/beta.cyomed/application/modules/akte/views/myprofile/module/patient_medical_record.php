<?php $this->ui->feed_item->base_init(); ?>
<?php if (isset($entries) && is_array($entries) && count($entries) > 0) { ?>
    <?php foreach ($entries as $entry_index => $entry) : ?>
      
        <?php
          if (!empty($entry->feed_type))
            switch ($entry->feed_type) {
              case 'condition':
                $this->ui->feed_item->icon = 'fa fa-smile-o';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - befinden: '.'<a href="javascript:;">'.$entry->title.'</a>');
                break;
              case 'diagnosis':
                $this->ui->feed_item->icon = 'fa fa-stethoscope';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - '.(empty($entry->entry_from) ? 'Diagnose' : 'Travel Diagnose').': '.'<a href="javascript:;">'.$entry->title.'</a>');
                break;
              case 'medication':
                $this->ui->feed_item->icon = 'fa fa-table';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - Medikamente: '.'<a href="javascript:;">'.$entry->name.'</a>');
                break;
              case 'vaccination':
                $this->ui->feed_item->icon = 'fa fa-medkit';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - Impfung: '.'<a href="javascript:;">'.$entry->Handelsname.'</a>');
                break;
              case 'blood_pressure':
                $this->ui->feed_item->icon = 'fa fa-heartbeat';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - Blutdruck');
                break;
              case 'blood_sugar':
                $this->ui->feed_item->icon = 'fa fa-tint';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - Blutzucker');
                break;
              case 'weight_bmi':
                $this->ui->feed_item->icon = 'fa fa-street-view';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - Gewicht &amp; BMI');
                break;
              case 'marcumar':
                $this->ui->feed_item->icon = 'fa fa-area-chart';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - Marcumar');
                break;
            
              default:
                $this->ui->feed_item->icon = 'fa fa-asterisk';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - Feed: '.'<a href="javascript:;">#'.$entry->id.'</a>');
                break;
            }
          $this->ui->feed_item->content->options('class', '');

          if (!empty($entry->feed_type))
            if (in_array($entry->feed_type, array('condition', 'diagnosis', 'medication', 'vaccination', ))) {
              $this->ui->feed_item->content(
                'content',
                $this->load->view(($entry->feed_type).'/'.($entry->feed_type).'_home_view', array(
                  'entry' => $entry,
                  'hide_insert' => TRUE,
                  'static' => TRUE, 
                  'readonly' => FALSE,
                  'update_btn' => TRUE,
                  'emergency_btn' => FALSE,
                  'confirm_btn' => FALSE,
                  'archive_btn' => FALSE,
                  'delete_btn' => TRUE,
                ), TRUE)
              );
              $this->ui->feed_item->actions->append('like', '<a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a>');
              $this->ui->feed_item->actions->append('comment', '<a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>');
              $this->ui->feed_item->actions->append('time', '<a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> '.date('d.m.Y', strtotime($entry->document_date)).'</a>');
              echo $this->ui->feed_item->output();
            } elseif (in_array($entry->feed_type, array('blood_pressure', 'blood_sugar', 'weight_bmi', 'marcumar', ))) {
              $this->load->view('graph'.'/'.($entry->feed_type).'_feed_view', array(
                'entries' => $entry->entries,
              ));
            }
            else 
            {
              $this->ui->feed_item->content(
                'content',
                '<ul class="icons-list">'.
                '  <li>'.
                '    <i class="icon-li fa fa-quote-left"></i>'.
                '    #Entry_'.$entry->id.
                '  </li>'.
                '</ul>'
              );
              echo $this->ui->feed_item->output();
            }
        ?>
    <?php endforeach; ?>
<?php }
else
{
  ?>
<h1 class="p-20 m-20"><i class="fa fa-warning"></i> No Record Found !</h1>
          <?php }
  ?>     
  



