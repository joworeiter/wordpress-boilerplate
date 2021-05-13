<?php
add_filter( 'manage_users_custom_column', 'misha_last_login_column', 10, 3 );
function misha_last_login_column( $output, $column_id, $user_id ){

    if( $column_id == 'last_login' ) {

        $last_login = get_user_meta( $user_id, 'last_login', true );
        $date_format = 'j M, Y';

        $output = $last_login ? date( $date_format, $last_login ) : '-';

    }

    return $output;

}


add_filter( 'manage_users_columns', 'misha_user_last_login_column' );

function misha_user_last_login_column( $columns ) {

    $columns['last_login'] = 'Last Login'; // column ID / column Title
    return $columns;

}


add_action( 'wp_login', 'misha_collect_login_timestamp', 20, 2 );

function misha_collect_login_timestamp( $user_login, $user ) {
    update_user_meta( $user->ID, 'last_login', time() );
}


//enable svg uploads
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );



//Disable emojis in WordPress
add_action('init', 'smartwp_disable_emojis');

function smartwp_disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');

}

function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

//enable menus in theme
add_theme_support( 'menus' );
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Hauptmenü' )
        ));
}

//style wp-admin-login

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/RVR_LOGO_Immo_blau.svg);
            height:75px;
            width:320px;
            background-size: 320px 100px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
        body.login{
            background: white;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );