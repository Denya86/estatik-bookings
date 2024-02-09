<?php

/**
 * Single booking page
 * @link       https://denya4444@gmail.com
 * @since      1.0.0
 *
 * @package    Estatik_Bookings
 * @subpackage Estatik_Bookings/public/templates
 */

get_header(); ?>

<div class="single-booking-content">
    <?php
    while (have_posts()) : the_post();
        the_content();
        $post_id = get_the_ID();
        $start_date = get_post_meta($post_id, '_start_date', true);
        $end_date = get_post_meta($post_id, '_end_date', true);
        $address = get_post_meta($post_id, '_address', true);
        ?>
        <?php if ($start_date && $end_date): ?>
            <div class="booking-date-fields">
                <p> Start Date: <?= date('j M Y H:i', strtotime($start_date)); ?> </p>
                <p> End Date: <?= date('j M Y H:i', strtotime($end_date)) ?> </p>
            </div>
        <?php endif; ?>

        <?php if ($address): ?>
            <div class="booking-google-map">
                <iframe width="100%" height="300"
                        src="https://maps.google.com/maps?width=100%25&height=600&hl=en&q=<?= urlencode($address) ?>
                        &t=&z=14&ie=UTF8&iwloc=B&output=embed">
                </iframe>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
</div>

<?php
get_footer(); ?>
