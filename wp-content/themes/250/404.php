<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package landscape
 */

get_header(); ?>
<header class="banner">
  <div style="overflow: auto;">
    <a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name'); ?></a>
    <div style="float: right; font-size: 12px; margin-top: 10px; margin-right: 20px;">by Joe Stein and Cody Ma</div>
  </div>
</header>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
    <h1 style="text-align: center; margin-top: 1em; font-size: 400%; color: rgb(58, 30, 26);"><?php _e( 'Not Found', 'twofifty' ); ?></h1>
    <div style="text-align: center;"><a href="<?php echo get_site_url(); ?>" style="font-family: serif;">return to home</a></div>
	</div>
</div>
<?php
get_footer();
