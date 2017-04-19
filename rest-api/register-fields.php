<?php
/**
 * Require wrdsb_ Field Files
 */
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-activity-code.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-employee-group-category.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-employee-group-code.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-employee-group-description.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-extension.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-home-loc.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-job-code.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-job-desc.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-location-code.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-location-desc.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-panel.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-phone-no.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-school-code.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-ipps-school-type.php';

require_once dirname( __FILE__ ) . '/fields/usermeta-wrdsb-id-number.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-wrdsb-school.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-wrdsb-baksheesh.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-wrdsb-supervisor.php';
require_once dirname( __FILE__ ) . '/fields/usermeta-wrdsb-section.php';

require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-physical-location.php';
require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-voicemail.php';
require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-job-title.php';
require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-display-in-staff-list.php';
require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-contact-options.php';
require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-website-url.php';
require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-phone-extension.php';
require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-regular-hours.php';
require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-is-in-today.php';
require_once dirname( __FILE__ ) . '/fields/useroption-wrdsb-is-available-now.php';

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
