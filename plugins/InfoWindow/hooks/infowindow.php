<?php defined('SYSPATH') or die('No direct script access.');


class InfoWindow {
	
	public function __construct(){
		$this->_init_settings();
		Event::add("system.pre_controller",array($this,"add"));
		
	}

	public function add(){
		if( Router::$controller == "main" || /*adminmap plugin support*/ Router::$controller == "bigmap") 
		{
		    plugin::add_stylesheet("InfoWindow/views/css/infowindow");
		    Event::add("ushahidi_action.main_footer",array($this,"register_script"));
		}
		if(/*mapembed plugin support*/ Router::$controller == "mapembed"){
		 	/*Incase we are using the map embed plugin*/
		    plugin::add_stylesheet("InfoWindow/views/css/infowindow");
		    Event::add("mapembed.main_footer",array($this,"register_script"));
		}
	
	}
	
	public function register_script(){
		plugin::add_javascript("InfoWindow/media/js/jquery.pagination");
		echo plugin::render("javascript");
		echo "<script src=\"".url::base()."infowindow\"></script>";
	}
	
	
	/**
	*	Initialize settings for infowindows
	*/
	private function _init_settings(){
		$subdomain = '';
		if(substr_count($_SERVER["HTTP_HOST"],'.') > 1) 
			$subdomain = substr($_SERVER["HTTP_HOST"],0,strpos($_SERVER["HTTP_HOST"],'.'));
		
		$cache = Cache::instance();
		
		
		$infowindow_settings = $cache->get($subdomain.'_infowindow_settings'); //do we have a cached instance of the settings?
		
		if( ! $infowindow_settings ) {
			//get the settings object and cache it.
			$infowindow_settings = ORM::factory('infowindow_settings', 1);
			$cache->set($subdomain.'_infowindow_settings', $infowindow_settings, array('infowindow_settings'), 60); // 1 Day
		}
		
		//Register the infowindow settings in the global kohana config.
		Kohana::config_set("infowindow.showcustomforms", $infowindow_settings->infowindow_showcustomforms);
		Kohana::config_set("infowindow.showimages", $infowindow_settings->infowindow_showimages);
		
	}
	
}



new InfoWindow;
