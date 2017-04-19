<?php
# Add the field "ipps_panel" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_ipps_panel' );
function usermeta_register_ipps_panel() {
	register_rest_field( 'user',
		'ipps_panel',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}
