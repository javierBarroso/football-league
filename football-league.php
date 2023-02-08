<?php
/**
 * @since             1.0.0
 * @package           Football_League
 *
 * @wordpress-plugin
 * Plugin Name:       Football League
 * Description:       Test Pluguin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Javier Barroso
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       football-league
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
	die;
}
defined('ABSPATH') or die('Hey, Hands off this file!!!!');

/**required files */
require dirname( __FILE__ ) . '/includes/class-football-league-activator.php';
require dirname( __FILE__ ) . '/includes/class-football-league-deactivator.php';
require dirname(__FILE__) . '/includes/class-football-league.php';

/**
 * Define constants
 */

/**
 * plugin path
*/
if (!defined('FOOTBALL_LEAGUE')) {
	define('FOOTBALL_LEAGUE', plugin_dir_path(__FILE__));
}
/**
 * Currently plugin version.
 */
if (!defined('FOOTBALL_LEAGUE_VERSION')) {
	define('FOOTBALL_LEAGUE_VERSION', '1.0.0');
}
/**pugin name */
if (!defined('FOOTBALL_LEAGUE_NAME')) {
	define('FOOTBALL_LEAGUE_NAME', plugin_basename(__FILE__));
}
/**plugin path */
if (!defined('FOOTBALL_LEAGUE_PATH')) {
	define('FOOTBALL_LEAGUE_PATH', plugin_dir_path(__FILE__));
}
/**plugin url */
if (!defined('FOOTBALL_LEAGUE_URL')) {
	define('FOOTBALL_LEAGUE_URL', plugin_dir_url(__FILE__));
}

/**DB tables */
global $wpdb;
if (!defined('LEAGUES_TABLE')) {
	define('LEAGUES_TABLE', $wpdb->prefix . 'fl_leagues');
}
if (!defined('TEAMS_TABLE')) {
	define('TEAMS_TABLE', $wpdb->prefix . 'fl_teams');
}


/**
 * plugin activation
 */
function activate_football_league()
{
	Football_League_Activator::activate();
}

/**
 * plugin deactivation
 */
function deactivate_football_league()
{
	Football_League_Deactivator::deactivate();
}

/**Run activation */
register_activation_hook(__FILE__, 'activate_football_league');
/**run deactivation */
register_deactivation_hook(__FILE__, 'deactivate_football_league');


/**
 * Start pluging
 *
 * @since    1.0.0
 */
function run_football_league()
{
	$plugin = new Football_League();
	$plugin->run();
}
run_football_league();


?>