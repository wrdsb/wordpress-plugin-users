<?php
# Add the field "wrdsb_section" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_section' );
function usermeta_register_wrdsb_section() {
	register_rest_field( 'user',
		'wrdsb_section',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
