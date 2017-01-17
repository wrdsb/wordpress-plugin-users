<?php
# Add the field "wrdsb_phone_extension" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_phone_extension' );
function usermeta_register_wrdsb_phone_extension() {
	register_rest_field( 'user',
		'wrdsb_phone_extension',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
