<?php
/**
 * test Theme Customizer
 *
 * @package test
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


## Удаление стандартных полей
function customize_register_init ( $wp_customize ){
	$wp_customize -> remove_section ( 'title_tagline' );
	$wp_customize -> remove_section ( 'header_image' );
	$wp_customize -> remove_section ( 'colors' );
}
add_action('customize_register', 'customize_register_init');

## Подключение скриптов
function true_customizer_live() {
	wp_enqueue_script(
		'true-theme-customizer',
		get_stylesheet_directory_uri() . '/js/theme-customizer.js',
		array( 'jquery', 'customize-preview', true )
	);
}
add_action( 'customize_preview_init', 'true_customizer_live' );

## Создание дополнительного поля header
add_action('customize_register', function($customizer){
	$customizer->add_section(
		'example_section_two',
		array(
			'title' => 'Header',
			'description' => 'Header settings',
			'priority' => 10,
		)
	);
	$customizer->add_setting(
		'example_header_text',
		array('default' => 'EASY BLOG')
	);
	$customizer->add_control(
		'example_header_text',
		array(
			'label' => 'Text',
			'section' => 'example_section_two',
			'type' => 'text',
		)
	);
	$customizer->add_setting('img-upload');
	$customizer->add_control(
		new WP_Customize_Image_Control(
			$customizer,
			'img-upload',
			array(
				'label' => 'Загрузите фоновое изображение',
				'section' => 'example_section_two',
				'settings' => 'img-upload',
				'flex_width' => false,
				'flex_height' => false,
				'width' => 1900,
				'height' => 600,
			)
		)
	);

});

## Создание дополнительного поля footer
add_action('customize_register', function($customizer){
	$customizer->add_section(
		'example_section_one',
		array(
			'title' => 'Footer',
			'description' => 'Footer settings',
			'priority' => 150,
		)
	);
	$customizer->add_setting(
		'example_textbox',
		array('default' => 'Страница создана по техническому заданию от ArtLemon')
	);
	$customizer->add_control(
		'example_textbox',
		array(
			'label' => 'Text',
			'section' => 'example_section_one',
			'type' => 'textarea',
		)
	);
});

