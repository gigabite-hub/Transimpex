<?php
/*
Plugin Name: Produkt Plugin
Description: Produkt plugin with a shortcode to display custom post type content, single page template, and styles.
Version: 1.0
*/

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
