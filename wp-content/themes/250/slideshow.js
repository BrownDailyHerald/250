var slideshow = function(useropts) {
  var options = {
    width: 400,
    delay: 3000,
    autoPlay: true,
    onLoad: function() { 
      $(options.element).show();
    }
  }
  $.extend(options, useropts);
  if (!options.element) {
    return false;
  }
  

  if ($(options.element).css('width') && !useropts.width) {
    options.width = parseInt($(options.element).css('width'));
  }

  var left = 0;
  // prepend last image for smooth transition
  $(options.element).find('.slide').last().css('left', '-'+options.width+'px').prependTo(options.element);

  options.onLoad();

  /* start playing! */
  var advanceSlides = function() {
    $(options.element).find('.slide').each(function() {
      $(this).css('left', $(this).position().left - options.width + 'px');
    });
    var maxRight = parseInt($(options.element).find('.slide').last().css('left'));
    $(options.element).find('.slide').first().css('left', maxRight + 'px').appendTo(options.element);
  }

  var itimer = setInterval(advanceSlides, options.delay);
}
