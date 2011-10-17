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
    'org_tubepress_impl_bootstrap_TubePressBootstrapper',
));

/**
 * Performs TubePress-wide initialization.
 */
class org_tubepress_impl_bootstrap_ProTubePressBootstrapper extends org_tubepress_impl_bootstrap_TubePressBootstrapper
{
    protected function loadSystemPlugins(org_tubepress_api_ioc_IocService $ioc)
    {
        parent::loadSystemPlugins($ioc);
        
        $pm = $ioc->get('org_tubepress_api_plugin_PluginManager');
        
        $pm->registerListener(org_tubepress_api_const_plugin_EventName::BOOT, $ioc->get('org_tubepress_impl_plugin_listeners_ProWordPressBootstrapper'));
    }
}
