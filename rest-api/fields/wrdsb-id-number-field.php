<?php
# Add the field "wrdsb_id_number" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_id_number' );
function usermeta_register_wrdsb_id_number() {
	register_rest_field( 'user',
		'wrdsb_id_number',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}
