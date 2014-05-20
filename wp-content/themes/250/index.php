<?php

get_header();

function render_category($slug = null) {
  if (empty($slug)) return array();
  $query = new WP_Query( 'category_name='.$slug );
  echo '<ul>';
  while ( $query->have_posts() ) {
	  $query->the_post();
	  echo '<li>' . get_the_title() . '</li>';
  }
  echo '</ul>';
  return $query;
}

?>

<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville' rel='stylesheet' type='text/css'>

<div class="catcontain">
  <div class="category" style="background-color: #dd1e36;">
    <div class="title" style="color: #ffffff"><b>The People</b></div>
    <div class="photo">
      <?php render_category('the-people'); ?>
      <img src="http://placekitten.com/1300/600" alt="">
    </div>
  </div>
  <div class="category" style="background-color: #3a1e1a; margin: auto; z-index: 2000;">
    <div class="title" style="color: #ffffff"><b>The Place</b></div>
    <div class="photo">
      <?php render_category('the-place'); ?>
      <img src="http://placekitten.com/1300/600" alt="">
    </div>
  </div>
  <div class="category" style="background-color: #dd1e36">
    <div class="title" style="color: #ffffff"><b>The Moment</b></div>
    <div class="photo">
      <?php render_category('the-moment'); ?>
      <img src="http://placekitten.com/1300/600" alt="">
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

  }, function() {
    $(this).stop().animate({width: '33.33%', height: min_height, opacity: '1.0'});
    $('.category').not($(this)).stop().animate({width: '33.33%', height: min_height, opacity: '1.0'});
  });
</script>

<?php
get_sidebar();
get_footer();
