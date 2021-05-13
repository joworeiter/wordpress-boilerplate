<?php

/**
 * Registers the `faq` post type.
 */
function faq_init() {
	register_post_type( 'faq', array(
		'labels'                => array(
			'name'                  => __( 'FAQs', 'rvr_2021' ),
			'singular_name'         => __( 'FAQ', 'rvr_2021' ),
			'all_items'             => __( 'Alle FAQs', 'rvr_2021' ),
			'archives'              => __( 'FAQ Archiv', 'rvr_2021' ),
			'attributes'            => __( 'FAQ Attribute', 'rvr_2021' ),
			'insert_into_item'      => __( 'zu FAQ hinzufügen', 'rvr_2021' ),
			'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'rvr_2021' ),
			'featured_image'        => _x( 'Featured Image', 'faq', 'rvr_2021' ),
			'set_featured_image'    => _x( 'Set featured image', 'faq', 'rvr_2021' ),
			'remove_featured_image' => _x( 'Remove featured image', 'faq', 'rvr_2021' ),
			'use_featured_image'    => _x( 'Use as featured image', 'faq', 'rvr_2021' ),
			'filter_items_list'     => __( 'Filter FAQs', 'rvr_2021' ),
			'items_list_navigation' => __( 'FAQs Listennavigation', 'rvr_2021' ),
			'items_list'            => __( 'FAQs Liste', 'rvr_2021' ),
			'new_item'              => __( 'neues FAQ', 'rvr_2021' ),
			'add_new'               => __( 'FAQ hinzufügen', 'rvr_2021' ),
			'add_new_item'          => __( 'neues FAQ hinzufügen', 'rvr_2021' ),
			'edit_item'             => __( 'FAQ bearbeiten', 'rvr_2021' ),
			'view_item'             => __( 'FAQ ansehen', 'rvr_2021' ),
			'view_items'            => __( 'FAQs ansehen', 'rvr_2021' ),
			'search_items'          => __( 'FAQs durchsuchen', 'rvr_2021' ),
			'not_found'             => __( 'keine FAQs gefunden', 'rvr_2021' ),
			'not_found_in_trash'    => __( 'keine FAQs im Papierkorb gefunden', 'rvr_2021' ),
			'parent_item_colon'     => __( 'Übergeordnetes FAQ:', 'rvr_2021' ),
			'menu_name'             => __( 'FAQs', 'rvr_2021' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'faq',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'faq_init' );

/**
 * Sets the post updated messages for the `faq` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `faq` post type.
 */
function faq_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['faq'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'FAQ updated. <a target="_blank" href="%s">View FAQ</a>', 'rvr_2021' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'rvr_2021' ),
		3  => __( 'Custom field deleted.', 'rvr_2021' ),
		4  => __( 'FAQ updated.', 'rvr_2021' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'FAQ restored to revision from %s', 'rvr_2021' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'FAQ published. <a href="%s">View FAQ</a>', 'rvr_2021' ), esc_url( $permalink ) ),
		7  => __( 'FAQ saved.', 'rvr_2021' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'FAQ submitted. <a target="_blank" href="%s">Preview FAQ</a>', 'rvr_2021' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'FAQ scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>', 'rvr_2021' ),
		date_i18n( __( 'M j, Y @ G:i', 'rvr_2021' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'FAQ draft updated. <a target="_blank" href="%s">Preview FAQ</a>', 'rvr_2021' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'faq_updated_messages' );
