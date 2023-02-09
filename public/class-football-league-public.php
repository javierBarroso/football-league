<?php


if (!defined('ABSPATH')) {
	exit();
}

if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

final class Football_League_Public
{

	const MINIMUM_ELEMENTOR_VERSION  = '3.6.0';

	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;

	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	public function __construct()
	{
		if ($this->is_compatible() && add_action('admin_menu', array($this, 'elementor_version'))) {
			add_action('elementor/init', [$this, 'init']);
		}
	}

	function elementor_version(){

		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}
		return true;
	}

	public function is_compatible()
	{

		if (!is_plugin_active('elementor/elementor.php')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}

	public function admin_notice_missing_main_plugin()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be used.', 'football-league'),
			'<strong>' . esc_html__('Football League', 'football-league') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'football-league') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'football-league'),
			'<strong>' . esc_html__('Football League', 'football-league') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'football-league') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'football-league'),
			'<strong>' . esc_html__('Ele Digital Clock', 'football-league') . '</strong>',
			'<strong>' . esc_html__('PHP', 'football-league') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	public function init()
	{

		add_action('elementor/widgets/register', [$this, 'register_widgets']);
		add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
		
	}

	public function register_widgets($widgets_manager)
	{

		require_once(__DIR__ . '/widgets/football-league-widget.php');

		$widgets_manager->register(new \Digital_Clock());
	}


	function add_elementor_widget_categories($elements_manager)
	{

		$elements_manager->add_category(
			'jbplugins',
			[
				'title' => esc_html__('Football League', 'football-league'),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function get_teams(){

		global $wpdb;

        $query_get_teams = "SELECT * FROM " . TEAMS_TABLE;

        $teams = $wpdb->get_results($query_get_teams);

        return $teams;

	}
}
