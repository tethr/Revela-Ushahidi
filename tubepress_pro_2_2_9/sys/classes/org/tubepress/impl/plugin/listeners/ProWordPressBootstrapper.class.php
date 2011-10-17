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

class_exists('org_tubepress_impl_classloader_ClassLoader') || require dirname(__FILE__) . '/../../classloader/ClassLoader.class.php';
org_tubepress_impl_classloader_ClassLoader::loadClasses(array(
    'org_tubepress_impl_plugin_listeners_WordPressBoot',
    'org_tubepress_impl_env_wordpress_Pro',
));

/**
 * Performs WordPress initialization.
 */
class org_tubepress_impl_plugin_listeners_ProWordPressBootstrapper extends org_tubepress_impl_plugin_listeners_WordPressBoot
{
    /**
     * Perform boot procedure.
     *
     * @return void
     */
    public function on_boot()
    {
        $ioc = org_tubepress_impl_ioc_IocContainer::getInstance();
        $ed  = $ioc->get('org_tubepress_api_environment_Detector');
        $fs  = $ioc->get('org_tubepress_api_filesystem_Explorer');
        
        if (!$ed->isWordPress()) {
        	return;
        }
        
        $baseName = $fs->getTubePressInstallationDirectoryBaseName();
        
        
        /* warn Pro users of auto-upgrade */
        add_action("in_plugin_update_message-$baseName/tubepress.php", array('org_tubepress_impl_env_wordpress_Pro', 'warnOnUpgrade'));
    }
}
