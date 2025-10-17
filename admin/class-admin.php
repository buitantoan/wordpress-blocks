<?php
/**
 * WPB Admin.
 *
 * @package WPB
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WPB_Admin' ) ) {

	/**
	 * Class WPB_Admin.
	 */
	final class WPB_Admin {

		/**
		 * Instance Variable
		 *
		 * @var instance
		 */
		private static $instance;

        /**
         * Instance
         *
         * @access private
         * @var string Class object.
         * @since 1.0.0
         */
        private $menu_slug = 'wp-blocks';

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			if ( ! is_admin() ) {
				return;
			}

            /* Setup the Admin Menu */
		    add_action( 'admin_menu', array( $this, 'setup_menu' ) );
            add_action( 'admin_init', array( $this, 'settings_admin_scripts' ) );


        }
        
        /**
         * Add submenu to admin menu.
         *
         * @since 1.0.0
         */
        public function setup_menu() {
            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            $menu_slug  = $this->menu_slug;
            $capability = 'manage_options';
            $icon_url   = 'dashicons-admin-generic';
            $position   = 30;

            add_menu_page(
                __( 'WP Blocks', 'wpb-blocks' ),
                __( 'WP Blocks', 'wpb-blocks' ),
                $capability,
                $menu_slug,
                array( $this, 'render_admin_page' ),
                $icon_url,
                $position
            );
        }

        /**
         * Renders the admin settings.
         *
         * @since 1.0.0
         * @return void
         */
        public function render_admin_page() {

            $menu_page_slug = ( ! empty( $_GET['page'] ) ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : $this->menu_slug; //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['page'] does not provide nonce.
            $page_action    = '';

            if ( isset( $_GET['action'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['page'] does not provide nonce.
                $page_action = sanitize_text_field( wp_unslash( $_GET['action'] ) ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['page'] does not provide nonce.
                $page_action = str_replace( '_', '-', $page_action );
            }

            if ( $menu_page_slug !== $this->menu_slug ) {
                return;
            }

            ?>
            <div class="wpb-menu-page-wrapper">
                <div id="wpb-menu-page" class="wpb-menu-page">
                    <div class="wpb-menu-page-content wpb-clear">
                        <div id="wpb-dashboard-app" class="wpb-dashboard-app"></div>
                    </div>
                </div>
            </div>
            <?php
        }

        /**
         *  Initialize after Spectra gets loaded.
         */
        public function settings_admin_scripts() {

            // Enqueue admin scripts.
            if ( ! empty( $_GET['page'] ) && ( $this->menu_slug === $_GET['page'] || false !== strpos( sanitize_text_field( $_GET['page'] ), $this->menu_slug . '_' ) ) || ( array_key_exists( 'post_type', $_GET ) && 'spectra-popup' === $_GET['post_type'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['page'] does not provide nonce.
                add_action( 'admin_enqueue_scripts', array( $this, 'styles_scripts' ) );
            }

        }

        /**
         * Enqueues the needed CSS/JS for the builder's admin settings page.
         *
         * @since 1.0.0
         */
        public function styles_scripts() {
            global $pagenow;

            $handle          = 'wpb-admin-settings';
            $build_url       = WPB_URI . 'build/';
			$script_dep_path = WPB_DIR_PATH . 'build/dashboard.asset.php';
			$script_info     = file_exists( $script_dep_path )
				? include $script_dep_path
				: array(
					'dependencies' => array(),
					'version'      => WPB_VER,
				);

			$script_dep = array_merge( $script_info['dependencies'], array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-api-fetch' ) );
			
			// Scripts.
			$admin_script = file_exists( WPB_DIR_PATH . 'build/dashboard.min.js' ) ? $build_url . 'dashboard.min.js' : $build_url . 'dashboard.js';
			
            wp_register_script(
                $handle,
                $admin_script,
                $script_dep,
                $script_info['version'],
                true
            );

            wp_enqueue_script( $handle );

            wp_register_style(
                $handle,
                $build_url . 'style-dashboard.css',
                array(),
                WPB_VER
            );
    
            wp_enqueue_style( $handle );

            // fonts 
            wp_register_style(
                'wpb-admin-google-fonts',
                'https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap',
                array(),
                WPB_VER
            );
            
            wp_enqueue_style( 'wpb-admin-google-fonts' );

        }

    }

    WPB_Admin::get_instance();
}