<?php

/**
 * Registers the `faq_type` taxonomy,
 * for use with 'faq'.
 */
function faq_type_init() {
	register_taxonomy( 'faq-type', array( 'faq' ), array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => __( 'FAQ-Bereiche', 'rvr_2021' ),
			'singular_name'              => _x( 'FAQ-Bereich', 'taxonomy general name', 'rvr_2021' ),
			'search_items'               => __( 'FAQ-Bereiche durchsuchen', 'rvr_2021' ),
			'popular_items'              => __( 'populäre FAQ-Bereiche', 'rvr_2021' ),
			'all_items'                  => __( 'Alle FAQ-Bereiche', 'rvr_2021' ),
			'parent_item'                => __( 'Übergeordneter FAQ-Bereich', 'rvr_2021' ),
			'parent_item_colon'          => __( 'Übergeordneter FAQ-Bereich:', 'rvr_2021' ),
			'edit_item'                  => __( 'FAQ-Bereich bearbeiten', 'rvr_2021' ),
			'update_item'                => __( 'FAQ-Bereiche updaten', 'rvr_2021' ),
			'view_item'                  => __( 'FAQ-Bereich ansehen', 'rvr_2021' ),
			'add_new_item'               => __( 'FAQ-Bereich hinzufügen', 'rvr_2021' ),
			'new_item_name'              => __( 'FAQ-Bereich hinzufügen', 'rvr_2021' ),
			'separate_items_with_commas' => __( 'FAQ-Bereiche mit Komma abtrennen', 'rvr_2021' ),
			'add_or_remove_items'        => __( 'FAQ-Bereiche hinzufügen oder löschen', 'rvr_2021' ),
			'choose_from_most_used'      => __( 'Choose from the most used FAQ types', 'rvr_2021' ),
			'not_found'                  => __( 'keine FAQ-Bereiche gefunden', 'rvr_2021' ),
			'no_terms'                   => __( 'keine FAQ-Bereiche', 'rvr_2021' ),
			'menu_name'                  => __( 'FAQ-Bereiche', 'rvr_2021' ),
			'items_list_navigation'      => __( 'FAQ-Bereiche Listennavigation', 'rvr_2021' ),
			'items_list'                 => __( 'FAQ-Bereich-Liste', 'rvr_2021' ),
			'most_used'                  => _x( 'am meisten benützt', 'FAQ-type', 'rvr_2021' ),
			'back_to_items'              => __( '&larr; zurück zu den FAQ-Bereichen', 'rvr_2021' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'faq-type',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'faq_type_init' );

/**
 * Sets the post updated messages for the `faq_type` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `faq_type` taxonomy.
 */
function faq_type_updated_messages( $messages ) {

	$messages['faq-type'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Faq type added.', 'rvr_2021' ),
		2 => __( 'Faq type deleted.', 'rvr_2021' ),
		3 => __( 'Faq type updated.', 'rvr_2021' ),
		4 => __( 'Faq type not added.', 'rvr_2021' ),
		5 => __( 'Faq type not updated.', 'rvr_2021' ),
		6 => __( 'Faq types deleted.', 'rvr_2021' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'faq_type_updated_messages' );
