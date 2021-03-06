<?php
if(!function_exists('rhs_child_setup')) {
    function rhs_child_setup() {

        add_image_size( 'tainacan-theme-list-post', 300, 200, true );
        add_image_size( 'tainacan-interface-list-post', 300, 200, true );
        add_image_size( 'tainacan-item-attachments', 125, 125, true );
    }

}
add_action( 'after_setup_theme', 'rhs_child_setup' );

function theme_enqueue_styles() {

	$parent_style = 'parent-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
	get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style )
	);
    wp_enqueue_style( 'style-theme', get_stylesheet_directory_uri() . '/assets/scss/theme.css');
    wp_enqueue_script( 'ThemeJS', get_stylesheet_directory_uri() . '/assets/js/js.js', null, null, true );    

    /**
     * Slick JS
     */
    wp_register_style( 'SlickCss', get_stylesheet_directory_uri() . '/assets/js/slick/scss/slick.min.css', '', '1.6.1', '' );
    wp_register_style( 'SlickThemeCss', get_stylesheet_directory_uri() . '/assets/js/slick/scss/slick-theme.min.css', '', '1.6.1', '' );
    wp_enqueue_style( 'SlickCss' );
    wp_enqueue_style( 'SlickThemeCss' );
    //Javascript
    wp_register_script( 'SlickJS', get_stylesheet_directory_uri() . '/assets/js/slick/js/slick.min.js', array( 'jquery' ), '1.6.1', true );
    wp_enqueue_script( 'SlickJS' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 99 );

function tainacan_collections_viewmode($public_query_vars){
    $public_query_vars[] = "tainacan_collections_viewmode";
    return $public_query_vars;
}
add_filter( 'query_vars', 'tainacan_collections_viewmode');

function tainacan_active($selected, $current = true, $echo = true) {

    $return = $selected == $current ? 'active' : '';

    if ($echo)
        echo $return;

    return $return;

}

function tainacan_theme_collection_title($title){
    if (is_post_type_archive('tainacan-collection')) {
        return __('Collections', 'tainacan-interface');
    }
    return $title;
}
add_filter('get_the_archive_title', 'tainacan_theme_collection_title');

function tainacan_theme_collection_query($query){
    if ($query->is_main_query() && $query->is_post_type_archive('tainacan-collection')) {
        $query->set('posts_per_page', 12);
    }
}
add_action('pre_get_posts', 'tainacan_theme_collection_query');

/**
 * Display date of post.
 */
function tainacan_meta_date_author( $echo = true ) {
	$time = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date()
	);

	$string = $time_string;
	$string .= __( '&nbsp;by&nbsp;', 'tainacan-interface' );
	$string .= get_the_author_posts_link();

	$string = apply_filters( 'tainacan-meta-date-author', $string );

	if ( $echo ) {
		echo $string;
	} else {
		return $string;
	}
}