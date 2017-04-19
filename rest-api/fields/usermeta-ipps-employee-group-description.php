<?php
# Add the field "ipps_employee_group_description" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_ipps_employee_group_description' );
function usermeta_register_ipps_employee_group_description() {
	register_rest_field( 'user',
		'ipps_employee_group_description',
		array(
			'get_callback'    => 'usermeta_get_value',
			'update_callback' => 'usermeta_update_value',
			'schema'          => null,
		)
	);
}
