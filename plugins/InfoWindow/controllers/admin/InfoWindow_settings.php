<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Infowindow Settings Controller
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Konpagroup <info@konpagroup.com> 
 * @package    Konpagroup - http://konpagroup.com
 * @module	   Infowindow Settings Controller	
 * @copyright  Konpagroup - http://kopnagroup.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
* 
*/

class InfoWindow_Settings_Controller extends Admin_Controller
{
	public function index()
	{
		$this->template->this_page = 'addons';
		
		// Standard Settings View
		$this->template->content = new View("admin/plugins_settings");
		$this->template->content->title = "Infowindow Settings";
		
		
		
		// Settings Form View
		$this->template->content->settings_form = new View("infowindow/admin/infowindow_settings");
		
		$form = array("show_custom_forms" => "","show_images" => "");
		
		
		//  Copy the form as errors, so the errors will be stored with keys
        //  corresponding to the form field names
        $errors = $form;
        $form_error = FALSE;
        $form_saved = FALSE;

		
		if($_POST){
			
			$post = new Validation($_POST);
			$post->pre_filter('trim', TRUE);
			
			
			
			if ($post->validate()){
				
				$show_custom_forms = (isset($post->show_custom_forms)) ? TRUE : FALSE;
				$show_images = (isset($post->show_images)) ? TRUE : FALSE;
				
				$infowindow_settings = new Infowindow_Settings_Model(1);
				$infowindow_settings->infowindow_showcustomforms = $show_custom_forms;
				$infowindow_settings->infowindow_showimages = $show_images;
				$infowindow_settings->save();
				
				$form_saved = TRUE;
				
				$form = arr::overwrite($form, $post->as_array());
			
			}else{
			
				// repopulate the form fields
                $form = arr::overwrite($form, $post->as_array());

                // populate the error fields, if any
                $errors = arr::overwrite($errors, $post->errors('settings'));
                $form_error = TRUE;
                
			}
            
			
		}else{
			$infowindow_settings = ORM::factory("infowindow_settings",1);
			$form = array(
					"show_custom_forms" => $infowindow_settings->infowindow_showcustomforms,
					"show_images" => $infowindow_settings->infowindow_showimages
					);
			
		}
		
		$this->template->content->settings_form->form = $form;
		
		// Other variables
	    $this->template->content->errors = $errors;
		$this->template->content->form_error = $form_error;
		$this->template->content->form_saved = $form_saved;
		
	
	}
}