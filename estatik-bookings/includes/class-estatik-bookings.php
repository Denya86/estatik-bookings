<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://denya4444@gmail.com
 * @since      1.0.0
 *
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/includes
 * @author     Denys <denya4444@gmail.com>
 */
class EstatikBookings
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     */
    protected EstatikBookingsLoader $loader;
    protected string $plugin_name;

    protected string $version;

    public function __construct()
    {

        $this->version = ESTATIK_BOOKINGS_VERSION;

        $this->plugin_name = PLUGIN_NAME;

        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     */
    private function load_dependencies(): void
    {
        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-estatik-bookings-loader.php';

        require_once plugin_dir_path(dirname(__FILE__)).'admin/class-estatik-bookings-admin.php';

        require_once plugin_dir_path(dirname(__FILE__)).'public/class-estatik-bookings-public.php';

        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-estatik-bookings-post-types.php';

        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-estatik-bookings-meta-boxes.php';

        $this->loader = new EstatikBookingsLoader();
    }


    /**
     * Register all the hooks related to the admin area functionality
     * of the plugin.
     */
    private function define_admin_hooks(): void
    {
        $plugin_admin = new EstatikBookingsAdmin($this->plugin_name, $this->version);
        $plugin_post_types = new EstatikBookingsPostTypes($this->plugin_name);
        $plugin_meta_boxes = new EstatikBookingsMetaBoxes($this->plugin_name);

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('init', $plugin_post_types, 'create_custom_post_type', 999);
        $this->loader->add_action('add_meta_boxes', $plugin_meta_boxes, 'register_booking_metabox');
        $this->loader->add_action('save_post', $plugin_meta_boxes, 'save_booking_meta');
    }

    /**
     * Register all the hooks related to the public-facing functionality
     * of the plugin.
     */
    private function define_public_hooks(): void
    {
        $plugin_public = new EstatikBookingsPublic($this->plugin_name, $this->version);

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_filter( 'single_template', $plugin_public,'display_booking_single_template' );
    }

    /**
     * Run the loader to execute all the hooks with WordPress.
     */
    public function run(): void
    {
        $this->loader->run();
    }


}
