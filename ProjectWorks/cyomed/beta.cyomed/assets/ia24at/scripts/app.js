$(document).ready(function() {

  if (jQuery().button && $.fn.button.noConflict) {
    var bootstrapButton = $.fn.button.noConflict();
    $.fn.bootstrapBtn = bootstrapButton;
  }

  moment.lang('de');

  var owl = $("#owlDoctors");

  owl.owlCarousel({

    items: 6, //10 items above 1000px browser width
    itemsDesktop: [1000, 6], //5 items between 1000px and 901px
    itemsDesktopSmall: [900, 5], // 3 items betweem 900px and 601px
    itemsTablet: [600, 4], //2 items between 600 and 0;
    itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
    navigation: true,
    navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
    pagination: false,

  });

  // Custom Navigation Events
  $(".next").click(function() {
    owl.trigger('owl.next');
  })
  $(".prev").click(function() {
    owl.trigger('owl.prev');
  })
  $(".play").click(function() {
    owl.trigger('owl.play', 1000);
  })
  $(".stop").click(function() {
    owl.trigger('owl.stop');
  })

  $("#owl-cinema").owlCarousel({

    navigation: false, // Show next and prev buttons
    slideSpeed: 300,
    paginationSpeed: 400,
    singleItem: true,
    autoPlay: 3000,

    // "singleItem:true" is a shortcut for:
    // items : 1, 
    // itemsDesktop : false,
    // itemsDesktopSmall : false,
    // itemsTablet: false,
    // itemsMobile : false

  });

  var owlCalendarAll = $(".owl-calendar"),
    owlCalendarInitCallback;

  owlCalendarAll.each(owlCalendarInitCallback = function() {
    var owlCalendar = $(this),
      doctorId = owlCalendar.data('doctor-id') || owlCalendar.attr('data-doctor-id'),
      insurancePublic = owlCalendar.data('insurance-public') || owlCalendar.attr('data-insurance-public') ? true : false,
      insurancePrivate = owlCalendar.data('insurance-private') || owlCalendar.attr('data-insurance-private') ? true : false,
      startDate = moment(owlCalendar.data('start-date')) || moment(owlCalendar.attr('data-start-date')) || moment();

    owlCalendar.data('noAvailable', owlCalendar.find('.action.no-available-appointments').clone());
    owlCalendar.data('notMember', owlCalendar.find('.action.integration_8').clone());
    owlCalendar.find('.action').remove();

    !doctorId ? (function() {
      owlCalendar.append($('<div></div>').addClass('col calendar-place-holder').html('&nbsp;'));

      var maxTerminPerDay = owlCalendar.hasClass('medium') ? 5 : 2;

      for (var dayDelta = 0, thisDay = startDate.clone(); dayDelta < 28; dayDelta++, thisDay.add('d', 1)) {
        var col = $('<div></div>').addClass('col').attr('data-date', thisDay.format('YYYY-MM-DD')),
          colHeader = $('<div></div>').addClass('col-header').appendTo(col);
        thisDay.isoWeekday() == 1 ? col.addClass('week-start') : $.ia24at;

        $('<span></span>').addClass('day').html(thisDay.format('dd')).appendTo(colHeader);
        $('<span></span>').addClass('date').html(thisDay.format('DD.MM')).appendTo(colHeader);

        owlCalendar.append(col);
      }

      owlCalendar.append($('<div></div>').addClass('col calendar-place-holder').html('&nbsp;'));

      owlCalendar.toggleClass('type-integration_8 exception', true);
      owlCalendar.toggleClass('type-appointments', false);
      owlCalendar.append(owlCalendar.data('notMember'));
    })() : (function() {
      var
        reservation_data = null,
        termin_data = null,
        bothSuccess = function(reservation_data, termin_data) {

          console.log('reservation_data:');
          console.log(reservation_data);
          console.log('termin_data:');
          console.log(termin_data);
          console.log('---');

          var termins = {};

          for (var i = 0, maskEvent; maskEvent = termin_data[i]; i++) {
            if (maskEvent.mask == 1 || maskEvent.mask == '1') {
              maskEvent.start = moment(maskEvent.start);
              maskEvent.end = moment(maskEvent.end);
              for (var j = 0, crossMatchEvent; crossMatchEvent = termin_data[j]; j++) {
                crossMatchEvent.start = moment(crossMatchEvent.start);
                crossMatchEvent.end = moment(crossMatchEvent.end);
                if (parseInt(maskEvent.mask_event_id) == 0) {
                  if (maskEvent.id != crossMatchEvent.id) {
                    if (maskEvent.allDay) {
                      if (crossMatchEvent.start.date() == maskEvent.start.date() && crossMatchEvent.start.month() == maskEvent.start.month() && crossMatchEvent.start.year() == maskEvent.start.year()) {
                        termin_data.splice(j <= i ? (i--, j--) : j--, 1);
                      }
                    } else {
                      if (!maskEvent.start.isAfter(crossMatchEvent.end) && !maskEvent.end.isBefore(crossMatchEvent.start)) {
                        termin_data.splice(j <= i ? (i--, j--) : j--, 1);
                      }
                    }
                  }
                } else {
                  if (maskEvent.mask_event_id == crossMatchEvent.id) {
                    if (maskEvent.allDay) {
                      if (crossMatchEvent.start.date() == maskEvent.start.date() && crossMatchEvent.start.month() == maskEvent.start.month() && crossMatchEvent.start.year() == maskEvent.start.year()) {
                        termin_data.splice(j <= i ? (i--, j--) : j--, 1);
                      }
                    } else {
                      if (!maskEvent.start.isAfter(crossMatchEvent.end) && !maskEvent.end.isBefore(crossMatchEvent.start)) {
                        termin_data.splice(j <= i ? (i--, j--) : j--, 1);
                      }
                    }
                  }
                }
              };
              termin_data.splice(i--, 1);
            }
          };

          for (var i = 0, maskEvent; maskEvent = termin_data[i]; parseInt(maskEvent.mask) == 1 && parseInt(maskEvent.mask_event_id) != 0 ? termin_data.splice(i, 1) : i++);

          !termin_data || !termin_data.length ? $.ia24at : $.each(termin_data, function() {
            var event = this,
              mStart = moment(event.start),
              mEnd = moment(event.end),
              hash = mStart.format('YYYY-MM-DD');

            // console.log(mStart.format('YYYY-MM-DD'));
            termins[hash] ? termins[hash].push($.extend({}, event)) : (termins[hash] = [$.extend({}, event), ]);
            event.repetitive == '1' ? (function() {
              for (var w = 1; w <= 104; w++) {
                if (mStart.isAfter(moment().add(30, 'd')))
                  break;
                hash = mStart.add(7, 'd').format('YYYY-MM-DD');
                mEnd.add(7, 'd');
                var eventToPush = $.extend({}, event);
                eventToPush.start = moment(mStart);
                eventToPush.end = moment(mEnd);
                termins[hash] ? termins[hash].push(eventToPush) : (termins[hash] = [eventToPush, ]);
              }
            })() : $.ia24at;
          });

          $.each(termins, function(hash, element) {
            $.each(element, function(index, crossMatchEvent) {

              for (var i = 0, maskEvent; maskEvent = reservation_data[i]; i++) {
                if (maskEvent.accept && parseInt(maskEvent.deleted) == 0 && parseInt(maskEvent.archived) == 0) {
                  maskEvent.start = moment(maskEvent.start);
                  maskEvent.end = moment(maskEvent.end);
                  maskEvent.end = maskEvent.end.isValid() ? maskEvent.end : maskEvent.start.add(30, 'minute');

                  if (maskEvent.allDay) {
                    if (crossMatchEvent.start.date() == maskEvent.start.date() && crossMatchEvent.start.month() == maskEvent.start.month() && crossMatchEvent.start.year() == maskEvent.start.year()) {
                      delete termins[index];
                    }
                  } else {
                    console.log(
                      maskEvent.start.format('YYYY-MM-DD HH:mm:ss') + ' - ' +
                      maskEvent.end.format('YYYY-MM-DD HH:mm:ss') + ' with ' +
                      crossMatchEvent.start.format('YYYY-MM-DD HH:mm:ss') + ' - ' +
                      crossMatchEvent.end.format('YYYY-MM-DD HH:mm:ss')
                    );
                    if (!maskEvent.start.isAfter(crossMatchEvent.end) && !maskEvent.end.isBefore(crossMatchEvent.start)) {
                      delete termins[hash][index];
                      if (!termins[hash].length) {
                        delete termins[hash];
                      }
                    }
                  }

                };
              };

              return true;
            });
          });

          $.each(termins, function() {
            this.sort(function(a, b) {
              return moment(a.start).isAfter(b.start);
            });
          });

          // owlCalendar.append($('<div></div>').addClass('col calendar-place-holder').html('&nbsp;'));

          var maxTerminPerDay = owlCalendar.hasClass('medium') ? 5 : 2;

          for (var dayDelta = 0, thisDay = startDate.clone(); dayDelta < 28; dayDelta++, thisDay.add('d', 1)) {
            var thisTermins = termins[thisDay.format('YYYY-MM-DD')];
            var col = $('<div></div>').addClass('col').attr('data-date', thisDay.format('YYYY-MM-DD')),
              colHeader = $('<div></div>').addClass('col-header').appendTo(col);
            thisDay.isoWeekday() == 1 ? col.addClass('week-start') : $.ia24at;

            $('<span></span>').addClass('day').html(thisDay.format('dd')).appendTo(colHeader);
            $('<span></span>').addClass('date').html(thisDay.format('DD.MM')).appendTo(colHeader);

            // console.log(thisDay.format('YYYY-MM-DD') + ':');
            // console.log(thisTermins);

            thisTermins && thisTermins.length > 0 ? (function() {
              for (var t = 0, thisTermin; t < maxTerminPerDay && (thisTermin = thisTermins[t]); t++) {
                var $a = $('<a href="#" class="appointment-link"></a>').addClass('appointment').html(moment(thisTermin.start).format('HH:mm')).appendTo(col);
                $a.data('start', moment(thisDay.format('YYYY-MM-DD') + 'T' + moment(thisTermin.start).format('HH:mm:ss')));
                $a.data('doctorId', doctorId);
              }
            })() : $.ia24at;

            thisTermins && thisTermins.length > maxTerminPerDay ? (function() {
              var more = $('<div></div>').addClass('appointment more').append('<div>mehr</div>').appendTo(col);
              more = $('<div></div>').addClass('appointments').attr('role', 'menu').appendTo(more);
              for (var t = maxTerminPerDay, thisTermin; thisTermin = thisTermins[t]; t++) {
                var $a = $('<a href="#" class="appointment-link"></a>').addClass('appointment').html(moment(thisTermin.start).format('HH:mm')).appendTo(more);
                $a.data('start', moment(thisDay.format('YYYY-MM-DD') + 'T' + moment(thisTermin.start).format('HH:mm:ss')));
                $a.data('doctorId', doctorId);
              }
            })() : $.ia24at;

            owlCalendar.append(col);
          }

          // owlCalendar.append($('<div></div>').addClass('col calendar-place-holder').html('&nbsp;'));

          // return;

          var itemsCustomArray = [];
          for (var i = 27; i >= 0; i--, itemsCustomArray.push([1920 - i * 68, 28 - i]));

          owlCalendar.owlCarousel({

            // Most important owl features
            // items: 16,
            itemsCustom: itemsCustomArray,
            // itemsCustom: [
            //   [0, 1],
            //   [64, 2],
            //   [128, 7],
            //   [256, 8],
            //   [512, 9],
            //   [1024, 7],
            //   [2048, 8],
            //   [1200, 9],
            //   [1300, 10],
            //   [1400, 11],
            //   [1500, 12],
            //   [1600, 13],
            //   [1700, 14],
            //   [1800, 15],
            //   [1920, 25],
            // ],
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [980, 3],
            itemsTablet: [768, 2],
            itemsTabletSmall: false,
            itemsMobile: [479, 1],
            singleItem: false,
            itemsScaleUp: false,

            //Basic Speeds
            slideSpeed: 200,
            paginationSpeed: 800,
            rewindSpeed: 1000,

            //Autoplay
            autoPlay: false,
            stopOnHover: false,

            // Navigation
            navigation: true,
            navigationText: ['<div class="arrow left" style="margin:0;border-radius:0;"></div>', '<div class="arrow right" style="margin:0;border-radius:0;"></div>'],
            rewindNav: true,
            scrollPerPage: false,

            //Pagination
            pagination: false,
            paginationNumbers: false,

            // Responsive 
            responsive: true,
            responsiveRefreshRate: 200,
            // responsiveBaseWidth: window,
            responsiveBaseWidth: owlCalendar,

            // CSS Styles
            baseClass: "owl-carousel",
            theme: "owl-theme",

            //Lazy load
            lazyLoad: false,
            lazyFollow: true,
            lazyEffect: "fade",

            //Auto height
            autoHeight: false,

            //JSON 
            jsonPath: false,
            jsonSuccess: false,

            //Mouse Events
            dragBeforeAnimFinish: true,
            mouseDrag: true,
            touchDrag: true,

            //Transitions
            transitionStyle: false,

            // Other
            addClassActive: false,

            //Callbacks
            beforeUpdate: false,
            afterUpdate: false,
            beforeInit: false,
            afterInit: function() {
              this.owl.owlItems.css({
                // width: "68px",
                "min-height": "160px",
              });

              var $moreTermins = this.owl.owlItems.find('.appointment.more');
              var $popoverContainer = $('body > div.layer').css({
                overflow: "visible",
              });

              $moreTermins.each(function() {
                var $thisMoreTermin = $(this);
                $thisMoreTermin.find(':first-child').hover(function(e) {
                  var $menu = $thisMoreTermin.find('.appointments').clone();

                  $popoverContainer.children().remove();
                  $popoverContainer.append($menu);

                  $menu.toggleClass('popup-container', true).css({
                    display: "block",
                    position: "absolute",
                    top: $thisMoreTermin.offset().top - ($menu.outerHeight() - $menu.height()) / 2,
                    left: $thisMoreTermin.offset().left - ($menu.outerWidth() - $menu.width()) / 2,
                    width: $thisMoreTermin.outerWidth() + $menu.outerWidth() - $menu.width(),
                  }).mouseleave(function() {
                    $menu.remove();
                  });

                  $menu.children().each(function() {
                    var index = $menu.children().index(this),
                      index = index + 1;

                    $(this).click(function() {
                      $thisMoreTermin.find('.appointments :nth-child(' + index + ')').click();
                    });
                  });

                }, function(e) {

                });
              });
            },
            beforeMove: function() {
              // console.log('before move:');
              // console.log(this.owl);
            },
            afterMove: false,
            afterAction: false,
            startDragging: false,
            afterLazyLoad: false,

          });

          if (!termin_data || !termin_data.length) {
            owlCalendar.toggleClass('type-no-available-appointments exception', true);
            owlCalendar.toggleClass('type-appointments', false);
            owlCalendar.append(owlCalendar.data('noAvailable'));
            return;
          } else {
            owlCalendar.toggleClass('type-no-available-appointments exception', false);
            owlCalendar.toggleClass('type-appointments', true);
          }

          $('a.appointment-link').click(function() {
            var
              doctorId = $(this).data('doctorId'),
              start = $(this).data('start').format('YYYY-MM-DD HH:mm:ss');

            var postData = {
              // doctor_id: doctorId,
              start: start,
            };

            window.location = $.siteUrl + '/portal/reservation/logout/' + doctorId + '/?' + $.param(postData);
          });

          // console.log( "lol owl init function ends." );
        };

      $.ajax({
        type: "POST",
        url: $.siteUrl + '/profile/doctor/member_reservations/' + doctorId,
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

          reservation_data = data;

          if (reservation_data && termin_data) {
            bothSuccess(reservation_data, termin_data);
          }
          // console.log('reservation_data:');
          // console.log(data);
        },
        statusCode: {
          404: function() {
            // console.log("page not found");
          },
          500: function() {
            // console.log("internal error");
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4>');
          // console.log("error");
        },
      });

      $.ajax({
        type: "POST",
        url: $.siteUrl + '/profile/doctor/member_termins/' + doctorId,
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

          termin_data = data;

          if (reservation_data && termin_data) {
            bothSuccess(reservation_data, termin_data);
          }
          // console.log('termin_data:');
          // console.log(data);
        },
        statusCode: {
          404: function() {
            // console.log("page not found");
          },
          500: function() {
            // console.log("internal error");
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4>');
          // console.log("error");
        },
      });

    })();

    // console.log('lol, one owl calendar is done.');
  });

  $('section[data-index] .gmap-relocate').click(function() {
    searchBounce($(this).closest('section[data-index]').data('doctor-id'));
    toggleBounce(31415926, gMarkers, gInfoWindows);
  });

  $('.insurance-selector .insurance-selector-button').click(function() {
    $(this).toggleClass('active');

    var dataTarget = $(this).data('toggle-calendar') || $(this).attr('data-toggle-calendar'),
      type = $(this).hasClass('public') ? 'public' : ($(this).hasClass('private') ? 'private' : false);

    if (type && dataTarget && (dataTarget = $(dataTarget)).length > 0) {
      if (dataTarget.data('insurance-' + type) || dataTarget.attr('data-insurance-' + type)) {
        dataTarget.removeAttr('data-insurance-' + type);
        dataTarget.removeData('insurance-' + type);
      } else {
        dataTarget.attr('data-insurance-' + type, 1);
        dataTarget.data('insurance-' + type, 1);
      }
    }
  });

  $('.datetime.momentjs').each(function() {
    var time = $(this).data('datetime') || $(this).attr('data-datetime'),
      m = time ? moment(time) : false;
    time ? $(this).append(m.format('dd. DD.MM.YYYY HH:mm')) : $.ia24at;
  });

  $('#go-to-step1, #go-to-step2').click(function() {
    $('#step-1').toggleClass('inactive');
    $('#step-2').toggleClass('active');
  });

  $('[data-toggle="tabPrev"][data-target], [data-toggle="tabNext"][data-target]').click(function() {
    var target = $(this).data('target');
    var $target = $(target);
    var tabNext = $(this).data('toggle') == 'tabNext';

    if ($target && $target.length) {
      var $tabContent = $($target.find('[role="tab"][data-toggle="tab"]').attr('href')).closest('.tab-content');

      if ($tabContent && $tabContent.length) {
        var fs = $(this).closest('fieldset');
        fs && fs.length && fs.data('fs-val') && typeof fs.data('fs-val').length !== 'undefined' && typeof window[fs.data('fs-val')] !== 'undefined' ? (function() {
          try {
            window[fs.data('fs-val')]();
          } catch (e) {
            // To prevent js unfocusable error log
          }
        })() : $.ia24at;
        var $invalids = $tabContent.children('.active').find(':invalid');
        if ($invalids.length) {
          try {
            $invalids.parents('form').find('[type="submit"]').click();
          } catch (e) {
            // To prevent js unfocusable error log
          }
        } else {
          $target.find('[role="tab"][data-toggle="tab"]').removeClass('active');
          var activeIndex = $tabContent.children().index($tabContent.children('.active'));
          if (tabNext && activeIndex < $tabContent.children().length - 1 || !tabNext && activeIndex) {
            $target.find('[role="tab"][data-toggle="tab"]:eq(' + (activeIndex + (tabNext ? 1 : -1)) + ')').toggleClass('active', true).tab('show');
          } else {
            tabNext ?
              $target.find('[role="tab"][data-toggle="tab"]:last').toggleClass('active', true).tab('show') :
              $target.find('[role="tab"][data-toggle="tab"]:first').toggleClass('active', true).tab('show');
          }
        }
      } else {
        tabNext ?
          $target.find('[role="tab"][data-toggle="tab"]:last').toggleClass('active', true).tab('show') :
          $target.find('[role="tab"][data-toggle="tab"]:first').toggleClass('active', true).tab('show');
      }
    }
  });

  $('a.list-group-item[href][role="tab"][data-toggle="tab"]').click(function() {
    $(this).siblings('a.list-group-item').removeClass('active');
    $(this).toggleClass('active', true);
  });

  $('select[name="insurance_provider"], select[name="treatment"], .chosen-select').chosen('destroy').off().chosen({
    inherit_select_classes: true,
  }).on('change', function(evt, params) {
    console.log('selected:' + $(this).val());
  }).on('focus', function(evt, params) {
    $(this).trigger('chosen:activate');
  });

  $('[data-toggle="tab"]').off('shown.bs.tab').on('shown.bs.tab', function(e) {
    console.log('fired again');
    $('select[name="insurance_provider"], select[name="treatment"], .chosen-select').chosen('destroy').off().chosen({
      inherit_select_classes: true,
    }).on('change', function(evt, params) {
      console.log('selected:' + $(this).val());
    }).on('focus', function(evt, params) {
      $(this).trigger('chosen:activate');
    });
  })

  jQuery().datetimepicker ? (function() {
    $.datepicker.setDefaults($.datepicker.regional["de"]);
    $.datetimepickerOptions = {
      language: "de",
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down"
      },
    };

    $('.datetime-picker').datetimepicker($.extend({
      format: "DD.MM.YYYY - HH:mm",
    }, $.datetimepickerOptions));

    $('.date-picker').datetimepicker($.extend({
      pickTime: false,
      format: "DD.MM.YYYY",
    }, $.datetimepickerOptions));

    $('.time-picker').datetimepicker($.extend({
      pickDate: false,
      format: "HH:mm",
    }, $.datetimepickerOptions));

    return $.ia24at;
  })() : $.ia24at;

  $('#terminLogout').click(function() {
    $.ajax({
      type: "POST",
      url: $.baseUrl + '../ia24portal/index.php/both/logout',
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
        window.location.reload(true);
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
  });

  $('#booking-form').submit(function(e) {
    // $(this).find('[disabled]').prop('disabled', false);
  });


  $('.toggle-filters.to-hide').click(function() {
    $('#filters-wrapper .filters-primary').slideToggle("slow");
  });
  //$('#filters-wrapper .filters-primary').slideUp("slow");

  $('#search .toggle-hide-btn').click(function() {
    var toggle = $('#search #search-map').data('toggle');
    if (toggle && toggle == 'expanded' || !toggle) {
      $('#search #search-map').data('toggle', 'collapsed');
      $('#search #search-map').slideUp("slow");
      $('#search').animate({
        height: $(this).outerHeight(),
      }, "slow");
    } else {
      $('#search #search-map').data('toggle', 'expanded');
      $('#search').css({
        height: 320,
      });
      $('#search #search-map').slideDown("slow");
    }
  });

  initialize();

  if (jQuery().fullCalendar) {
    (function(inputEvent, $) {

      var eventSources = [];
      var dialogTerminClick;

      eventSources.push({
        name: 'termins',
        events: function(start, end, timezone, callback) {
          $.ajax({
            type: "POST",
            url: $.siteUrl + '/admin/calendar/all_termin_json',
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
                for (var week = 0; week < 52; week++) {
                  if (evt.repetitive && parseInt(evt.repetitive) || week == 0) {
                    var poolPushEvent = $.extend({}, evt);

                    poolPushEvent.start = moment(evt.start).add('w', week);
                    poolPushEvent.end = moment(evt.end).add('w', week);

                    if (poolPushEvent.start.isAfter(moment().add('w', 6))) {
                      break;
                    }

                    var pr = evt.insurance_private && parseInt(evt.insurance_private) == 1,
                      pb = evt.insurance_public && parseInt(evt.insurance_public) == 1,
                      vc = evt.mask && parseInt(evt.mask) == 1;

                    // Title, text
                    poolPushEvent.title = (pb || pr ? 'Für ' : 'Eingene Belegung') + (pb ? 'Ges.' : '') + (pb && pr ? ' / ' : '') + (pr ? 'Pvt.' : '') + (pb || pr ? ' Ver. ' : '');
                    evt.text_patient || evt.text_notes ? (poolPushEvent.title = '<span>' + evt.text_patient + '</span>' + '<br/>' + '<span>' + evt.text_notes + '</span>') : $.ia24at;
                    // poolPushEvent.title = '<h4>' + poolPushEvent.title + '</h4>';

                    poolPushEvent.allDay = evt.allday && (evt.allday == '1' || evt.allday == 1) ? true : false;
                    poolPushEvent.weekOffset = week;

                    // Color, bgColor
                    !pr && !pb ? ((poolPushEvent.className = 'btn-default'), (poolPushEvent.borderColor = '#ccc'), (poolPushEvent.textColor = '#333333')) : $.ia24at;
                    pr && !pb ? ((poolPushEvent.className = 'btn-warning'), (poolPushEvent.borderColor = '#d58512')) : $.ia24at;
                    pr && pb ? (poolPushEvent.className = 'btn-info') : $.ia24at;
                    !pr && pb ? (poolPushEvent.className = 'btn-primary') : $.ia24at;
                    vc ? ((poolPushEvent.className = 'btn-success'), (poolPushEvent.textColor = 'white'), (poolPushEvent.title = 'Schließzeiten')) : $.ia24at;

                    pool.push(poolPushEvent);

                    var typePool = $('#fullcalendar').data('eventTypePool') || {
                      'private': [],
                      'public': [],
                      'both': [],
                      'none': [],
                      'close': [],
                    };
                    typePool[!pr && !pb ? 'none' : (pr && !pb ? 'private' : (pr && pb ? 'both' : (!pr && pb ? 'public' : (vc ? 'close' : 'default'))))].push(poolPushEvent);
                    $('#fullcalendar').data('eventTypePool', typePool);
                  };
                };
              };

              for (var i = 0, maskEvent; maskEvent = pool[i]; i++) {
                if (maskEvent.mask == 1 || maskEvent.mask == '1') {
                  for (var j = 0, crossMatchEvent; crossMatchEvent = pool[j]; j++) {
                    if (parseInt(maskEvent.mask_event_id) == 0) {
                      if (maskEvent.id != crossMatchEvent.id) {
                        if (maskEvent.allDay) {
                          if (crossMatchEvent.start.date() == maskEvent.start.date() && crossMatchEvent.start.month() == maskEvent.start.month() && crossMatchEvent.start.year() == maskEvent.start.year()) {
                            pool.splice(j <= i ? (i--, j--) : j--, 1);
                          }
                        } else {
                          if (!maskEvent.start.isAfter(crossMatchEvent.end) && !maskEvent.end.isBefore(crossMatchEvent.start)) {
                            pool.splice(j <= i ? (i--, j--) : j--, 1);
                          }
                        }
                      }
                    } else {
                      if (maskEvent.mask_event_id == crossMatchEvent.id) {
                        if (maskEvent.allDay) {
                          if (crossMatchEvent.start.date() == maskEvent.start.date() && crossMatchEvent.start.month() == maskEvent.start.month() && crossMatchEvent.start.year() == maskEvent.start.year()) {
                            pool.splice(j <= i ? (i--, j--) : j--, 1);
                          }
                        } else {
                          if (!maskEvent.start.isAfter(crossMatchEvent.end) && !maskEvent.end.isBefore(crossMatchEvent.start)) {
                            pool.splice(j <= i ? (i--, j--) : j--, 1);
                          }
                        }
                      }
                    }
                  };
                }
              };

              for (var i = 0, maskEvent; maskEvent = pool[i]; parseInt(maskEvent.mask) == 1 && parseInt(maskEvent.mask_event_id) != 0 ? pool.splice(i, 1) : i++);

              // console.log(pool);

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
      });

      eventSources.push({
        name: 'reservations',
        events: function(start, end, timezone, callback) {
          $.ajax({
            type: "POST",
            url: $.siteUrl + '/admin/termin/all_termin_json',
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

                var insurance = parseInt(evt.insurance),
                  poolPushEvent;

                pool.push(poolPushEvent = $.extend({}, evt));

                // Title, text, start / end
                poolPushEvent.title = '<br/><span class="">' + evt.first_name + ' ' + evt.last_name + '</span>' + '<br/>' + '<span>' + (insurance ? (insurance == 1 ? '(Pvt.)' : '(Ges.)') : '') + '</span>';
                poolPushEvent.start = moment(evt.start);
                poolPushEvent.end = moment(evt.end);
                poolPushEvent.end.isValid() ? $.ia24at : (poolPushEvent.end = moment(evt.start).add('m', (typeof window.docSettings !== 'undefined' ? (window.docSettings.termin_default_length || 30) : 30)));
                poolPushEvent.allDay = false;
                poolPushEvent.weekOffset = 0;

                // Color, bgColor
                poolPushEvent.className = insurance != '0' ? (insurance == '1' ? 'btn-danger active' : 'btn-danger active') : 'btn-danger active';
                // poolPushEvent.borderColor = insurance != '0' ? (insurance == '1' ? '#b92c28' : '#269abc') : '#adadad';
                // poolPushEvent.textColor = insurance != '0' ? (insurance == '1' ? 'white' : 'white') : 'black';

              };

              // console.log(pool);

              callback(pool);
            },
            statusCode: {
              404: function() {
                console.log("page not found");
              },
              500: function() {
                console.log("internal error");
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4>');
            },
          });
        }
      });

      $('#fullcalendar').fullCalendar({
        // theme: true,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        lang: 'de',
        defaultDate: moment().format(),
        defaultView: 'agendaWeek',
        timeFormat: 'HH:mm',
        slotDuration: '00:' + (typeof window.docSettings !== 'undefined' ? (window.docSettings.calendar_cell || 15) : 15) + ':00',
        selectable: true,
        selectHelper: true,
        editable: true,
        height: 650,
        // weekends: false,

        eventSources: eventSources,
        loading: function(bool) {
          $('#fullcalendarLoading').toggle(bool);
        },

        eventRender: function(event, element) {
          element.find('.fc-title').html(event.title);
        },

        eventClick: function(event) {
          // opens events in a popup window
          // console.log("clicked event:");
          // console.log(event);
          // console.log("--");

          if (event.source.name == 'termins') {
            dialogTerminClick.removeData('currentEvent');
            dialogTerminClick.data('currentEvent', $.extend({}, event));

            dialogTerminClick.dialog("open");
          }

          if (event.source.name == 'reservations') {
            $("#dialogBearbeiten").removeData('bearbeitenData');
            $("#dialogBearbeiten").data('bearbeitenData', $.extend({}, event));

            $("#dialogBearbeiten").dialog("open");
          }

          return false;
        },

        eventDrop: function(event, delta, revertFunc) {

          if (confirm("Sind Sie sicher, zu dieser Änderung?")) {
            if (event.source.name == "termins") {
              var postData;
              if (typeof event.weekOffset === 'undefined') {
                var relatedEvents = $('#fullcalendar').fullCalendar('clientEvents', event.id),
                  topEvent;

                $.each(relatedEvents, function() {
                  topEvent = topEvent ? (this.start.isBefore(topEvent.start) ? this : topEvent) : this;
                });

                postData = {
                  id: event.id,
                  doctor_id: event.doctor_id,
                  start: topEvent.start.format('YYYY-MM-DD HH:mm:ss'),
                  end: topEvent.end.format('YYYY-MM-DD HH:mm:ss'),
                };
              } else {
                postData = {
                  id: event.id,
                  doctor_id: event.doctor_id,
                  start: event.start.subtract('w', event.weekOffset).format('YYYY-MM-DD HH:mm:ss'),
                  end: event.end.subtract('w', event.weekOffset).format('YYYY-MM-DD HH:mm:ss'),
                };
              }

              $.ajax({
                type: "POST",
                url: $.siteUrl + '/admin/calendar/update_termin_time',
                data: postData,
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

                  // console.log(data);

                  $('#fullcalendar').fullCalendar('refetchEvents');
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
          } else {
            revertFunc();
          }

        },

        eventResize: function(event, delta, revertFunc) {

          if (confirm("Sind Sie sicher, zu dieser Änderung?")) {
            if (event.source.name == "termins") {
              var postData;
              if (typeof event.weekOffset === 'undefined') {
                var relatedEvents = $('#fullcalendar').fullCalendar('clientEvents', event.id),
                  topEvent;

                $.each(relatedEvents, function() {
                  topEvent = topEvent ? (this.start.isBefore(topEvent.start) ? this : topEvent) : this;
                });

                postData = {
                  id: event.id,
                  doctor_id: event.doctor_id,
                  start: topEvent.start.format('YYYY-MM-DD HH:mm:ss'),
                  end: topEvent.end.format('YYYY-MM-DD HH:mm:ss'),
                };
              } else {
                postData = {
                  id: event.id,
                  doctor_id: event.doctor_id,
                  start: event.start.subtract('w', event.weekOffset).format('YYYY-MM-DD HH:mm:ss'),
                  end: event.end.subtract('w', event.weekOffset).format('YYYY-MM-DD HH:mm:ss'),
                };
              }

              $.ajax({
                type: "POST",
                url: $.siteUrl + '/admin/calendar/update_termin_time',
                data: postData,
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

                  // console.log(data);

                  $('#fullcalendar').fullCalendar('refetchEvents');
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
          } else {
            revertFunc();
          }

        },

        select: function(start, end) {

          var event = {
              id: 'add',
              start: start,
              end: end,
            },
            view = $(this).fullCalendar('getView');

          view && view.length > 0 && view.get(0).name == 'month' ? (event.allDay = true) : $.ia24at;

          // opens events in a popup window
          // console.log("selected event:");
          // console.log(event);
          // console.log("--");

          dialogTerminClick.removeData('currentEvent');
          dialogTerminClick.data('currentEvent', event);

          dialogTerminClick.dialog("open");
        },

        // US Holidays
        // events: 'http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic',
        // eventClick: function(event) {
        //   // opens events in a popup window
        //   window.open(event.url, 'gcalevent', 'width=700,height=600');
        //   return false;
        // },
      });

      dialogTerminClick = $("#dialogTerminClick").dialog({
        title: 'Termin',
        autoOpen: false,
        width: 450,
        maxHeight: 650,
        modal: true,
        buttons: [{
          text: "Löschen",
          class: "dialog-delete",
          click: function() {
            var currentEventData = $(this).data('currentEvent');

            if (!currentEventData) {
              $(this).dialog("close");
              return;
            }

            var $deleteBtn = dialogTerminClick.dialog("widget").find(".ui-dialog-buttonpane button.dialog-delete");
            $deleteBtn.button("disable");

            $.ajax({
              type: "POST",
              url: $.siteUrl + '/admin/termin_settings/delete/ajax/' + currentEventData.id,
              data: {},
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

                console.log(data);

                $deleteBtn.button("enable");
                $('#fullcalendar').fullCalendar('refetchEvents');

                dialogTerminClick.dialog("close");
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

            dialogTerminClick.dialog("close");
          },
        }, {
          text: "Speichern",
          class: "dialog-save",
          click: function() {
            var currentEventData = $(this).data('currentEvent');

            if (!currentEventData) {
              $(this).dialog("close");
              return;
            }

            var $saveBtn = dialogTerminClick.dialog("widget").find(".ui-dialog-buttonpane button.dialog-save"),
              postData = {
                id: currentEventData.id,
                doctor_id: currentEventData.doctor_id,
                start: currentEventData.start.format('YYYY-MM-DD HH:mm:ss'),
                end: currentEventData.end.format('YYYY-MM-DD HH:mm:ss'),
              },
              postMode = (postData.id == 'add' ? 'insert_termin' : 'update_termin');

            $saveBtn.button("disable");

            $.each(dialogTerminClick.find('input, textarea').serializeArray(), function() {
              if (postData[this.name] !== undefined) {
                if (!postData[this.name].push) {
                  postData[this.name] = [postData[this.name]];
                }
                postData[this.name].push(this.value || '');
              } else {
                postData[this.name] = this.value || '';
              }
            });

            try {
              var exp, dateExp;
              exp = postData["start_picker"].split(' - ');
              dateExp = exp[0].split('.');
              postData["start_picker"] = dateExp[2] + '-' + dateExp[1] + '-' + dateExp[0] + ' ' + exp[1];

              exp = postData["end_picker"].split(' - ');
              dateExp = exp[0].split('.');
              postData["end_picker"] = dateExp[2] + '-' + dateExp[1] + '-' + dateExp[0] + ' ' + exp[1];

              // postData["start_picker"] && postData["start_picker"] != postData["start"] ? (postData["start"] = postData["start_picker"]) : $.ia24at;
              // postData["end_picker"] && postData["end_picker"] != postData["end"] ? (postData["end"] = postData["end_picker"]) : $.ia24at;
            } catch (e) {

            }

            var ajaxPost = function(mode) {
              if (typeof mode === 'undefined' || !mode) {
                return;
              }
              $.ajax({
                type: "POST",
                url: $.siteUrl + '/admin/calendar/' + mode,
                data: postData,
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

                  console.log(data);

                  $saveBtn.button("enable");
                  $('#fullcalendar').fullCalendar('refetchEvents');

                  dialogTerminClick.dialog("close");
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
            };

            // currentEventData.repetitive == '1' : before change, it was serial events
            // $(this).find('input[name="repetitive"]:radio:checked').val() == '1' : after change, it becomes serial events / is still serial events
            if (currentEventData.repetitive == '1') {
              $("#dialogApplyChangesTo").dialog("option", "buttons", [{
                text: 'Nur diese termin',
                click: function() {
                  ajaxPost('mask_termin');
                  $(this).dialog("close");
                },
              }, {
                text: 'Alle aktuellen Serientermin',
                click: function() {
                  ajaxPost(postMode);
                  $(this).dialog("close");
                },
              }, {
                text: 'Abbrechen',
                click: function() {
                  $(this).dialog("close");
                },
              }, ]).dialog("open");
            } else {
              ajaxPost(postMode);
            }

          },
        }, {
          text: "Abbrechen",
          class: "dialog-cancel",
          click: function() {
            dialogTerminClick.dialog("close");
          },
        }, ],
        close: function() {
          // form[0].reset();
          // allFields.removeClass("ui-state-error");
        },
        open: function(event, ui) {
          var currentEvent = $(this).data('currentEvent'),
            $dialog = $(this);

          if (!currentEvent) {
            console.log('dialog cannot fetch event data. closed.');
            $dialog.dialog("close");
            return;
          }

          if (currentEvent.start.format('YYYY-MM-DD') != currentEvent.end.format('YYYY-MM-DD')) {
            if (currentEvent.end.diff(currentEvent.start, 'days') == 1 && currentEvent.start.hour() == 0 && currentEvent.start.minute() == 0 && currentEvent.end.hour() == 0 && currentEvent.end.minute() == 0) {
              $dialog.find('.first-row p.text-left').html(currentEvent.start.format('dddd') + ' <strong>' + currentEvent.start.format('Do MMMM YYYY') + '<strong>');
              $dialog.find('.first-row p.text-right').html('');
              $dialog.find('.second-row').toggleClass('hidden', true);
              $dialog.find('.second-row p.text-left').html('');
              $dialog.find('.second-row p.text-right').html('');
            } else {
              $dialog.find('.first-row p.text-left').html('von ' + currentEvent.start.format('dddd') + ' <strong>' + currentEvent.start.format('Do MMMM YYYY') + '<strong>');
              $dialog.find('.first-row p.text-right').html(currentEvent.start.hour() + currentEvent.start.minute() > 0 ? currentEvent.start.format('HH:mm') : '');
              $dialog.find('.second-row').toggleClass('hidden', false);
              $dialog.find('.second-row p.text-left').html('bis ' + currentEvent.end.format('dddd') + ' <strong>' + currentEvent.end.format('Do MMMM YYYY') + '<strong>');
              $dialog.find('.second-row p.text-right').html(currentEvent.end.hour() + currentEvent.end.minute() > 0 ? currentEvent.end.format('HH:mm') : '');
            }
          } else {
            $dialog.find('.first-row p.text-left').html(currentEvent.start.format('HH:mm') + ' bis ' + currentEvent.end.format('HH:mm'));
            $dialog.find('.first-row p.text-right').html(currentEvent.start.format('dddd') + ' <strong>' + currentEvent.start.format('Do MMMM YYYY') + '<strong>');
            $dialog.find('.second-row').toggleClass('hidden', true);
            $dialog.find('.second-row p.text-left').html('');
            $dialog.find('.second-row p.text-right').html('');
          }
          $dialog.find('input:checkbox[name="ready"]').prop('checked', currentEvent.ready == '1').closest('.checkbox').toggleClass('bg-success', currentEvent.ready == '1').toggleClass('bg-danger', currentEvent.ready != '1');
          $dialog.find('input[type="checkbox"][name="allday"]').prop('checked', currentEvent.allDay);

          $dialog.find('#inputPatient').val(currentEvent.text_patient);
          $dialog.find('#inputNotes').html(currentEvent.text_notes);

          var topEvent = currentEvent;
          if (currentEvent.repetitive == '1') {
            var relatedEvents = $('#fullcalendar').fullCalendar('clientEvents', currentEvent.id);

            $.each(relatedEvents, function() {
              topEvent = topEvent ? (this.start.isBefore(topEvent.start) ? this : topEvent) : this;
            });

            $dialog.find('.dialog-start-date').toggleClass('hidden', false);
            $dialog.find('input[name="repetitive"]').filter('[value="1"]').prop('checked', true);
          } else {
            $dialog.find('.dialog-start-date').toggleClass('hidden', true);
            $dialog.find('input[name="repetitive"]').filter('[value="0"]').prop('checked', true);
          }
          $dialog.find('.dialog-start-date').find('span').html(topEvent.start.format('Do MMMM YYYY'));

          var $type = $dialog.find('input[name="insurance[]"]');

          currentEvent.insurance_private == '1' ? $type.filter('[value="1"]').prop('checked', true) : $type.filter('[value="1"]').prop('checked', false);
          currentEvent.insurance_public == '1' ? $type.filter('[value="2"]').prop('checked', true) : $type.filter('[value="2"]').prop('checked', false);
          currentEvent.insurance_private != '1' && currentEvent.insurance_public != '1' ? $type.filter('[value="0"]').prop('checked', true) : $type.filter('[value="0"]').prop('checked', false);
          currentEvent.mask == '1' ? $dialog.find('input[name="mask"]').prop('checked', true) : $dialog.find('input[name="mask"]').prop('checked', false);

          $dialog.dialog("widget").find(".ui-dialog-buttonpane button").button("enable");

          $dialog.find('.datetime-picker').blur().datetimepicker("hide");
          $dialog.find('input[name="start_picker"]').data("DateTimePicker").setDate(currentEvent.start.format('DD.MM.YYYY - HH:mm'));
          $dialog.find('input[name="end_picker"]').data("DateTimePicker").setDate(currentEvent.end.format('DD.MM.YYYY - HH:mm'));
        },
      });

      $("#dialogApplyChangesTo").dialog({
        title: 'Änderungen bestätigen',
        width: 650,
        autoOpen: false,
        modal: true,
      });

      dialogTerminClick.find('input[name="insurance[]"]').click(function() {
        var tv = $(this).val();
        $(this).prop('checked') ? (tv == '0' ? dialogTerminClick.find('input[name="insurance[]"]').not(this).prop('checked', false) : dialogTerminClick.find('input[name="insurance[]"]').filter('[value="0"]').prop('checked', false)) && dialogTerminClick.find('input[name="mask"]').prop('checked', false) : $.ia24at;
      });

      dialogTerminClick.find('input[name="mask"]').click(function() {
        dialogTerminClick.find('input[name="insurance[]"]').prop('checked', false);
      });

      dialogTerminClick.find('input[name="repetitive"]').click(function() {
        if (this.value == '1') {
          dialogTerminClick.find('.dialog-start-date').toggleClass('hidden', false);
        } else {
          dialogTerminClick.find('.dialog-start-date').toggleClass('hidden', true);
        }
      });

      $('[data-toggle-type]').each(function() {
        var type = $(this).data('toggle-type') || $(this).attr('data-toggle-type'),
          $calendarTarget = $('#fullcalendar');
        !type || !$calendarTarget ? $.ia24at : $(this).click(function() {
          var relatedEvents, $btn = $(this);

          $btn.toggleClass('active');

          switch (type) {
            case 'private':
              relatedEvents = $calendarTarget.fullCalendar('clientEvents', function(event) {
                if (event.insurance_public == '0' && event.insurance_private == '1') {
                  var arrIndex = $.inArray('hidden', event.className);
                  $btn.hasClass('active') ? (arrIndex >= 0 ? event.className.splice(arrIndex, 1) : $.ia24at) : (arrIndex >= 0 ? $.ia24at : event.className.push('hidden'));
                  $calendarTarget.fullCalendar('updateEvent', event);
                  return true;
                } else {
                  return false;
                }
              });
              break;
            case 'public':
              relatedEvents = $calendarTarget.fullCalendar('clientEvents', function(event) {
                if (event.insurance_public == '1' && event.insurance_private == '0') {
                  var arrIndex = $.inArray('hidden', event.className);
                  $btn.hasClass('active') ? (arrIndex >= 0 ? event.className.splice(arrIndex, 1) : $.ia24at) : (arrIndex >= 0 ? $.ia24at : event.className.push('hidden'));
                  $calendarTarget.fullCalendar('updateEvent', event);
                  return true;
                } else {
                  return false;
                }
              });
              break;
            case 'both':
              relatedEvents = $calendarTarget.fullCalendar('clientEvents', function(event) {
                if (event.insurance_public == '1' && event.insurance_private == '1') {
                  var arrIndex = $.inArray('hidden', event.className);
                  $btn.hasClass('active') ? (arrIndex >= 0 ? event.className.splice(arrIndex, 1) : $.ia24at) : (arrIndex >= 0 ? $.ia24at : event.className.push('hidden'));
                  $calendarTarget.fullCalendar('updateEvent', event);
                  return true;
                } else {
                  return false;
                }
              });
              break;
            case 'none':
              relatedEvents = $calendarTarget.fullCalendar('clientEvents', function(event) {
                if (event.insurance_public == '0' && event.insurance_private == '0') {
                  var arrIndex = $.inArray('hidden', event.className);
                  $btn.hasClass('active') ? (arrIndex >= 0 ? event.className.splice(arrIndex, 1) : $.ia24at) : (arrIndex >= 0 ? $.ia24at : event.className.push('hidden'));
                  $calendarTarget.fullCalendar('updateEvent', event);
                  return true;
                } else {
                  return false;
                }
              });
              break;
            case 'close':
              relatedEvents = $calendarTarget.fullCalendar('clientEvents', function(event) {
                if (event.mask == '1') {
                  var arrIndex = $.inArray('hidden', event.className);
                  $btn.hasClass('active') ? (arrIndex >= 0 ? event.className.splice(arrIndex, 1) : $.ia24at) : (arrIndex >= 0 ? $.ia24at : event.className.push('hidden'));
                  $calendarTarget.fullCalendar('updateEvent', event);
                  return true;
                } else {
                  return false;
                }
              });
              break;
          };

          // $.each(relatedEvents, function() {
          //   var arrIndex = $.inArray('hidden', this.className);
          //   $btn.hasClass('active') ? (arrIndex >= 0 ? this.className.splice(arrIndex, 1) : $.ia24at) : (arrIndex >= 0 ? $.ia24at : this.className.push('hidden'));
          //   $calendarTarget.fullCalendar('updateEvent', this);
          // });
        });
      });

    })(typeof fcEvent !== 'undefined' ? fcEvent : undefined, jQuery);
  }

  $('select[data-toggle="mSelector"]').each(function() {
    var $result = $(this);
    var $select = $($result.data('selector') || $result.attr('data-selector'));
    var $ctrlUp = $($result.data('control-up') || $result.attr('data-control-up'));
    var $ctrlDown = $($result.data('control-down') || $result.attr('data-control-down'));
    var $ctrlDelete = $($result.data('control-delete') || $result.attr('data-control-delete'));

    if ($select && $select.length > 0) {
      $select.each(function() {
        var $select = $(this);
        $select.change(function() {
          $select.find('option:selected').each(function() {
            var old = $result.find('option[value="' + this.value + '"]');
            if (old && old.length <= 0) {
              $result.append('<option value="' + this.value + '">' + $(this).html() + '</option>');
            }
          });
        });
      });
    }

    if ($ctrlUp && $ctrlUp.length > 0) {
      $ctrlUp.each(function() {
        $(this).click(function() {
          $result.find('option:selected').each(function() {
            $(this).prev().before(this);
          });
        });
      });
    }

    if ($ctrlDown && $ctrlDown.length > 0) {
      $ctrlDown.each(function() {
        $(this).click(function() {
          $result.find('option:selected').each(function() {
            $(this).next().after(this);
          });
        });
      });
    }

    if ($ctrlDelete && $ctrlDelete.length > 0) {
      $ctrlDelete.each(function() {
        $(this).click(function() {
          $result.find('option:selected').each(function() {
            $(this).remove();
          });
        });
      });
    }

  });

  (function(d, $) {
    if (typeof d !== 'undefined' && (d = d.form)) {
      $('#filter-location').attr('value', d.location || '');
      $('#input_distance_select').val(d.distance || '0');
      $('#filter-specialty').val(d.medical_specialty_id || '');
    }
  })(typeof postData !== 'undefined' ? postData : undefined, jQuery);

  $('#inputCoordinate').click(function() {
    if (typeof geocoder === 'undefined' || !geocoder) {
      geocoder = new google.maps.Geocoder();
    }

    var strPostalCode = $('#inputPostalCode').val();
    var strLocality = $('#inputLocality').val();
    var strStreet = $('#inputStreet').val();
    var strStreetAdditional = $('#inputStreetAdditional').val();

    if (!strPostalCode && !strLocality && !strStreet && !strStreetAdditional) {
      return;
    }

    var address = strStreet + strStreetAdditional + ', ' + strPostalCode + ' ' + strLocality;

    var $lat = $('#inputCoordinateLat');
    var $lng = $('#inputCoordinateLng');

    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var geoLoc = results[0].geometry.location;
        $lat.val(geoLoc.lat());
        $lng.val(geoLoc.lng());
      } else {
        console.log('Geocode report button was not successful for the following reason: ' + status);
      }
    });
  });

  $('#formAdminProfile').submit(function(event) {
    $('[type="hidden"][name="coordinate_lat"], [type="hidden"][name="coordinate_lng"]').remove();

    $('<input />')
      .attr('type', 'hidden')
      .attr('name', 'coordinate_lat')
      .attr('value', $('#inputCoordinateLat').val())
      .appendTo(this);

    $('<input />')
      .attr('type', 'hidden')
      .attr('name', 'coordinate_lng')
      .attr('value', $('#inputCoordinateLng').val())
      .appendTo(this);

    $('select[data-toggle="mSelector"]').prop('multiple', true).find('option').prop('selected', true);
  });

  $('#submitChangePassword').click(function() {
    $('#formChangePassword').submit();
  });

  $('.button-regular-termin-add').each(function() {
    $(this).click(function() {
      var $pane = $(this).closest('.tab-pane');
      var $wrapper = $pane.find('.form-group-termin-wrapper');
      var $toPrepend = $wrapper.clone().removeClass('hidden').removeClass('form-group-termin-wrapper').toggleClass('added-termin', true);
      var $hidden = $pane.find('input[type="hidden"].regular-termins-added');

      $toPrepend.find('input.input-termin-ready').attr('name', 'added_termin_ready[' + parseInt($hidden.data('day') || $hidden.attr('data-day')) + '][' + parseInt($hidden.val() || 0) + ']');
      $toPrepend.find('.select-termin-start').attr('name', 'added_termin_start[' + parseInt($hidden.data('day') || $hidden.attr('data-day')) + '][' + parseInt($hidden.val() || 0) + ']');
      $toPrepend.find('.select-termin-dur').attr('name', 'added_termin_dur[' + parseInt($hidden.data('day') || $hidden.attr('data-day')) + '][' + parseInt($hidden.val() || 0) + ']');
      $toPrepend.find('.select-termin-end').attr('name', 'added_termin_end[' + parseInt($hidden.data('day') || $hidden.attr('data-day')) + '][' + parseInt($hidden.val() || 0) + ']');
      $toPrepend.find('input[type="checkbox"].input-termin-insurance').attr('name', 'added_termin_insurance[' + parseInt($hidden.data('day') || $hidden.attr('data-day')) + '][' + parseInt($hidden.val() || 0) + '][]');
      $toPrepend.find('input[type="checkbox"].input-termin-mask').attr('name', 'added_termin_mask[' + parseInt($hidden.data('day') || $hidden.attr('data-day')) + '][' + parseInt($hidden.val() || 0) + ']');
      $toPrepend.find('input[type="checkbox"].input-termin-insurance').click(function() {
        if (this.checked) {
          $(this).parent().siblings().find('.input-termin-mask, input-termin-single').prop('checked', false);
        }
      });
      $toPrepend.find('input[type="checkbox"].input-termin-mask').click(function() {
        if (this.checked) {
          $(this).parent().siblings().find('.input-termin-insurance, input-termin-single').prop('checked', false);
        }
      });
      $toPrepend.find('input[type="checkbox"].input-termin-single').click(function() {
        if (this.checked) {
          $(this).parent().siblings().find('.input-termin-insurance, .input-termin-mask').prop('checked', false);
        }
      });

      $toPrepend.find('.button-regular-termin-remove').click(function() {
        $toPrepend.remove();
        $hidden.val(parseInt($hidden.val() || 0) - 1);
      });
      $toPrepend.find('.time-picker').datetimepicker($.extend({
        pickDate: false,
        format: "HH:mm",
      }, $.datetimepickerOptions));

      $wrapper.before($toPrepend);
      $hidden.val(parseInt($hidden.val() || 0) + 1);
    });
  });

  $('.button-regular-termin-remove').each(function() {
    $(this).click(function() {
      var $pane = $(this).closest('.tab-pane');
      var $formGroup = $(this).closest('.form-group');
      var $hidden = $pane.find('input[type="hidden"].regular-termins-added');

      if ($formGroup.hasClass('added-termin')) {
        $formGroup.remove();
        $hidden.val(parseInt($hidden.val() || 0) - 1);
      } else {
        var terminId;
        // console.log('removing db entry ' + $formGroup.data('regular-termin-id'));
        (terminId = $formGroup.data('regular-termin-id')) ? (
          window.location = $.siteUrl + '/admin/termin_settings/delete/r/' + terminId
        ) : $.ia24at;
      }
    });
  });

  $('.input-termin-mask').click(function() {
    if (this.checked) {
      $(this).parent().siblings().find('.input-termin-insurance, .input-termin-single').prop('checked', false);
    }
  });

  $('.input-termin-insurance').click(function() {
    if (this.checked) {
      $(this).parent().siblings().find('.input-termin-mask, .input-termin-single').prop('checked', false);
    }
  });

  $('.input-termin-single').click(function() {
    if (this.checked) {
      $(this).parent().siblings().find('.input-termin-insurance, .input-termin-mask').prop('checked', false);
    }
  });

  // if ($('input[type="hidden"][name="regular_termins_count"]').val() <= 0) {
  //   var $thisHidden = $('input[type="hidden"][name="regular_termins_count"]');
  //   $thisHidden.closest('.tab-pane').find('.button-regular-termin-add').click();
  // }

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

  $('[ia-action="reservation-action"]').click(function() {
    var $thisBtn = $(this),
      action = $thisBtn.data('action') || $thisBtn.attr('data-action'),
      submitQuery = $thisBtn.data('action-submit') || $thisBtn.attr('data-action-submit'),
      checkboxQuery = $thisBtn.data('action-checkbox') || $thisBtn.attr('data-action-checkbox');

    if (checkboxQuery) {
      $(checkboxQuery).prop('checked', true);
    }

    if (submitQuery) {
      $(submitQuery).each(function() {
        if (this != $thisBtn.get(0)) {
          $(this).click();
        }
      });
    }

    if (action) {
      var postData = {};
      $('.checked-reservation').each(function() {
        if ($(this).prop('checked')) {
          postData[$(this).attr('name')] = 1;
        }
      });
      $.ajax({
        type: "POST",
        url: $.siteUrl + '/admin/termin/action/' + action + '/y',
        data: postData,
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

          // console.log(data);

          // alert(data);
          window.location = window.location;
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

  });

  $('.dialog-open-bearbeiten').click(function() {
    var dialogBearbeitenId = $(this).data('bearbeiten-id') || $(this).attr('data-bearbeiten-id');
    if (dialogBearbeitenId && typeof bearbeitenData !== 'undefined' && bearbeitenData[dialogBearbeitenId]) {
      $("#dialogBearbeiten").data('bearbeitenData', bearbeitenData[dialogBearbeitenId]).dialog("open");
    }
  });

  $("#dialogBearbeiten").dialog({
    title: 'Termin',
    autoOpen: false,
    width: 450,
    maxHeight: 650,
    modal: true,
    buttons: {
      "Speichern": function() {
        $(this).dialog("close");
        return;

        var $saveBtn = dialogTerminClick.dialog("widget").find(".ui-dialog-buttonpane button:first"),
          postData = {
            id: dialogTerminClick.data('currentEvent').id,
            doctor_id: dialogTerminClick.data('currentEvent').doctor_id,
          };

        postData.id == 'add' ? console.log('exit without saving.' + dialogTerminClick.dialog("close")) : $.ia24at;

        $saveBtn.button("disable");

        $.each(dialogTerminClick.find('input, textarea').serializeArray(), function() {
          if (postData[this.name] !== undefined) {
            if (!postData[this.name].push) {
              postData[this.name] = [postData[this.name]];
            }
            postData[this.name].push(this.value || '');
          } else {
            postData[this.name] = this.value || '';
          }
        });

        $.ajax({
          type: "POST",
          url: $.siteUrl + '/admin/calendar/update_termin',
          data: postData,
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

            console.log(data);

            $saveBtn.button("enable");

            dialogTerminClick.dialog("close");
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
      },
      "Abbrechen": function() {
        $(this).dialog("close");
      }
    },
    close: function() {
      // form[0].reset();
      // allFields.removeClass("ui-state-error");
    },
    open: function(event, ui) {

      var $dialog = $(this),
        bData = $(this).data('bearbeitenData');

      if (!bData) {
        console.log('dialog cannot fetch event data. closed. (reservation)');
        $dialog.dialog("close");
        return;
      }

      bData.start = moment(bData.start);
      bData.end = moment(bData.end);
      bData.end = bData.end.isValid() ? bData.end : moment(bData.start).add(30, 'minute');



      var refreshDialog = function(newEventData) {
        if (newEventData.start.format('YYYY-MM-DD') != newEventData.end.format('YYYY-MM-DD')) {
          if (newEventData.end.diff(newEventData.start, 'days') == 1 && newEventData.start.hour() == 0 && newEventData.start.minute() == 0 && newEventData.end.hour() == 0 && newEventData.end.minute() == 0) {
            $dialog.find('.first-row p.text-left').html(newEventData.start.format('dddd') + ' <strong>' + newEventData.start.format('Do MMMM YYYY') + '<strong>');
            $dialog.find('.first-row p.text-right').html('');
            $dialog.find('.second-row').toggleClass('hidden', true);
            $dialog.find('.second-row p.text-left').html('');
            $dialog.find('.second-row p.text-right').html('');
          } else {
            $dialog.find('.first-row p.text-left').html('von ' + newEventData.start.format('dddd') + ' <strong>' + newEventData.start.format('Do MMMM YYYY') + '<strong>');
            $dialog.find('.first-row p.text-right').html(newEventData.start.hour() + newEventData.start.minute() > 0 ? newEventData.start.format('HH:mm') : '');
            $dialog.find('.second-row').toggleClass('hidden', false);
            $dialog.find('.second-row p.text-left').html('bis ' + newEventData.end.format('dddd') + ' <strong>' + newEventData.end.format('Do MMMM YYYY') + '<strong>');
            $dialog.find('.second-row p.text-right').html(newEventData.end.hour() + newEventData.end.minute() > 0 ? newEventData.end.format('HH:mm') : '');
          }
        } else {
          $dialog.find('.first-row p.text-left').html(newEventData.start.format('HH:mm') + ' bis ' + newEventData.end.format('HH:mm'));
          $dialog.find('.first-row p.text-right').html(newEventData.start.format('dddd') + ' <strong>' + newEventData.start.format('Do MMMM YYYY') + '<strong>');
          $dialog.find('.second-row').toggleClass('hidden', true);
          $dialog.find('.second-row p.text-left').html('');
          $dialog.find('.second-row p.text-right').html('');
        }
      };

      refreshDialog(bData);

      // OLD START

      var $labelInsurance = $dialog.find('#labelInsurance'),
        $labelInsuranceProvider = $dialog.find('#labelInsuranceProvider'),
        $labelTreatment = $dialog.find('#labelTreatment');

      $dialog.find('#labelPatient').find('span').html(bData.first_name + ' ' + bData.last_name);
      $dialog.find('#labelGender').find('span').html(bData.gender == '1' ? 'Frau' : 'Herr');
      $dialog.find('#labelEmail').find('span').html(bData.email);
      $dialog.find('#labelTelephone').find('span').html(bData.telephone);
      bData.insurance && bData.insurance != '' && bData.insurance != '0' ? $labelInsurance.toggleClass('hidden', false).find('span').html(bData.insurance == '1' ? 'privat' : 'gesetzlich') : $labelInsurance.toggleClass('hidden', true);
      bData.insurance_provider && bData.insurance_provider != '' && bData.insurance_provider != '0' ? $labelInsuranceProvider.toggleClass('hidden', false).find('span').html(bData.insurance_provider) : $labelInsuranceProvider.toggleClass('hidden', true);
      bData.treatment && bData.treatment != '' && bData.treatment != '0' ? $labelTreatment.toggleClass('hidden', false).find('.form-control-static').html(bData.treatment.join('<br/>')) : $labelTreatment.toggleClass('hidden', true);

      $dialog.find('#inputPatientNotes').html(bData.text_patient_notes);
      $dialog.find('#inputDoctorAnswer').html(bData.text_doctor_answer);
      $dialog.find('#inputNotes').html(bData.text_notes);

      $dialog.dialog("widget").find(".ui-dialog-buttonpane button").button("enable");

      $dialog.find('.datetime-picker').blur().datetimepicker("hide");
      $dialog.find('input[name="start"]')
        .off('dp.change')
        .on('dp.change', function(e) {
          bData.start = e.date;
          refreshDialog(bData);
        })
        .data("DateTimePicker")
        .setDate(bData.start.format('DD.MM.YYYY - HH:mm'));

      $dialog.find('input[name="end"]')
        .off('dp.change')
        .on('dp.change', function(e) {
          bData.end = e.date;
          refreshDialog(bData);
        })
        .data("DateTimePicker")
        .setDate(bData.end.format('DD.MM.YYYY - HH:mm'));
    },
  });

  $('.dialog-new-appointment').click(function() {
    $("#dialogNeuTermin").dialog("open");
  });

  $("#dialogNeuTermin").dialog({
    title: 'Neu Termin',
    autoOpen: false,
    width: 450,
    maxHeight: 650,
    modal: true,
    buttons: {
      "Speichern": function() {

        var $dialog = $(this);

        var $saveBtn = $dialog.dialog("widget").find(".ui-dialog-buttonpane button:first"),
          postData = {};

        $saveBtn.button("disable");

        $.each($dialog.find('input, textarea').not(function(index, element) {
          var $this = $(this);
          if ($this.closest('.tab-pane').length && !$this.closest('.tab-pane').hasClass('active')) {
            return true;
          }
          if ($this.hasClass('datetime-picker')) {
            $this.val($this.data('DateTimePicker').date.format('YYYY-MM-DD HH:mm:ss'));
          }
          return false;
        }).serializeArray(), function() {
          if (postData[this.name] !== undefined) {
            if (!postData[this.name].push) {
              postData[this.name] = [postData[this.name]];
            }
            postData[this.name].push(this.value || '');
          } else {
            postData[this.name] = this.value || '';
          }
        });

        $.ajax({
          type: "POST",
          url: $.siteUrl + '/admin/termin/new_appointment',
          data: postData,
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

            console.log(data);

            $saveBtn.button("enable");

            $dialog.dialog("close");

            window.location.reload(true);
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
      },
      "Abbrechen": function() {
        $(this).dialog("close");
      }
    },
    close: function() {
      // form[0].reset();
      // allFields.removeClass("ui-state-error");
    },
    open: function(event, ui) {

      var $dialog = $(this),
        newEventData = {};

      newEventData.start = moment();
      newEventData.end = moment().add(30, 'minute');

      var refreshDialog = function(newEventData) {
        if (newEventData.start.format('YYYY-MM-DD') != newEventData.end.format('YYYY-MM-DD')) {
          if (newEventData.end.diff(newEventData.start, 'days') == 1 && newEventData.start.hour() == 0 && newEventData.start.minute() == 0 && newEventData.end.hour() == 0 && newEventData.end.minute() == 0) {
            $dialog.find('.first-row p.text-left').html(newEventData.start.format('dddd') + ' <strong>' + newEventData.start.format('Do MMMM YYYY') + '<strong>');
            $dialog.find('.first-row p.text-right').html('');
            $dialog.find('.second-row').toggleClass('hidden', true);
            $dialog.find('.second-row p.text-left').html('');
            $dialog.find('.second-row p.text-right').html('');
          } else {
            $dialog.find('.first-row p.text-left').html('von ' + newEventData.start.format('dddd') + ' <strong>' + newEventData.start.format('Do MMMM YYYY') + '<strong>');
            $dialog.find('.first-row p.text-right').html(newEventData.start.hour() + newEventData.start.minute() > 0 ? newEventData.start.format('HH:mm') : '');
            $dialog.find('.second-row').toggleClass('hidden', false);
            $dialog.find('.second-row p.text-left').html('bis ' + newEventData.end.format('dddd') + ' <strong>' + newEventData.end.format('Do MMMM YYYY') + '<strong>');
            $dialog.find('.second-row p.text-right').html(newEventData.end.hour() + newEventData.end.minute() > 0 ? newEventData.end.format('HH:mm') : '');
          }
        } else {
          $dialog.find('.first-row p.text-left').html(newEventData.start.format('HH:mm') + ' bis ' + newEventData.end.format('HH:mm'));
          $dialog.find('.first-row p.text-right').html(newEventData.start.format('dddd') + ' <strong>' + newEventData.start.format('Do MMMM YYYY') + '<strong>');
          $dialog.find('.second-row').toggleClass('hidden', true);
          $dialog.find('.second-row p.text-left').html('');
          $dialog.find('.second-row p.text-right').html('');
        }
      };

      refreshDialog(newEventData);

      // OLD START

      var $labelInsurance = $dialog.find('#labelInsurance'),
        $labelInsuranceProvider = $dialog.find('#labelInsuranceProvider'),
        $labelTreatment = $dialog.find('#labelTreatment');

      $dialog.find('#labelPatient').find('span').html(newEventData.first_name + ' ' + newEventData.last_name);
      $dialog.find('#labelGender').find('span').html(newEventData.gender == '1' ? 'Frau' : 'Herr');
      $dialog.find('#labelEmail').find('span').html(newEventData.email);
      $dialog.find('#labelTelephone').find('span').html(newEventData.telephone);
      newEventData.insurance && newEventData.insurance != '' && newEventData.insurance != '0' ? $labelInsurance.toggleClass('hidden', false).find('span').html(newEventData.insurance == '1' ? 'privat' : 'gesetzlich') : $labelInsurance.toggleClass('hidden', true);
      newEventData.insurance_provider && newEventData.insurance_provider != '' && newEventData.insurance_provider != '0' ? $labelInsuranceProvider.toggleClass('hidden', false).find('span').html(newEventData.insurance_provider) : $labelInsuranceProvider.toggleClass('hidden', true);
      newEventData.treatment && newEventData.treatment != '' && newEventData.treatment != '0' ? $labelTreatment.toggleClass('hidden', false).find('.form-control-static').html(newEventData.treatment.join('<br/>')) : $labelTreatment.toggleClass('hidden', true);

      $dialog.find('#inputPatientNotes').html(newEventData.text_patient_notes);

      $dialog.dialog("widget").find(".ui-dialog-buttonpane button").button("enable");

      $dialog.find('.datetime-picker').blur().datetimepicker("hide");
      $dialog.find('input[name="start"]')
        .off('dp.change')
        .on('dp.change', function(e) {
          newEventData.start = e.date;
          refreshDialog(newEventData);
        })
        .data("DateTimePicker")
        .setDate(newEventData.start.format('DD.MM.YYYY - HH:mm'));
      $dialog.find('input[name="end"]')
        .off('dp.change')
        .on('dp.change', function(e) {
          newEventData.end = e.date;
          refreshDialog(newEventData);
        })
        .data("DateTimePicker")
        .setDate(newEventData.end.format('DD.MM.YYYY - HH:mm'));
    },
  });

  $('.doctor-package').click(function() {
    var $btn = $(this);
    $('#rechnungForm').prepend($('<input />').attr('type', 'hidden').attr('value', $btn.attr('value')).attr('name', $btn.attr('name'))).find('[type="submit"]').click();
    $('#rechnungForm [name="package"]').remove();
  });

  $('.payone-submit').click(function() {

    var data = {
      request: 'creditcardcheck',
      responsetype: 'JSON', // JSON or REDIRECT available
      mode: 'test',
      mid: '27439',
      aid: '27449',
      portalid: '2928',
      encoding: 'UTF-8',
      storecarddata: 'yes',
      hash: $.payoneHash,
      cardholder: $('[name="cardholder"]').val(),
      cardpan: $('[name="cardpan"]').val(),
      cardtype: $('[name="cardtype"]').val(),
      cardexpiremonth: $('[name="cardexpiremonth"]').val(),
      cardexpireyear: $('[name="cardexpireyear"]').val(),
      cardcvc2: $('[name="cardcvc2"]').val(),
      language: 'en',
    }
    var options = {
      return_type: 'object',
      callback_function_name: 'processPayoneResponse',
    }

    window.processPayoneResponse = function(response) {
      if (response.get('status') == 'VALID') {
        $('[name="cardholder"]').val();
        $('[name="cardpan"]').val();
        $('[name="cardtype"]').val();
        $('[name="cardexpiremonth"]').val();
        $('[name="cardexpireyear"]').val();
        $('[name="cardcvc2"]').val(response.get('pseudocardpan'));

        $.ajax({
          type: "POST",
          url: 'https://secure.pay1.de/client-api/',
          data: data,
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

            console.log(data);
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
      } else {
        alert(response.get('customermessage'));
        console.log('status:' + response.get('status'));
        console.log('errorcode:' + response.get('errorcode'));
        console.log('errormessage:' + response.get('errormessage'));
        console.log('customermessage:' + response.get('customermessage'));
      }
    }

    var request = new PayoneRequest(data, options);
    request.checkAndStore();

  });


});

// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

var map;
var mapDiv = document.getElementById('search-map');
var myLatlng = new google.maps.LatLng(51.2384547, 6.8143503);
var searchKeyword = (typeof postData !== 'undefined' && postData && postData.form && postData.form.medical_specialty) ? postData.form.medical_specialty : 'Arzt';
var searchRadius = (typeof postData !== 'undefined' && postData && postData.form && postData.form.distance) ? parseInt(postData.form.distance + 1) * 5000 : 15000;
var markers = [];
var infoWindows = [];
var gMarkers = [];
var gInfoWindows = [];
var geocoder;
var placesService;
var placeDetails;

function initialize() {

  if (!mapDiv) {
    return;
  }

  $('#search .map-popup-wrapper').toggleClass('hidden', true);

  geocoder = new google.maps.Geocoder();

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    showPosition(null);
  }

}

function showPosition(position) {
  if (position !== null) {
    // console.log("Latitude: " + position.coords.latitude + "; Longitude: " + position.coords.longitude);
    myLatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  }

  if (postData && postData.form && postData.form.location) {
    $('.location[data-item-prop="keywords"').html(postData.form.location || 'NaN');
    codeCenter(postData.form.location);
  } else {
    $('.location[data-item-prop="keywords"').html('NaN');
    centerInitialized(myLatlng);
  }
}

function centerInitialized(geometryLocation, address) {
  map = new google.maps.Map(mapDiv, {
    center: myLatlng = geometryLocation,
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  placesService = new google.maps.places.PlacesService(map);

  var image = {
    url: '//maps.gstatic.com/mapfiles/place_api/icons/camping-71.png',
    size: new google.maps.Size(71, 71),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(12, 25),
    scaledSize: new google.maps.Size(25, 25)
  };

  var marker = new google.maps.Marker({
    map: map,
    icon: image,
    title: address || '',
    position: geometryLocation,
    animation: google.maps.Animation.DROP,
    // draggable: true,
  });

  if (typeof doctors !== 'undefined') {
    for (var i = 0, doctor; doctor = doctors[i]; i++) {
      codeAddress(doctor);
    }
  }
  $('#essenScript').remove();

  if (mapDiv) {
    searchDoctors();
  }
}


// google.maps.event.addDomListener(window, 'load', initialize);

function toggleBounce(index, markersContainer, infoWindowsContainer) {
  var mContainer = markersContainer || markers;
  var iwContainer = infoWindowsContainer || infoWindows;

  for (var i = 0, marker; marker = mContainer[i]; i++) {
    marker.setAnimation(null);
  }
  for (var i = 0, infoWindow; infoWindow = iwContainer[i]; i++) {
    infoWindow.close();
  }

  if (index >= mContainer.length || index >= iwContainer.length) {
    return;
  }


  var marker = mContainer[index];
  if (marker) {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }

  var infoWindow = iwContainer[index];
  if (infoWindow) {
    infoWindow.open(map);
  }

  // map.setCenter(marker.position);
}

function searchBounce(doctorId) {
  for (var i = 0, marker; marker = markers[i]; i++) {
    if (marker.doctor && marker.doctor.id && parseInt(marker.doctor.id) == parseInt(doctorId)) {
      toggleBounce(i);
    }
  }
}

function codeCenter(address) {
  if (!address) {
    return;
  }
  geocoder.geocode({
    'address': address
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      centerInitialized(results[0].geometry.location, address);
    } else {
      console.log('Geocode was not successful for the following reason: ' + status);
    }
  });
}

function codeAddress(doctor) {
  var address = doctor.address + ", " + doctor.zip + ' ' + doctor.city;
  if (!address) {
    return;
  }

  if (doctor.coordinate_lat && doctor.coordinate_lng && parseInt(doctor.coordinate_lat) != 0 && parseInt(doctor.coordinate_lng) != 0) {
    codeCoordinate(doctor);
  } else {
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        doctor.coordinate_lat = results[0].geometry.location.lat();
        doctor.coordinate_lng = results[0].geometry.location.lng();

        codeCoordinate(doctor);
      } else {
        console.log('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
}

function codeCoordinate(doctor) {
  var coordinates = new google.maps.LatLng(parseFloat(doctor.coordinate_lat), parseFloat(doctor.coordinate_lng));

  var marker = new google.maps.Marker({
    map: map,
    title: (doctor.academic_grade + ' ' + doctor.name + ' ' + doctor.surname) || 'Lorem Ipsum',
    position: coordinates,
    animation: google.maps.Animation.DROP,
    // draggable: true,
  });

  marker.markerIndex = markers.length;
  marker.doctor = doctor;

  google.maps.event.addListener(marker, 'click', function() {
    toggleBounce(this.markerIndex);
    toggleBounce(31415926, gMarkers, gInfoWindows);
  });

  $('#search .map-popup').find(".name a").text(doctor.academic_grade + ' ' + doctor.name + ' ' + doctor.surname).attr('href', $.siteUrl + '/profile/doctor/member/' + doctor.id);
  $('#search .map-popup').find(".photo img").attr('src', doctor.avatar);
  $('#search .map-popup').find(".street").html(doctor.address);
  $('#search .map-popup').find(".cityzip").html(doctor.zip + ' ' + doctor.city);
  $('#search .map-popup').find(".actions .btn").attr('href', typeof doctor.id != 'undefined' ? ($.siteUrl + '/profile/doctor/member/' + doctor.id) : (doctor.link || '#noanchor_ihrarzt24'));

  var infoWindow = new google.maps.InfoWindow({
    content: $('#search .map-popup-wrapper').html(),
    position: coordinates,
    pixelOffset: new google.maps.Size(0, -30),
  });

  google.maps.event.addListener(infoWindow, 'closeclick', function() {
    toggleBounce(31415926);
    toggleBounce(31415926, gMarkers, gInfoWindows);
  });

  markers.push(marker);
  infoWindows.push(infoWindow);

  var bounds = new google.maps.LatLngBounds();
  for (var i = 0, marker; marker = markers[i]; i++) {
    bounds.extend(marker.position);
  }

  map.fitBounds(bounds);

  // map.setCenter(coordinates);
}

function searchDoctors() {
  console.log(searchKeyword);
  $('.specialty[data-item-prop="keywords"').html(searchKeyword + '(e/en)');
  console.log(searchKeyword + ' in der Nähe von ' + postData.form.location);
  placesService.radarSearch({
    'keyword': searchKeyword + ' in der Nähe von ' + postData.form.location,
    'location': myLatlng,
    'radius': searchRadius,
  }, function(results, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {

      // [START region_getplaces]
      // Listen for the event fired when the user selects an item from the
      // pick list. Retrieve the matching places for that item.

      var places = results;

      var bounds = new google.maps.LatLngBounds();

      console.log(places.length + ' locations found.');
      $('.docs-count[data-item-prop="headline"').html(places.length + (typeof doctors !== 'undefined' ? doctors.length : 0));

      for (var i = 0, place; place = places[i]; i++) {
        var image = {
          url: '//maps.gstatic.com/mapfiles/place_api/icons/doctor-71.png',
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(7, 15),
          scaledSize: new google.maps.Size(15, 15)
        };

        // Create a marker for each place.
        var marker = new google.maps.Marker({
          map: map,
          icon: image,
          // title: place.name,
          position: place.geometry.location,
          opacity: .65,
        });

        marker.markerIndex = gMarkers.length;
        marker.placeReference = place.reference;
        marker.detailsFetched = false;

        var infoWindow = new google.maps.InfoWindow({
          content: 'Fetching data..',
          position: place.geometry.location,
          pixelOffset: new google.maps.Size(0, -30),
        });

        google.maps.event.addListener(marker, 'click', function() {
          var thisMarker = this;
          var markerIndex = this.markerIndex;
          var placeReference = this.placeReference;

          if (this.detailsFetched) {
            toggleBounce(31415926);
            toggleBounce(markerIndex, gMarkers, gInfoWindows);

            console.log('Pulled from pool.');
          } else {

            placesService.getDetails({
              reference: placeReference
            }, function(place, detailStatus) {
              if (detailStatus == google.maps.places.PlacesServiceStatus.OK) {
                var $adrHtml = $('<p>' + place.adr_address + '</p>');

                console.log(place);

                $.ajax({
                  type: "POST",
                  url: $.siteUrl + '/profile/doctor/google/' + place.placeReference,
                  data: {
                    google: JSON.stringify(place),
                  },
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

                    // console.log(data);
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

                $('#search .map-popup').find(".name a").text(place.name).attr('href', typeof place.url !== 'undefined' && place.url ? place.url : '#');
                $('#search .map-popup').find(".street").html($adrHtml.find('.street-address').html());
                $('#search .map-popup').find(".cityzip").html($adrHtml.find('.postal-code').html() + ' ' + $adrHtml.find('.locality').html());
                $('#search .map-popup').find(".actions .btn").attr('href', typeof place.url !== 'undefined' && place.url ? place.url : '#').toggleClass('hidden', typeof place.url !== 'undefined' && place.url ? false : true);
                // $('#search .map-popup').find(".cityzip").html(place.international_phone_number);
                if (place.photos && place.photos.length > 0) {
                  $('#search .map-popup').find(".photo img").attr('src', place.photos[0].getUrl({
                    maxWidth: 300,
                  }));
                } else {
                  $('#search .map-popup').find(".photo img").attr('src', 'http://placehold.it/50x100');
                }

                $('#results-list .Google-list').find(".name a").text(place.name).attr('href', typeof place.url !== 'undefined' && place.url ? place.url : '#');
                $('#results-list .Google-list').find(".street").html($adrHtml.find('.street-address').html());
                $('#results-list .Google-list').find(".cityzip").html($adrHtml.find('.postal-code').html() + ' ' + $adrHtml.find('.locality').html());
                $('#results-list .Google-list').find(".actions .btn").attr('href', typeof place.url !== 'undefined' && place.url ? place.url : '#').toggleClass('hidden', typeof place.url !== 'undefined' && place.url ? false : true);
                // $('#search .map-popup').find(".cityzip").html(place.international_phone_number);
                if (place.photos && place.photos.length > 0) {
                  $('#results-list .Google-list').find(".photo img").attr('src', place.photos[0].getUrl({
                    maxWidth: 300,
                  }));
                } else {
                  $('#search .map-popup').find(".photo img").attr('src', 'http://placehold.it/50x100');
                }

                var infoWindow = new google.maps.InfoWindow({
                  content: $('#search .map-popup-wrapper').html(),
                  position: place.geometry.location,
                  pixelOffset: new google.maps.Size(0, -30),
                });

                if (gInfoWindows[markerIndex]) {
                  gInfoWindows[markerIndex].close();
                }

                gInfoWindows[markerIndex] = infoWindow;

                google.maps.event.addListener(infoWindow, 'closeclick', function() {
                  toggleBounce(31415926);
                  toggleBounce(31415926, gMarkers, gInfoWindows);
                });

                toggleBounce(31415926);
                toggleBounce(markerIndex, gMarkers, gInfoWindows);

                thisMarker.detailsFetched = true;
                thisMarker.setTitle(place.name);

                console.log('New request performed.');
              } else {
                console.log('PlacesService.getDetails was not successful for the following reason: ' + detailStatus);
              }
            });
          }
        });

        gMarkers.push(marker);
        gInfoWindows.push(infoWindow);

        bounds.extend(place.geometry.location);
      }
      map.fitBounds(bounds);

    } else {
      console.log('PlacesService.nearbySearch was not successful for the following reason: ' + status);
    }
  });
}