<?php
/*
Template Name: Test page
*/


get_header();
?>
  <!-- last post -->
  <div id="last_post" class="container space">
    <h2><?php _e('Last Post', 'test'); ?></h2>
    <div class="row">
      <?php
      global $post;
		    $tmp_post = $post;
		    $myposts = get_posts( 'post_type=post&numberposts=16&orderby=desc' );
		    foreach( $myposts as $post ) : setup_postdata($post); ?>
          <!-- last post wrapper-->
          <div class="last_post_wrapper col-md-3 col-sm-6">
            <div class="post_thumbnail_wrapper">
              <div class="last_post_banner">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <img src="<?php echo the_post_thumbnail_url( 'thumb' ); ?>" class="img-responsive center-block wp-post-image">
                </a>
              </div>
            </div>
            <div class="post_info_wrapper">
              <div class="last_post_title">
                <h3 class="title post_title">
                  <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h3>
              </div>
              <div class="entry-content blog_post_text blog_post_description">
                <p><?php the_truncated_post( 90 ); ?><a href="<?php the_permalink(); ?>" class="post_link"> … </a></p>
              </div>
              <div class="last_post_meta clearfix">
                <span class="blog_meta_item blog_meta_date"><span class="screen-reader-text"></span><time class="entry-date published updated" datetime="<?php the_time('j M Y'); ?>"><?php the_time('M, j Y'); ?></time></span>
                <span class="last_meta_author">
                <span class="author vcard"><a href="<?php the_author_link(); ?>"><?php $author_email = get_the_author_email(); echo get_avatar($author_email, '33');?></a>
                <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></span>
              </span>
              </div>
            </div>
          </div>
          <!-- last post wrapper end-->
		    <?php endforeach; ?>
		    <?php $post = $tmp_post; ?>
    </div>
  </div>
  <!-- last post end-->

  <!-- popular post-->
  <div id="popular_post" class="container space">
    <h2><?php _e('Popular Post', 'test'); ?></h2>
    <div class="row">
      <?php $populargb = new WP_Query('showposts=8&meta_key=post_views_count&orderby=meta_value_num' );
      while ( $populargb->have_posts() ) {
	    $populargb->the_post(); ?>
        <!-- popular post wrapper-->
        <div class="last_post_wrapper col-md-3 col-sm-6">
          <div class="post_thumbnail_wrapper">
            <div class="last_post_banner">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <img src="<?php echo the_post_thumbnail_url( 'thumb' ); ?>" class="img-responsive center-block wp-post-image">
              </a>
            </div>
          </div>
          <div class="post_info_wrapper">
            <div class="last_post_title">
              <h3 class="title post_title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
              </h3>
            </div>
            <div class="entry-content blog_post_text blog_post_description">
              <p><?php the_truncated_post( 90 ); ?><a href="<?php the_permalink(); ?>" class="post_link"> … </a></p>
            </div>
            <div class="last_post_meta clearfix">
              <span class="blog_meta_item blog_meta_date"><span class="screen-reader-text"></span><time class="entry-date published updated" datetime="<?php the_time('j M Y'); ?>"><?php the_time('M, j Y'); ?></time></span>
              <span class="last_meta_author">
                <span class="author vcard"><a href="<?php the_author_link(); ?>"><?php $author_email = get_the_author_email(); echo get_avatar($author_email, '33');?></a>
                <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></span>
              </span>
            </div>
          </div>
        </div>
        <!-- popular post wrapper end-->
      <?php } ?>
    </div>
  </div>
  <!-- popular post end -->

  <!-- subscribe -->
  <div id="subscribe" class="container space">
    <h2><?php _e('Subscribe to our newsletter', 'test'); ?></h2>
    <div class="row">
      <div class="form col-md-4 col-sm-6">
        <?php echo do_shortcode('[contact-form-7 id="134" title="Контактная форма 1"]') ?>
      </div>
      <div class="text col-md-6 col-sm-6">
        <p><?php _e('Subscribe to the newsletter and find out first about our news', 'test'); ?></p>
      </div>
    </div>
  </div>
  <!-- subscribe end -->

<?php
get_footer();
