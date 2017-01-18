<?php
/**
 * WRDSB_REST_Users_Controller class.
 */
if ( ! class_exists( 'WRDSB_REST_Users_Controller' ) ) {
	require_once dirname( __FILE__ ) . '/routes/class-wrdsb-rest-users-controller.php';
}

add_action( 'rest_api_init', 'create_wrdsb_rest_routes', 99 );
function create_wrdsb_rest_routes() {
	// Users.
	$controller = new WRDSB_REST_Users_Controller;
	$controller->register_routes();
}

