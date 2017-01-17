<?php
# Add the field "wrdsb_display_in_staff_list" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_display_in_staff_list' );
function usermeta_register_wrdsb_display_in_staff_list() {
	register_rest_field( 'user',
		'wrdsb_display_in_staff_list',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
