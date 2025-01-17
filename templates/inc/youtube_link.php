<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function youtube_link_add_meta_box() {

	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'youtube_link_sectionid',
			__( 'Youtube Link Section', 'kino' ),
			'youtube_link_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'youtube_link_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function youtube_link_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'youtube_link_meta_box', 'youtube_link_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_youtube_link_key', true );

	echo '<label for="youtube_link_new_field">';
	_e( 'Youtube Link Here', 'kino' );
	echo '</label> ';
	echo '<input type="text" id="youtube_link_new_field" name="youtube_link_new_field" value="' . esc_attr( $value ) . '" size="95" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function youtube_link_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['youtube_link_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['youtube_link_meta_box_nonce'], 'youtube_link_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['youtube_link_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['youtube_link_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_youtube_link_key', $my_data );
}
add_action( 'save_post', 'youtube_link_save_meta_box_data' );