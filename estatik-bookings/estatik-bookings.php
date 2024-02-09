<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://denya4444@gmail.com
 * @since             1.0.0
 * @package           Estatik_Bookings
 *
 * @wordpress-plugin
 * Plugin Name:       Estatik Bookings
 * Plugin URI:        https://estatik-booking.com
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Denys
 * Author URI:        https://denya4444@gmail.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       estatik-bookings
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 */
define('ESTATIK_BOOKINGS_VERSION', '1.0.0');

/**
 * Currently plugin name.
 */
define('PLUGIN_NAME', 'estatik-bookings');

/**
 * The code that runs during plugin activation.
 */
function activate_estatik_bookings(): void
{
    require_once plugin_dir_path(__FILE__).'includes/class-estatik-bookings-activator.php';
    EstatikBookingsActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_estatik_bookings(): void
{
    require_once plugin_dir_path(__FILE__).'includes/class-estatik-bookings-deactivator.php';
    EstatikBookingsDeactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_estatik_bookings');
register_deactivation_hook(__FILE__, 'deactivate_estatik_bookings');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__).'includes/class-estatik-bookings.php';

/**
 * Begins execution of the plugin.
 */
function run_estatik_bookings(): void
{
    $plugin = new EstatikBookings();
    $plugin->run();
}

run_estatik_bookings();
