<?php
/**
 * Require wrdsb_ Field Files
 */
require_once dirname( __FILE__ ) . '/fields/wrdsb-id-number.php';
require_once dirname( __FILE__ ) . '/fields/wrdsb-school.php';
require_once dirname( __FILE__ ) . '/fields/wrdsb-voicemail.php';
require_once dirname( __FILE__ ) . '/fields/wrdsb-job-title.php';
require_once dirname( __FILE__ ) . '/fields/wrdsb-display-in-staff-list.php';
require_once dirname( __FILE__ ) . '/fields/wrdsb-contact-options.php';
require_once dirname( __FILE__ ) . '/fields/wrdsb-website-url.php';

/**
 * Handler for getting custom user meta field data.
 *
 * @param array $object The object from the response
 * @param string $field_name Name of field
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function usermeta_get_value( $object, $field_name, $request ) {
    return get_user_meta( $object['id'], $field_name );
}

/**
 * Handler for getting custom user option field data.
 *
 * @param array $object The object from the response
 * @param string $field_name Name of field
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function useroption_get_value( $object, $field_name, $request ) {
    return get_user_option( $field_name, $object['id'] );
}

/**
 * Handler for updating custom user meta field data.
 *
 * @param mixed $value The value of the field
 * @param object $object The object from the response
 * @param string $field_name Name of field
 *
 * @return bool|int
 */
function usermeta_update_value( $value, $object, $field_name ) {
    if ( ! $value || ! is_string( $value ) ) {
        return;
    }
    return update_user_meta( $object->ID, $field_name, strip_tags( $value ) );
}

/**
 * Handler for updating custom user option field data.
 *
 * @param mixed $value The value of the field
 * @param object $object The object from the response
 * @param string $field_name Name of field
 *
 * @return bool|int
 */
function useroption_update_value( $value, $object, $field_name ) {
    if ( ! $value || ! is_string( $value ) ) {
        return;
    }
    return update_user_option( $object->ID, $field_name, strip_tags( $value ) );
}
