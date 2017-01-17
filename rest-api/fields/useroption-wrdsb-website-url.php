<?php
# Add the field "wrdsb_website_url" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_website_url' );
function usermeta_register_wrdsb_website_url() {
	register_rest_field( 'user',
		'wrdsb_website_url',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
