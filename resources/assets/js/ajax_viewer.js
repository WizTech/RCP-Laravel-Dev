var ajax_container = '.ajax_container';
var ajax_opacityLayer = '.opacity_layer';
var ajax_close = '.ajax_close,.cancel_popup';
var content_container = '.content_container';
function ajax_viewer_config(id, URL, back, userId) {

  var DATA = {'id': id, 'user_id': userId, 'back': back};
  $.ajax({
    url: URL,
    type: 'POST',
    data: DATA,
    //dataType: 'json',
    cache: false,
    success: function (resp) {
      $(ajax_opacityLayer).fadeIn('fast', function () {
        $(ajax_container).html('<div style="" class="content_container">' + resp + '</div>').show();
        $(ajax_container).prepend('<div class="ajax_close"></div>');
        $(window).resize();
        setTimeout("$(window).resize();", 10);
      });
    },
    error: function (e) {
      //called when there is an error
      //console.log(e.message);
    }
  });
}
jQuery(window).resize(function () {
  var WW = $(window).width();
  var WH = $(window).height();

  $(ajax_container).css({
    position: 'fixed',
    width: (WW - 200) + 'px',
    height: (WH - 200) + 'px'
  });

  if ($(ajax_container).height() > $(content_container).children('div').height()) {
    $(ajax_container).height($(content_container).children('div').height() + 30)
  }

  $(ajax_container).css({
    position: 'fixed',
    left: ($(window).width() - $(ajax_container).outerWidth()) / 2,
    top: ($(window).height() - $(ajax_container).outerHeight()) / 2
  });


  $('.child_popup').css({
    position: 'fixed',
    left: ($(window).width() - $('.child_popup').outerWidth()) / 2,
    top: ($(window).height() - $('.child_popup').outerHeight()) / 2
  });

  $(content_container).css({height: ($(ajax_container).height()) + 'px'});


});


$(document).on('click', ajax_close, function () {
  $(ajax_opacityLayer).click();
})

$(document).on('click', ajax_opacityLayer, function () {
  $(this).hide();
  $(ajax_container).hide().children('*').remove();
});
jQuery(window).load(function () {

  $('body').prepend('<div class="opacity_layer"></div>');
  $('body').append('<div class="ajax_container"></div>');
  jQuery(window).resize();
});
$.fn.extend({
  typeDone: function (call_func, wait_time) {
    var this_ele = $(this);
    if (typeof wait_time === 'undefined' || isNaN(wait_time)) {
      var wait_time = 950;
    }
    this_ele.on('keyup', function (eve) {

      //if (eve.charCode) {
      var key_count = this_ele.attr('data-keyout');
      if (isNaN(key_count)) {
        key_count = 0;
      } else {
        key_count = parseInt(key_count) + 1;
      }
      this_ele.attr('data-keyout', key_count);
      var is_typedone;
      var clear_timeout;
      is_typedone = false;
      clear_timeout = setTimeout(function () {
        var key_count = parseInt(this_ele.attr('data-keyout')) - 1;
        this_ele.attr('data-keyout', key_count);
        if (is_typedone == true) {
          return false;
        }
        if (isNaN(key_count) || key_count < 0) {
          is_typedone = true;
          clearTimeout(clear_timeout);
          this_ele.removeAttr('data-keyout');
          if (typeof call_func === 'function') {
            call_func();
          }
        }
      }, wait_time);
      // }

    });
  }
});