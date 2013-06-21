<?php
/**
 * Twelve31 Interactive ListManager
 *
 * @package		ListManager
 * @author		Neal Stanard
 * @version		1.0.0
 */

if( !class_exists( 'ListManager' ) ) {

	/**
	 * Main ListManager Class
	 *
	 * @since		1.0
	 */
	final class ListManager {

		/**
		 * @since		1.0.0
		 * @var			ListManager The one true ListManager
		 */
		private static $instance;


		/**
		 * Main ListManager Instance
		 *
		 * Ensures that only one instance of ListManager exists in memory at any one time
		 *
		 * @since		1.0.0
		 * @access		public
		 * @static
		 * @staticvar	array $instance
		 * @return		The one true ListManager
		 */
		public static function instance() {
			if( !isset( self::$instance ) && !( self::$instance instanceof ListManager ) ) {
				self::$instance = new ListManager;
				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->first_run();
				self::$instance->session();
			}

			return self::$instance;
		}


		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object. Therefore, we don't want the object to be cloned.
		 *
		 * @since		1.0.0
		 * @access		protected
		 * @return		void
		 */
		public function __clone() {
			die( 'Cheatin&#8217; huh?' );
		}


		/**
		 * Disable unserializing of the class
		 *
		 * @since		1.0.0
		 * @access		protected
		 * @return		void
		 */
		public function __wakeup() {
			die( 'Cheatin&#8217; huh?' );
		}


		/**
		 * Setup plugin constants
		 *
		 * @since		1.0.0
		 * @access		private
		 * @return		void
		 */
		private function setup_constants() {
			// Script path
			if( !defined( 'LISTMANAGER_DIR' ) )
				define( 'LISTMANAGER_DIR', dirname( __FILE__ ) . '/' );

			// Script URL
			if( !defined( 'LISTMANAGER_URL' ) )
				define( 'LISTMANAGER_URL', $this->get_script_url() );

			// Script root file
			if( !defined( 'LISTMANAGER_FILE' ) )
				define( 'LISTMANAGER_FILE', __FILE__ );
		}


		/**
		 * Include required files
		 *
		 * @since		1.0.0
		 * @access		private
		 * @return		void
		 */
		private function includes() {
			require_once LISTMANAGER_DIR . 'includes/mysql.php';
			require_once LISTMANAGER_DIR . 'includes/config.php';
			require_once LISTMANAGER_DIR . 'includes/scripts.php';
		}


		/**
		 * Get script URL
		 *
		 * Returns the URL the ListManager script is running on
		 *
		 * @since		1.0.0
		 * @access		public
		 * @global		$_SERVER
		 * @return		string $url The URL associated with the ListManager script
		 */
		public function get_script_url() {

			$url = 'http';

			// Check if we are using HTTPS
			if( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' )
				$url .= 's';

			$url .= '://' . $_SERVER['SERVER_NAME'];

			// Are we using a non-standard HTTP port?
			if( $_SERVER['SERVER_PORT'] != '80' )
				$url .= ':' . $_SERVER['SERVER_PORT'];

			$url .= $_SERVER['REQUEST_URI'];

			return $url;
		}


		/**
		 * First run configuration
		 *
		 * @since		1.0.0
		 * @access		public
		 * @return		void
		 */
		public function first_run() {

			// We only want to execute this on the first run!
			if( !file_exists( LISTMANAGER_DIR . 'cache/firstrun' ) ) return;

			require_once LISTMANAGER_DIR . 'install.php';

			install_script();
		}


		/**
		 * Run the login script, if necessary
		 *
		 * @since		1.0.0
		 * @access		public
		 * @return		void
		 */
		public function session() {
			require_once LISTMANAGER_DIR . 'login.php';
		}
	}
}


/**
 * The main function responsible for returning the one true ListManager Instance
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * @since		1.0.0
 * @return		object The one true ListManager Instance
 */
function LM() {
	return ListManager::instance();
}


// Off we go!
LM();
