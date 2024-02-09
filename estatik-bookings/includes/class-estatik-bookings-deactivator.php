<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://denya4444@gmail.com
 * @since      1.0.0
 *
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/includes
 * @author     Denys <denya4444@gmail.com>
 */
class EstatikBookingsDeactivator
{
    public static function deactivate(): void
    {
        flush_rewrite_rules();
    }

}
