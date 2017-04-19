<?php
# Add the field "ipps_school_type" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_ipps_school_type' );
function usermeta_register_ipps_school_type() {
	register_rest_field( 'user',
		'ipps_school_type',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}
