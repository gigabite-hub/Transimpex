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

    // Enqueue jQuery from WordPress core
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/2e71d1c020.js', array('jquery'), null, false);
    // Enqueue your custom jQuery file
    wp_enqueue_script( 'custom-plugin-custom-js', plugin_dir_url( __FILE__ ) . 'custom-script.js', array( 'jquery' ), '1.0', true );

    wp_localize_script('custom-plugin-custom-js', 'TRANS', array(
        'AJAX_URL'	=> admin_url('admin-ajax.php'),
        'NONCE'		=> wp_create_nonce('trans-nonce'),
    ));

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

function fetch_categories_and_related_posts($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'category_slug' => '', // Default empty slug
    ), $atts);

    // Initialize output variable
    $output = '';

    // Fetching categories
    $categories_output = '<div class="category-wrapper">';
    $categories = get_terms(array(
        'taxonomy' => 'zertifikat',
        'hide_empty' => false,
    ));
    if (!empty($categories) && !is_wp_error($categories)) {
        $categories_output .= '<div class="category-container">';
        $categories_output .= '<a href="JavaScript:void(0)" data-slug="all">' . esc_html__('All Produkte', 'transimpex') . '</a>';
        foreach ($categories as $category) {
            $categories_output .= '<a href="JavaScript:void(0)" data-slug="' . $category->slug  . '">' . $category->name . '</a>';
        }
        $categories_output .= '</div>';
    } else {
        $categories_output .= '<div class="category-container">No categories found.</div>';
    }
    $categories_output .= '</div>';

    // Fetching related posts
    $posts_output = '';
    $category = get_term_by('slug', $atts['category_slug'], 'kategorie');
    if ($category) {
        $posts_query = new WP_Query(array(
            'post_type' => 'produkt',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'kategorie',
                    'field' => 'slug',
                    'terms' => $atts['category_slug'],
                ),
            ),
        ));
        if ($posts_query->have_posts()) {
            ob_start(); ?>
            <div class="related-posts-container wp-block-group alignwide has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">
                <div class="transimpex-related-pots wp-block-query alignwide wp-block-query-is-layout-flow"><?php

                    while ($posts_query->have_posts()) {
                        $posts_query->the_post(); ?>
                        <div class="related-post">
                            <div class="post-content"><?php
                                if (has_post_thumbnail()) { ?>
                                    <div class="thumbnail"><?php echo get_the_post_thumbnail(); ?></div><?php
                                } ?>
                                <div class="transimpex-content">
                                    <h2><?php echo get_the_title(); ?></h2>
                                    <div class="transimpex-flex">
                                        <div class="transimpex-item">
                                            <div class="excerpt"><?php echo get_the_excerpt(); ?></div>
                                        </div>
                                        <div class="transimpex-item"><?php
                                            $post_categories = get_the_terms(get_the_ID(), 'zertifikat');
                                            if ($post_categories && !is_wp_error($post_categories)) { ?>
                                                <div class="post-categories"><?php
                                                    foreach ($post_categories as $post_category) { 
                                                        $taxonomy_id = $post_category->taxonomy . '_' . $post_category->term_taxonomy_id;
                                                        $product_image = get_field('zertifikatsbild', $taxonomy_id);

                                                        if ($product_image) : ?>
                                                            <img src="<?php echo esc_url($product_image['url']); ?>" alt="<?php echo esc_attr($product_image['alt']); ?>"><?php
                                                        else : ?>
                                                            <img src="<?php echo plugin_dir_url( __FILE__ ) . './img/basmatireis.webp';?>" alt="<?php echo esc_attr($product_image->name); ?>"><?php
                                                        endif;
                                                    } ?>
                                                </div><?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                               <div class="transimpex-cta">
                                <a href="<?php echo get_permalink(); ?>" class="permalink-button">Mehr erfahren</a>
                               </div>
                            </div>
                        </div><?php
                    } ?>

                </div>
            </div>
            <?php

            $posts_output = ob_get_clean();
            wp_reset_postdata();
        } else {
            $posts_output = 'No posts found in this category.';
        }
    } else {
        $posts_output = 'Category not found.';
    }

    // Combine categories and related posts output
    $output .= $categories_output;
    $output .= $posts_output;

    return $output;
}
add_shortcode('categories_and_related_posts', 'fetch_categories_and_related_posts');



function get_certificate_related_post() {
    check_ajax_referer('trans-nonce', 'nonce');

    $slug = isset($_POST['slug']) ? sanitize_text_field(wp_unslash($_POST['slug'])) : '';

    $posts_output = '';
    $category = get_term_by('slug', $atts['category_slug'], 'kategorie');
    if ($category) {
        $posts_query = new WP_Query(array(
            'post_type' => 'produkt',
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND', // Establishing relation between taxonomies
                array(
                    'taxonomy' => 'kategorie',
                    'field' => 'slug',
                    'terms' => $atts['category_slug'],
                ),
                array(
                    'taxonomy' => 'zertifikat',
                    'field' => 'slug', // Assuming 'term_id' is the correct field for 'zertifikat'
                    'terms' => $slug,
                ),
            ),
        ));
        if ($posts_query->have_posts()) {
            ob_start(); 

            while ($posts_query->have_posts()) {
                $posts_query->the_post(); ?>
                <div class="related-post">
                    <div class="post-content"><?php
                        if (has_post_thumbnail()) { ?>
                            <div class="thumbnail"><?php echo get_the_post_thumbnail(); ?></div><?php
                        } ?>
                        <div class="transimpex-content">
                            <h2><?php echo get_the_title(); ?></h2>
                            <div class="transimpex-flex">
                                <div class="transimpex-item">
                                    <div class="excerpt"><?php echo get_the_excerpt(); ?></div>
                                </div>
                                <div class="transimpex-item"><?php
                                    $post_categories = get_the_terms(get_the_ID(), 'zertifikat');
                                    if ($post_categories && !is_wp_error($post_categories)) { ?>
                                        <div class="post-categories"><?php
                                            foreach ($post_categories as $post_category) { 
                                                $taxonomy_id = $post_category->taxonomy . '_' . $post_category->term_taxonomy_id;
                                                $product_image = get_field('zertifikatsbild', $taxonomy_id);

                                                if ($product_image) : ?>
                                                    <img src="<?php echo esc_url($product_image['url']); ?>" alt="<?php echo esc_attr($product_image['alt']); ?>"><?php
                                                else : ?>
                                                    <img src="<?php echo plugin_dir_url( __FILE__ ) . './img/basmatireis.webp';?>" alt="<?php echo esc_attr($product_image->name); ?>"><?php
                                                endif;
                                            } ?>
                                        </div><?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="transimpex-cta">
                        <a href="<?php echo get_permalink(); ?>" class="permalink-button">Mehr erfahren</a>
                        </div>
                    </div>
                </div><?php
            }

            $posts_output = ob_get_clean();
            wp_reset_postdata();
        } else {
            $posts_output = 'No posts found in this category.';
        }
    } else {
        $posts_output = 'Category not found.';
    }

    // Combine categories and related posts output
    $output .= $categories_output;
    $output .= $posts_output;

    return $output;

    wp_die();
}

add_action('wp_ajax_get_certificate_related_post', 'get_certificate_related_post');
add_action('wp_ajax_nopriv_get_certificate_related_post', 'get_certificate_related_post');







