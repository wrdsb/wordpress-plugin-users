<?php
# Add the field "wrdsb_is_in_today" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_is_in_today' );
function usermeta_register_wrdsb_is_in_today() {
	register_rest_field( 'user',
		'wrdsb_is_in_today',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
