<?php
/**
 * WPB Loader.
 *
 * @package WPB
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WPB_Loader' ) ) {

	/**
	 * Class WPB_Loader.
	 */
	final class WPB_Loader {	
		/**
		 * Instance Variable
		 *
		 * @var instance
		 */
		private static $instance;

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
            add_action( 'init', array( $this, 'init_actions' ) );
        }

        /**
		 * Init actions
		 *
		 * @since 2.0.0
		 *
		 * @return void
		 */
		public function init_actions() {
            add_action( 'enqueue_block_editor_assets', array( $this, 'wpb_enqueue_editor_assets' ) );

			add_filter('block_categories_all', array( $this, 'wpb_register_new_block_category' ), 99999999, 2 );

            $this->wpb_register_block_type();
        }

        public function wpb_register_block_type() {
            $blocks_dir = WPB_BUILD_PATH . '/blocks';
            foreach ( glob( $blocks_dir . '/*', GLOB_ONLYDIR ) as $block_folder ) {
                register_block_type( $block_folder );
            }
        }

		public function wpb_register_new_block_category($block_categories, $editor_context){
			if (!empty($editor_context->post)) {
				array_unshift(
					$block_categories,
					array(
						'slug'  => 'wpb-blocks',
						'title' => __('WP Blocks', 'wpb-blocks'),
						'icon'  => null,
					),
				);
			}
			return $block_categories;
		}

        /**
         * Enqueue Editor assets.
         */
        public function wpb_enqueue_editor_assets() {
			global $pagenow;

			$script_dep_path = WPB_DIR_PATH . 'build/blocks.min.asset.php';
			$script_info     = file_exists( $script_dep_path )
				? include $script_dep_path
				: array(
					'dependencies' => array(),
					'version'      => UAGB_VER,
				);

			$script_dep = array_merge( $script_info['dependencies'], array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-api-fetch' ) );

			if ( 'widgets.php' !== $pagenow ) {
				$script_dep = array_merge( $script_info['dependencies'], array( 'wp-editor' ) );
			}
			
			// Scripts.
			$blocks_script = file_exists( UAGB_DIR . 'build/blocks.min.js' ) ? 'blocks.min.js' : 'blocks.js';
			wp_enqueue_script(
				'wpb-block-editor-js', // Handle.
				WPB_URI . 'build/' . $blocks_script,
				$script_dep, // Dependencies, defined above.
				$script_info['version'], // UAGB_VER.
				true // Enqueue the script in the footer.
			);

        }

    }

}

WPB_Loader::get_instance();
