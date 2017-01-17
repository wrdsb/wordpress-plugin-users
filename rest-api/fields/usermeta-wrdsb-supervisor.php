<?php
# Add the field "wrdsb_supervisor" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_supervisor' );
function usermeta_register_wrdsb_supervisor() {
	register_rest_field( 'user',
		'wrdsb_supervisor',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
