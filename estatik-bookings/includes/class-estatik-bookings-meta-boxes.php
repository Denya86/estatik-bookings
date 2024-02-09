<?php

/**
 * Register custom meta box
 *
 * @link       https://denya4444@gmail.com
 * @since      1.0.0
 *
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/includes
 */

class EstatikBookingsMetaBoxes
{
    private string $plugin_name;

    public function __construct(string $plugin_name)
    {
        $this->plugin_name = $plugin_name;
    }

    public function register_booking_metabox(): void
    {
        add_meta_box(
            'booking_details',
            'Booking Details',
            [$this, 'render_booking_metabox'],
            'booking',
            'normal',
            'default'
        );
    }

    public function render_booking_metabox($post): void
    {
        $start_date = get_post_meta($post->ID, '_start_date', true);
        $end_date = get_post_meta($post->ID, '_end_date', true);
        $address = get_post_meta($post->ID, '_address', true);

        wp_nonce_field(basename(__FILE__), 'booking_meta_nonce');
        ?>
        <div class="booking-metabox">
            <div class="booking-field">
                <label for="start_date"><?= __('Start Date:', $this->plugin_name); ?></label>
                <input type="text" id="start_date" name="start_date" class="datepicker"
                       value="<?= esc_attr($start_date); ?>"/>
            </div>
            <div class="booking-field">
                <label for="end_date"><?= __('End Date:', $this->plugin_name); ?></label>
                <input type="text" id="end_date" name="end_date" class="datepicker"
                       value="<?= esc_attr($end_date); ?>"/>
            </div>
            <div class="booking-field">
                <label for="address"><?= __('Address:', $this->plugin_name); ?></label>
                <input type="text" id="address" name="address" value="<?= esc_attr($address); ?>"/>
            </div>

            <div class="booking-field">
                <input type="submit" class="button button-primary" value="<?= __('Save', $this->plugin_name); ?>"/>
                <span class="booking-metabox-error"></span>
            </div>
        </div>
        <?php
    }

    public function save_booking_meta($post_id)
    {
        if (!isset($_POST['booking_meta_nonce']) || !wp_verify_nonce(
                $_POST['booking_meta_nonce'],
                basename(__FILE__)
            )) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        if ('booking' !== $_POST['post_type']) {
            return $post_id;
        }

        if (isset($_POST['start_date'])) {
            update_post_meta($post_id, '_start_date', sanitize_text_field($_POST['start_date']));
        }

        if (isset($_POST['end_date'])) {
            update_post_meta($post_id, '_end_date', sanitize_text_field($_POST['end_date']));
        }

        if (isset($_POST['address'])) {
            update_post_meta($post_id, '_address', sanitize_text_field($_POST['address']));
        }
    }
}