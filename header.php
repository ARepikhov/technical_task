<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package test
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <!-- header -->
  <header >
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Brand</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
	        <?php
	        wp_nav_menu( array(
		        'theme_location'    => 'header-menu',
		        'container'         => 'ul',
		        'container_class'   => 'navbar-collapse collapse',
		        'menu_class'        => 'nav navbar-nav navbar-right'
	        ));
	        ?>
        </div>
      </div>
    </nav>
    <div class="title_box bg" style="background-image: url(<?php echo get_theme_mod('img-upload'); ?>)">
      <h1><?php echo get_theme_mod('example_header_text', 'Текст еще не придумали'); ?></h1>
    </div>
  </header>
  <!-- header end-->