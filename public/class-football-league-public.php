<?php


if (!defined('ABSPATH')) {
	exit();
}

/* if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
} */

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

		require_once(__DIR__ . '/widget/football-league-widget.php');

		$widgets_manager->register(new Football_League_Widget());
	}


	function add_elementor_widget_categories($elements_manager)
	{

		$elements_manager->add_category(
			'jb-footbal-league',
			[
				'title' => esc_html__('Football League', 'football-league'),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function get_teams( $query_by, $include ){

		global $wpdb;

		$select_condition = '';

		switch($query_by){
			case 'league':
				$select_condition = "WHERE league_id = " . $include;
				break;
		}

        $query_get_teams = "SELECT * FROM " . TEAMS_TABLE . " " . $select_condition;

        $teams = $wpdb->get_results($query_get_teams);

        return $teams;

	}
	public function get_league($league_id){

		global $wpdb;

        $query_get_league = "SELECT * FROM " . LEAGUES_TABLE . " WHERE ID = " . $league_id;

        $league = $wpdb->get_results($query_get_league);
		
        return $league[0];

	}
	public function get_leagues(){

		global $wpdb;

        $query_get_leagues = "SELECT * FROM " . LEAGUES_TABLE;

        $league = $wpdb->get_results($query_get_leagues);
		
        return $league;

	}

	public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
        *
        * An instance of this class should be passed to the run() function
        * defined in Plugin_Name_Loader as all of the hooks are defined
        * in that particular class.
        *
        * The Plugin_Name_Loader will then create the relationship
        * between the defined hooks and the functions defined in this
        * class.
        */

        //wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/football-league-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
    *
    * @since    1.0.0
    */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
        *
        * An instance of this class should be passed to the run() function
        * defined in Plugin_Name_Loader as all of the hooks are defined
        * in that particular class.
        *
        * The Plugin_Name_Loader will then create the relationship
        * between the defined hooks and the functions defined in this
        * class.
        */

        //wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/football-league-admin.js', array('jquery'), $this->version, false);
    }
}
