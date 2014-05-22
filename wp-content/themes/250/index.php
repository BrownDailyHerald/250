<?php

get_header();

function render_category($slug = null) {
  if (empty($slug)) return array();
  $query = new WP_Query( array('category_name' => $slug, 'posts_per_page' => -1) );
  echo '<ul>';
  while ( $query->have_posts() ) {
	  $query->the_post();
	  echo '<li> <a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
  }
  echo '</ul>';
  return $query;
}

?>
<style type="text/css">
body {
  background: url(<?php echo get_template_directory_uri() . '/img/bg_fw.jpg'; ?>);
  background-size: 100% auto;
}
</style>
<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville' rel='stylesheet' type='text/css'>

<div class="catcontain">
  <div class="category" style="background-color: #dd1e36;">
    <div class="title" style="color: #ffffff"><b>The People</b></div>
    <?php render_category('the-people'); ?>
  </div>
  <div class="category middle" style="background-color: #3a1e1a; margin: auto;">
    <div class="title" style="color: #ffffff"><b>The Place</b></div>
    <?php render_category('the-place'); ?>
  </div>
  <div class="category" style="background-color: #dd1e36">
    <div class="title" style="color: #ffffff"><b>The Moment</b></div>
    <div class="photo">
      <?php render_category('the-moment'); ?>
    </div>
  </div>
</div>
<script type='text/javascript'>
  var low_opc = 0.4;
  var min_width = "5%";
  var min_height = $('.category').first().css('height');
  var exp_height = '600px';
  $('.category').hover(function() {
    $(this).stop().animate({width: '90%', height: exp_height, opacity: '1.0'});
    $('.category').not($(this)).stop().animate({width: min_width, height: min_height, opacity: low_opc});
    $('.content-container').stop().animate({opacity: low_opc});

  }, function() {
    $(this).stop().animate({width: '33.33%', height: min_height, opacity: '1.0'});
    $('.category').not($(this)).stop().animate({width: '33.33%', height: min_height, opacity: '1.0'});
    $('.content-container').stop().animate({opacity: '1.0'});
  });
</script>
<?php
get_sidebar();
get_footer();
