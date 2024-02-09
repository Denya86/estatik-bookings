<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/public
 * @author     Denys <denya4444@gmail.com>
 */

class EstatikBookingsPublic
{
    private string $plugin_name;
    private string $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles(): void
    {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'css/estatik-bookings-public.css',
            [],
            '1.0.2',
            'all'
        );
    }

    public function enqueue_scripts(): void
    {

        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'js/estatik-bookings-public.js',
            ['jquery'],
            $this->version,
            false
        );
    }

    public function display_booking_single_template( $single_template )
    {

        $file = dirname(__FILE__) .'/templates/single-booking.php';

        if( file_exists( $file ) ) $single_template = $file;

        return $single_template;
    }
}
