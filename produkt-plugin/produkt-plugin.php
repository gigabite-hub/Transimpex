<?php
/*
Plugin Name: Produkt Plugin
Description: Produkt plugin with a shortcode to display custom post type content, single page template, and styles.
Version: 1.0
*/

// Enqueue style.css file
function custom_plugin_enqueue_styles() {
    // Get the path to the main plugin file
    $plugin_file = plugin_dir_url( __FILE__ );

    // Enqueue the style.css file
    wp_enqueue_style( 'custom-plugin-style', $plugin_file . 'style.css', array(), '1.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'custom_plugin_enqueue_styles' );


// Add single page template for custom post type
function custom_plugin_single_template($single) {
    global $post;
    if ($post->post_type == 'produkt') {
        if (file_exists(plugin_dir_path(__FILE__) . 'single-produkt.php')) {
            return plugin_dir_path(__FILE__) . 'single-produkt.php';
        }
    }
    return $single;
}
add_filter('single_template', 'custom_plugin_single_template');

// Shortcode to display custom post type content
function custom_plugin_shortcode($atts) {
    $atts = shortcode_atts(array(
        'post_type' => 'produkt',
    ), $atts);

    $args = array(
        'post_type' => $atts['post_type'],
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    $output = '<ul class="custom-post-list">';
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
    }
    $output .= '</ul>';

    wp_reset_postdata();

    return $output;
}
add_shortcode('custom_posts', 'custom_plugin_shortcode');

function fetch_zertifikat_categories() {
    $categories_output = '<div class="category-wrapper">';

    $categories = get_terms( array(
        'taxonomy' => 'zertifikat',
        'hide_empty' => false,
    ) );

    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) { 
        $categories_output .= '<div class="category-container">';
        $categories_output .= '<a href="JavaScript:void(0)" data-slug="all">' . esc_html__( 'All Produkte', 'transimpex' ) . '</a>';
        foreach ( $categories as $category ) {
            $categories_output .= '<a href="JavaScript:void(0)" data-slug="' . $category->slug  . '">' . $category->name . '</a>';
        }
        $categories_output .= '</div>'; 
    } else {
        $categories_output .= '<div class="category-container">No categories found.</div>';
    }

    $categories_output .= '</div>';

    return $categories_output;

}
add_shortcode( 'zertifikat_categories', 'fetch_zertifikat_categories' );




