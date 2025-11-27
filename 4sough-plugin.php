<?php

/*
Plugin Name: پلاگین اختصاصی چهارسوق - ویرایشات اختصاصی
Plugin URI: https://raman.agencu
Description: ویرایشات اختصاصی تیم برنامه نویسی رامان برای سایت بلاگ 4 سوق
Version: 1.0
Author: بهروز نعمت مراد
Author URI: https://raman.agencu
License: A "Slug" license name e.g. GPL2
*/
defined( 'ABSPATH' ) || exit;
/**
 * Change Default Timezone
 */
date_default_timezone_set('Asia/Kabul');

/**
 * Define Constants
 */
define( 'SB_VERSION' , rand(50 , 100000));
define( 'SB_NAME', plugin_basename( __FILE__ ) );
define( 'SB_DIR', plugin_dir_path( __FILE__ ) );
define( 'SB_URI', plugin_dir_url( __FILE__ ) );
define( 'SB_ASSETS', trailingslashit( SB_URI . 'assets' ) );
define( 'SB_INCS', trailingslashit( SB_DIR . 'includes' ) );
define( 'SB_TEMPLATES', trailingslashit( SB_DIR . 'template-parts' ) );
$includes = array(
	'enqueue',
	'functions',
	'code-snippets',
	'shortcodes',
);

foreach ( $includes as $file ) {
	$ext = '.php';
	$file = SB_INCS . $file . $ext;
	if ( file_exists( $file ) ) {
		require_once wp_normalize_path( $file );
	}
}
