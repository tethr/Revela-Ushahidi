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
    'org_tubepress_api_const_options_names_Display',
    'org_tubepress_api_exec_ExecutionContext',
    'org_tubepress_impl_factory_commands_YouTubeFactoryCommand',
    'org_tubepress_impl_ioc_IocContainer',
));

/**
 * Pro video factory for YouTube
 */
class org_tubepress_impl_factory_commands_ProYouTubeFactoryCommand extends org_tubepress_impl_factory_commands_YouTubeFactoryCommand
{
    const LOG_PREFIX = 'Pro YouTube Video Factory';
    
    protected function _getThumbnailUrlsArray($index)
    {
        $ioc  = org_tubepress_impl_ioc_IocContainer::getInstance();
        $tpom = $ioc->get('org_tubepress_api_exec_ExecutionContext');
        
        if (!$tpom->get(org_tubepress_api_const_options_names_Display::HQ_THUMBS)) {
            return parent::_getThumbnailUrlsArray($index);
        }
        
        $thumbs = $this->_relativeQuery($index, 'media:group/media:thumbnail');
        $index = $thumbs->length - 1;
        do {
            $url = $thumbs->item($index--)->getAttribute('url');
        } while (strpos($url, 'hqdefault') === FALSE);
        return array($url);
    }
}
