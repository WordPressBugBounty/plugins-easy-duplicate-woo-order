<?php

if (!defined('ABSPATH')) {
    exit;
}

define('WB_EDWO_NOTICE_VER', '2.6.2');

add_action('admin_init', 'wb_edwo_handle_dismiss_notice');
function wb_edwo_handle_dismiss_notice() {
    if (!current_user_can('manage_woocommerce')) {
        return;
    }
    if (isset($_GET['wb_edwo_dismiss_notice']) && $_GET['wb_edwo_dismiss_notice'] === WB_EDWO_NOTICE_VER) {
        update_user_meta(get_current_user_id(), 'wb_edwo_notice_dismissed_version', WB_EDWO_NOTICE_VER);
        wp_redirect(remove_query_arg('wb_edwo_dismiss_notice'));
        exit;
    }
}

add_action('admin_notices', 'wb_edwo_promotional_notice');
function wb_edwo_promotional_notice() {
    if (!current_user_can('manage_woocommerce')) return;

    $dismissed_version = get_user_meta(get_current_user_id(), 'wb_edwo_notice_dismissed_version', true);
    if ($dismissed_version === WB_EDWO_NOTICE_VER) return;

    $plugin_url = 'https://wordpress.org/support/plugin/easy-duplicate-woo-order/reviews/#new-post';
    $donate_url = 'https://www.paypal.com/donate/?hosted_button_id=Z8NFDWW8RSDVL';
    $dismiss_url = add_query_arg('wb_edwo_dismiss_notice', WB_EDWO_NOTICE_VER);

    ?>
    <div class="notice notice-info">
        <h3><strong><?php _e('Enjoying Easy Duplicate Woo Order?', 'easy-duplicate-woo-order'); ?></strong></h3>
        <p><?php _e('If you are enjoying Easy Duplicate Woo Order and find it useful, please consider supporting us.
Maintaining and regularly updating a plugin requires significant time and effort. Your contributions help us keep the plugin current and free for everyone.<br><strong>You can support us by leaving a positive review or buying us a coffee.</strong>', 'easy-duplicate-woo-order'); ?></p>
        
        <p>
            <a class="button-secondary" href="<?php echo esc_url($plugin_url); ?>" target="_blank"><?php _e('Leave a Review', 'easy-duplicate-woo-order'); ?></a>
            <a class="button-primary" style="display:none;" href="<?php echo esc_url($donate_url); ?>" target="_blank"><?php _e('Buy us a coffee', 'easy-duplicate-woo-order'); ?></a>
            <a href="<?php echo esc_url($dismiss_url); ?>&action=already" style="margin-left:10px;"><?php _e('Already did', 'easy-duplicate-woo-order'); ?></a> |
            <a href="<?php echo esc_url($dismiss_url); ?>&action=never"><?php _e('Never mind', 'easy-duplicate-woo-order'); ?></a>
        </p><br>
		<h3><strong><?php _e('Check out Custom Product in Woo Order!', 'easy-duplicate-woo-order'); ?></strong></h3>
		<p><?php _e('If you find this plugins useful, you might also enjoy <strong>Custom Product in Woo Order</strong>. <br><strong>It allow to add custom products directly to orders without adding them to the product catalog. Perfect solution for WooCommerce store owners who need to add one-time custom products to customer orders without cluttering their product catalog.</strong>', 'custom-product-in-woo-order'); ?></p>
		<a class="button-secondary" href="https://wordpress.org/plugins/custom-product-in-woo-order/" target="_blank"><?php _e('View Details', 'easy-duplicate-woo-order'); ?></a><br>
    </div>
    <?php
}

