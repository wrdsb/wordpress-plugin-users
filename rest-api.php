<?php
# Add the field "wrdsb_id_number" to REST API responses for users read and write
add_action( 'rest_api_init', 'usermeta_register_wrdsb_id_number' );
function usermeta_register_wrdsb_id_number() {
	register_rest_field( 'user',
		'wrdsb_id_number',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}

# Add the field "wrdsb_school" to REST API responses for users read and write
add_action( 'rest_api_init', 'usermeta_register_wrdsb_school' );
function usermeta_register_wrdsb_school() {
	register_rest_field( 'user',
		'wrdsb_school',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}

# Add the field "wrdsb_voicemail" to REST API responses for users read and write
add_action( 'rest_api_init', 'usermeta_register_wrdsb_voicemail' );
function usermeta_register_wrdsb_voicemail() {
	register_rest_field( 'user',
		'wrdsb_voicemail',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}

# Add the field "wrdsb_job_title" to REST API responses for users read and write
add_action( 'rest_api_init', 'usermeta_register_wrdsb_job_title' );
function usermeta_register_wrdsb_job_title() {
	register_rest_field( 'user',
		'wrdsb_job_title',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}

# Add the field "wrdsb_display_in_staff_list" to REST API responses for users read and write
add_action( 'rest_api_init', 'usermeta_register_wrdsb_display_in_staff_list' );
function usermeta_register_wrdsb_display_in_staff_list() {
	register_rest_field( 'user',
		'wrdsb_display_in_staff_list',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}

# Add the field "wrdsb_contact_options" to REST API responses for users read and write
add_action( 'rest_api_init', 'usermeta_register_wrdsb_contact_options' );
function usermeta_register_wrdsb_contact_options() {
	register_rest_field( 'user',
		'wrdsb_contact_options',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}

# Add the field "wrdsb_website_url" to REST API responses for users read and write
add_action( 'rest_api_init', 'usermeta_register_wrdsb_website_url' );
function usermeta_register_wrdsb_website_url() {
	register_rest_field( 'user',
		'wrdsb_website_url',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}

/**
 * Handler for getting custom field data.
 *
 * @param array $object The object from the response
 * @param string $field_name Name of field
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function usermeta_get_value( $object, $field_name, $request ) {
    return get_user_option( $field_name, $object['id'] );
}

/**
 * Handler for updating custom field data.
 *
 * @param mixed $value The value of the field
 * @param object $object The object from the response
 * @param string $field_name Name of field
 *
 * @return bool|int
 */
function usermeta_update_value( $value, $object, $field_name ) {
    if ( ! $value || ! is_string( $value ) ) {
        return;
    }
    return update_user_option( $object->ID, $field_name, strip_tags( $value ) );
}
