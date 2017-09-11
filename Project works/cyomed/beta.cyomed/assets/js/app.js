$.navLinksSelector =
  '#sidebar > .side-menu > li > a, ' +
  '#sidebar > .side-menu > li > ul > li > a, ' +
  'a.ajax-nav-links, a.ajax-nav-link, ' +
  'header.navbar > a.ajax-nav-links, ' +
  '.mainnav > a.ajax-nav-links';

/*
 * Convert HEX color to an array of (r,g,b)
 */
$.convertHex2RGB = function(hex) {
  if (hex.indexOf('#') === 0) {
    hex = hex.substring(1);
  }

  hex = parseInt(hex, 16);

  var r = (hex >> 16) & 255;
  var g = (hex >> 8) & 255;
  var b = (hex >> 0) & 255;

  return [r, g, b];
};

(function(){
  $(window).on('popstate',function(event){
      if(event.originalEvent.state){   //check if dom element exists
        $.loadUrl(event.originalEvent.state.url,$(document).find(event.originalEvent.state.container),'',false);
      }
      else{
          window.location.reload(true);
      }
  });
})();
/*
 * LOAD AJAX PAGES
 */
$.loadUrl = function(url, container, successCallback, pushToHistory) {
  if(pushToHistory !== false){
    pushToHistory = true;
  }
  if(pushToHistory && url.substring($.siteUrl.length) !='/akte/feed/general'){
    history.pushState({container: container.selector, url: url},'title 1',url);
  }else if(container.selector=='#content' && url.substring($.siteUrl.length)=='/rezept/r_question'){
      history.replaceState(null,null,$.siteUrl+'/akte');
      history.pushState(null,null,$.siteUrl+'/rezept');
  }


  $.ajax({
    type: "GET",
    url: url,
    dataType: 'html',
    cache: true, // (warning: setting it to false will cause a timestamp and will call the request twice)
    beforeSend: function() {

      //IE11 bug fix for googlemaps (delete all google map instances)
      //check if the page is ajax = true, has google map class and the container is #content
      // if ($(".google_maps")[0] && (container[0] == $("#content")[0])) {

      //   // target gmaps if any on page
      //   var collection = $(".google_maps"),
      //     i = 0;
      //   // run for each map
      //   collection.each(function() {
      //     i++;
      //     // get map id from class elements
      //     var divDealerMap = document.getElementById(this.id);

      //     if (i == collection.length + 1) {
      //       // "callback"
      //       /*console.log("all maps destroyed");*/
      //     } else {
      //       // destroy every map found
      //       if (divDealerMap) divDealerMap.parentNode.removeChild(divDealerMap);
      //       /*console.log(this.id + " destroying maps...");*/
      //     }
      //   });

      //   /*console.log("google maps nuked!!!");*/

      // } //end fix

      // // destroy all datatable instances
      // if ($('.dataTables_wrapper')[0] && (container[0] == $("#content")[0])) {

      //   var tables = $.fn.dataTable.fnTables(true);
      //   $(tables).each(function() {
      //     $(this).dataTable().fnDestroy();
      //   });
      //   /*console.log("datatable nuked!!!");*/
      // }
      // end destroy

      // empty container and var to start garbage collection (frees memory)
      //container.removeData().html("");

      // place cog
      //container.html('<h1 class="p-20 m-20"><i class="fa fa-cog fa-spin"></i> Loading..</h1>');
	  var image_path = $.baseUrl+'assets/img/loading.png';
	  $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');

      // Only draw breadcrumb if it is main content material
      if (container[0] == $("#content")[0]) {

        // clear everything else except these key DOM elements
        // we do this because sometime plugins will leave dynamic elements behind
        // $('body').find('> *').filter(':not(' + ignore_key_elms + ')').empty().remove();

        // scroll up
        $("html").animate({
          scrollTop: 0
        }, "fast");
      }
      // end if
    },
    success: function(data) {

		$("#loadingDiv").remove();
      // dump data to container
      container.css({
        /*opacity: '0.0'*/
      }).html(data).delay(50).animate({
        opacity: '1.0'
      }, 300);

      // clear data var
      data = null;
      container = null;

      // clear everything else except these key DOM elements
      // we do this because sometime plugins will leave dynamic elements behind
      // $('body').find('> *').attr('data-toggle', 'keep-on-page').data('toggle', 'keep-on-page');

      // $('body').find('> *').filter(':not(' + '[data-toggle="keep-on-page"]' + ')').empty().remove();
      $("#linechart-tooltip").hide();

      $($.navLinksSelector).filter('[href]').each(function() {
        /*console.log('searching [' + $(this).attr('href') + '] in [' + url + ']');*/
        $($.navLinksSelector).parents('li').toggleClass('active', false);
        if (url == $(this).attr('href')) {
          // $('.mainnav-menu').find('li, a').toggleClass('active', false);          
          $(this).toggleClass('active', true).parents('li').toggleClass('active', true);
          return false;
        }
      });

      if (typeof successCallback !== 'undefined' && successCallback) {
        successCallback();
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      container.html('<h1 class="p-20 m-20"><i class="fa fa-warning"></i> Error! ' + thrownError + '</h4>');
    },
    statusCode: {
      403: function(result) {
        console.log(result.responseText);
        console.log("403 forbidden");
        location.reload(true);
      },
      404: function(result) {
        console.log(result.responseText);
        console.log("404 page not found");
      },
      500: function(result) {
        console.log(result.responseText);
        console.log("500 internal error");
      },
    },
    async: true,
  });

  /*console.log("ajax request sent");*/
}

$.pageSetup = function($scope) {

  if (typeof $scope === 'undefined' || !$scope) {
    $scope = $(document);
  }

  /* --------------------------------------------------------
  Components
  -----------------------------------------------------------*/
  (function() {
    /* Textarea */
    if ($scope.find('.auto-size')[0]) {
      $scope.find('.auto-size').autosize();
    }

    //Select
    if ($scope.find('.select')[0]) {
      $scope.find('.select').selectpicker().on('change', function() {
        $(this).selectpicker('refresh');
      });
    }

    //Sortable
    if ($scope.find('.sortable')[0]) {
      $scope.find('.sortable').sortable();
    }

    //Tag Select
    if ($scope.find('.tag-select')[0]) {
      $scope.find('.tag-select').chosen();
    }

    /* Tab */
    if ($scope.find('.tab')[0]) {
      $scope.find('.tab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
      });
    }

    if ($.uiName == 'sa103') {
      /* Collapse */
      if ($scope.find('.collapse')[0]) {
        $scope.find('.collapse').collapse();
      }

      /* Accordion */
      $scope.find('.panel-collapse').off('shown.bs.collapse').on('shown.bs.collapse', function() {
        $(this).prev().find('.panel-title a').removeClass('active');
      });

      $scope.find('.panel-collapse').off('hidden.bs.collapse').on('hidden.bs.collapse', function() {
        $(this).prev().find('.panel-title a').addClass('active');
      });
    }

    //Popover
    if ($scope.find('.pover')[0]) {
      $scope.find('.pover').popover();
    }
  })();

  /* --------------------------------------------------------
  Todo List
  -----------------------------------------------------------*/
  (function() {
    setTimeout(function() {
      //Add line-through for alreadt checked items
      $scope.find('.todo-list .media .checked').each(function() {
        $(this).closest('.media').find('.checkbox label').css('text-decoration', 'line-through')
      });
    })
  })();

  /* --------------------------------------------------------
  Custom Scrollbar
  -----------------------------------------------------------*/
  (function() {
    if ($scope.find('.overflow')[0]) {
      var overflowRegular, overflowInvisible = false;
      overflowRegular = $scope.find('.overflow').niceScroll();
    }
  })();

  /* --------------------------------------------------------
  Calendar
  -----------------------------------------------------------*/
  (function() {

    //Sidebar
    if ($scope.find('#sidebar-calendar')[0]) {
        var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      $scope.find('#sidebar-calendar').fullCalendar({
        editable: false,
        events: [],
        header: {
          left: 'title'
        },dayClick: function(date, jsEvent, view) {
          date = date.format();
          $.ajax({
            url:$.siteUrl+'/akte/overview/getPatientReservation',
            data:{'date':date},
            type:'POST',
            beforeSend:function(html){
                var image_path = '../assets/img/process.gif';
                $("#reservation").html("<center><img src='"+image_path+"' /></center>");
            },
            success:function(html){
               $("#reservation").html(html);
               $(".sidebar-calendar-block").toggleClass('sidebar-calendar1');
            }
          });
        // change the day's background color just for fun
       $(".fc-today").removeClass("fc-today");
       $(this).addClass('fc-today');
    }
      });
    }

    //Content widget
    if ($scope.find('#calendar-widget')[0]) {
      $scope.find('#calendar-widget').fullCalendar({
        header: {
          left: 'title',
          right: 'prev, next',
        },
        editable: true,
        events: [{
          title: 'All Day Event',
          start: new Date(y, m, 1)
        }, {
          title: 'Long Event',
          start: new Date(y, m, d - 5),
          end: new Date(y, m, d - 2)
        }, {
          title: 'Repeat Event',
          start: new Date(y, m, 3),
          allDay: false
        }, {
          title: 'Repeat Event',
          start: new Date(y, m, 4),
          allDay: false
        }]
      });
    }

  })();

  /* --------------------------------------------------------
  Form Validation
  -----------------------------------------------------------*/
  (function() {
    if ($scope.find("[class*='form-validation']")[0]) {
      $scope.find("[class*='form-validation']").validationEngine();
    }
  })();

  /* --------------------------------------------------------
     Color Picker
  -----------------------------------------------------------*/
  (function() {
    //Default - hex
    if ($scope.find('.color-picker')[0]) {
      $scope.find('.color-picker').colorpicker();
    }

    //RGB
    if ($scope.find('.color-picker-rgb')[0]) {
      $scope.find('.color-picker-rgb').colorpicker({
        format: 'rgb'
      });
    }

    //RGBA
    if ($scope.find('.color-picker-rgba')[0]) {
      $scope.find('.color-picker-rgba').colorpicker({
        format: 'rgba'
      });
    }

    //Output Color
    if ($scope.find('[class*="color-picker"]')[0]) {
      $scope.find('[class*="color-picker"]').colorpicker().off('changeColor').on('changeColor', function(e) {
        var colorThis = $(this).val();
        $(this).closest('.color-pick').find('.color-preview').css('background', e.color.toHex());
      });
    }
  })();

  /* --------------------------------------------------------
     Date Time Picker
    -----------------------------------------------------------*/
(function() {

     
        var checkin=$scope.find(".diagnosis_startdate").datetimepicker({	  
        pickTime: false
      }).on('changeDate', function(ev) {
        $(this).datetimepicker('hide');
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setStartDate(newDate);
      }).data('datetimepicker');
      if(checkin){
     var date=new Date(checkin._date);
      date.setDate(date.getDate() + 1);
      
      
      var checkout=   $(".diagnosis_enddate").datetimepicker({	  
        pickTime: false,
        startDate:date,
      }).on('changeDate', function() {
        $(this).datetimepicker('hide');
      }).data('datetimepicker');
      }
})();


(function() {
    
      var fullDate = new Date();
      fullDate.setDate(fullDate.getDate());
     if ($scope.find('.dob')) { 
     $scope.find(".dob").each(function(){
         $(this).datetimepicker({
        pickTime: false,
        endDate:fullDate,
      }).on('changeDate', function() {
        $(this).datetimepicker('hide');
      }).data('datetimepicker');
      })}
})();


  (function() {
      
    
    // Date Only
    if ($scope.find('.date-only')) {
        $scope.find('.date-only').each(function(){
        $(this).datetimepicker({	  
        pickTime: false,
        autoclose: true,
      }).on('changeDate', function() { 
        $(this).datetimepicker('hide');
      });
    });
    }

    if($scope.find('.date-picker')){
      $scope.find('.date-picker').each(function(){
        $(this).datetimepicker($.extend({
        pickTime: false,
        autoclose:true,
        //format: "dd.MM.yyyy",
        },$.datetimepickerOptions)).blur( function(ev){
            $(this).datetimepicker('hide');
            })
          .on('changeDate', function(ev){
            $(this).datetimepicker('hide');
        });
      });
    }

    //Time only
    if ($scope.find('.time-only')[0]) {
     $scope.find('.time-only').each(function(){
      $(this).datetimepicker({
        pickDate: false,
        autoclose:true,
      });
    });
    }

    //time-picker
    if ($scope.find('.time-picker')[0]) {
     $scope.find('.time-picker').each(function(){
      $(this).datetimepicker($.extend({
      pickDate: false,
      autoclose:true,
      format: "hh:mm",
      }, 
      $.datetimepickerOptions)).blur( function(ev){
        $(this).datetimepicker('hide');
      });
    });
    }    

    //12 Hour Time
    if ($scope.find('.time-only-12')[0]) {
      $scope.find('.time-only-12').datetimepicker({
        pickDate: false,
        pick12HourFormat: true
      });
    }

    $scope.find('.datetime-pick input:text').off('click').on('click', function() {
      $(this).closest('.datetime-pick').find('.add-on i').click();
    });
  })();

  /* --------------------------------------------------------
     Input Slider
    -----------------------------------------------------------*/
//  (function() {
//    if ($scope.find('.input-slider')[0]) {
//      $scope.find('.input-slider').slider().off('slide').on('slide', function(ev) {
//        $(this).closest('.slider-container').find('.slider-value').val(ev.value);
//      });
//    }
//  })();

  /* --------------------------------------------------------
     WYSIWYE Editor + Markedown
    -----------------------------------------------------------*/
  (function() {
    //Markedown
    if ($scope.find('.markdown-editor')[0]) {
      $scope.find('.markdown-editor').markdown({
        autofocus: false,
        savable: false
      });
    }

    //WYSIWYE Editor
    if ($scope.find('.wysiwye-editor')[0]) {
      $scope.find('.wysiwye-editor').summernote({
        height: 200
      });
    }

  })();

  /* --------------------------------------------------------
     Media Player
    -----------------------------------------------------------*/
  (function() {
    if ($scope.find('audio, video')[0]) {
      $scope.find('audio,video').mediaelementplayer({
        success: function(player, node) {
          $('#' + node.id + '-mode').html('mode: ' + player.pluginType);
        }
      });
    }
  })();

  /* ---------------------------
  Image Popup [Pirobox]
    --------------------------- */
  (function() {
    if ($scope.find('.pirobox_gall')[0]) {
      //Fix IE
      jQuery.browser = {};
      (function() {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
          jQuery.browser.msie = true;
          jQuery.browser.version = RegExp.$1;
        }
      })();

      //Lightbox
      $().piroBox_ext({
        piro_speed: 700,
        bg_alpha: 0.5,
        piro_scroll: true // pirobox always positioned at the center of the page
      });
    }
  })();

  /* ---------------------------
     Vertical tab
     --------------------------- */
  (function() {
    $scope.find('.tab-vertical').each(function() {
      var tabHeight = $(this).outerHeight();
      var tabContentHeight = $(this).closest('.tab-container').find('.tab-content').outerHeight();

      if ((tabContentHeight) > (tabHeight)) {
        $(this).height(tabContentHeight);
      }
    })


  })();

  /* --------------------------------------------------------
     Checkbox + Radio
    -----------------------------------------------------------*/
  if ($scope.find('input:checkbox, input:radio')[0]) {

    //Checkbox + Radio skin
    $scope.find('input:checkbox:not([data-toggle="buttons"] input, .make-switch input), input:radio:not([data-toggle="buttons"] input)').iCheck({
      checkboxClass: 'icheckbox_minimal',
      radioClass: 'iradio_minimal',
      increaseArea: '20%' // optional
    });

    //Checkbox listing
    var parentCheck = $scope.find('.list-parent-check');
    var listCheck = $scope.find('.list-check');

    parentCheck.off('ifChecked').on('ifChecked', function() {
      $(this).closest('.list-container').find('.list-check').iCheck('check');
    });

    parentCheck.off('ifClicked').on('ifClicked', function() {
      $(this).closest('.list-container').find('.list-check').iCheck('uncheck');
    });

    listCheck.off('ifChecked').on('ifChecked', function() {
      var parent = $(this).closest('.list-container').find('.list-parent-check');
      var thisCheck = $(this).closest('.list-container').find('.list-check');
      var thisChecked = $(this).closest('.list-container').find('.list-check:checked');

      if (thisCheck.length == thisChecked.length) {
        parent.iCheck('check');
      }
    });

    listCheck.off('ifUnchecked').on('ifUnchecked', function() {
      var parent = $(this).closest('.list-container').find('.list-parent-check');
      parent.iCheck('uncheck');
    });

    listCheck.off('ifChanged').on('ifChanged', function() {
      var thisChecked = $(this).closest('.list-container').find('.list-check:checked');
      var showon = $(this).closest('.list-container').find('.show-on');
      if (thisChecked.length > 0) {
        showon.show();
      } else {
        showon.hide();
      }
    });
  }

  /* --------------------------------------------------------
  Photo Gallery
  -----------------------------------------------------------*/
  (function() {
    if ($scope.find('.photo-gallery')[0]) {
      $scope.find('.photo-gallery').SuperBox();
    }
  })();

  /* --------------------------------------------------------
  Legacy Forms
  -----------------------------------------------------------*/
  (function() {
    $scope.find('form[data-readonly]').each(function() {
      var str = $(this).data('readonly');
      $(this).find('input, textarea, button, select, option, optgroup, fieldset, label').prop('readonly', true).attr('readonly', str);
    });
  })();

  (function() {
    $scope.find('form[data-disabled]').each(function() {
      var str = $(this).data('disabled');
      $(this).find('input, textarea, button, select, option, optgroup, fieldset, label').prop('disabled', true).attr('disabled', str);
    });
  })();

  (function() {
    $scope.find('[data-submit-location]').click(function() {
      var postLocation = $(this).data('submit-location');
      $(this).closest('form').attr('action', postLocation).submit();
    });
  })();


  /* --------------------------------------------------------
  Weight BMI
  -----------------------------------------------------------*/

  (function() {

    var
      $size = $scope.find('[name="size"]'),
      $weight = $scope.find('[name="weight"]'),
      $bmi = $scope.find('[name="bmi"]');

    $size.add($weight).change(function(e) {
      try {
        var
          $size = $(this).closest('form').find('[name="size"]'),
          $weight = $(this).closest('form').find('[name="weight"]'),
          weight = parseFloat($weight.val()),
          size = parseFloat($size.val()) / 100;

        if (!weight || !size || weight < 0 || size < 0) {
          $bmi.val('');
          return;
        }

        $bmi.val(Math.round((weight / (size * size)) * 100) / 100);
      } catch (exc) {}
    });

  })();

  (function() {

    var ft = 0,
      inc = 0,
      ht = 0;

    var $size = $scope.find('[name="size"]'),
      $feet = $scope.find('[name="opt2"]'),
      $inch = $scope.find('[name="opt3"]');

    $feet.add($inch).change(function(e) {
      try {
    	  //console.log('feet/inch changed');

        var
          $feet = $(this).closest('form').find('[name="opt2"]'),
          $inch = $(this).closest('form').find('[name="opt3"]'),
          feet = parseFloat($feet.val()),
          inch = parseFloat($inch.val());

        if (!feet && !inch || feet < 0 || inch < 0) {
          $size.val('');
          return;
        }

        $size.val(((feet * 12 + inch) * 2.54).toFixed(2));
      } catch (exc) {}
    });

  })();
  
	(function() {
		var $size = $scope.find('[name="size"]'),
	    	$feet = $scope.find('[name="opt2"]'),
	    	$inch = $scope.find('[name="opt3"]');

		$size.change(function(e) {
	    	try 
	    	{
	    		//console.log('size changed');

	    		var $size = $(this).closest('form').find('[name="size"]'),
		          	size = parseFloat($size.val());
	    			
    			if (!size || size < 0) {
    				$feet.val('');
    				$inch.val('');
    				return;
    			}
    			
    			var inch = size/2.54;
    			var feet = parseInt(inch/12);
    			inch = Math.round(inch - (feet * 12));
    			
		        $feet.val(feet);
		        $inch.val(inch);
	    	} 
	    	catch (exc) 
	    	{
	    		
	    	}
	    });
	  })();

  /* --------------------------------------------------------
  Custom toggle
  -----------------------------------------------------------*/
  (function() {
    if ($scope.find('[data-toggle="toggle"][data-toggle-target]')[0]) {
      $scope.find('[data-toggle="toggle"][data-toggle-target]').each(function() {
        if ($(this).data('toggle-target-bound'))
          return;
        else
          $(this).data('toggle-target-bound', true);

        var handler;
        $(this).each(handler = function() {
          if ($(this).is('[type="checkbox"]:checked, [type="radio"]:checked')) {
            $($(this).attr('data-toggle-target')).show().toggleClass('hidden', false);
          } else {
            $($(this).attr('data-toggle-target')).hide().toggleClass('hidden', true);
          }
        }).off('change click').bind('change click ifChecked ifClicked ifUnchecked ifChanged', handler);

      });
    }
  })();

  /* --------------------------------------------------------
  MVPR110 init
  -----------------------------------------------------------*/
  if ($.uiName == 'mvpr110') {
    mvpready_admin.init();
  }

}

