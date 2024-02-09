<?php
/**
 * Register custom post type
 *
 * @link       https://denya4444@gmail.com
 * @since      1.0.0
 *
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/includes
 */

class EstatikBookingsPostTypes
{
    private string $plugin_name;

    public function __construct(string $plugin_name)
    {
        $this->plugin_name = $plugin_name;
    }

    /**
     * Register custom post type
     */
    private function register_single_post_type($fields): void
    {
        $labels = [
            'name' => $fields['plural'],
            'singular_name' => $fields['singular'],
            'menu_name' => $fields['menu_name'],
            'new_item' => sprintf(__('New %s', $this->plugin_name), $fields['singular']),
            'add_new_item' => sprintf(__('Add new %s', $this->plugin_name), $fields['singular']),
            'edit_item' => sprintf(__('Edit %s', $this->plugin_name), $fields['singular']),
            'view_item' => sprintf(__('View %s', $this->plugin_name), $fields['singular']),
            'view_items' => sprintf(__('View %s', $this->plugin_name), $fields['plural']),
            'search_items' => sprintf(__('Search %s', $this->plugin_name), $fields['plural']),
            'not_found' => sprintf(__('No %s found', $this->plugin_name), strtolower($fields['plural'])),
            'not_found_in_trash' => sprintf(
                __('No %s found in trash', $this->plugin_name),
                strtolower($fields['plural'])
            ),
            'all_items' => sprintf(__('All %s', $this->plugin_name), $fields['plural']),
            'archives' => sprintf(__('%s Archives', $this->plugin_name), $fields['singular']),
            'attributes' => sprintf(__('%s Attributes', $this->plugin_name), $fields['singular']),
            'insert_into_item' => sprintf(__('Insert into %s', $this->plugin_name), strtolower($fields['singular'])),
            'uploaded_to_this_item' => sprintf(
                __('Uploaded to this %s', $this->plugin_name),
                strtolower($fields['singular'])
            ),
            'parent_item' => sprintf(__('Parent %s', $this->plugin_name), $fields['singular']),
            'parent_item_colon' => sprintf(__('Parent %s:', $this->plugin_name), $fields['singular']),
            'archive_title' => $fields['plural'],
        ];

        $args = [
            'labels' => $labels,
            'description' => (isset($fields['description'])) ? $fields['description'] : '',
            'public' => (isset($fields['public'])) ? $fields['public'] : true,
            'publicly_queryable' => (isset($fields['publicly_queryable'])) ? $fields['publicly_queryable'] : true,
            'exclude_from_search' => (isset($fields['exclude_from_search'])) ? $fields['exclude_from_search'] : false,
            'show_ui' => (isset($fields['show_ui'])) ? $fields['show_ui'] : true,
            'show_in_menu' => (isset($fields['show_in_menu'])) ? $fields['show_in_menu'] : true,
            'query_var' => (isset($fields['query_var'])) ? $fields['query_var'] : true,
            'show_in_admin_bar' => (isset($fields['show_in_admin_bar'])) ? $fields['show_in_admin_bar'] : true,
            'capability_type' => (isset($fields['capability_type'])) ? $fields['capability_type'] : 'post',
            'has_archive' => (isset($fields['has_archive'])) ? $fields['has_archive'] : true,
            'hierarchical' => (isset($fields['hierarchical'])) ? $fields['hierarchical'] : true,
            'supports' => (isset($fields['supports'])) ? $fields['supports'] : [
                'title',
                'editor',
                'excerpt',
                'author',
                'thumbnail',
                'comments',
                'trackbacks',
                'custom-fields',
                'revisions',
                'page-attributes',
                'post-formats',
            ],
            'menu_position' => (isset($fields['menu_position'])) ? $fields['menu_position'] : 21,
            'menu_icon' => (isset($fields['menu_icon'])) ? $fields['menu_icon'] : 'dashicons-admin-generic',
            'show_in_nav_menus' => (isset($fields['show_in_nav_menus'])) ? $fields['show_in_nav_menus'] : true,
            'show_in_rest' => (isset($fields['show_in_rest'])) ? $fields['show_in_rest'] : true,
        ];

        if (isset($fields['rewrite'])) {
            $args['rewrite'] = $fields['rewrite'];
        }

        if (isset($fields['taxonomies']) && is_array($fields['taxonomies'])) {
            foreach ($fields['taxonomies'] as $taxonomy) {
                $this->register_single_post_type_taxonomy($taxonomy);
            }
        }

        register_post_type($fields['slug'], $args);
    }

