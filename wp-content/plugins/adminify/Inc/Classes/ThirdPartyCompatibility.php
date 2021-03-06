<?php

namespace WPAdminify\Inc\Classes;

use  WPAdminify\Inc\Utils ;
use  WPAdminify\Inc\Admin\AdminSettings ;
// no direct access allowed
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * WPAdminify
 * Third Party Plugins Compatibility
 *
 * @author Jewel Theme <support@jeweltheme.com>
 */
class ThirdPartyCompatibility
{
    public function __construct()
    {
        add_action( 'init', [ $this, 'register_actions_on_init' ], 0 );
        add_action( 'admin_init', [ $this, 'register_actions_on_admin_init' ], 0 );
        $this->enqueue_scripts();
        add_action( 'admin_enqueue_scripts', [ $this, 'jltwp_adminify_reset_theme_conflicts' ], 100 );
    }
    
    public function jltwp_adminify_reset_theme_conflicts()
    {
        $theme = wp_get_theme();
        //Neve WordPress Theme
        if ( 'Neve' == $theme->name || 'Neve' == $theme->parent_theme ) {
            wp_enqueue_style(
                'wp-adminify_neve-theme',
                WP_ADMINIFY_ASSETS . 'css/themes/neve.css',
                false,
                WP_ADMINIFY_VER
            );
        }
        // Third Party Plugin CSS Conflict
        // $jltwp_adminify_plugin_conflict_css = '';
        // if (Utils::is_plugin_active('quillforms/quillforms.php')) {
        //     $jltwp_adminify_plugin_conflict_css = '//css code here';
        //     $jltwp_adminify_plugin_conflict_css = preg_replace('#/\*.*?\*/#s', '', $jltwp_adminify_plugin_conflict_css);
        //     $jltwp_adminify_plugin_conflict_css = preg_replace('/\s*([{}|:;,])\s+/', '$1', $jltwp_adminify_plugin_conflict_css);
        //     $jltwp_adminify_plugin_conflict_css = preg_replace('/\s\s+(.*)/', '$1', $jltwp_adminify_plugin_conflict_css);
        // }
        // $adminify_ui = AdminSettings::get_instance()->get('admin_ui');
        // if (!empty($adminify_ui)) {
        //     wp_add_inline_style('wp-adminify-admin', wp_strip_all_tags($jltwp_adminify_plugin_conflict_css));
        // } else {
        //     wp_add_inline_style('wp-adminify-default-ui', wp_strip_all_tags($jltwp_adminify_plugin_conflict_css));
        // }
    }
    
    public function register_actions_on_init()
    {
        // Brizy Builder
        
        if ( isset( $_REQUEST['brizy-edit-iframe'] ) ) {
            add_filter( 'wp_adminify_defer_skip', '__return_true' );
            add_filter( 'wp_adminify_skip_removing_dashicons', '__return_true' );
        }
    
    }
    
    public function register_actions_on_admin_init()
    {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ], 999 );
        add_filter( 'adminify_third_party_styles', [ $this, 'register_compatability_styles' ] );
        // Fluent CRM
        add_action( 'fluentcrm_skip_no_conflict', '__return_true' );
        // Fluent FORM
        add_action( 'fluentform_skip_no_conflict', '__return_true' );
    }
    
    /**
     * Register Third Party Styles
     * @since 1.0.0
     */
    public function register_compatability_styles( $plugin_supports )
    {
        if ( !is_array( $plugin_supports ) ) {
            $plugin_supports = array();
        }
        $plugin_dir = WP_ADMINIFY_ASSETS . 'css/plugins/';
        $plugin_files = list_files( WP_ADMINIFY_PATH . 'assets/css/plugins/', 1 );
        if ( !empty($plugin_files) ) {
            foreach ( $plugin_files as $file ) {
                $plugin_supports[wp_basename( $file, '.css' )] = $plugin_dir . wp_basename( $file );
            }
        }
        return $plugin_supports;
    }
    
    /**
     * Admin Enqueue Third Party Scripts/Styles
     *
     * @return void
     */
    public function enqueue_scripts()
    {
        $plugin_supports = array();
        $plugin_supports = apply_filters( 'adminify_third_party_styles', $plugin_supports );
        // Check Plugin Activated for Site Wide
        
        if ( is_multisite() ) {
            $active_plugins = get_site_option( 'active_sitewide_plugins' );
            foreach ( $active_plugins as $active_path => $active_plugin ) {
                
                if ( is_plugin_active_for_network( $active_path ) ) {
                    $string = explode( '/', $active_path );
                    $pluginname = $string[0];
                    if ( isset( $plugin_supports[$pluginname] ) ) {
                        
                        if ( $plugin_supports[$pluginname] != "" ) {
                            wp_register_style(
                                'wp-adminify_site-wide_' . $pluginname . '_css',
                                $plugin_supports[$pluginname],
                                array(),
                                WP_ADMINIFY_VER
                            );
                            wp_enqueue_style( 'wp-adminify_site-wide_' . $pluginname . '_css' );
                        }
                    
                    }
                }
            
            }
        }
        
        // Check Plugin Activated for Individual Sites
        $activeplugins = get_option( 'active_plugins' );
        foreach ( $activeplugins as $plugin ) {
            
            if ( Utils::is_plugin_active( $plugin ) ) {
                $string = explode( '/', $plugin );
                $pluginname = $string[0];
                if ( isset( $plugin_supports[$pluginname] ) ) {
                    
                    if ( $plugin_supports[$pluginname] != "" ) {
                        wp_register_style(
                            'wp-adminify_' . $pluginname . '_css',
                            $plugin_supports[$pluginname],
                            array(),
                            WP_ADMINIFY_VER
                        );
                        wp_enqueue_style( 'wp-adminify_' . $pluginname . '_css' );
                    }
                
                }
            }
        
        }
    }

}