<?php
# Add the field "wrdsb_contact_options" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_contact_options' );
function usermeta_register_wrdsb_contact_options() {
	register_rest_field( 'user',
		'wrdsb_contact_options',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}

