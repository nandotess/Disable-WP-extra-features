<?php
/**
 * Disable WordPress extra features
 *
 * @package dwef
 *
 * Plugin Name: Disable WordPress extra features
 * Plugin URI: https://github.com/nandotess/wp-plugin-disable-wp-extra-features
 * Description: Disable WordPress extra features.
 * Version: 1.0.0
 * Author: Fernando Tessmann
 * Author URI: https://fernandotessmann.com
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dwef
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dwef_dir = dirname( __FILE__ );

require_once "{$dwef_dir}/class-disable-extra-features.php";
