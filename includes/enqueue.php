<?php
defined( 'ABSPATH' ) || exit;



/**
 * Frontend Assets
 */
function sb_enqueue_scripts() {

	// global css
	wp_enqueue_style( 'sb-front', SB_ASSETS . 'css/front.css', '' , SB_VERSION);
	
	//global js
	wp_enqueue_script( 'sb-custom-js', SB_ASSETS . 'js/front.js', array( 'jquery' ), SB_VERSION , true );
	wp_localize_script( 'sb-front', 'sb_values', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ) ,
		'nonce' => wp_create_nonce('custom_ajax_nonce'),
	) );
}
add_action( 'wp_enqueue_scripts', 'sb_enqueue_scripts' );


/**
 * Backend Assets
 */
function sb_admin_enqueue_scripts() {
	// Admin
	wp_enqueue_style( 'sb-admin', SB_ASSETS . 'css/admin.css', '',  2.44 );
	wp_enqueue_script( 'sb-admin', SB_ASSETS . 'js/admin.js', array( 'jquery' ), '1.1', true );
	wp_localize_script('sb-admin', 'sb_obj_admin_ajax', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce'    => wp_create_nonce('sb_nc_admin_ajax'),
	]);
}
add_action( 'admin_enqueue_scripts', 'sb_admin_enqueue_scripts');
