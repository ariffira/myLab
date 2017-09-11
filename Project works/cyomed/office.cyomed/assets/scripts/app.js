var CyomedApp, Cyomed, App, CA, _CA, _C, _A;
CyomedApp = Cyomed = App = CA = _CA = _C = _A = $.extend({},
  CyomedApp ? CyomedApp : null,
  Cyomed ? Cyomed : null,
  App ? App : null,
  CA ? CA : null,
  _CA ? _CA : null,
  _C ? _C : null,
  _A ? _A : null
);

+ function(App, $, window, document, undefined) {

  "use strict"; // jshint ;_;

  function convertHex2RGB(hex) {
    if (hex.indexOf('#') === 0) {
      hex = hex.substring(1);
    }

    hex = parseInt(hex, 16);

    var r = (hex >> 16) & 255;
    var g = (hex >> 8) & 255;
    var b = (hex >> 0) & 255;

    return [r, g, b];
  };

  function ltrim(str, charlist) {
    //  discuss at: http://phpjs.org/functions/ltrim/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    //    input by: Erkekjetter
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Onno Marsman
    //   example 1: ltrim('    Kevin van Zonneveld    ');
    //   returns 1: 'Kevin van Zonneveld    '

    charlist = !charlist ? ' \\s\u00A0' : (charlist + '')
      .replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
    var re = new RegExp('^[' + charlist + ']+', 'g');
    return (str + '')
      .replace(re, '');
  };

  function rtrim(str, charlist) {
    //  discuss at: http://phpjs.org/functions/rtrim/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    //    input by: Erkekjetter
    //    input by: rem
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Onno Marsman
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //   example 1: rtrim('    Kevin van Zonneveld    ');
    //   returns 1: '    Kevin van Zonneveld'

    charlist = !charlist ? ' \\s\u00A0' : (charlist + '')
      .replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\\$1');
    var re = new RegExp('[' + charlist + ']+$', 'g');
    return (str + '')
      .replace(re, '');
  };

  function trim(str, charlist) {
    return ltrim(rtrim(str, charlist));
  };

  var _siteUrl = 'localhost';

  function setSiteUrl(url) {
    _siteUrl = url;
  };

  function siteUrl(url) {
    url = url || '';

    if (url.indexOf('#') !== 0 &&
      url.indexOf('javascript:') !== 0 &&
      url.indexOf('http:') !== 0 &&
      url.indexOf('https:') !== 0 &&
      url.indexOf('//') !== 0) {
      url = _siteUrl + (url ? '/' + ltrim(url, '/') : '');
    }

    return url;
  };

  var _baseUrl = 'localhost';

  function setBaseUrl(url) {
    _baseUrl = url;
  };

  function baseUrl(url) {
    url = url || '';

    if (url.indexOf('#') !== 0 &&
      url.indexOf('javascript:') !== 0 &&
      url.indexOf('http:') !== 0 &&
      url.indexOf('https:') !== 0 &&
      url.indexOf('//') !== 0) {
      url = _baseUrl + (url ? ltrim(url, '/') : '');
    }

    return url;
  };

  function loadUrl(url, container, successCallback) {

    if (typeof container === 'undefined' || !container) {
      container = $(".content");
    }

    container = $(container);

    $.ajax({
      type: "GET",
      url: url,
      dataType: 'html',
      cache: true, // (warning: setting it to false will cause a timestamp and will call the request twice)
      beforeSend: function() {

        //IE11 bug fix for googlemaps (delete all google map instances)
        //check if the page is ajax = true, has google map class and the container is .content
        // if ($(".google_maps")[0] && (container[0] == $(".content")[0])) {

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
        // if ($('.dataTables_wrapper')[0] && (container[0] == $(".content")[0])) {

        //   var tables = $.fn.dataTable.fnTables(true);
        //   $(tables).each(function() {
        //     $(this).dataTable().fnDestroy();
        //   });
        //   /*console.log("datatable nuked!!!");*/
        // }
        // end destroy

        // empty container and var to start garbage collection (frees memory)
        container.removeData().html("");

        // place cog
        container.html('<h1 class="p-20 m-20"><i class="fa fa-cog fa-spin"></i> Loading..</h1>');

        // Only draw breadcrumb if it is main content material
        if (container[0] == $(".content")[0]) {

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

        // dump data to container
        container.css({
          /*opacity: '0.0'*/
        }).html(data).delay(50).animate({
          opacity: '1.0'
        }, 300);

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
          successCallback.apply(this, [data, this, ]);
        }

        pageSetup(container);

        // clear data var
        data = null;
        container = null;
      },
      error: function(jqXHR, textStatus, errorThrown) {
        container.html('<h1 class="p-20 m-20"><i class="fa fa-warning"></i> Error! ' + errorThrown + '</h4>');
      },
      statusCode: {
        302: function(jqXHR, textStatus, errorThrown) {
          console.log(arguments);
          container.html('<h1 class="p-20 m-20"><i class="fa fa-cog fa-spin"></i> Reloading.. ' + errorThrown + '</h4>');

          var redirect = jqXHR.getResponseHeader('X-Cyomed-Redirect');
          if (redirect) {
            window.location = redirect;
          }
        },
        403: function(jqXHR, textStatus, errorThrown) {
          console.log(arguments);
        },
        404: function(jqXHR, textStatus, errorThrown) {
          console.log(arguments);
        },
        500: function(jqXHR, textStatus, errorThrown) {
          console.log(arguments);
        },
      },
      async: true,
    });

  };

  function pageSetup(scope) {

    if (typeof scope === 'undefined' || !scope) {
      scope = $(document);
    }

    scope = $(scope);

    /**
     * owlCalendar
     */
    $().owlCalendar ?
      + function() {

    }() : 0;

    /**
     * fullCalendar
     */
    $().fullCalendar ?
      + function() {

    }() : 0;

    /**
     * moment
     */
    typeof moment !== 'undefined' && moment && moment() ?
      + function() {

        scope.find('.datetime.momentjs').each(function() {
          var time = $(this).data('datetime') || $(this).attr('data-datetime'),
            m = time ? moment(time) : false;
          time ? $(this).append(m.format('dd. DD.MM.YYYY HH:mm')) : 1;
        });

    }() : 0;

    /**
     * chosen
     */
    $().chosen ?
      + function() {

        scope.find('.chosen-select').chosen({
          inherit_select_classes: true,
        }).on('change', function(evt, params) {
          console.log('selected:' + $(this).val());
        }).on('focus', function(evt, params) {
          $(this).trigger('chosen:activate');
        });

    }() : 0;

    /**
     * datetimepicker
     */
    $().datetimepicker ?
      + function() {

        scope.find('.datetime-picker').datetimepicker({
          dateFormat: 'yy-mm-dd',
          timeFormat: 'HH:mm:ss',
        });

    }() : 0;

    /**
     * mSelector
     */
    !$().mSelector ?
      + function() {

        $.fn.mSelector = function(userOpts) {

          var opts = $.extend({}, $.fn.mSelector.defaultOptions, userOpts);

          return this.each(function() {
            var $result = $(this);
            var $select = $($result.data('selector') || $result.attr('data-selector'));
            var $ctrlUp = $($result.data('control-up') || $result.attr('data-control-up'));
            var $ctrlDown = $($result.data('control-down') || $result.attr('data-control-down'));
            var $ctrlDelete = $($result.data('control-delete') || $result.attr('data-control-delete'));

            if ($result.data('mSelector'))
              return;
            else
              $result.data('mSelector', $result);

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

        };

        $.fn.mSelector.defaultOptions = {};

    }() : 0;

    scope.find('select[data-toggle="mSelector"]').mSelector();

    /**
     * popover
     */
    $().popover ?
      + function() {

        scope.find('[rel="popover"]').click(function() {
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

        scope.find('[rel="popover"]').popover({
          trigger: 'hover',
          placement: 'left',
          html: true,
        });

    }() : 0;

    /**
     * tooltip
     */
    $().tooltip ?
      + function() {

        scope.find('[rel="tooltip"]').tooltip();

    }() : 0;

    /**
     * data-apply
     */
    !$().dataApply ?
      + function() {

        $.fn.dataApply = function(userOpts) {

          var opts = $.extend({}, $.fn.dataApply.defaultOptions, userOpts);

          return this.each(function() {

            var $this = $(this),
              scope = $this.data('apply-scope') || false,
              field = $this.data('apply-field') || false,
              value = $this.data('apply-value') || 0;

            if ($this.data('dataApply'))
              return;
            else
              $this.data('dataApply', {
                target: $this,
                field: field,
                value: value,
              });

            if (scope && field) {
              var postData = {
                'field': field,
                'value': value,
              };

              var ajaxPostCallback = function() {
                $.ajax({
                  type: "POST",
                  url: siteUrl('admin/' + scope),
                  data: postData,
                  async: true,
                  cache: false,
                  beforeSend: function() {
                    // cog placed
                    // container.html('<h1><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
                    // $this.button('disable');
                    $this.bootstrapBtn('loading');
                  },
                  /*complete: function(){
                // Handle the complete event
                // console.log("complete")
                },*/
                  success: function(data) {
                    // Handle the success event / data
                    // cog replaced here...
                    // console.log("success")
                    // $this.bootstrapBtn('reset');
                    window.location.reload(true);
                  },
                  statusCode: {
                    302: function(jqXHR, textStatus, errorThrown) {
                      console.log(arguments);

                      var redirect = jqXHR.getResponseHeader('X-Cyomed-Redirect');
                      if (redirect) {
                        window.location = redirect;
                      }
                    },
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

              if ($this.is('button')) {
                if ($this.is('[data-input-target]')) {
                  $this.click(function() {
                    var $inputHidden = $('<input type="hidden" name="field" value="' + field + '" />'),
                      $inputTextbox = $('<input type="text" class="form-control" name="value" value="' + value + '" placeholder="' + field + '" />'),
                      $inputOk = $('<button type="button" class="btn btn-xs btn-primary" ><span class="icomoon i-checkmark"></span> Ok</button>'),
                      $inputNo = $('<button type="button" class="btn btn-xs btn-default" ><span class="icomoon i-close"></span> Cancel</button>'),
                      $form = $('<form class="form-horizontal" role="form"></form>').append($inputHidden).append($inputTextbox).append($inputOk).append($inputNo);

                    $inputNo.click(function() {
                      $form.remove();
                      $this.toggleClass('hidden', false);
                      $($this.data('input-target')).toggleClass('hidden', false);
                    });

                    $inputOk.click(function() {
                      postData['value'] = $form.find('[name="value"]').val();
                      $(this).bootstrapBtn('loading');
                      ajaxPostCallback();
                    });

                    $this.toggleClass('hidden', true).before($form);
                    $($this.data('input-target')).toggleClass('hidden', true);
                  });
                } else {
                  $this.click(ajaxPostCallback);
                }
              }

              if ($this.is('select')) {
                $this.change(function() {
                  var newValue = $this.val();
                  var doAct = confirm('Changing field ' + field + ' from "' + $this.find("option[selected]").html() + '"<' + value + '> to "' + $this.find("option[value='" + newValue + "']").html() + '"<' + newValue + '>?');
                  if (doAct) {
                    postData['value'] = newValue;
                    ajaxPostCallback();
                  } else {
                    $this.val($this.find("option[value='" + value + "']").attr('value'));
                  }
                });
              }
            }

          });

        };

        $.fn.dataApply.defaultOptions = {};

    }() : 0;

    scope.find('[data-apply-scope][data-apply-field]').dataApply();

    /**
     * summernote
     */
    $().summernote ?
      + function() {

        scope.find('.summernote').each(function() {
          $(this).summernote({
            height: $(this).data('summernote-height') || 350,
          });
        });

    }() : 0;

    /**
     * dataTable
     */
    $().dataTable ?
      + function() {

        scope.find("#example1").dataTable();
        scope.find('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
        scope.find('#pending').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });

    }() : 0;

    /**
     * iCheck
     */
    $().iCheck ?
      + function() {

        scope.find('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });

    }() : 0;



  };

  if (!window.initialized) {
    window.initialized = [];
  }

  function init(scope) {

    if (typeof scope === 'undefined' || !scope) {
      scope = $(document);
    }

    scope = $(scope);

    for (var i = window.initialized.length - 1; i >= 0; i--) {
      if (window.initialized[i] === scope[0]) {
        return;
      }
    };

    window.initialized.push(scope[0]);

    /**
     * BS button
     */
    if (jQuery().button && $.fn.button.noConflict) {
      var bootstrapButton = $.fn.button.noConflict();
      $.fn.bootstrapBtn = bootstrapButton;
    }

    /**
     * Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
     */
    $ && $.widget && $.widget.bridge && $.widget.bridge('uibutton', $.ui.button);


    /**
     * Moment
     */
    moment.lang('de');


    /**
     * Ajax links & Hash change
     */
    scope.find(
      '.sidebar-menu li > a,' +
      '.ajax-link').click(function(e) {

      var $t = $(this),
        href =
        $t.attr('href') ||
        $t.data('href') ||
        $t.attr('data-href') ||
        $t.data('location') ||
        $t.attr('data-location') || null;

      if (href && href.indexOf('#') !== 0) {
        e.preventDefault();

        loadUrl(siteUrl(href));
      }
    });

    var prevHref = window.location.hash;

    $(window).on('hashchange', function(e) {

      if (window.location.href !== baseUrl() + window.location.hash) {
        window.location = baseUrl() + window.location.hash;
        return;
      }

      var href = window.location.hash;

      href.charAt(0) === '#' ? + function() {
        href = href.substring(1);
      }() : 1;

      loadUrl(siteUrl(href));

      prevHref = href;
    });

    if (prevHref) {
      $(window).trigger('hashchange');
    } else if (App.activeUrl) {
      loadUrl(siteUrl(App.activeUrl));
    } else if ($(".content").length && $.trim($(".content").html()) == '') {
      var firstLink = scope.find('.sidebar-menu li > a[href!="#"]:not([href^="javascript:"])').eq(0);

      if (firstLink.length && firstLink.attr('href') && firstLink.attr('href').indexOf('#') === 0) {
        loadUrl(siteUrl(firstLink.attr('href').slice(1)));
      } else {
        loadUrl(siteUrl(firstLink.attr('href')));
      }
    } else {

    }

    /**
     * Misc
     */

  };

  /**
   * Utils
   */
  App.convertHex2RGB = convertHex2RGB;
  App.ltrim = ltrim;
  App.rtrim = rtrim;
  App.trim = trim;
  App.baseUrl = baseUrl;
  App.siteUrl = siteUrl;
  App.setBaseUrl = setBaseUrl;
  App.setSiteUrl = setSiteUrl;

  /**
   * Cores
   */
  App.loadUrl = loadUrl;
  App.init = init;
  App.pageSetup = pageSetup;

}(CyomedApp, jQuery, window, document);


$(document).ready(function() {

  CyomedApp && CyomedApp.init && CyomedApp.init();
  CyomedApp && CyomedApp.pageSetup && CyomedApp.pageSetup();

});