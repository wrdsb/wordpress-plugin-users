<?php
# Add the field "wrdsb_baksheesh" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_baksheesh' );
function usermeta_register_wrdsb_baksheesh() {
	register_rest_field( 'user',
		'wrdsb_baksheesh',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}
