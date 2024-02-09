<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/admin
 * @author     Denys <denya4444@gmail.com>
 */

class EstatikBookingsAdmin
{
    private string $plugin_name;
    private string $version;

    public function __construct(string $plugin_name, string $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles(): void
    {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'css/estatik-bookings-admin.css',
            [],
            '1.0.4',
            'all'
        );
    }

    public function enqueue_scripts(): void
    {
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'js/estatik-bookings-admin.js',
            ['jquery'],
            '1.1.3',
            false
        );

        wp_enqueue_script( 'jquery-ui-datepicker' );

        wp_enqueue_script(
            'timepicker',
            plugin_dir_url(__FILE__).'js/jquery-ui-timepicker-addon.min.js',
            ['jquery', 'jquery-ui-datepicker'],
            '1.1.1',
            false
        );
    }
}
