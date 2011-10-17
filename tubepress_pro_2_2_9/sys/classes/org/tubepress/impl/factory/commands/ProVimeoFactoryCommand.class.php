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
    'org_tubepress_impl_factory_commands_VimeoFactoryCommand',
    'org_tubepress_impl_ioc_IocContainer',
));

/**
 * Pro video factory for Vimeo
 */
class org_tubepress_impl_factory_commands_ProVimeoFactoryCommand extends org_tubepress_impl_factory_commands_VimeoFactoryCommand
{
    protected function _getThumbnailUrlsArray($index)
    {
        $ioc  = org_tubepress_impl_ioc_IocContainer::getInstance();
        $tpom = $ioc->get('org_tubepress_api_exec_ExecutionContext');
        
        if (!$tpom->get(org_tubepress_api_const_options_names_Display::HQ_THUMBS)) {
            return parent::_getThumbnailUrlsArray($index);
        }
        
        $node           = $this->_videoArray[$index];
        $thumbnailArray = $node->thumbnails->thumbnail;
        
        $size = count($thumbnailArray);
        do {
            $size--;
            $thumb = $thumbnailArray[$size]->_content;
            $width = $thumbnailArray[$size]->width;
        } while ($size > 0 && (strpos($thumb, 'defaults') !== FALSE || intval($width) > 640));
        
        return array($thumbnailArray[$size]->_content);
    }
}
