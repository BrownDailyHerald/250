<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

$custom_author = get_post_meta( get_the_ID(), '_custom_author', true );
if (!empty($custom_author)) trim($custom_author);
?>
<header class="banner">
  <div style="overflow: auto;">
    <a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name'); ?></a>
    <div style="float: right; font-size: 12px; margin-top: 10px; margin-right: 20px;">by Joe Stein and Cody Ma</div>
  </div>
</header>
<div id="main" class="site-main">
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
      <h1 class="entry-title"><?php the_title( ); ?></h1>
      <div class="entry-meta">
        <span class="byline">
          <span class="author vcard">
            <a class="url fn n" rel="author">By: <?php if (empty($custom_author)) { the_author(); } else { echo $custom_author; } ?></a>
          </span>
        </span>
      </div>
    </header>

	  <?php if ( is_search() ) : ?>
	  <div class="entry-summary">
		  <?php the_excerpt(); ?>
	  </div><!-- .entry-summary -->
	  <?php else : ?>
	  <div class="entry-content">
		  <?php
			  the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', '250' ) );
			  wp_link_pages( array(
				  'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', '250' ) . '</span>',
				  'after'       => '</div>',
				  'link_before' => '<span>',
				  'link_after'  => '</span>',
			  ) );
		  ?>
	  </div><!-- .entry-content -->
	  <?php endif; ?>
<?php
    $tags = get_the_tags();
    if ( ! empty( $tags ) ) :
?>
    <footer class="entry-meta">
      <span class="tag-links">
<?php
      $tag_html = array();
      foreach ( $tags as $tag ) {
        $tag_html[] = $tag->name;
      }
      echo join(' | ', $tag_html);
?>
      </span>
    </footer>
<?php
    endif; // tags
?>
  </article><!-- #post-## -->
</div>
