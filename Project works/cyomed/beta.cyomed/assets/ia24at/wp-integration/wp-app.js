$(document).ready(function() {

  $('#nav').onePageNav({
    filter: ':not(.external)',
    scrollSpeed: 2500,
    scrollThreshold: 0.75
  });
});
//scroll-to-top button show and hide
jQuery(document).ready(function() {
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 100) {
      jQuery('.scrollup').fadeIn();
    } else {
      jQuery('.scrollup').fadeOut();
    }
  });
  //scroll-to-top animate
  jQuery('.scrollup').click(function() {
    jQuery("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });
});
$("div.lazy").lazyload({
  effect: "fadeIn"
});

$('.videoslider').bxSlider({
  infiniteLoop: false,

  pagerCustom: '#video-pager',
  touchEnabled: false,
  video: true,
  useCSS: false,
  controls: false,
  onSlideBefore: function($slideElement, oldIndex, newIndex) {
    if (typeof($("#player_iframe1")[0]) != 'undefined') {
      $('#player_iframe1')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
    }
    if (typeof($("#player_iframe2")[0]) != 'undefined') {
      $('#player_iframe2')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
    }
    if (typeof($("#player_iframe3")[0]) != 'undefined') {
      $('#player_iframe3')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
    }
  }

});

function slider(slideridn) {
  goto(slideridn);
}

function slideNext() {
  curtSlider = 1;
  sliderlen = $('#wideslider').find('li.slide').length;
  curtSlider = (typeof($("#bx-pager a.active").index()) != 'undefined') ? parseInt($("#bx-pager a.active").index()) + 1 : 1;
  slideridn = curtSlider;
  if (curtSlider < sliderlen) {
    goto(slideridn);
  }
}

function slidePrev() {
  curtSlider = 1;
  sliderlen = $('#wideslider').find('li.slide').length;
  curtSlider = (typeof($("#bx-pager a.active").index()) != 'undefined') ? parseInt($("#bx-pager a.active").index()) - 1 : 1;
  slideridn = curtSlider;
  if (curtSlider >= 0) {
    goto(slideridn);
  }
}


function goto(slideridn) {
  $("#bx-pager").find('a').removeClass('active');
  $("#bx-pager").find('a:eq(' + slideridn + ')').toggleClass('active', true);
  $('#wideslider').find('li.slide').toggleClass('fade-out', true);
  $('#wideslider').find('li.slide').toggleClass('active', false);
  $("#wideslider").find('li.slide:eq(' + slideridn + ')').removeClass('fade-out').toggleClass('active', true);
}
$(document).ready(function() {
  goto(0);
});