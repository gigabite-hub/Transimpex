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
    wp_enqueue_script( 'main.js', plugin_dir_url( __FILE__ ) . 'custom-script.js', array( 'jquery' ), '1.0', true );
	// wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), _S_VERSION, true );


    wp_localize_script( 'main.js', 'FHWS', array(
        'AJAX_URL'	=> admin_url( 'admin-ajax.php' ),
        'NONCE'		=> wp_create_nonce( 'fhws-nonce' ),
    ) );

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
function fetch_categories_and_related_posts($atts) {
    $atts = shortcode_atts(array(
        'category_slug' => '',
    ), $atts);

    $output = '';

    $categories_output = '<div class="category-wrapper">';
    $categories = get_terms(array(
        'taxonomy' => 'zertifikat',
        'hide_empty' => false,
    ));
    if (!empty($categories) && !is_wp_error($categories)) {
        $categories_output .= '<div class="category-container">';
        $categories_output .= '<a href="JavaScript:void(0)" data-slug="all">' . esc_html__('Alle Produkte', 'transimpex') . '</a>';
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
            <input id="category-slug" type="hidden" value="<?php echo $atts['category_slug']; ?>">
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
                               <div class="transimpex-cta"><?php
                                    $seite = get_field('seite');
                                    if ($seite) {
                                        foreach ($seite as $post) { ?>
                                            <a href="<?php echo get_permalink($post->ID); ?>" class="permalink-button">Mehr erfahren</a><?php
                                            
                                        }
                                    } ?>
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

function fetch_related_posts() {
    check_ajax_referer('fhws-nonce', 'nonce');

    $zertifikatSlug = isset($_POST['zertifikatSlug']) ? sanitize_text_field(wp_unslash($_POST['zertifikatSlug'])) : '';
    $categorySlug = isset($_POST['categorySlug']) ? sanitize_text_field(wp_unslash($_POST['categorySlug'])) : '';

    $tax_query = array(
        array(
            'taxonomy' => 'kategorie',
            'field' => 'slug',
            'terms' => $categorySlug,
            'operator' => 'IN',
        ),
    );

    if ($zertifikatSlug !== 'all' && !empty($zertifikatSlug)) {
        $terms = array($zertifikatSlug);

        // If the 'naturland' filter is applied, also include 'naturland-fair'
        if ($zertifikatSlug === 'naturland') {
            $terms[] = 'naturland-fair';
        }

        $tax_query[] = array(
            'taxonomy' => 'zertifikat',
            'field' => 'slug',
            'terms' => $terms,
            'operator' => 'IN',
        );
    }

    $args = array(
        'post_type' => 'produkt',
        'posts_per_page' => -1,
        'tax_query' => $tax_query,
    );

    $posts_query = new WP_Query($args);

    ob_start();

    if ($posts_query->have_posts()) :
        while ($posts_query->have_posts()) :
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
                                            // Skip 'naturland' category only if $zertifikatSlug is 'naturland-fair'
                                            if ($zertifikatSlug === "naturland-fair" && $post_category->slug === 'naturland') {
                                                continue;
                                            }

                                            // Print the parent category if it exists
                                            if ($post_category->parent) {
                                                $parent_category = get_term($post_category->parent, 'zertifikat');
                                                if ($parent_category && !is_wp_error($parent_category)) {
                                                    echo '<span class="category-parent">' . esc_html($parent_category->name) . ' > </span>';
                                                }
                                            }

                                            // Print the current category
                                            $taxonomy_id = $post_category->taxonomy . '_' . $post_category->term_taxonomy_id;
                                            $product_image = get_field('zertifikatsbild', $taxonomy_id);

                                            if ($product_image) : ?>
                                                <img src="<?php echo esc_url($product_image['url']); ?>" alt="<?php echo esc_attr($product_image['alt']); ?>"><?php
                                            endif;
                                        } ?>
                                    </div><?php
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="transimpex-cta"><?php
                        $seite = get_field('seite');
                        if ($seite) {
                            foreach ($seite as $post) { ?>
                                <a href="<?php echo get_permalink($post->ID); ?>" class="permalink-button">Mehr erfahren</a><?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        <?php endwhile;
    else :
        echo 'No posts found in this category.';
    endif;

    $posts_output = ob_get_clean();
    wp_reset_postdata();

    echo $posts_output;

    wp_die();
}

add_action('wp_ajax_fetch_related_posts', 'fetch_related_posts');
add_action('wp_ajax_nopriv_fetch_related_posts', 'fetch_related_posts');



function get_zertifikat_shortcode($atts) {
    // Get the current page URL
    // $current_url = home_url(add_query_arg(array(), $wp->request));
    $current_url = get_permalink();

    // Define the query arguments
    $args = array(
        'post_type' => 'produkt',
        'posts_per_page' => -1,
    );
    $query = new WP_Query($args);

    ob_start(); ?>
    <div class="related-certifcates">
        <h2><?php echo esc_html__("Zertifikat durch", 'transimpex')?></h2>
        <ul class="custom-post-list"><?php
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $seite = get_field('seite');
                    $show_post = false;
                    if ($seite) {
                        foreach ($seite as $post) {
                            if (get_permalink($post->ID) == $current_url) {
                                $show_post = true;
                                break;
                            }
                        }
                    }

                    if ($show_post) {
                        ?>
                        <li><?php
                            $post_categories = get_the_terms(get_the_ID(), 'zertifikat');
                            if ($post_categories && !is_wp_error($post_categories)) { ?>
                                <div class="post-categories"><?php
                                    foreach ($post_categories as $post_category) {
                                        $taxonomy_id = $post_category->taxonomy . '_' . $post_category->term_taxonomy_id;
                                        $product_image = get_field('zertifikatsbild', $taxonomy_id);

                                        if ($product_image) { ?>
                                            <img src="<?php echo esc_url($product_image['url']); ?>" alt="<?php echo esc_attr($product_image['alt']); ?>"><?php
                                        }
                                    } ?>
                                </div><?php
                            } ?>
                        </li><?php
                    }
                }
            } ?>
        </ul>
    </div><?php

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('get_zertifikat', 'get_zertifikat_shortcode');