    private function register_single_post_type_taxonomy($tax_fields): void
    {
        $labels = [
            'name' => $tax_fields['plural'],
            'singular_name' => $tax_fields['single'],
            'menu_name' => $tax_fields['plural'],
            'all_items' => sprintf(__('All %s', $this->plugin_name), $tax_fields['plural']),
            'edit_item' => sprintf(__('Edit %s', $this->plugin_name), $tax_fields['single']),
            'view_item' => sprintf(__('View %s', $this->plugin_name), $tax_fields['single']),
            'update_item' => sprintf(__('Update %s', $this->plugin_name), $tax_fields['single']),
            'add_new_item' => sprintf(__('Add New %s', $this->plugin_name), $tax_fields['single']),
            'new_item_name' => sprintf(__('New %s Name', $this->plugin_name), $tax_fields['single']),
            'parent_item' => sprintf(__('Parent %s', $this->plugin_name), $tax_fields['single']),
            'parent_item_colon' => sprintf(__('Parent %s:', $this->plugin_name), $tax_fields['single']),
            'search_items' => sprintf(__('Search %s', $this->plugin_name), $tax_fields['plural']),
            'popular_items' => sprintf(__('Popular %s', $this->plugin_name), $tax_fields['plural']),
            'separate_items_with_commas' => sprintf(
                __('Separate %s with commas', $this->plugin_name),
                $tax_fields['plural']
            ),
            'add_or_remove_items' => sprintf(__('Add or remove %s', $this->plugin_name), $tax_fields['plural']),
            'choose_from_most_used' => sprintf(
                __('Choose from the most used %s', $this->plugin_name),
                $tax_fields['plural']
            ),
            'not_found' => sprintf(__('No %s found', $this->plugin_name), $tax_fields['plural']),
        ];

        $args = [
            'label' => $tax_fields['plural'],
            'labels' => $labels,
            'hierarchical' => (isset($tax_fields['hierarchical'])) ? $tax_fields['hierarchical'] : true,
            'public' => (isset($tax_fields['public'])) ? $tax_fields['public'] : true,
            'show_ui' => (isset($tax_fields['show_ui'])) ? $tax_fields['show_ui'] : true,
            'show_in_nav_menus' => (isset($tax_fields['show_in_nav_menus'])) ? $tax_fields['show_in_nav_menus'] : true,
            'show_tagcloud' => (isset($tax_fields['show_tagcloud'])) ? $tax_fields['show_tagcloud'] : true,
            'meta_box_cb' => (isset($tax_fields['meta_box_cb'])) ? $tax_fields['meta_box_cb'] : null,
            'show_admin_column' => (isset($tax_fields['show_admin_column'])) ? $tax_fields['show_admin_column'] : true,
            'show_in_quick_edit' => (isset($tax_fields['show_in_quick_edit'])) ? $tax_fields['show_in_quick_edit'] : true,
            'update_count_callback' => (isset($tax_fields['update_count_callback'])) ? $tax_fields['update_count_callback'] : '',
            'show_in_rest' => (isset($tax_fields['show_in_rest'])) ? $tax_fields['show_in_rest'] : true,
            'rest_base' => $tax_fields['taxonomy'],
            'rest_controller_class' => (isset($tax_fields['rest_controller_class'])) ? $tax_fields['rest_controller_class'] : 'WP_REST_Terms_Controller',
            'query_var' => $tax_fields['taxonomy'],
            'rewrite' => (isset($tax_fields['rewrite'])) ? $tax_fields['rewrite'] : true,
            'sort' => (isset($tax_fields['sort'])) ? $tax_fields['sort'] : '',
        ];

        $args = apply_filters($tax_fields['taxonomy'].'_args', $args);

        register_taxonomy($tax_fields['taxonomy'], $tax_fields['post_types'], $args);
    }

    /**
     * Create post types
     */
    public function create_custom_post_type(): void
    {
        $post_types_fields = [

            [
                'slug' => __('booking', $this->plugin_name),
                'singular' => __('Booking', $this->plugin_name),
                'plural' => __('Bookings', $this->plugin_name),
                'menu_name' => __('Bookings', $this->plugin_name),
                'description' => __('Bookings', $this->plugin_name),
                'add_new_item' => __('Add New Booking', $this->plugin_name),
                'edit_item' => __('Edit Booking', $this->plugin_name),
                'new_item' => __('New Booking', $this->plugin_name),
                'view_item' => __('View Booking', $this->plugin_name),
                'search_items' => __('Search Bookings', $this->plugin_name),
                'not_found' => __('No bookings found.', $this->plugin_name),
                'not_found_in_trash' => __('No bookings found in trash.', $this->plugin_name),
                'parent_item_colon' => __('Parent Booking:', $this->plugin_name),
                'all_items' => __('All Bookings', $this->plugin_name),
                'menu_icon' => 'dashicons-calendar-alt',

                'supports' => [
                    'title',
                ],
            ],

        ];

        foreach ($post_types_fields as $fields) {
            $this->register_single_post_type($fields);
        }
    }
}