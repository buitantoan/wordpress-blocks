<?php
/**
 * Plugin Name: WordPress Blocks
 * Author: Matt
 * Version: 1.0.0
 * Description: The WordPress Blocks extends the Gutenberg functionality with several unique and feature-rich blocks that help build websites faster.
 * Text Domain: wpb-blocks
 * Domain Path: /languages
 *
 * @package WPB
 */
defined('ABSPATH') || exit;

define( 'WPB_VER', '1.0.0' );
define( 'WPB_FILE', __FILE__ );
define( 'WPB_ROOT', dirname( plugin_basename( WPB_FILE ) ) );
define( 'WPB_DIR_PATH', plugin_dir_path( WPB_FILE ) );
define( 'WPB_URI', plugins_url( '/', WPB_FILE ) );
define( 'WPB_BUILD_PATH', __DIR__ . '/build' );

add_action( 'plugins_loaded', 'wpb_load_plugin' );
function wpb_load_plugin() {
    require_once WPB_DIR_PATH . 'classes/class-wpb-loader.php';
}