$(document).ready(function() {


  if (jQuery().button && $.fn.button.noConflict) {
    var bootstrapButton = $.fn.button.noConflict();
    $.fn.bootstrapBtn = bootstrapButton;
  }

  moment.lang('de');

  /* --------------------------------------------------------
    Template Settings
  -----------------------------------------------------------*/

  var settings = '<a id="settings" href="#changeSkin" data-toggle="modal">' +
    '<i class="fa fa-gear"></i> Change Skin' +
    '</a>' +
    '<div class="modal fade" id="changeSkin" tabindex="-1" role="dialog" aria-hidden="true">' +
    '<div class="modal-dialog modal-lg">' +
    '<div class="modal-content">' +
    '<div class="modal-header">' +
    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
    '<h4 class="modal-title">Change Template Skin</h4>' +
    '</div>' +
    '<div class="modal-body">' +
    '<div class="row template-skins">' +
    // '<a data-skin="skin-blur-violate" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-violate.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-lights" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-lights.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-city" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-city.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-greenish" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-greenish.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-night" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-night.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-blue" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-blue.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-sunny" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-sunny.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-cloth" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-cloth.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-tectile" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-tectile.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-chrome" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-chrome.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-ocean" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-ocean.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-sunset" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-sunset.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a data-skin="skin-blur-yellow" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-yellow.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a  data-skin="skin-blur-kiwi" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-kiwi.jpg" alt="" class="img-responsive">' +
    // '</a>' +
    // '<a  data-skin="skin-blur-nexus" class="col-sm-2 col-xs-4" href="">' +
    // '<img src="' + $.baseUrl + 'assets/sa103/img/skin-thumbnails/skin-nexus.jpg" alt="" class="img-responsive">' +
    // '</a>' +

    '<a class="col-sm-2 col-xs-4 text-center" href="' + $.siteUrl + '/akte?mvprt=admin' + '" style="min-height:76px;" >' +
    '<span>Admin</span><br/><br/>' + '<span class="color p-5 m-3 br-5" style="background: #354B5E; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #D74B4B; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #6685a4; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #BCBCBC; width:10px;">&nbsp;</span>' +
    '</a>' +
    '<a class="col-sm-2 col-xs-4 text-center" href="' + $.siteUrl + '/akte?mvprt=slate' + '" style="min-height:76px;" >' +
    '<span>Slate</span><br/><br/>' + '<span class="color p-5 m-3 br-5" style="background: #354B5E; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #D74B4B; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #6685a4; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #BCBCBC; width:10px;">&nbsp;</span>' +
    '</a>' +
    '<a class="col-sm-2 col-xs-4 text-center" href="' + $.siteUrl + '/akte?mvprt=belize' + '" style="min-height:76px;" >' +
    '<span>Belize</span><br/><br/>' + '<span class="color p-5 m-3 br-5" style="background: #2c3e50; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #7CB268; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #428bca; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #A9A9A9; width:10px;">&nbsp;</span>' +
    '</a>' +
    '<a class="col-sm-2 col-xs-4 text-center" href="' + $.siteUrl + '/akte?mvprt=square' + '" style="min-height:76px;" >' +
    '<span>Square</span><br/><br/>' + '<span class="color p-5 m-3 br-5" style="background: #444444; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #6B5C93; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #569BAA; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #AFB7C2; width:10px;">&nbsp;</span>' +
    '</a>' +
    '<a class="col-sm-2 col-xs-4 text-center" href="' + $.siteUrl + '/akte?mvprt=royal' + '" style="min-height:76px;" >' +
    '<span>Royal</span><br/><br/>' + '<span class="color p-5 m-3 br-5" style="background: #2c3e50; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #3498db; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #78afbb; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #BCBCBC; width:10px;">&nbsp;</span>' +
    '</a>' +
    '<a class="col-sm-2 col-xs-4 text-center" href="' + $.siteUrl + '/akte?mvprt=pom' + '" style="min-height:76px;" >' +
    '<span>Pom</span><br/><br/>' + '<span class="color p-5 m-3 br-5" style="background: #232323; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #e74c3c; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #569BAA; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #AFB7C2; width:10px;">&nbsp;</span>' +
    '</a>' +
    '<a class="col-sm-2 col-xs-4 text-center" href="' + $.siteUrl + '/akte?mvprt=carrot' + '" style="min-height:76px;" >' +
    '<span>Carrot</span><br/><br/>' + '<span class="color p-5 m-3 br-5" style="background: #373737; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #E5723F; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #67B0DE; width:10px;">&nbsp;</span>  <span class="color p-5 m-3 br-5" style="background: #BCBCBC; width:10px;">&nbsp;</span>' +
    '</a>' +


    '</div>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>';

  /*console.log($.uiName);*/

  $.uiName == 'sa103' ? $('#main').prepend(settings) : $('#wrapper').prepend(settings);

  $('body').on('click', '.template-skins > a', function(e) {
    var skin = $(this).attr('data-skin');
    if (skin) {
      e.preventDefault();
      $('body').attr('id', skin);
      if ($.uiName != 'sa103') {
        window.location = $.siteUrl + '/akte?mvprt=clear';
      }
    } else {
      $('body').removeAttr('id');
    }

    $('#changeSkin').modal('hide');
  });

  // jQuery().datetimepicker ? (function() {
  //   $.datepicker.setDefaults($.datepicker.regional["de"]);
  //   $.datetimepickerOptions = {
  //     language: "de",
  //     icons: {
  //       time: "fa fa-clock-o",
  //       date: "fa fa-calendar",
  //       up: "fa fa-arrow-up",
  //       down: "fa fa-arrow-down"
  //     },
  //   };

  //   $('.datetime-picker').datetimepicker($.extend({
  //     format: "DD.MM.YYYY - HH:mm",
  //   }, $.datetimepickerOptions));

  //   $('.date-picker').datetimepicker($.extend({
  //     pickTime: false,
  //     format: "DD.MM.YYYY",
  //   }, $.datetimepickerOptions));

  //   $('.time-picker').datetimepicker($.extend({
  //     pickDate: false,
  //     format: "HH:mm",
  //   }, $.datetimepickerOptions));

  //   return $.dlei;
  // })() : $.dlei;


  $('.tag-select').chosen('destroy').chosen();

  $('[data-toggle="tab"]').off('shown.bs.tab').on('shown.bs.tab', function(e) {
    $('.tag-select').chosen('destroy').chosen();
  })


  $('[rel="popover"]').click(function() {
    var $t = $(this),
      changed = $t.data('triggerChanged');

    if (!changed) {
      $t.popover('destroy');
      $t.popover({
        trigger: 'click',
        placement: 'left',
        html: true,
      });
      $t.popover('toggle');
      $t.data('triggerChanged', true);
    }

  });

  $('[rel="popover"]').popover({
    trigger: 'hover',
    placement: 'left',
    html: true,
  });

  $('[rel="tooltip"]').tooltip();

  $('[data-toggle="print"]').click(function() {
    window.print();
  });

  $('[data-toggle="print-ready"]').each(function() {
    window.printReady || window.print();
    window.printReady = true;
  });

  $('[data-toggle="print-redirect"]').click(function() {
//      alert('fa');
//      return false;
//      alert($.siteUrl + '/portal/term/output/' + $(this).data('target')+'/print');return false;
       var  printWindow = window.open($.siteUrl + '/portal/term/output/' + $(this).data('target')+'/print', $(this).val(), 'height=400,width=800');
            $(printWindow.document).ready(function(){
                  setInterval(
                  function(){ 
                      printWindow.print(); }, 3000
                    );
                 
                   
            });
           
         
//            printWindow.location($.siteUrl + '/portal/term/output/' + $(this).data('target')+'/print');
//            return false;
//            printWindow.print();
//            printWindow.document.close();
//        printWindow.document.write($.siteUrl + '/portal/term/output/' + $(this).data('target')+'/print');return false;
//       printWindow.document.write.load($.siteUrl + '/portal/term/output/' + $(this).data('target')+'/print',function(response) {
//             printWindow.document.write(response)
//             printWindow.print();
//            printWindow.document.close();
//        alert( "Load was performed." );
        });
//    $(this).data('target') && (window.location = $.siteUrl + '/portal/term/output/' + $(this).data('target')+'/print');
//  });


  if ($.activeUrl && $.activeUrl.length) {
    $.loadUrl($.activeUrl, $('#content'),'',false);
  }

  $($.navLinksSelector).click(function(e) {

    e.preventDefault();
    if ($(this).attr('href').indexOf('javascript:') < 0)
      $.loadUrl($(this).attr('href'), $('#content'));
  });


	$('.ajax-patientprofiles-links').click(function(e) {
		if ($("#patient_id").val()) 
		{
			e.preventDefault();

			var URL = $(this).attr('href') + '/?regid=' + $("#patient_id").val();
			//alert(URL);
			if ($(this).attr('href').indexOf('javascript:') < 0)
				$.loadUrl(URL, $('#content'));
		} 
		else 
		{
				//alert("Please Enter Patient Id/Patient Name");
				e.preventDefault();
				/*var URL = $(this).attr('hrefhome');
				if ($(this).attr('hrefhome').indexOf('javascript:') < 0)
				$.loadUrl(URL, $('#content'));*/
		}
	});
  
	$('.ajax-doctorprofiles-links').click(function(e) {	
		if ($("#doctor_id").val()) 
		{
			e.preventDefault();

			var URL = $(this).attr('href') + '/?regid=' + $("#doctor_id").val();
			if ($(this).attr('href').indexOf('javascript:') < 0)
				$.loadUrl(URL, $('#content'));
		} 
		else 
		{
			//alert("Please Enter Doctor Id/Doctor Name");
			e.preventDefault();
			/*var URL = $(this).attr('hrefhome');
			if ($(this).attr('hrefhome').indexOf('javascript:') < 0)
				$.loadUrl(URL, $('#content'));*/
		}
	});



  // clear everything else except these key DOM elements
  // we do this because sometime plugins will leave dynamic elements behind
  $('body').find('> *').attr('data-toggle', 'keep-on-page').data('toggle', 'keep-on-page');


//patient registor date picker
    
    var fullDate = new Date();
      fullDate.setDate(fullDate.getDate());
      
     if($(document).find('.birth-date')[0]){
        $(document).find('.birth-date').each(function(){
            $(this).datetimepicker({
              pickTime: false,
              format: "dd.MM.yyyy",
              autoclose:true,
               endDate:fullDate,
            }
            ).on('changeDate', function(ev){
                $(this).datetimepicker('hide');
            });
        });
}    
    $(document).find('.birthdate-pick input:text').off('click').on('click', function() {
      $(this).closest('.birthdate-pick').find('.add-on i').click();
    });


});

