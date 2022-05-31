<?php

/**
 * Registers the `faq` post type.
 */
function faq_init() {

    $slug = 'faq';

    register_post_type( 'faq', array(
        'labels'                => array(
            'name'                  => __( 'FAQs', $slug ),
            'singular_name'         => __( 'FAQ', $slug ),
            'all_items'             => __( 'Alle FAQs', $slug ),
            'archives'              => __( 'FAQ Archiv', $slug ),
            'attributes'            => __( 'FAQ Attribute', $slug ),
            'insert_into_item'      => __( 'zu FAQ hinzufügen', $slug ),
            'uploaded_to_this_item' => __( 'Uploaded to this FAQ', $slug ),
            'featured_image'        => _x( 'Featured Image', 'faq', $slug ),
            'set_featured_image'    => _x( 'Set featured image', 'faq', $slug ),
            'remove_featured_image' => _x( 'Remove featured image', 'faq', $slug ),
            'use_featured_image'    => _x( 'Use as featured image', 'faq', $slug ),
            'filter_items_list'     => __( 'Filter FAQs', $slug ),
            'items_list_navigation' => __( 'FAQs Listennavigation', $slug ),
            'items_list'            => __( 'FAQs Liste', $slug ),
            'new_item'              => __( 'neues FAQ', $slug ),
            'add_new'               => __( 'FAQ hinzufügen', $slug ),
            'add_new_item'          => __( 'neues FAQ hinzufügen', $slug ),
            'edit_item'             => __( 'FAQ bearbeiten', $slug ),
            'view_item'             => __( 'FAQ ansehen', $slug ),
            'view_items'            => __( 'FAQs ansehen', $slug ),
            'search_items'          => __( 'FAQs durchsuchen', $slug ),
            'not_found'             => __( 'keine FAQs gefunden', $slug ),
            'not_found_in_trash'    => __( 'keine FAQs im Papierkorb gefunden', $slug ),
            'parent_item_colon'     => __( 'Übergeordnetes FAQ:', $slug ),
            'menu_name'             => __( 'FAQs', $slug ),
        ),
        'public'                => true,
        'hierarchical'          => false,
        'show_ui'               => true,
        'show_in_nav_menus'     => true,
        'supports'              => array( 'title' ),
        'has_archive'           => true,
//        'rewrite' => array('slug' => 'projects'),
        'query_var'             => true,
        'menu_position'         => null,
        'menu_icon'             => 'dashicons-admin-post',
        'show_in_rest'          => true,
    ) );

}
add_action( 'init', 'faq_init' );
