<?php

namespace WPAdminify\Inc\Classes;

use  WPAdminify\Inc\Utils ;
use  WPAdminify\Inc\Admin\AdminSettings ;
use  WPAdminify\Inc\Classes\OutputCSS_Body ;
use  WPAdminify\Inc\Admin\AdminSettingsModel ;
// no direct access allowed
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class OutputCSS extends AdminSettingsModel
{
    public  $url ;
    public function __construct()
    {
        $this->options = (array) AdminSettings::get_instance()->get( 'menu_layout_settings' );
        add_action( 'admin_enqueue_scripts', [ $this, 'jltwp_adminify_output_scripts' ], 100 );
        add_filter( 'admin_body_class', [ $this, 'add_body_classes' ] );
        new OutputCSS_Body();
    }
    
    public function add_body_classes( $classes )
    {
        $color_mode = (array) AdminSettings::get_instance()->get();
        $color_mode = ( !empty($color_mode['admin_bar_mode']) ? $color_mode['admin_bar_mode'] : 'light' );
        $active_menu_style = ( !empty($this->options['active_menu_style']) ? $this->options['active_menu_style'] : 'classic' );
        $menu_hover_submenu = ( !empty($this->options['menu_hover_submenu']) ? $this->options['menu_hover_submenu'] : 'classic' );
        $bodyclass = '';
        if ( $color_mode == 'light' ) {
            $bodyclass .= ' adminify-light-mode ';
        }
        if ( $color_mode == 'dark' ) {
            $bodyclass .= ' adminify-dark-mode ';
        }
        // Submenu Hover Style
        
        if ( $menu_hover_submenu == 'classic' ) {
            $bodyclass .= ' adminify-default-v-menu ';
        } elseif ( $menu_hover_submenu == 'accordion' ) {
            $bodyclass .= ' adminify-accordion-v-menu ';
        } elseif ( $menu_hover_submenu == 'toggle' ) {
            $bodyclass .= ' adminify-toggle-v-menu ';
        }
        
        // Active Menu Style
        
        if ( $active_menu_style == 'classic' ) {
        } elseif ( $active_menu_style == 'rounded' ) {
            $bodyclass .= ' adminify-rounded-v-menu ';
            $bodyclass .= ' adminify-round-open-menu ';
        }
        
        return $classes . $bodyclass;
    }
    
    public function jltwp_adminify_output_scripts()
    {
        $jltwp_adminify_output_css = '';
        // Menu Styles
        // Typography Settings
        if ( !empty($this->options['menu_styles']['menu_typography']['font-family']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top, .wp-adminify #adminmenu .wp-submenu li a { font-family: ' . $this->options['menu_styles']['menu_typography']['font-family'] . '}';
            }
        }
        if ( !empty($this->options['menu_styles']['menu_typography']['font-weight']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top, .wp-adminify #adminmenu .wp-submenu li a { font-weight: ' . $this->options['menu_styles']['menu_typography']['font-weight'] . '}';
            }
        }
        if ( !empty($this->options['menu_styles']['menu_typography']['text-align']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top, .wp-adminify #adminmenu .wp-submenu li a { text-align: ' . $this->options['menu_styles']['menu_typography']['text-align'] . '}';
            }
        }
        if ( !empty($this->options['menu_styles']['menu_typography']['text-transform']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top, .wp-adminify #adminmenu .wp-submenu li a { text-transform: ' . $this->options['menu_styles']['menu_typography']['text-transform'] . '}';
            }
        }
        if ( !empty($this->options['menu_styles']['menu_typography']['font-size']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top, .wp-adminify #adminmenu .wp-submenu li a { font-size: ' . $this->options['menu_styles']['menu_typography']['font-size'] . 'px;}';
            }
        }
        if ( !empty($this->options['menu_styles']['menu_typography']['line-height']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top, .wp-adminify #adminmenu .wp-submenu li a { line-height: ' . $this->options['menu_styles']['menu_typography']['line-height'] . 'px;}';
            }
        }
        if ( !empty($this->options['menu_styles']['menu_typography']['letter-spacing']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top, .wp-adminify #adminmenu .wp-submenu li a { letter-spacing: ' . $this->options['menu_styles']['menu_typography']['letter-spacing'] . 'px;}';
            }
        }
        // Menu Wrapper Padding
        if ( !empty($this->options['menu_styles']['menu_wrapper_padding']['top']) && $this->options['menu_styles']['menu_wrapper_padding']['top'] !== '' ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp_adminify_sidebar_admin-menu { padding-top: ' . esc_attr( $this->options['menu_styles']['menu_wrapper_padding']['top'] ) . $this->options['menu_styles']['menu_wrapper_padding']['unit'] . ';}';
            }
        }
        if ( !empty($this->options['menu_styles']['menu_wrapper_padding']['right']) && $this->options['menu_styles']['menu_wrapper_padding']['right'] !== '' ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp_adminify_sidebar_admin-menu { padding-right: ' . esc_attr( $this->options['menu_styles']['menu_wrapper_padding']['right'] ) . $this->options['menu_styles']['menu_wrapper_padding']['unit'] . ';}';
            }
        }
        if ( !empty($this->options['menu_styles']['menu_wrapper_padding']['bottom']) && $this->options['menu_styles']['menu_wrapper_padding']['bottom'] !== '' ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp_adminify_sidebar_admin-menu { padding-bottom: ' . esc_attr( $this->options['menu_styles']['menu_wrapper_padding']['bottom'] ) . $this->options['menu_styles']['menu_wrapper_padding']['unit'] . ';}';
            }
        }
        if ( !empty($this->options['menu_styles']['menu_wrapper_padding']['left']) && $this->options['menu_styles']['menu_wrapper_padding']['left'] !== '' ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp_adminify_sidebar_admin-menu { padding-left: ' . esc_attr( $this->options['menu_styles']['menu_wrapper_padding']['left'] ) . $this->options['menu_styles']['menu_wrapper_padding']['unit'] . ';}';
            }
        }
        // Sub Menu Wrapper Padding
        if ( !empty($this->options['menu_styles']['submenu_wrapper_padding']['top']) && $this->options['menu_styles']['submenu_wrapper_padding']['top'] !== '' ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu { padding-top: ' . esc_attr( $this->options['menu_styles']['submenu_wrapper_padding']['top'] ) . $this->options['menu_styles']['submenu_wrapper_padding']['unit'] . ';}';
            }
        }
        if ( !empty($this->options['menu_styles']['submenu_wrapper_padding']['right']) && $this->options['menu_styles']['submenu_wrapper_padding']['right'] !== '' ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu { padding-right: ' . esc_attr( $this->options['menu_styles']['submenu_wrapper_padding']['right'] ) . $this->options['menu_styles']['submenu_wrapper_padding']['unit'] . ';}';
            }
        }
        if ( !empty($this->options['menu_styles']['submenu_wrapper_padding']['bottom']) && $this->options['menu_styles']['submenu_wrapper_padding']['bottom'] !== '' ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu { padding-bottom: ' . esc_attr( $this->options['menu_styles']['submenu_wrapper_padding']['bottom'] ) . $this->options['menu_styles']['submenu_wrapper_padding']['unit'] . ';}';
            }
        }
        if ( !empty($this->options['menu_styles']['submenu_wrapper_padding']['left']) && $this->options['menu_styles']['submenu_wrapper_padding']['left'] !== '' ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu { padding-left: ' . esc_attr( $this->options['menu_styles']['submenu_wrapper_padding']['left'] ) . $this->options['menu_styles']['submenu_wrapper_padding']['unit'] . ';}';
            }
        }
        // Vertical Menu Parent Padding
        if ( !empty($this->options['layout_type']) === 'vertical' ) {
            if ( !empty($this->options['menu_styles']['menu_vertical_padding']) ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp-submenu-wrap, .wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top { padding:' . esc_attr( $this->options['menu_styles']['menu_vertical_padding'] ) . 'px 0;}';
            }
        }
        // Submenu Item Padding
        if ( !empty($this->options['layout_type']) === 'vertical' ) {
            // Sub Menu Vertical Padding
            if ( !empty($this->options['menu_styles']['submenu_vertical_space']) ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp-submenu li a { padding:' . esc_attr( $this->options['menu_styles']['submenu_vertical_space'] ) . 'px 0px !important;}';
            }
        }
        // Parent Menu Colors
        // Background Color
        if ( !empty($this->options['menu_styles']['parent_menu_colors']['wrap_bg']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu, .wp-adminify #adminmenuback, .wp-adminify #adminmenuwrap, .wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open { background:' . esc_attr( $this->options['menu_styles']['parent_menu_colors']['wrap_bg'] ) . ' !important;}';
            }
        }
        // Menu Item Hover Background
        if ( !empty($this->options['menu_styles']['parent_menu_colors']['hover_bg']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top:hover { background:' . esc_attr( $this->options['menu_styles']['parent_menu_colors']['hover_bg'] ) . ' !important;}';
            }
        }
        // Text Color
        if ( !empty($this->options['menu_styles']['parent_menu_colors']['text_color']) ) {
            
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a { color:' . esc_attr( $this->options['menu_styles']['parent_menu_colors']['text_color'] ) . ' !important;}';
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a .wp-adminify-icon-button:before { color:' . esc_attr( $this->options['menu_styles']['parent_menu_colors']['text_color'] ) . ' !important;}';
            }
        
        }
        // Text Color
        if ( !empty($this->options['menu_styles']['parent_menu_colors']['text_hover']) ) {
            
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top:hover { color:' . esc_attr( $this->options['menu_styles']['parent_menu_colors']['text_hover'] ) . ' !important;}';
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top:hover .wp-adminify-icon-button:before { color:' . esc_attr( $this->options['menu_styles']['parent_menu_colors']['text_hover'] ) . ' !important;}';
            }
        
        }
        // Active Menu Background Color
        if ( !empty($this->options['menu_styles']['parent_menu_colors']['active_bg']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top.current { background:' . esc_attr( $this->options['menu_styles']['parent_menu_colors']['active_bg'] ) . ' !important;}';
            }
        }
        if ( !empty($this->options['menu_styles']['parent_menu_colors']['active_color']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top > a.menu-top.current { color:' . esc_attr( $this->options['menu_styles']['parent_menu_colors']['active_color'] ) . ' !important;}';
            }
        }
        // Sub Menu Colors
        if ( !empty($this->options['menu_styles']['sub_menu_colors']['wrap_bg']) ) {
            
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top .wp-submenu, .wp-adminify #adminmenu .wp-not-current-submenu .wp-submenu { background:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['wrap_bg'] ) . ' !important;}';
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu, .wp-adminify #adminmenu .wp-not-current-submenu .wp-submenu { background:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['wrap_bg'] ) . ' !important;}';
            }
        
        }
        if ( !empty($this->options['menu_styles']['sub_menu_colors']['hover_bg']) ) {
            
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top .wp-submenu li a:hover { background:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['hover_bg'] ) . ' !important;}';
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu li a:hover { background:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['hover_bg'] ) . ' !important;}';
            }
        
        }
        if ( !empty($this->options['menu_styles']['sub_menu_colors']['text_color']) ) {
            
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top .wp-submenu li a { color:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['text_color'] ) . ' !important;}';
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu li a { color:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['text_color'] ) . ' !important;}';
            }
        
        }
        if ( !empty($this->options['menu_styles']['sub_menu_colors']['text_hover']) ) {
            
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top .wp-submenu li a:hover { color:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['text_hover'] ) . ' !important;}';
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu li a:hover { color:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['text_hover'] ) . ' !important;}';
            }
        
        }
        if ( !empty($this->options['menu_styles']['sub_menu_colors']['active_bg']) ) {
            
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top .wp-submenu li a.current { background:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['active_bg'] ) . ' !important;}';
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu li a.current { background:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['active_bg'] ) . ' !important;}';
            }
        
        }
        if ( !empty($this->options['menu_styles']['sub_menu_colors']['active_color']) ) {
            
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top .wp-submenu li a.current { color:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['active_color'] ) . ' !important;}';
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li.menu-top.wp-menu-open .wp-submenu li a.current { color:' . esc_attr( $this->options['menu_styles']['sub_menu_colors']['active_color'] ) . ' !important;}';
            }
        
        }
        // Notification Counter
        // Background Color
        if ( !empty($this->options['menu_styles']['notif_colors']['notif_bg']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .wp_adminify_admin-menu li .awaiting-mod, .wp-adminify #adminmenu .wp_adminify_admin-menu li .update-plugins, .wp-adminify #adminmenu .wp_adminify_admin-menu #sidemenu li a span.update-plugins, .wp-adminify #adminmenu .wp_adminify_admin-menu li a.wp-has-current-submenu .update-plugins
            { background-color:' . esc_attr( $this->options['menu_styles']['notif_colors']['notif_bg'] ) . ' !important;}';
            }
        }
        if ( !empty($this->options['menu_styles']['notif_colors']['notif_color']) ) {
            if ( $this->options['layout_type'] === 'vertical' ) {
                $jltwp_adminify_output_css .= '.wp-adminify #adminmenu .awaiting-mod, .wp-adminify #adminmenu .update-plugins, .wp-adminify #sidemenu li a span.update-plugins, .wp-adminify #adminmenu li a.wp-has-current-submenu .update-plugins { color:' . esc_attr( $this->options['menu_styles']['notif_colors']['notif_color'] ) . ';}';
            }
        }
        // Custom CSS
        $custom_css_js = AdminSettings::get_instance()->get();
        if ( !empty($custom_css_js['custom_css']) ) {
            $jltwp_adminify_output_css .= $custom_css_js['custom_css'];
        }
        if ( Utils::is_plugin_active( 'brizy/brizy.php' ) ) {
            $jltwp_adminify_output_css .= '.brz-review-notice-container a { padding-left: 14px !important; }';
        }
        // Combine the values from above and minifiy them.
        $jltwp_adminify_output_css = preg_replace( '#/\\*.*?\\*/#s', '', $jltwp_adminify_output_css );
        $jltwp_adminify_output_css = preg_replace( '/\\s*([{}|:;,])\\s+/', '$1', $jltwp_adminify_output_css );
        $jltwp_adminify_output_css = preg_replace( '/\\s\\s+(.*)/', '$1', $jltwp_adminify_output_css );
        $adminify_ui = AdminSettings::get_instance()->get( 'admin_ui' );
        
        if ( !empty($adminify_ui) ) {
            wp_add_inline_style( 'wp-adminify-admin', wp_strip_all_tags( $jltwp_adminify_output_css ) );
        } else {
            wp_add_inline_style( 'wp-adminify-default-ui', wp_strip_all_tags( $jltwp_adminify_output_css ) );
        }
        
        // Custom JS
        $custom_js = ( !empty($custom_css_js['custom_js']) ? $custom_css_js['custom_js'] : '' );
        
        if ( !empty($custom_js) ) {
            $custom_js_formatted = "\n<!-- Start of WP Adminify - Admin Area Custom JS -->\n";
            $custom_js_formatted .= $custom_js;
            $custom_js_formatted .= "\n<!-- /End of WP Adminify - Admin Area Custom JS -->\n";
            
            if ( !empty($adminify_ui) ) {
                wp_add_inline_style( 'wp-adminify-admin', wp_strip_all_tags( $jltwp_adminify_output_css ) );
            } else {
                wp_add_inline_style( 'wp-adminify-default-ui', wp_strip_all_tags( $jltwp_adminify_output_css ) );
            }
        
        }
    
    }

}