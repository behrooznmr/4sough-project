<?php
defined( 'ABSPATH' ) || exit;

// 1-change lang IR to AF
function change_html_lang_attribute_to_af( $output ) {
	return str_replace( 'lang="fa-IR"', 'lang="fa-AF"', $output );
}

add_filter( 'language_attributes', 'change_html_lang_attribute_to_af' );
