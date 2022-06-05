<?php

/**
 * Template Name: Contact Page
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="header">
                <h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content" itemprop="mainContentOfPage">
                <div id="page-contact">
                    <h2>Send us a Message</h2>
                    <?php echo do_shortcode('[contact-form-7 id="5" title="Contact form 1"]'); ?><h2>Address</h2>
                    <address class="contact-address"><?php echo get_field('address'); ?></address>
                    <h2>Telephone</h2>
                    <p><a href="tel:<?php echo get_field('telephone'); ?>"><?php echo get_field('telephone'); ?></a></p>
                    <h2>Email</h2>
                    <p><a href="mailto:<?php echo get_field('email'); ?>"><?php echo get_field('email'); ?></a></p>
                </div>
                <div id="page-content">

                    <?php the_content(); ?>
                </div>
            </div>
        </article>
<?php endwhile;
endif; ?>
<?php get_footer(); ?>