var slideshow = function(useropts) {
  var options = {
    width: 400,
    delay: 3000,
    autoPlay: true,
    slideTime: 1000,
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

  var doneAnimating = true;
  /* start playing! */
  var advanceSlides = function(right) {
    if (!doneAnimating) return;
    doneAnimating = false;
    if (typeof right == 'undefined') right = true;
    $(options.element).find('.slide').each(function() {
      var thisLeft = parseInt($(this).css('left'));
      $(this).css('left', (right ? thisLeft- options.width : thisLeft + options.width) + 'px');
    });
    if (right) {
      var nextBound = parseInt($(options.element).find('.slide').last().css('left'));
      $(options.element).find('.slide').first().css('left', nextBound + 'px').appendTo(options.element);
    } else {
      var nextBound = parseInt($(options.element).find('.slide').first().css('left'));
      $(options.element).find('.slide').last().css('left', nextBound + 'px').prependTo(options.element);
    }
    var current_id = $(options.element).find('.slide').get(1).id;

    /* bubbles! */
    $(options.element).find('.gallery-nav .bubble').removeClass('active').end().find('.gallery-nav .bubble#'+current_id).addClass('active');
    
    /* done in transition time */
    setTimeout(function(){doneAnimating=true}, options.slideTime); 
  }
  /* activate first bubble */
  $(options.element).find('.gallery-nav .bubble').first().addClass('active');

  var itimer = setInterval(advanceSlides, options.delay);

  var controls = {
    next: function() {
      if (itimer != null) clearInterval(itimer);
      advanceSlides();
      itimer = setInterval(advanceSlides, options.delay);
    },
    prev: function() {
      if (itimer != null) clearInterval(itimer);
      advanceSlides(false);
      itimer = setInterval(advanceSlides, options.delay);
    },
    start: function() {
      if (itimer == null) {
        itimer = setInterval(advanceSlides, options.delay);
      }
    },
    pause: function() {
      clearInterval(itimer);
      itimer = null;
    }
  };

  return controls;
}
