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
  /* set up images */
  var count = $(options.element).find('.slide').length;
  var checkTermination = function() {
    if (--count == 0) {
      $(options.element).find('.slide').last().css('left', '-'+options.width+'px').prependTo(options.element);
    }
  };
  $(options.element).find('.slide').each(function() {
    // preload images
    var img = new Image();
    var self = $(this);
    img.onload = function() {
      self.css({
        'width': options.width+'px',
        'left' : left+'px',
        'position' : 'absolute'
      }).find('img').css('width', options.width+'px');
      left += options.width;
      checkTermination();
    }
    img.onerror = function() {
      console.log('image not found', this);
      self.remove();
      checkTermination();
    }
    img.src = $(this).find('img').attr('src');
  });
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
