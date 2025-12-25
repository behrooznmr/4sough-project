<?php
defined( 'ABSPATH' ) || exit;

// 1-change lang IR to AF
function change_html_lang_attribute_to_af( $output ) {
	return str_replace( 'lang="fa-IR"', 'lang="fa-AF"', $output );
}

add_filter( 'language_attributes', 'change_html_lang_attribute_to_af' );


add_filter( 'language_attributes', function( $output ) {
	return str_replace( 'fa-IR', 'fa-AF', $output );
});

add_filter( 'rank_math/snippet/rich_snippet_blog_posting_entity', function( $entity ) {
	if ( isset( $entity['inLanguage'] ) ) {
		$entity['inLanguage'] = 'fa-AF';
	}
	return $entity;
}, 99 );

add_filter( 'rank_math/snippet/rich_snippet_article_entity', function( $entity ) {
	if ( isset( $entity['inLanguage'] ) ) {
		$entity['inLanguage'] = 'fa-AF';
	}
	return $entity;
}, 99 );

add_filter( 'rank_math/json_ld', function( $data, $jsonld ) {
	$recursive_replace = function( $data ) use ( &$recursive_replace ) {
		if ( ! is_array( $data ) ) {
			return $data;
		}
		foreach ( $data as $key => $value ) {
			if ( 'inLanguage' === $key && ( 'fa-IR' === $value || 'fa_IR' === $value ) ) {
				$data[ $key ] = 'fa-AF';
			} elseif ( is_array( $value ) ) {
				$data[ $key ] = $recursive_replace( $value );
			}
		}
		return $data;
	};
	return $recursive_replace( $data );
}, PHP_INT_MAX, 2 );
?>