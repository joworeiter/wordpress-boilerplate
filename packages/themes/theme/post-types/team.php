<?php
add_action('init', 'register_cpt_staff');

function register_cpt_staff()
{

    $labels = array(
        'name' => _x('Mitarbeiter', 'team'),
        'singular_name' => _x('Mitarbeiter', 'team'),
        'add_new' => _x('Hinzufügen', 'staff'),
        'add_new_item' => _x('neuen Mitarbeiter anlegen', 'team'),
        'edit_item' => _x('Mitarbeiter bearbeiten', 'team'),
        'new_item' => _x('neuen Mitarbeiter anlegen', 'team'),
        'view_item' => _x('Mitarbeiter anzeigen', 'team'),
        'search_items' => _x('Suche Mitarbeiter', 'team'),
        'not_found' => _x('kein Mitarbeiter gefunden', 'team'),
        'not_found_in_trash' => _x('No staff found in Trash', 'team'),
        'parent_item_colon' => _x('Übergeordneter Mitarbeiter:', 'team'),
        'menu_name' => _x('Mitarbeiter', 'team'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Mitarbeiter',
        'supports' => array('title'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type('team', $args);
}