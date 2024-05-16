<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <article <?php post_class(); ?>>
            <header>
                <h1><?php the_title(); ?></h1>
                
            </header>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
endif;

get_footer();
?>
