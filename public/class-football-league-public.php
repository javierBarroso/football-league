<?php
class Football_League_Public
{
    /**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// require FOOTBALL_LEAGUE . 'public/class-breaking-news-ticker-shortcode.php';

		// add_shortcode('NEWSTICKER', array($this, 'print_breaking_news_ticker'));
	}


    //TODO: Load Elementor Widget
	/** 
	 * print the breaking news ticker for the public face of the site
	 * 
	 * @since	1.0.0
	 * 
	 * @param	string	$id breaking news ticker ID
	 * @return	string	html block for the public side
	 */
	// function print_breaking_news_ticker($id)
	// {

	// 	if (class_exists('Breaking_News_Ticker_ShortCode')) {

	// 		return Breaking_News_Ticker_ShortCode::print($id);
			
	// 	}

	// }

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * enqueue css stylesheets for the public faceing side of the site
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/football-league-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * enqueue javascripts files for the public faceing side of the site
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/football-league-public.js', array('jquery'), $this->version, false);
	}
}
?>