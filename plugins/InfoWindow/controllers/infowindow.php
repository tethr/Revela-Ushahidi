<?php defined('SYSPATH') OR die('No direct access allowed.');

class InfoWindow_Controller extends Controller{


	public function index(){
		
		$this->view = View::factory("infowindow/infowindow_js");
		
		
		
		header("Content-Type: text/javascript"); //set proper mime-type;
		
		$this->view->showcustomforms = kohana::config("infowindow.showcustomforms");
		$this->view->showimages = kohana::config("infowindow.showimages");
		
		$this->view->render(TRUE);
		
	
	}

}