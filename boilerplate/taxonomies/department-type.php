<?php

function department_init()
{
    register_taxonomy('Bereich', array('team'), array(

        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Bereich', 'taxonomy general name'),
            'singular_name' => _x('Bereich', 'taxonomy singular name'),
            'search_items' => __('Bereich suchen'),
            'all_items' => __('Alle Bereiche'),
            'parent_item' => __('Übergeordneter Bereich'),
            'parent_item_colon' => __('Übergeordneter Bereich:'),
            'edit_item' => __('Bereich bearbeiten'),
            'update_item' => __('Bereich speichern'),
            'add_new_item' => __('Bereich hinzufügen'),
            'new_item_name' => __('Bezeichnung Bereich'),
            'menu_name' => __('Bereiche'),
        ),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'bereiche'),
    ));
}
add_action('init', 'department_init');