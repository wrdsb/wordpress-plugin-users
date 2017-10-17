<?php
class WRDSB_REST_Blog_User_by_Email_Controller extends WP_REST_Users_Controller {
	/**
	 * Instance of a user meta fields object.
	 *
	 * @access protected
	 * @var WP_REST_User_Meta_Fields
	 */
	protected $meta;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->namespace = 'wrdsb/v2';
		$this->rest_base = 'blog-user-by-email';

		$this->meta = new WP_REST_User_Meta_Fields();
	}

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {

		register_rest_route( $this->namespace, '/' . $this->rest_base . '/(?P<id>[^\@]+\@[^\@]+)', array(
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
 	* Check if a given request has access to update a user
 	*
 	* @param  WP_REST_Request $request Full details about the request.
 	* @return WP_Error|boolean
 	*/
	public function update_item_permissions_check( $request ) {
		// because this only makes sense in a multisite install:
		$this->multisite_check();

		$user = $this->get_user( $request['id'] );

		if ( is_wp_error( $user ) ) {
			return $user;
		}

		//TODO: confirm these capabilities identify Admins and Super Admins only
		if ( ! current_user_can( 'edit_user', $user->ID ) ) {
			return new WP_Error( 'rest_cannot_edit', __( 'Sorry, you are not allowed to edit this user.' ), array( 'status' => rest_authorization_required_code() ) );
		}

		if ( ! empty( $request['roles'] ) && ! current_user_can( 'edit_users' ) ) {
			return new WP_Error( 'rest_cannot_edit_roles', __( 'Sorry, you are not allowed to edit roles of this user.' ), array( 'status' => rest_authorization_required_code() ) );
		}

		return true;
	}

	/**
	 * Updates a single user.
	 *
	 * @access public
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function update_item( $request ) {
		$user = $this->get_user( $request['id'] );

		if ( is_wp_error( $user ) ) {
			return $user;
		}

		if ( ! $user->ID ) {
			return new WP_Error( 'rest_user_invalid_id', __( 'Invalid user ID.' ), array( 'status' => 404 ) );
		}

		if ( empty( $request['roles'] ) ) {
			return new WP_Error( 'rest_user_missing_role', __( 'Bad Request: missing role' ), array( 'status' => 400 ) );
		}

		// Protect existing roles
		if ( is_user_member_of_blog( $user->ID, get_current_blog_id() ) ) {
			$member = new WP_User( $user->ID, '', get_current_blog_id() );

			if ( in_array( 'administrator', $member->roles) ) {
				return new WP_Error( 'rest_user_demotion_failed', __( 'Bad Request: User is an administrator' ), array( 'status' => 400 ) );
			}
			if ( in_array( 'editor', $member->roles) ) {
				return new WP_Error( 'rest_user_demotion_failed', __( 'Bad Request: User is an editor' ), array( 'status' => 400 ) );
			}
			if ( in_array( 'author', $member->roles) ) {
				return new WP_Error( 'rest_user_demotion_failed', __( 'Bad Request: User is an author' ), array( 'status' => 400 ) );
			}
		}

		$user_id = $user->ID;
		$blog_id = get_current_blog_id();
		$role = (string) reset( $request['roles'] );

		$result = add_user_to_blog( $blog_id, $user_id, $role );

		if ( is_wp_error( $result ) ) {
			return new WP_Error( 'rest_user_add_failure', $result->get_error_message(), array( 'status' => 500 ) );
		}

		$request->set_param( 'context', 'edit' );

		$response = $this->prepare_item_for_response( $user, $request );
		$response = rest_ensure_response( $response );

		return $response;
	}

	/**
	 * Check if a given request has access to delete (remove) a user
	 *
	 * @param  WP_REST_Request $request Full details about the request.
	 * @return WP_Error|boolean
	 */
	public function delete_item_permissions_check( $request ) {
		//TODO: this is exactly the same as permission check for adding a user,
		// so let's make it a function we can call from both places

		// because this only makes sense in a multisite install:
		$this->multisite_check();

		$user = $this->get_user( $request['id'] );

		if ( is_wp_error( $user ) ) {
			return $user;
		}

		if ( ! current_user_can( 'edit_user', $user->ID ) ) {
			return new WP_Error( 'rest_cannot_edit', __( 'Sorry, you are not allowed to edit this user.' ), array( 'status' => rest_authorization_required_code() ) );
		}

		if ( ! empty( $request['roles'] ) && ! current_user_can( 'edit_users' ) ) {
			return new WP_Error( 'rest_cannot_edit_roles', __( 'Sorry, you are not allowed to edit roles of this user.' ), array( 'status' => rest_authorization_required_code() ) );
		}

		return true;
	}

	/**
	 * Deletes (removes) a single user.
	 *
	 * @access public
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function delete_item( $request ) {
		$user = $this->get_user( $request['id'] );

		if ( is_wp_error( $user ) ) {
			return $user;
		}

		if ( ! $user->ID ) {
			return new WP_Error( 'rest_user_invalid_id', __( 'Invalid user ID.' ), array( 'status' => 404 ) );
		}

		if ( ! is_user_member_of_blog( $user->ID, get_current_blog_id() ) ) {
			return new WP_Error( 'rest_user_non_member', __( 'Bad Request: User is not a member of this blog' ), array( 'status' => 400 ) );
		}

		$user_id = $user->ID;
		$blog_id = get_current_blog_id();
		//TODO: support reassignment
		//$reassign = 

		$result = remove_user_from_blog( $user_id, $blog_id );

		if ( is_wp_error( $result ) ) {
			return new WP_Error( 'rest_user_remove_failure', $result->get_error_message(), array( 'status' => 500 ) );
		}

		//TODO: just return a 200. seriously.
		$request->set_param( 'context', 'edit' );

		$response = $this->prepare_item_for_response( $user, $request );
		$response = rest_ensure_response( $response );

		return $response;
	}

	/**
	 * Get the user, if the ID is valid.
	 *
	 * @since 4.7.2
	 *
	 * @param int $id Supplied ID.
	 * @return WP_User|WP_Error True if ID is valid, WP_Error otherwise.
	 */
	protected function get_user( $email ) {
		$error = new WP_Error( 'rest_user_invalid_id', __( 'Invalid user ID.' ), array( 'status' => 404 ) );

		$user = get_user_by( 'email', $email );

		if ( empty( $user ) || ! $user->exists() ) {
			return $error;
		}

		return $user;
	}

	/**
	 * Confirm we're running multisite
	 *
	 * @param int $id Supplied ID.
	 * @return WP_User|WP_Error True if ID is valid, WP_Error otherwise.
	 */
	protected function multisite_check() {
		$error = new WP_Error( 'rest_multisite_check_failure', __( 'Bad Request: not a multisite install' ), array( 'status' => 400 ) );

		if ( !is_multisite() ) {
			return $error;
		}

		return true;
	}
}

