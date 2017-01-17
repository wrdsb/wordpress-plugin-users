<?php
# Add the field "wrdsb_is_available_now" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_is_available_now' );
function usermeta_register_wrdsb_is_available_now() {
	register_rest_field( 'user',
		'wrdsb_is_available_now',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
