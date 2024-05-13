<?php
/*
Plugin Name:  Widget Projets WooCommerce
Plugin URI:   https://zerda.digital/
Description:  Ajoute un widget elementor personnalisé.
Version:      1.0
Author:       Zerda TN 
Author URI:   https://zerda.digital/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
require_once plugin_dir_path(__FILE__) . '/includes/function.php';
require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

$General_Widget_Projets_WooCommerc = new General_Widget_Projets_WooCommerc();

// Vérifier si Elementor est actif
if (! did_action( 'elementor/loaded' )) {
    add_action('admin_notices', array($General_Widget_Projets_WooCommerc, 'widget_projets_wooCommerce_missing_notice'));
    return;
}

/**
 * Check if WooCommerce is activated
 */
if (!is_plugin_active( 'woocommerce/woocommerce.php') ) {
    add_action('admin_notices', array($General_Widget_Projets_WooCommerc, 'widget_projets_wooCommerce_missing_notice'));
    return;
}

/**
 * Register the widget
 */
function widget_projets_woocommerce_register_widget() {
    require_once(plugin_dir_path(__FILE__) . 'includes/function-widget.php');
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor_Widget_Projets_WooCommerce());
}
add_action('elementor/widgets/widgets_registered', 'widget_projets_woocommerce_register_widget');



