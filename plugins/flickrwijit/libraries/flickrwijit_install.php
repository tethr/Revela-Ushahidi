<?php
/**
 * Performs install/uninstall methods for the flickrwijit plugin
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   Actionable Installer
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class Flickrwijit_Install {

	/**
	 * Constructor to load the shared database library
	 */
	public function __construct()
	{
		$this->db = Database::instance();
	}

	/**
	 * Creates the required database tables for the actionable plugin
	 */
	public function run_install()
	{
		// Create the database tables.
		// Also include table_prefix in name
		$this->db->query('CREATE TABLE IF NOT EXISTS `'.Kohana::config('database.default.table_prefix').'flickrwijit` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  			`flickr_tag` varchar(255) DEFAULT NULL,
  			`flickr_id` varchar(15) DEFAULT NULL,
  			`num_of_photos` tinyint(4) NOT NULL DEFAULT \'0\',
  			`image_width` int(11) NOT NULL DEFAULT \'500\',
  			`image_height` int(11) NOT NULL DEFAULT \'375\',
  			`block_position` varchar(15) DEFAULT NULL,
  			`enable_cache` int(5) NOT NULL,
  			`block_no_photos` int(5) NOT NULL,
  			PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	/**
	 * Deletes the database tables for the actionable module
	 */
	public function uninstall()
	{
		$this->db->query('DROP TABLE `'.Kohana::config('database.default.table_prefix').'flickrwijit');
	}
}