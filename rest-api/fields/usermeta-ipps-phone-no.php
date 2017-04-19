<?php
# Add the field "ipps_phone_no" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_ipps_phone_no' );
function usermeta_register_ipps_phone_no() {
	register_rest_field( 'user',
		'ipps_phone_no',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}
