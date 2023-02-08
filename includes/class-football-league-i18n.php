<?php
/**
 * @since      1.0.0
 * @package    Football_League
 * @subpackage Football_League/includes
 * @author     Javier Barroso <abby.javi.infox5@gmail.com>
 */

class Football_League_i18n
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'plugin-name',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);
	}
}
