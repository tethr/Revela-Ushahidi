<?php defined('SYSPATH') or die('No direct script access.');
/**
 * This is the controller for the main site.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Main Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */
class Flickrwijit_Controller extends Main_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index() 
	{
		$this->template->content = new View('flickrwijit_front');
		//fetch flickrwijit settings from db
		$flickrwijit_settings = ORM::factory('flickrwijit',1);
		// include phpflickr library
		include Kohana::find_file('libraries/phpflickr','phpFlickr');
		
		$f = new phpFlickr(Kohana::config('flickrwijit.flick_api_key'));
		
		//enable caching
		if( $flickrwijit_settings->enable_cache == 1 ) {
			$f->enableCache("fs", "application/cache");	
		}
		
		$pagination = new Pagination(array(
				'query_string' => 'page',
				'items_per_page' => (int) Kohana::config('settings.items_per_page'),
				'total_items' => $flickrwijit_settings->num_of_photos));
		//print_r($pagination);
		$photos = $f->photos_search( array(
			'page' => $pagination->current_page,
			'tags' => $flickrwijit_settings->flickr_tag,
			'per_page' => (int) Kohana::config('settings.items_per_page'),
			'user_id' => $flickrwijit_settings->flickr_id ) );
	
		$this->template->content->image_width = $flickrwijit_settings->image_width;
		$this->template->content->image_height = $flickrwijit_settings->image_height;
		$this->template->content->num_of_photos = $flickrwijit_settings->num_of_photos;
		$this->template->content->f = $f;
		$this->template->content->photos = $photos;
		$this->template->content->pagination = $pagination;
		
	}
}
