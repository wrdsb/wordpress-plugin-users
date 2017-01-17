<?php
# Add the field "wrdsb_physical_location" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_physical_location' );
function usermeta_register_wrdsb_physical_location() {
	register_rest_field( 'user',
		'wrdsb_physical_location',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
