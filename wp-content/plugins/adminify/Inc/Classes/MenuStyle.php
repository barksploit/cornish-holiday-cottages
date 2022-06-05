<?php

namespace WPAdminify\Inc\Classes;

use  WPAdminify\Inc\Classes\MenuStyles\VerticalMainMenu ;
// no direct access allowed
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class MenuStyle
{
    public function __construct()
    {
        $layout_type = ( !empty($this->options['menu_layout_settings']['layout_type']) ? $this->options['menu_layout_settings']['layout_type'] : 'vertical' );
        new VerticalMainMenu();
    }

}