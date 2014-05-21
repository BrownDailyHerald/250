<?php
/**
 * Plugin Name: 250 Slideshow Gallery
 * Version: 0.1
 * Author: Joe Stein
 */

add_filter( 'post_gallery', 'slideshow_gallery', 1, 4 );

function slideshow_gallery($output = '', $atts, $content = false, $tag = false ) {
  if (empty($atts['ids'])) return $output;
  
  $w = get_option('large_size_w');
  $output = '<div class="gallery" style="width: '.$w.'px">'; // clear output

  $post = get_post();
  
  $html5 = current_theme_supports( 'html5', 'gallery' );
  extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'size'       => 'large',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $atts, 'gallery'));

  // get attachments
  if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

  $left = 0;
  $i = 0;

  foreach ( $attachments as $id => $attachment ) {
			$image_output = wp_get_attachment_image( $id, $size, false );

    // now time for OUR style stuff

		$output .= "<div class='slide' style='left: ".$left."px;' id='".($i++)."'>";
		if ( trim($attachment->post_excerpt) ) {
			$output .= "
				<figcaption class='wp-caption-text gallery-caption'>
        <h1>" . $attachment->post_title . "</h1>" . wptexturize($attachment->post_excerpt) . "
				</figcaption>";
		}
    $output .= $image_output;
		$output .= "</div>";
    $left += $w;
	}
  $figcap_width = $w - 20; // for padding
  $control_width = count($attachments)*22 + 50;

  /* navigation */
  $output .= '<div class="gallery-nav"><div class="controls" style="width: '.$control_width.'px;">';
  $output .= '<img src="'.plugins_url( 'triangle_left.png' , __FILE__ ).'" style="float: left;" id="l" />';
  for ($i = 0; $i < count($attachments); $i++) {
    $output .= '<div class="bubble" id="'.$i.'"></div>';
  }
  $output .= '<img src="'.plugins_url( 'triangle_right.png' , __FILE__ ).'" style="float: left; margin-left: 10px;" id="r" />';
  $output .= '</div></div>';

  $output .= <<<HTML
<script type="text/javascript">
(function($) {  
  var ss = slideshow({
    element: '.gallery',
    width: {$w},
    delay: 8000,
  });
  $('.gallery').find('img').click(function() {
    (this.id == 'r' ? ss.next : ss.prev)();
  });
})(jQuery);
</script>
<style type="text/css">
.slide {
  width: {$w}px;
}
figcaption {
  width: {$figcap_width}px;
}
.gallery-nav {
  width: {$figcap_width}px;
}
</style>
HTML;

  /* end gallery div */
  $output .= '</div>';

  $output .= <<<CSS
<style type="text/css">
.gallery-nav .controls {
  margin: auto;
  overflow: auto;
}

.gallery-nav {
  overflow: auto;
  width: {$figcap_width}px;
  padding: 10px;
  margin: auto;
  position: absolute;
  z-index: 100000;
  height: 13px;
  overflow: hidden;
  bottom: 0px;
  background-color: rgba(0, 0, 0, 0.75);
  text-align: center;
}
.bubble {
  width: 10px;
  height: 10px;
  border-radius: 5px;
  border: 1px solid gray;
  background-color: rgba(0,0,0,0);
  float: left;
  margin-left: 10px;
  cursor: default;
  transition: background-color linear 0.4s;
}
.bubble.active {
  background-color: rgba(255,255,255,0.3);
}
.gallery-nav img {
  cursor: pointer;
}
.gallery {
  min-height: 500px;
  margin: auto;
  position: relative;
  overflow: hidden;
  border: 1px solid black;
  box-shadow: 0px 0px 5px 1px gray;
  border-radius: 5px;
}

.slide {
  position: absolute;
  top: 0px;
  text-align: center;
  transition: left ease 1s;
}

figcaption {
  font-family: sans-serif;
  text-align: center;
  top: 0px;
  padding: 10px;
  color: white;
  background-color: rgba(0, 0, 0, 0.75);
  font-size: 13px;
}
figcaption h1 {
  margin-bottom: 5px;
  margin-top: 2px;
  font-size: 16px;
}
.slide img {
  min-height: 100%;
  max-height: 100%;
  width: auto !important;
}
</style>
CSS;

  return $output;
  die;
}