function acceptResv(reserv_id){
        $.ajax({
            url:$.siteUrl+'/akte/overview/getDoctorReservation',
            data:{'reserv_id':reserv_id},
            type:'POST',
            beforeSend:function(html){
                var image_path = $.baseUrl+'assets/img/ajax-loader.gif';
                $("#loading_"+reserv_id).html("<img src='"+image_path+"' />");
            },
            success:function(html){
               $("#doc_reservation").html(html);
            }
          });    
}

function acceptResv_list(reserv_id,patient){
        var url=$.siteUrl+'/akte/reservation/ajax_accept'
        if(patient!=""){
           url=$.siteUrl+'/akte/reservation/ajax_accept/patient';
        }            
        $.ajax({
            url:url,
            data:{'reserv_id':reserv_id},
            type:'POST',
            beforeSend:function(html){
                var image_path = $.baseUrl+'assets/img/ajax-loader.gif';
                $("#loading_"+reserv_id).html("<img src='"+image_path+"' />");
            },
            success:function(html){
               $("#main-content").html(html);
            }
          });    
}
function cancelResv(reserv_id,patient){
    var url=$.siteUrl+'/akte/reservation/ajax_cancel'
    if(patient!=""){
       url=$.siteUrl+'/akte/reservation/ajax_cancel/patient';
    }  
    $.ajax({
        url:url,
        data:{'reserv_id':reserv_id},
        type:'POST',
        beforeSend:function(html){
            var image_path = $.baseUrl+'assets/img/ajax-loader.gif';
            $("#loading_"+reserv_id).html("<img src='"+image_path+"' />");
        },
        success:function(html){
           $("#main-content").html(html);
        }
    });    
}
function submitReserv(){
  var formData = {};
$.each($('#booking-form').serializeArray(), function(i,field) {
    formData[field.name] = field.value;
});
  var msg = '';
  var InsurnceChecked = $('input:radio[name=insurance]').is(':checked');
  var returning_visitorChecked = $('input:radio[name=returning_visitor]').is(':checked');
  var termChecked =$('input:checkbox[name=agb]').is(':checked'); 
  var inputSpeciality = $("#inputSpeciality option").is(':selected');
    if(!inputSpeciality){
         msg +='Bitte auswählen Behandlungsgrund\n';
    }
    if(!InsurnceChecked)
    {
       msg +='Bitte auswählen Versicherungsart\n';
    }
    if(!returning_visitorChecked)
    {
      msg +='Bitte auswählen, Waren Sie bereits Patient/in bei\n';  
    }
    if(!termChecked)
    {
      msg +='Bitte wählen Sie Laufzeit und Zustand';  
    }
    
    if(InsurnceChecked && returning_visitorChecked && termChecked){
     $.ajax({
            url:$.siteUrl+'/termin/portal/reservation/reserve_patient',
            data:formData,
            type:'POST',
            beforeSend:function(html){
                var image_path = $.baseUrl+'assets/img/ajax-loader.gif';
                $("#loading").html("<img src='"+image_path+"' />");
            },
            success:function(html){
              if(html){  
              $("#termin_booking_div").hide();
                $("#termin_success_div").show();
                 $('html, body').animate({
                                scrollTop: $("#termin_success_div").offset().top
                },1000);
            }else{
               $("#termin_booking_div").hide();
                $("#termin_fail_div").show(); 
            } 
            }
          });   
    }else{
        alert(msg);
        return false;
    }    
}

