<?php $this->ui->tile->base_init(); ?>


<div class="row">

  <div class="col-md-12">
    <?php
    static $_ci;

    if (empty($_ci)) $_ci =& get_instance();
  
        $data['questions']=$questions;
//        $data['medicine']=$medicine;
        $this->ui->tile->title('content', $this->lang->line('epres_questions_title'));
        $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
        $this->ui->tile->body(
          'content',
          $this->load->view('rezept/e_question_view', $data, TRUE)
          //$this->load->view('epres_questions_view', $data, TRUE)
        );
        echo $this->ui->tile->output();
    ?>
  </div>

</div>

 <script>
    $.pageSetup($('#content'));
  </script>

  <script type="text/javascript">
        $(function(){

                  $('#atc_code').autocomplete({

                    source: $.siteUrl + "/akte/autocomplete/atc_by_code",
                    minLength: 1,

                    select: function(event, ui){
                        $('#wirkstoff').val(ui.item.substance);
        
                  }
                  });

                  $('#wirkstoff').autocomplete({

                    source: $.siteUrl + "/akte/autocomplete/atc_by_name",
                    minLength: 1,

                    select: function(event, ui){
                      $.ajax({
                           type:'POST',
                           url:$.siteUrl + "/akte/medication/fetchmedication",
                           data:{'patientId':<?php echo $_ci->m->user_id();?>,'atc_code':ui.item.atc},
                           success:function(json){
                            if(json!=''){
                            var responseData = $.parseJSON(json);
				$("input[name=question1][value=ja]").parent().addClass('checked');
                                $("input[name=question1][value=ja]").parent().attr('aria-checked',true);
				$("#question2").val(responseData.dose_rate);
				$("#question3").val(responseData.taken_since);
				$("#question4").val(responseData.repeating_periods);
				var takentime = responseData.taken_time;
				$.each(takentime.split(","), function(i,e){
                                    	$("#question5 option[value='" + e + "']").attr("selected", true);
				});
				
				
			}
   
                           }
                        });
                        $('#atc_code').val(ui.item.atc);
                  }
                  });


              //Styling for the autocomplete widgets with maximum height and scrollbar
                $(".ui-autocomplete").css({"color":"white","max-Height":"250px","overflow-y":"auto","overflow-x":"hidden"});
        });
        </script>

