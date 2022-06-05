<?php

/**
 * Template Name: Home Page
 */
?>


<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content" itemprop="mainContentOfPage">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('full', array('itemprop' => 'image'));
                } ?>
                <section id="home-enquire">
                    <?php //nggShowSlideshow(3, -1, -1); 
                    echo do_shortcode("[slide-anything id='83']"); ?>

                    <div class="home-enquire-form">
                        <h2><?php echo get_field('form_header'); ?></h2>
                        <?php echo do_shortcode('[contact-form-7 id="5" title="Contact form 1"]'); ?>
                    </div>
                </section>
                <div class="entry-links"><?php wp_link_pages(); ?></div>
            </div>
        </article>
<?php endwhile;
endif; ?>
<?php get_footer(); ?>