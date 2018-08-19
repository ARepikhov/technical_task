<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package test
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function test_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'test_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function test_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'test_pingback_header' );

## Убираем лишнее из head
remove_action('wp_head','feed_links_extra', 3);
remove_action('wp_head','feed_links', 2);
remove_action('wp_head','rsd_link');
remove_action('wp_head','wlwmanifest_link');
remove_action('wp_head','wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head','qtranxf_wp_head_meta_generator');

## Подключаем css, js
add_action( 'wp_enqueue_scripts', 'test_scripts' );
function test_scripts() {

	wp_enqueue_style( 'bootstrap-style', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css', array(), null, 'all' );
	wp_enqueue_style( 'fonts_r', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700&amp;subset=cyrillic" rel="stylesheet', array(), null, 'all' );
	wp_enqueue_style( 'fonts_o', 'https://fonts.googleapis.com/css?family=Russo+One', array(), null, 'all' );
	wp_enqueue_style( 'test-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'test_styles' );
function test_styles() {
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js' );
	wp_enqueue_script( 'bootstrap', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js', array(), '201808', true );
	wp_enqueue_script( 'scroll', get_template_directory_uri() . '/js/scroll.js', array(), '201808', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

## Регистрируем меню.
function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' )
		)
	);
}
add_action( 'init', 'register_my_menus' );

## Отключаем стандартные виджеты WordPress
add_action('widgets_init', 'unregister_basic_widgets' );
function unregister_basic_widgets() {
	unregister_widget('WP_Widget_Pages');            // Виджет страниц
	unregister_widget('WP_Widget_Calendar');         // Календарь
	unregister_widget('WP_Widget_Archives');         // Архивы
	unregister_widget('WP_Widget_Links');            // Ссылки
	unregister_widget('WP_Widget_Meta');             // Мета виджет
	unregister_widget('WP_Widget_Search');           // Поиск
	unregister_widget('WP_Widget_Text');             // Текст
	unregister_widget('WP_Widget_Categories');       // Категории
	unregister_widget('WP_Widget_Recent_Posts');     // Последние записи
	unregister_widget('WP_Widget_Recent_Comments');  // Последние комментарии
	unregister_widget('WP_Widget_RSS');              // RSS
	unregister_widget('WP_Widget_Tag_Cloud');        // Облако меток
	unregister_widget('WP_Nav_Menu_Widget');         // Меню
	unregister_widget('WP_Widget_Media_Audio');      // Audio
	unregister_widget('WP_Widget_Media_Video');      // Video
	unregister_widget('WP_Widget_Media_Gallery');    // Gallery
	unregister_widget('WP_Widget_Media_Image');      // Image
}

## Включаем миниатюры
add_theme_support( 'post-thumbnails', array( 'page' ) );
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}
add_image_size( 'thumb', 400, 182, true );

## Ограничиваем анонс записи
function the_truncated_post($symbol_amount) {
	$filtered = strip_tags( preg_replace('@<style[^>]*?>.*?</style>@si', '', preg_replace('@<script[^>]*?>.*?</script>@si', '', apply_filters('the_content', get_the_content()))) );
	echo substr($filtered, 0, strrpos(substr($filtered, 0, $symbol_amount), ' ')) . '';
}

## Счетчик просмотра постов
function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0";
	}
	return $count;
}
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
	$defaults['post_views'] = __('Просмотры');
	return $defaults;
}
function posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
		echo getPostViews(get_the_ID());
	}
}