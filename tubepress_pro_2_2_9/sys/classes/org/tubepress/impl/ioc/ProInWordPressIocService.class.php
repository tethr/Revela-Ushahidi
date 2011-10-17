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
    'org_tubepress_impl_ioc_FreeWordPressPluginIocService',
));

/**
 * Dependency injector for TubePress Pro in a WordPress environment
 */
class org_tubepress_impl_ioc_ProInWordPressIocService extends org_tubepress_impl_ioc_FreeWordPressPluginIocService
{
    function __construct()
    {
        parent::__construct();

        /* override the bootstrapper */
        $this->bind('org_tubepress_api_bootstrap_Bootstrapper')->to('org_tubepress_impl_bootstrap_ProTubePressBootstrapper');
        
        /* override the video factory */
        $this->bind('org_tubepress_api_factory_VideoFactory')->to('org_tubepress_impl_factory_ProVideoFactoryChain');
        
        /* override the video provider */
        $this->bind('org_tubepress_api_provider_Provider')->to('org_tubepress_impl_provider_MultipleSourcesVideoFeedProvider');
    
        /* override the HTML generator */
        $this->bind('org_tubepress_api_shortcode_ShortcodeHtmlGenerator')->to('org_tubepress_impl_shortcode_ProShortcodeHtmlGeneratorChain');
    }
}
