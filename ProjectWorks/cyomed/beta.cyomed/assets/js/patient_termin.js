$(function() {
  // set effect from select menu value
  var menu_toggle = true;
  $("#button_menu").click(function() {
    if (menu_toggle) {
      $("#menu_slide").animate({
        opacity: 1,
        left: '0px',
      }, 400);
    } else {
      $("#menu_slide").animate({
        opacity: 0.25,
        left: '-112px',
      }, 400);
    }
    menu_toggle = !menu_toggle;
  });

  var context_toggle = true;
  $("#button_context").click(function() {
    if (context_toggle) {
      $("#context_container_slide").animate({
        opacity: 1,
        right: '0px',
      }, 400);
    } else {
      $("#context_container_slide").animate({
        opacity: 0.25,
        right: '-285px',
      }, 400);
    }
    context_toggle = !context_toggle;
  });


  // for collapse the window
  $('.collapsible').click(function() {
    var click_toggle;
    if ($(this).parent().parent().parent().parent().next().height() > 0) {
      click_toggle = true;
    } else {
      click_toggle = false;
    }

    if (click_toggle) {
      $(this).parent().parent().parent().parent().next().animate({
        height: '0px',
        overflow: 'hidden',
      }, 400);

      $(this).parent().parent().parent().parent().next().children().animate({
        opacity: '0'
      });

      $(this).html($(this).data('label-collapsed') || 'show');
    } else {
      $(this).parent().parent().parent().parent().next().animate({
        height: '100%',
        overflow: 'visible',
      }, 400);

      $(this).parent().parent().parent().parent().next().children().animate({
        opacity: '1'
      });
      $(this).html($(this).data('label-expanded') || 'hide');
    }
    // click_toggle = !click_toggle;
  }).each(function() {
    var $container = $(this).closest('.window_container');
    if ($container.hasClass('window-collapsed')) {
      $container.find('.information_container').css({
        height: '0px',
        overflow: 'hidden',
      });
      $(this).html($(this).data('label-collapsed') || 'show');
    }
  });

  $('.window-title-tabs ul.window_tabs li').click(function() {
    var tab_id = $(this).attr('data-tab');
    $("#" + $(this).siblings('.current').removeClass('current').attr('data-tab')).removeClass('current');
    // $('.window-title-tabs .tab-content').removeClass('current');
    $(this).addClass('current');
    $("#" + tab_id).addClass('current');
    var $jsp = $('.scroll-pane').jScrollPane().data('jsp'),
      $jsp = $jsp && $jsp.reinitialise && $jsp.reinitialise(); //This is for customed scrolling
  });

  // SLider  1--------
  $(".slider_bar").each(function() {
    var $this = $(this);
    var inputValue = $this.find("input").val().split(":");
    var initHour, initMinute;
    var dataMin = $this.find("input").data('slider-min') || 0;
    var dataMax = $this.find("input").data('slider-max') || 1439;
    var dataMod = $this.find("input").data('slider-mod') || 1440;

    if ((inputValue[0]) && (inputValue[1]) && (initHour = parseInt(inputValue[0])) && (initMinute = parseInt(inputValue[1]))) {
      inputValue = initHour * 60 + initMinute;
    } else {
      inputValue = dataMin;
    }

    if (dataMax < dataMin) {
      dataMax += 1440;
    }

    var cgFunc = function(e, ui) {
      var value = ui.value % dataMod;
      var hours = Math.floor(value / 60);
      var minutes = value - (hours * 60);
      var minutes = minutes + "";
      if (hours.length == 1) hours = '0' + hours;
      if (minutes.length == 1) minutes = '0' + minutes;
      $this.find("input").val(hours + ':' + minutes);
      var leftPx = $this.find('.ui-slider-handle').position().left;
      var outerWidthHalf = $this.find('.customized_slider_helper').outerWidth() * .5;
      var thisWidth = $this.innerWidth();
      if (leftPx + outerWidthHalf < thisWidth) {
        $this.find('.customized_slider_helper').css({
          left: leftPx - outerWidthHalf,
        });
      }
      if (leftPx + outerWidthHalf >= thisWidth) {
        $this.find('.customized_slider_helper').css({
          left: thisWidth - outerWidthHalf * 2,
        });
      }
      if (leftPx - outerWidthHalf <= 0) {
        $this.find('.customized_slider_helper').css({
          left: 0,
        });
      }
    };

    $this.slider({
      orientation: "horizontal",
      range: "min",
      min: dataMin,
      max: dataMax,
      value: inputValue,
      step: 1,
      slide: cgFunc,
      change: cgFunc,
    });

    cgFunc(null, {
      value: inputValue,
    });

    //move the input form into the stylized  picker
    // $this.find('.customized_slider_helper').appendTo($this.find('.ui-slider-handle'));
  });

  $('[name="document_date"], .document-date').datepicker({
    dateFormat: 'dd.mm.yy',
  });

  $("#IhrArzt24_datepicker").datepicker();

  $('.chosen-select').chosen({
    inherit_select_classes: true,
  }).on('change', function(evt, params) {
    console.log('selected:' + $(this).val());
  }).on('focus', function(evt, params) {
    $(this).trigger('chosen:activate');
  });

  $('#callendar').fullCalendar({
    lang: 'de',
    defaultDate: moment().format(),
    defaultView: 'month',
    timeFormat: 'HH:mm',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    editable: true,
    eventSources: [{
      name: 'medication',
      events: function(start, end, timezone, callback) {
        $.ajax({
          type: "POST",
          url: $.siteUrl + '/akte/medication/json',
          data: {},
          // dataType: 'json',
          async: true,
          cache: false,
          beforeSend: function() {
            // cog placed
            // container.html('<h1><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
          },
          /*complete: function(){
                // Handle the complete event
                // console.log("complete")
              },*/
          success: function(data) {
            // Handle the success event / data
            // cog replaced here...
            // console.log("success")

            var pool = [];
            for (var i = 0, evt; evt = data[i++];) {

              var poolPushEvent;

              pool.push(poolPushEvent = $.extend({}, evt));

            };

            callback(pool);
          },
          statusCode: {
            404: function() {
              // console.log( "page not found" );
            },
            500: function() {
              // console.log( "internal error" );
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            // container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4>');
          },
        });
      }
    }, {
      name: 'reservation',
      events: function(start, end, timezone, callback) {
        $.ajax({
          type: "POST",
          url: $.siteUrl + '/akte/patients/reservation/json',
          data: {},
          // dataType: 'json',
          async: true,
          cache: false,
          beforeSend: function() {
            // cog placed
            // container.html('<h1><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
          },
          /*complete: function(){
                // Handle the complete event
                // console.log("complete")
              },*/
          success: function(data) {
            // Handle the success event / data
            // cog replaced here...
            // console.log("success")

            var pool = [];
            for (var i = 0, evt; evt = data[i++];) {

              var poolPushEvent;

              pool.push(poolPushEvent = $.extend({}, evt));

            };

            callback(pool);
          },
          statusCode: {
            404: function() {
              // console.log( "page not found" );
            },
            500: function() {
              // console.log( "internal error" );
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            // container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4>');
          },
        });
      }
    }, ],
    loading: function(bool) {
      $('#callendarLoading').toggle(bool);
    },
  });

  $('.scroll-pane').jScrollPane(); //This is for customed scrolling

  $.mask.definitions['h'] = '[0-5]';
  $.mask.definitions['o'] = '[0-1]';
  $.mask.definitions['y'] = '[1-2]';
  $.mask.definitions['d'] = '[0-3]';
  $('[name="document_time"], .document-time').mask("h9:h9", {
    placeholder: '_',
    completed: function() {},
  });
  $('[name="document_date"], .document-date').mask("d9.o9.y999", {
    placeholder: '_',
    completed: function() {},
  });

  $('[data-toggle-toggle]').each(function() {
    var target = $(this).data('toggle-toggle') || $(this).attr('data-toggle-toggle') || false;
    if (target) {
      $(target).toggle($(this).prop('checked'));
    }
  }).click(function() {
    var target = $(this).data('toggle-toggle') || $(this).attr('data-toggle-toggle') || false;
    if (target) {
      $(target).toggle();
    }
  });

  $('form[data-readonly]').each(function() {
    var str = $(this).data('readonly');
    $(this).find('input, textarea, button, select, option, optgroup, fieldset, label').prop('readonly', true).attr('readonly', str);
  });

  $('form[data-disabled]').each(function() {
    var str = $(this).data('disabled');
    $(this).find('input, textarea, button, select, option, optgroup, fieldset, label').prop('disabled', true).attr('disabled', str);
  });

  $('[data-submit-location]').click(function() {
    var postLocation = $(this).data('submit-location');
    $(this).closest('form').attr('action', postLocation).submit();
  });


  typeof window.graphData !== 'undefined' && window.graphData ? $.each(window.graphData, function(index, gData) {

    var $g = $(index);
    if ($g && $g.length <= 0) return;

    var graphWidth = $g.closest('.graph-wrapper').width() * .99 //((0.1 * gData[0].data.length)); //desktop compatible
    var graphHeight = 300;

    $('.graph-container').width(graphWidth).height(graphHeight);

    var COLOR = window.COLOR || "rgb(112, 112, 112)";

    $.plot($g, gData, $.extend({
      series: {
        points: {
          show: true,
          radius: 5
        },
        lines: {
          show: true
        },
        shadowSize: 0
      },
      grid: {
        show: true,
        hoverable: true,
        clickable: true,
        color: COLOR,
        borderWidth: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 2
        },
      },
      zoom: {
        interactive: true
      },
      pan: {
        interactive: true
      },
      xaxis: {
        tickLength: 0,
        font: {
          size: 15,
          weight: "bold",
          color: COLOR
        },
        zoomRange: [0, 100],
        panRange: [0, 100],
      },
      yaxis: {
        color: COLOR,
        tickSize: 50,
        font: {
          size: 15,
          weight: "bold",
          color: COLOR
        },
        zoomRange: [0, 0]
      }
    }, window.graphOptions || {}));


    $g.bind("plothover", function(event, pos, item) {
      if (item) {
        var y = item.datapoint[1].toFixed(0);
        var datetime = item.series.data[item.dataIndex][3] + ' ' + item.series.data[item.dataIndex][4];
        $("#tooltip")
          .html(y + ($g.data('flot-label') || item.series.data[item.dataIndex][2] || '') + ' / ' + datetime)
          .css({
            top: item.pageY - 45,
            left: item.pageX
          })
          .fadeIn(100);
      } else {
        $("#tooltip").hide();
      }
    });

    $g.bind("plotclick", function(event, pos, item) {
      if (item) {
        console.log(item);

      }

    });
  }) : (function() {
    return console.log('No graphs on page.');
  })();


});