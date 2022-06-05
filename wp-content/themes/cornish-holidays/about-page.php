<?php

/**
 * Template Name: About Page
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="header">
                <h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content" itemprop="mainContentOfPage">
                <div id="page-thumbnail">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('full', array('itemprop' => 'image'));
                    } ?></div>
                <div id="page-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
<?php endwhile;
endif; ?>
<?php get_footer(); ?>