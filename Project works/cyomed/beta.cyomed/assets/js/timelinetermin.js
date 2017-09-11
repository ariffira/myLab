/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 (function($){
        $.fn.mycalender = function(start){
            var today = new Date(start);
                               var dd = today.getDate();
                               var mm = today.getMonth()+1; //January is 0!
                               var yyyy = today.getFullYear();
                               if(dd<10) {
                                 dd='0'+dd
                                } 
                               if(mm<10) {
                                 mm='0'+mm
                               } 
            var eventdate= start;
            var eventSources = [];
            var dialogTerminClick;
            eventSources.push({
            name: 'termins',
            events: function(start, end, timezone, callback) {
            $.ajax({
            type: "POST",
            url: $.siteUrl + '/termin/doctor/calendar/all_termin_json',
            data: {},
            async: true,
            cache: false,
            beforeSend: function() {
              },
           
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
                    vc ? ((poolPushEvent.className = 'btn-success'), (poolPushEvent.textColor = 'black'), (poolPushEvent.title = 'Schließzeiten')) : $.ia24at;

                    pool.push(poolPushEvent);

                    var typePool = $('#fullcalendar').data('eventTypePool') || {
                      'private': [],
                      'public': [],
                      'both': [],
                      'none': [],
                      'close': []
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
              callback(pool);
            },
            statusCode:
            {
              404: function() {
              },
              500: function() {
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              }
          });
        }
      });

      eventSources.push({
        name: 'reservations',
        events: function(start, end, timezone, callback) {
          $.ajax({
            type: "POST",
            url: $.siteUrl + '/termin/doctor/termin/all_termin_json',
            data: {},
            async: true,
            cache: false,
            beforeSend: function() {
                 },
           success: function(data) {
               var pool = [];
              for (var i = 0, evt; evt = data[i++];) {
              var insurance = parseInt(evt.insurance),
                poolPushEvent;
                pool.push(poolPushEvent = $.extend({}, evt));
                poolPushEvent.title = evt.first_name + ' ' + evt.last_name + (insurance ? (insurance == 1 ? '(Pvt.)' : '(Ges.)') : '');
                poolPushEvent.start = moment(evt.start);
                poolPushEvent.end = moment(evt.end);
                poolPushEvent.end.isValid() ? $.ia24at : (poolPushEvent.end = moment(evt.start).add('m', (typeof window.docSettings !== 'undefined' ? (window.docSettings.termin_default_length || 30) : 30)));
                poolPushEvent.allDay = false;
                poolPushEvent.weekOffset = 0;
                 // Color, bgColor
                poolPushEvent.className = insurance != '0' ? (insurance == '1' ? 'btn-danger active' : 'btn-danger active') : 'btn-danger active';
              };
            callback(pool);
            },
            statusCode: {
              404: function() {
                },
              500: function() {
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              }
          });
        }
      });
         
           $('#calendar2').fullCalendar({
                                header: 
                                {
                                 left: '',
				 center: 'title',
				 right: ''
			        },
                                /*slotDuration: '00:20:00',*/
                                axisFormat: 'HH:mm',
                                timeFormat: 
                                {
                                 agenda: 'H(:mm)' //h:mm{ - h:mm}'
                                },
			        defaultDate: eventdate,
			        defaultView: 'agendaDay',
                                eventSources: eventSources,
                                selectable:true,
			        editable: true,
                                eventLimit: true
                });
        };
    })(jQuery);
     jQuery(document).ready(function (){
                   var today = new Date();
                   var dd = today.getDate();
                   var mm = today.getMonth()+1; //January is 0!
                   var yyyy = today.getFullYear();
                   if(dd<10) {
                    dd='0'+dd
                   } 
                   if(mm<10) {
                    mm='0'+mm
                   } 
                   var todaydate= yyyy+'-'+mm+'-'+dd;
                   var eventSources = [];
                   var dialogTerminClick;
                  eventSources.push({
           name: 'termins',
           events: function(start, end, timezone, callback)
           {
           $.ajax({
            type: "POST",
            url: $.siteUrl + '/termin/doctor/calendar/all_termin_json',
            data: {},
            // dataType: 'json',
            async: true,
            cache: false,
            beforeSend: function() {
             },
            success: function(data) {
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
                      'close': []
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
              callback(pool);
            },
            statusCode:
            {
              404: function() {
              },
              500: function() {
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
             }
          });
        }
      });
    eventSources.push({
        name: 'reservations',
        events: function(start, end, timezone, callback) {
          $.ajax({
            type: "POST",
            url: $.siteUrl + '/termin/doctor/termin/all_termin_json',
            data: {},
            async: true,
            cache: false,
            beforeSend: function() {
              },
            success: function(data) {
              var pool = [];
              for (var i = 0, evt; evt = data[i++];) {
              var insurance = parseInt(evt.insurance),
                  poolPushEvent;
                  pool.push(poolPushEvent = $.extend({}, evt));
                poolPushEvent.title = evt.first_name + ' ' + evt.last_name + (insurance ? (insurance == 1 ? '(Pvt.)' : '(Ges.)') : '');
                poolPushEvent.start = moment(evt.start);
                poolPushEvent.end = moment(evt.end);
                poolPushEvent.end.isValid() ? $.ia24at : (poolPushEvent.end = moment(evt.start).add('m', (typeof window.docSettings !== 'undefined' ? (window.docSettings.termin_default_length || 30) : 30)));
                poolPushEvent.allDay = false;
                poolPushEvent.weekOffset = 0;
                // Color, bgColor
                poolPushEvent.className = insurance != '0' ? (insurance == '1' ? 'btn-danger active' : 'btn-danger active') : 'btn-danger active';
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
            }
          });
        }
      });
		
                $('#calendar1').fullCalendar({
			header: {
				left: 'prev ',
        center: 'title',
				right: 'next'
			},
			defaultDate: todaydate,
			selectable: true,
			selectHelper: true,
                        
                        dayClick: function(date,jsEvent,view)
                        {
                          var eventData;
                          $("#calendar2").remove();
                          $("#termin .col-md-8").append("<div id='calendar2' ></div>");
                          $("#calendar2").mycalender(date.format());
                        },
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				
			]
		});
                
                 $('#calendar2').fullCalendar({
               
                                header: {
				left: '',
				center: 'title',
				right: ''
			        },
                                axisFormat: 'HH:mm',
                                timeFormat: {
                                 agenda: 'H(:mm)' //h:mm{ - h:mm}'
                                },
			        defaultDate: todaydate,
			        defaultView: 'agendaDay',
                                
                                selectable:true,
			        editable: true,
                                eventLimit: true, 
                                eventSources: eventSources
		});
});

