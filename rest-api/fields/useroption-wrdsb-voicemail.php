<?php
# Add the field "wrdsb_voicemail" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_voicemail' );
function usermeta_register_wrdsb_voicemail() {
	register_rest_field( 'user',
		'wrdsb_voicemail',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
