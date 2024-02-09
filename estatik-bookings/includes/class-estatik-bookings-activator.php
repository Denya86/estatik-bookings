<?php

/**
 * Fired during plugin activation
 *
 * @link       https://denya4444@gmail.com
 * @since      1.0.0
 *
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/includes
 * @author     Denys <denya4444@gmail.com>
 */
class EstatikBookingsActivator
{
    public static function activate(): void
    {
        /**
         * Custom Post Types
         */
        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-estatik-bookings-post-types.php';

        $plugin_post_types = new EstatikBookingsPostTypes(PLUGIN_NAME);
        $plugin_post_types->create_custom_post_type();

        flush_rewrite_rules();
    }
}
