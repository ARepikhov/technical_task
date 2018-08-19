<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package test
 */

get_header();
?>

	<div id="primary" class="content-area container space">
    <div class="row">
      <main id="main" class="site-main">
      <?php
      while ( have_posts() ) :
        the_post();
        setPostViews(get_the_ID());?>
        <div class="single_post_wrapper">
          <div class="post_thumbnail_wrapper">
            <div class="single_post_title">
              <h1 class="title"><?php the_title(); ?></h1>
            </div>
            <div class="single_post_banner">
                <img src="<?php echo the_post_thumbnail_url( 'thumb' ); ?>" class="img-responsive center-block wp-post-image">
            </div>
          </div>
          <div class="post_info_wrapper">
            <div class="single-content col-md-10 col-md-offset-1">
              <p><?php the_content(); ?></p>
            </div>
          </div>
          <div class="last_post_meta clearfix col-xs-12">
            <span class="blog_meta_item blog_meta_date"><span class="screen-reader-text"></span><time class="entry-date published updated" datetime="<?php the_time('j M Y'); ?>"><?php the_time('M, j Y'); ?></time></span>
            <span class="last_meta_author">
                <span class="author vcard"><a href="<?php the_author_link(); ?>"><?php $author_email = get_the_author_email(); echo get_avatar($author_email, '33');?></a>
                <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></span>
              </span>
          </div>
        </div>
      <?php
      endwhile; // End of the loop.
      ?>
      </main><!-- #main -->
    </div>
    <div class="post_nav">
			<?php the_post_navigation();?>
    </div>
	</div><!-- #primary -->
<?php
get_footer();
