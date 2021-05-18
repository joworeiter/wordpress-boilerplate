<?php

require_once __DIR__ . '/customLogin/customLogin.php';
require_once __DIR__ . '/displayUserLastLogin/index.php';
require_once __DIR__ . '/removeHeaderScripts/index.php';

//enable svg uploads
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//enable menus in theme
add_theme_support( 'menus' );
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Hauptmenü' )
        ));
}








