<?php
class WRDSB_REST_User_by_Username_Controller extends WP_REST_Users_Controller {
	/**
	 * Instance of a user meta fields object.
	 *
	 * @since 4.7.0
	 * @access protected
	 * @var WP_REST_User_Meta_Fields
	 */
	protected $meta;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->namespace = 'wrdsb/v2';
		$this->rest_base = 'user-by-username';

		$this->meta = new WP_REST_User_Meta_Fields();
	}

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {

		register_rest_route( $this->namespace, '/' . $this->rest_base . '/(?P<id>[a-zA-Z0-9]+)', array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_item' ),
				'permission_callback' => array( $this, 'get_item_permissions_check' ),
				'args'                => array(
					'context' => $this->get_context_param( array( 'default' => 'edit' ) ),
				),
			),
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'create_item' ),
				'permission_callback' => array( $this, 'create_item_permissions_check' ),
				'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::CREATABLE ),
			),
			array(
				'methods'             => WP_REST_Server::EDITABLE,
				'callback'            => array( $this, 'update_item' ),
				'permission_callback' => array( $this, 'update_item_permissions_check' ),
				'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::EDITABLE ),
			),
			array(
				'methods'             => WP_REST_Server::DELETABLE,
				'callback'            => array( $this, 'delete_item' ),
				'permission_callback' => array( $this, 'delete_item_permissions_check' ),
				'args'                => array(
					'force' => array(
						'default'     => false,
						'description' => __( 'Required to be true, as resource does not support trashing.' ),
					),
					'reassign' => array(),
				),
			),
			'schema' => array( $this, 'get_public_item_schema' ),
		) );
	}

	/**
	 * Check if a given request has access to read a user
	 *
	 * @param  WP_REST_Request $request Full details about the request.
	 * @return WP_Error|boolean
	 */
	public function get_item_permissions_check( $request ) {
		$username = $request['id'];
		$user = get_user_by( 'login', $username );
		if ( !empty( $user ) ) {
			$id = $user->ID;
			$request['id'] = $id;
		} else {
			$request['id'] = 0;
		}
		$parent_response = parent::get_item_permissions_check( $request );
		return $parent_response;
	}

	/**
	 * Check if a given request has access to update a user
	 *
	 * @param  WP_REST_Request $request Full details about the request.
	 * @return WP_Error|boolean
	 */
	public function update_item_permissions_check( $request ) {
		$username = $request['id'];
		$user = get_user_by( 'login', $username );
		if ( !empty( $user ) ) {
			$id = $user->ID;
			$request['id'] = $id;
		} else {
			$request['id'] = 0;
		}
		$parent_response = parent::update_item_permissions_check( $request );
		return $parent_response;
	}

	/**
	 * Check if a given request has access delete a user
	 *
	 * @param  WP_REST_Request $request Full details about the request.
	 * @return WP_Error|boolean
	 */
	public function delete_item_permissions_check( $request ) {
		$username = $request['id'];
		$user = get_user_by( 'login', $username );
		if ( !empty( $user ) ) {
			$id = $user->ID;
			$request['id'] = $id;
		} else {
			$request['id'] = 0;
		}
		$parent_response = parent::delete_item_permissions_check( $request );
	}
}