function serachTerminDoctor(){
     var formData = {};
   /* $.each($('#search_termin').serializeArray(), function(i,field) {
        formData[field.name] = field.value;
    });*/
    var inputSpeciality = $("#medical-speciality option:selected").val();
    var location = $("#filter-location").val();
    var distance = $("#input-distance-select option:selected").val();
    var insurance_type = $("#insurance-type option:selected").val();
    msg='';
    if(inputSpeciality==''){
         msg +='Bitte auswählen Behandlungsgrund\n';
          alert(msg);
        return false;
    }
   formData = {
       "specialty" : inputSpeciality,
       "location" : location,
       "distance" : distance,
       "insurance"  : insurance_type,
   };
    $.ajax({
            url:$.siteUrl+'/termin/search_result',
            data:formData,
            type:'POST',
            beforeSend:function(html){
              var image_path = $.baseUrl+'assets/img/ajax-loader.gif';
               $("#termin_doc_termin_search_div").html("<img src='"+image_path+"' />");
            },
            success:function(html){
               $("#feedContent").html(html);
             }
          });  
}
jQuery(document).ready(function() {
	jQuery("#frm_patient_forgot_pass").submit(function(e) {
		e.preventDefault();
		var emailRegex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		if(jQuery("#email").val()=="")
		{
			alert("Please enter email address");
			return false;
		}
		else if(!emailRegex.test(jQuery("#email").val()))
		{
			alert("Please enter valid email address.");
			return false;
		}
		else 
		{
			jQuery.ajax({ 
				url: jQuery("#frm_patient_forgot_pass").attr('action'),
				type: "POST",
				data: ({email : jQuery("#email").val()}),
				success: function(data){  
					var res = data.split("||");
					alert(res[1]);
					if(res[0]==1)
					{
						window.location = $.siteUrl+'/portal/patient/login/page';
					}
				}
			});
		}
	});
	
	jQuery("#frm_doctor_forgot_pass").submit(function(e) {
		e.preventDefault();
		var emailRegex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		if(jQuery("#email").val()=="")
		{
			alert("Please enter email address");
			return false;
		}
		else if(!emailRegex.test(jQuery("#email").val()))
		{
			alert("Please enter valid email address.");
			return false;
		}
		else 
		{
			jQuery.ajax({ 
				url: jQuery("#frm_doctor_forgot_pass").attr('action'),
				type: "POST",
				data: ({email : jQuery("#email").val()}),
				success: function(data){  
					var res = data.split("||");
					alert(res[1]);
					if(res[0]==1)
					{
						window.location = $.siteUrl+'/portal/doctor/login/page';
					}
				}
			});
		}
	});
	
	jQuery("#patientRegister #registrationForm").submit(function(e) {
		var emailRegex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		var passwordRegex = new RegExp(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{6,}/);
		
		if(jQuery("#inputEmail").val()=="")
		{
			alert("Please enter email address.");
			return false;
		}
		else if(!emailRegex.test(jQuery("#inputEmail").val()))
		{
			alert("Please enter valid email address.");
			return false;
		}
		else if(jQuery("#inputFirstName").val()=="")
		{
			alert("Please enter first name.");
			return false;
		}
		else if(jQuery("#inputFirstName").val().length>50)
		{
			alert("First name cannot exceed 50 characters.");
			return false;
		}
		else if(jQuery("#inputLastName").val()=="")
		{
			alert("Please enter last name.");
			return false;
		}
		else if(jQuery("#inputLastName").val().length>50)
		{
			alert("Last name cannot exceed 50 characters.");
			return false;
		}
		else if(jQuery("#inputGender").val()=="")
		{
			alert("Please select gender.");
			return false;
		}
		else if(jQuery("#inputBirthday").val()=="")
		{
			alert("Please select birthday.");
			return false;
		}
		else if(jQuery("#inputPassword").val()=="")
		{
			alert("Please enter password.");
			return false;
		}
		else if(!passwordRegex.test(jQuery("#inputPassword").val()))
		{
			alert("Password must contain at least 6 characters, including UPPER/lowercase and numbers.");
			return false;
		}
		else if(jQuery("#inputPassword2").val()=="")
		{
			alert("Please enter confirm password.");
			return false;
		}
		else if(!passwordRegex.test(jQuery("#inputPassword2").val()))
		{
			alert("Confirm password must contain at least 6 characters, including UPPER/lowercase and numbers.");
			return false;
		}
		else if(jQuery("#inputPassword").val()!=jQuery("#inputPassword2").val())
		{
			alert("Password and confirm password must be same.");
			return false;
		}
		else if(jQuery("#terms").prop("checked")==false)
		{
			alert("Please accept our terms and conditions.");
			return false;
		}
		else if(jQuery(this).find(".has-error").length>0)
		{
			return false;
		}
		return true;
	});
	
	jQuery("#doctorRegister #registrationForm").submit(function(e) {
		var emailRegex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		var passwordRegex = new RegExp(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{6,}/);
		
		if(jQuery(this).find("#inputEmail").val()=="")
		{
			alert("Please enter email address.");
			return false;
		}
		else if(!emailRegex.test(jQuery(this).find("#inputEmail").val()))
		{
			alert("Please enter valid email address.");
			return false;
		}
		else if(jQuery(this).find("#inputFirstName").val()=="")
		{
			alert("Please enter first name.");
			return false;
		}
		else if(jQuery(this).find("#inputFirstName").val().length>50)
		{
			alert("First name cannot exceed 50 characters.");
			return false;
		}
		else if(jQuery(this).find("#inputLastName").val()=="")
		{
			alert("Please enter last name.");
			return false;
		}
		else if(jQuery(this).find("#inputLastName").val().length>50)
		{
			alert("Last name cannot exceed 50 characters.");
			return false;
		}
		else if(jQuery(this).find("#inputGender").val()=="")
		{
			alert("Please select gender.");
			return false;
		}
		else if(jQuery(this).find("#inputPassword").val()=="")
		{
			alert("Please enter password.");
			return false;
		}
		else if(!passwordRegex.test(jQuery(this).find("#inputPassword").val()))
		{
			alert("Password must contain at least 6 characters, including UPPER/lowercase and numbers.");
			return false;
		}
		else if(jQuery(this).find("#inputPassword2").val()=="")
		{
			alert("Please enter confirm password.");
			return false;
		}
		else if(!passwordRegex.test(jQuery(this).find("#inputPassword2").val()))
		{
			alert("Confirm password must contain at least 6 characters, including UPPER/lowercase and numbers.");
			return false;
		}
		else if(jQuery(this).find("#inputPassword").val()!=jQuery(this).find("#inputPassword2").val())
		{
			alert("Password and confirm password must be same.");
			return false;
		}
		else if(jQuery(this).find("#terms").prop("checked")==false)
		{
			alert("Please accept our terms and conditions.");
			return false;
		}
		else if(jQuery(this).find(".has-error").length>0)
		{
			return false;
		}
		return true;
	});
	
	$("#register_view").ready(function(){
		if($(".nav-tabs").find("li.active a").attr("href")=="#patientRegister")
		{
			$("#doctorRegister #registrationForm input").val("");
			$("#doctorRegister #registrationForm #terms").prop("checked",false);
			$("#doctorRegister #registrationForm #inputGender").val("1")
			$("#doctorRegister #registrationForm .alert.alert-danger").remove()
		}
		else
		{
			$("#patientRegister #registrationForm input").val("");
			$("#patientRegister #registrationForm #terms").prop("checked",false);
			$("#patientRegister #registrationForm #inputGender").val("1")
			$("#patientRegister #registrationForm .alert.alert-danger").remove()
		}
	});
	jQuery(".validateSecurityQuestion").submit(function(e) {
		if(jQuery("#inputquestion1").val()=="")
		{
			alert("Please select security question.");
			return false;
		}
		else if(jQuery("#inputAnswer1").val()=="")
		{
			alert("Please enter security answer.");
			return false;
		}
		else if(jQuery("#inputquestion2").val()=="")
		{
			alert("Please select security question.");
			return false;
		}
		else if(jQuery("#inputAnswer2").val()=="")
		{
			alert("Please enter security answer.");
			return false;
		}
		else if(jQuery("#inputquestion1").val()==jQuery("#inputquestion2").val())
		{
			alert("Both security questions must be different.");
			return false;
		}
		
		return true;
	});
});

