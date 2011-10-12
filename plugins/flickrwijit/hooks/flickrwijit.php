<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Flickrwijit Hook - Load All Events
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class flickrwijit {

	/**
	 * Registers the main event add method
	 */
	public function __construct()
	{
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}

	/**
	 * Adds all the events to the main Ushahidi application
	 */
	public function add()
	{
		// Add a Sub-Nav Link
		Event::add('ushahidi_action.nav_admin_settings', array($this, '_settings_link'));
		Event::add('ushahidi_action.nav_main_top', array($this, '_top_nav_link'));		
		// Only add the events if we are on the main controller
		if (Router::$controller == 'main')
		{
			switch (Router::$method)
			{

				// Hook into the main dashboard
				case 'index':
					plugin::add_stylesheet('flickrwijit/media/css/style');
					plugin::add_stylesheet('../media/css/picbox/picbox');
					plugin::add_javascript('../media/js/picbox');
					Event::add('ushahidi_action.main_sidebar', array($this, '_display_flickrwiji'));
					break;
			}
		}
		elseif (Router::$controller == 'flickrwijit')
		{ 	
			// Add Flickrwijit to settings page
			switch(Router::$method) 
			{
				case 'index':
					
					//Hook js and css files into flickrwijit page
					plugin::add_stylesheet('flickrwijit/media/css/style');
					plugin::add_stylesheet('../media/css/picbox/picbox');
					plugin::add_javascript('../media/js/picbox');
					break;					
			}
		}
	}
	
	public function _settings_link() 
	{
		$this_sub_page = Event::$data;
		
		echo ($this_sub_page == "flickrwijit") ? Kohana::lang('flickrwijit.flickrwijit_link') : 
			"<a href=\"".url::site()."admin/flickrwijit\">".Kohana::lang('flickrwijit.flickrwijit_link')."</a>";	
	}
	
	public function _top_nav_link()
	{
		//show only when top menu is enabled at the settings page
		$top_nav = Event::$data;
		
		//fetch flickrwijit settings from db
		$flickrwijit_settings = ORM::factory('flickrwijit',1);
		
		if($flickrwijit_settings->block_position ==  1 ) {
		
			echo ($top_nav == "flickrwijit") ? 
				Kohana::lang('flickrwijit.flickrwijit_top_nav') : 
				"<a href=\"".url::site()."flickrwijit\">".
				Kohana::lang('flickrwijit.flickrwijit_top_nav')."</a>";
	
		}
	}
	
	public function _display_flickrwiji() {
		
		//fetch flickrwijit settings from db
		$flickrwijit_settings = ORM::factory('flickrwijit',1);
		
		$flickrwijit_view = View::factory('flickrwijit_view');
		
		
		
		$f = $this->_get_flickr_images();
		//enable caching
		if( $flickrwijit_settings->enable_cache == 1 ) {
			$f->enableCache("fs", "application/cache");	
		}
		$photos = $f->photos_search( array(
			'tags' => $flickrwijit_settings->flickr_tag,
			'per_page' => $flickrwijit_settings->block_no_photos,
			'user_id' => $flickrwijit_settings->flickr_id ) );
		$flickrwijit_view->f = $f;
		$flickrwijit_view->photos = $photos;
		$flickrwijit_view->render(TRUE);
	
	}
	
	public function _get_flickr_images() {
		include Kohana::find_file('libraries/phpflickr','phpFlickr');
		
		$f = new phpFlickr(Kohana::config('flickrwijit.flick_api_key'));
		//enable caching
		return $f;
	}

}

new flickrwijit;
