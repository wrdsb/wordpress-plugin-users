<?php
# Add the field "wrdsb_regular_hours" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_regular_hours' );
function usermeta_register_wrdsb_regular_hours() {
	register_rest_field( 'user',
		'wrdsb_regular_hours',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
