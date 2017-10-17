<?php
/*
* Plugin Name: WRDSB Users
* Plugin URI: https://github.com/wrdsb/wordpress-plugin-users
* Description: Profile tweaks, custom meta fields, user roles, and API endpoints for Users.
* Author: WRDSB
* Author URI: https://github.com/wrdsb
* Version: 2.0.1
* License: GPLv3 or later
* Text Domain: wrdsb-users
* GitHub Plugin URI: wrdsb/wordpress-plugin-users
* GitHub Branch: master
*/

require_once dirname(__FILE__). "/profiles.php";
require_once dirname(__FILE__). "/rest-api/register-routes.php";
require_once dirname(__FILE__). "/rest-api/register-fields.php";
