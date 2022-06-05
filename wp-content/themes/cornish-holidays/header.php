<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="wrapper" class="hfeed">
        <header id="header" role="banner">
            <div class="header-wrapper">
                <div id="branding">
                    <div id="logo-wrapper">
                        <a href="<?php echo get_home_url(); ?>"><?php
                                                                $custom_logo_id = get_theme_mod('custom_logo');
                                                                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

                                                                if (has_custom_logo()) {
                                                                    echo '<img id="header-logo" src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
                                                                } else {
                                                                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                                                                } ?>
                        </a>
                    </div>
                </div>
                <nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <?php wp_nav_menu(array('theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>')); ?>
                </nav>

        </header>
        <div id="container">
            <main id="content" role="main">