<?php
# Add the field "wrdsb_supervisor" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_supervisor' );
function usermeta_register_wrdsb_supervisor() {
	register_rest_field( 'user',
		'wrdsb_supervisor',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}
