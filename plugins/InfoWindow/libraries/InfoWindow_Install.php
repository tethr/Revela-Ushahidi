<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Performs install/uninstall methods for the FrontlineSMS Plugin
 *
 * @package    KonpaGroup
 * @author     Konpagroup
 * @copyright  (c) 2011 Konpagroup Team
 * @license    http://www.ushahidi.com/license.html
 */
class Infowindow_Install {

        /**
         * Constructor to load the shared database library
         */
        public function __construct()
        {
                $this->db =  new Database();
                $this->tbl = kohana::config("database.default.table_prefix")."infowindow_settings";
        }

        /**
         * Creates the required columns for the FrontlineSMS Plugin
         */
        public function run_install()
        {
                // ****************************************
                // DATABASE STUFF
                $this->db->query("
                        CREATE TABLE IF NOT EXISTS `{$this->tbl}` (
                                `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                                `infowindow_showcustomforms` TINYINT( 4 ) NOT NULL ,
                                `infowindow_showimages` TINYINT( 4 ) NOT NULL
                        ) 
                ");
                // ****************************************
        }

        /**
         * Drops the FrontlineSMS Tables
         */
        public function uninstall()
        {
                $this->db->query("
                        DROP TABLE {$this->tbl};
                ");
        }
}
