<?php
# Add the field "ipps_home_loc" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_ipps_home_loc' );
function usermeta_register_ipps_home_loc() {
	register_rest_field( 'user',
		'ipps_home_loc',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}
