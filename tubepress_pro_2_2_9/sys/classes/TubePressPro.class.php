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

 class_exists('org_tubepress_impl_classloader_ClassLoader') || require dirname(__FILE__) . '/org/tubepress/impl/classloader/ClassLoader.class.php';
org_tubepress_impl_classloader_ClassLoader::loadClasses(array(
    'org_tubepress_impl_ioc_IocContainer',
    'org_tubepress_api_html_HeadHtmlGenerator',
    'org_tubepress_api_message_MessageService',
    'org_tubepress_api_shortcode_ShortcodeHtmlGenerator'
));

require dirname(__FILE__) . '/../scripts/wordpress/loader.php';

/**
 * TubePress Pro. Aren't you lucky!
 */
class TubePressPro
{
    public static function getHtmlForHead($includeJQuery = false)
    {
        $ioc           = org_tubepress_impl_ioc_IocContainer::getInstance();
        $bootstrapper  = $ioc->get('org_tubepress_api_bootstrap_Bootstrapper');
        $htmlGenerator = $ioc->get('org_tubepress_api_html_HeadHtmlGenerator');
        
        $jQueryIncludeString = $includeJQuery ? $htmlGenerator->getHeadJqueryInclusion() : '';
        $inlineJsString      = $htmlGenerator->getHeadInlineJs();
        $jsIncludeString     = $htmlGenerator->getHeadJsIncludeString();
        $cssIncludeString    = $htmlGenerator->getHeadCssIncludeString();
        $metaString          = $htmlGenerator->getHeadHtmlMeta();

        return <<<EOT
$jQueryIncludeString
$inlineJsString
$jsIncludeString
$cssIncludeString
$metaString
EOT;
        
    }
    
    public static function getHtmlForShortcode($raw_shortcode = '')
    {
        /* pad the shortcode if it doesn't start and end with the right stuff */
        $shortcode = self::_cleanShortcode($raw_shortcode);

        $ioc           = org_tubepress_impl_ioc_IocContainer::getInstance();
        $bootstrapper  = $ioc->get('org_tubepress_api_bootstrap_Bootstrapper');
        $htmlGenerator = $ioc->get('org_tubepress_api_shortcode_ShortcodeHtmlGenerator');

        /* boot up */
        $bootstrapper->boot();
        
        /* parse the shortcode and return the output */
        try {
        	
        	return $htmlGenerator->getHtmlForShortcode($shortcode);
        
        } catch (Exception $e) {

        	$ms = $ioc->get('org_tubepress_api_message_MessageService');
        	
        	return $ms->_('no-videos-found');
        }
    }

    /**
     * Pads the user-supplied shortcode, if necessary
     *
     * @param unknown_type $shortcode
     * @return unknown
     */
    private static function _cleanShortcode($shortcode)
    {
        /* make sure it starts with [tubepress */
        if (substr($shortcode, 0, 11) != '[tubepress ') {
            $shortcode = "[tubepress $shortcode";
        }

        /* make sure it ends with a bracket */
        if (substr($shortcode, strlen($shortcode) - 1) != ']') {
            $shortcode = "$shortcode]";
        }
        return $shortcode;
    }
}
