<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package test
 */

?>
<!-- footer -->
<footer class="bg" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/header.jpg)">
  <div class="container">
    <div class="row">
      <div class="collapse navbar-collapse" id="navbar-collapse">
	      <?php
	      wp_nav_menu( array(
		      'theme_location'    => 'header-menu',
		      'container'         => 'ul',
		      'container_class'   => 'navbar-collapse collapse',
		      'menu_class'        => 'nav'
	      ));
	      ?>
      </div>
      <p><?php echo _e(get_theme_mod('example_textbox', 'Текст еще не придумали'), 'test'); ?></p>
    </div>
  </div>
</footer>
<!-- footer end -->

<?php wp_footer(); ?>
</body>
</html>
