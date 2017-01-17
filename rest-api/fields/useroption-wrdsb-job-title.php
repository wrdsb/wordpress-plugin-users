<?php
# Add the field "wrdsb_job_title" to REST API responses for users read and write

add_action( 'rest_api_init', 'usermeta_register_wrdsb_job_title' );
function usermeta_register_wrdsb_job_title() {
	register_rest_field( 'user',
		'wrdsb_job_title',
		array(
			'get_callback'    => 'useroption_get_value',
			'update_callback' => 'useroption_update_value',
			'schema'          => null,
		)
	);
}
