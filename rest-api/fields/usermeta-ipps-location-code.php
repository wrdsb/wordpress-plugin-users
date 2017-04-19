<?php
# Add the field "ipps_location_code" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_ipps_location_code' );
function usermeta_register_ipps_location_code() {
	register_rest_field( 'user',
		'ipps_location_code',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}
