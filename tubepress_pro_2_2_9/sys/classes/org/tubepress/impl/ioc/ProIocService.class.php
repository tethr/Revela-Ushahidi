<?php
/**
 * Copyright 2006 - 2011 Eric D. Hough (http://ehough.com)
 * 
 * This file is part of TubePress (http://tubepress.org)
 * 
 * TubePress is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * TubePress is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with TubePress.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

class_exists('org_tubepress_impl_classloader_ClassLoader') || require dirname(__FILE__) . '/../classloader/ClassLoader.class.php';
org_tubepress_impl_classloader_ClassLoader::loadClasses(array(
    'org_tubepress_impl_ioc_ProInWordPressIocService',
));

/**
 * Dependency injector for TubePress Pro in a standalone environment
 */
class org_tubepress_impl_ioc_ProIocService extends org_tubepress_impl_ioc_ProInWordPressIocService
{
    function __construct()
    {
        parent::__construct();

        /* override the message service */
        $this->bind('org_tubepress_api_message_MessageService')->to('org_tubepress_impl_message_GettextMessageService');
        
        /* override the storage manager */
        $this->bind('org_tubepress_api_options_StorageManager')->to('org_tubepress_impl_options_MemoryStorageManager');
    }
}
