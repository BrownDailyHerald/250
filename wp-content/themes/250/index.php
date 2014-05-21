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
    <div class="archive"></div>
    <div class="photo">
      <?php render_category('the-people'); ?>
    </div>
  </div>
  <div class="category" style="background-color: #3a1e1a; margin: auto;">
    <div class="title" style="color: #ffffff"><b>The Place</b></div>
    <div class="content-container">
      <div class="archive">
        <h1> <u> Archives </u></h1>
        <h3> Announcements </h3>
        <ul>
          <li> <a href="#"> Article 1 </a> </li>
          <li> <a href="#"> Article 2 </a> </li>
        </ul>
        <h3> Presidency </h3>
        <ul>
          <li> <a href="#"> Fuck 1 </a> </li>
          <li> <a href="#"> Fuck 2 </a> </li>
        </ul>
        <h3> Deaths </h3>
        <ul>
          <li> <a href="#"> Fuck 1 </a> </li>
          <li> <a href="#"> Fuck 2 </a> </li>
        </ul>
      </div>
      <div class="content">
        <h1> <u> Shit load of links...? </u> </h1>
        <ul>
          <li> <a href="#"> Fuck 1 </a> </li>
          <li> <a href="#"> Fuck 2 </a> </li>
          <li> <a href="#"> Fuck 3 </a> </li>
          <li> <a href="#"> Fuck 4 </a> </li>
          <li> <a href="#"> Fuck 5 </a> </li>
          <li> <a href="#"> Fuck 6 </a> </li>
        </ul>
      </div>
    </div>
    <div class="photo">
      <?php render_category('the-place'); ?>
    </div>
  </div>
  <div class="category" style="background-color: #dd1e36">
    <div class="title" style="color: #ffffff"><b>The Moment</b></div>
    <div class="archive"></div>
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

  }, function() {
    $(this).stop().animate({width: '33.33%', height: min_height, opacity: '1.0'});
    $('.category').not($(this)).stop().animate({width: '33.33%', height: min_height, opacity: '1.0'});
  });
</script>

<?php
get_sidebar();
get_footer();