/***********************************************************/
/**** js function for allow specific pattern in textbox ****/
/***********************************************************/

function customAlphaNum(event,regx,chars,showCode){
	var eCharCode = event.which;
	var allChars = [];
	for(var i in chars){
		allChars[i] = chars[i].charCodeAt(0);
	}
	if(showCode)console.log(eCharCode);
	return (String.fromCharCode(eCharCode).match('^['+regx+']*$') || allChars.indexOf(eCharCode) >= 0 || eCharCode == 8 || eCharCode == 0 || eCharCode == 13 )?true:false;
}
jQuery(document).ready(function() {
	$('input.numeric').on('keypress',function(e){
		 return customAlphaNum(e,'0-9');
	});
	$('input.charonly').on('keypress',function(e){
		 return customAlphaNum(e,'A-Za-z ');
	});

	$("input[pattern]").on('blur',function(e){
		var value = $(this).val();
		var Regex = new RegExp($(this).attr("pattern"));
			
		if(value!="" && !Regex.test(value))
		{
			var title = $(this).attr("title");
			if($(this).hasClass("has-error")==false)
			{
				$(this).addClass("has-error");
			}
			if($(this).next("div.error-msg").length==0)
			{
				if(title=='')
					$('<div class="error-msg">Please enter valid information.</div>').insertAfter(this);
				else
					$('<div class="error-msg">'+title+'</div>').insertAfter(this);
			}
			
			return false;
		}
		else
		{
			$(this).removeClass("has-error");
			$(this).next('.error-msg').remove();
		}
	});
	
	/*$("input[min],input[max]").on('blur',function(e){
		var value = $(this).val();
		var min = $(this).attr("min");
		var max = $(this).attr("max");
		var minError = false;
		var maxError = false;
		var error;
		
		if(value!="" && min!='undefined' && min>value)
		{
			minError = true;
		}
		if(value!="" && max!='undefined' && max<value)
		{
			maxError = true;
		}
		
		if(minError && maxError)
		{
			error = "Value must be between "+min+" and "+max;
		}
		else if(minError)
		{
			error = "Value must be greater than and equal to "+min;
		}
		else if(maxError)
		{
			error = "Value must be less than and equal to "+max;
		}
		console.log(minError+" "+maxError+" "+error);
		if($(this).hasClass("has-error")==false)
		{
			$(this).addClass("has-error");
		}
		if($(this).next("div.error-msg").length==0)
		{
			$('<div class="error-msg">'+error+'</div>').insertAfter(this);
		}
		if(error=="")
		{
			$(this).removeClass("has-error");
			$(this).next('.error-msg').remove();
		}
	});*/
});