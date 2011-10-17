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
    'org_tubepress_api_const_options_names_Output',
    'org_tubepress_api_const_options_values_OutputValue',
    'org_tubepress_api_const_template_Variable',
    'org_tubepress_impl_shortcode_commands_SearchInputCommand',
    'org_tubepress_impl_util_StringUtils',
));

/**
 * HTML generation strategy that generates HTML for a single video + meta info.
 */
class org_tubepress_impl_shortcode_commands_DetachedPlayerCommand extends org_tubepress_impl_shortcode_commands_SearchInputCommand
{
    const LOG_PREFIX = 'Detached Player Command';

    /**
     * Execute the command.
     *
     * @return unknown The result of this command execution.
     */
    public function execute($context)
    {
        $ioc         = org_tubepress_impl_ioc_IocContainer::getInstance();
        $execContext = $ioc->get('org_tubepress_api_exec_ExecutionContext');

        if ($execContext->get(org_tubepress_api_const_options_names_Output::OUTPUT) !== org_tubepress_api_const_options_values_OutputValue::PLAYER
            || $execContext->get(org_tubepress_api_const_options_names_Advanced::GALLERY_ID) == '') {
            org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Not set to show output or no gallery ID set');
            return false;
        }

        $player   = $ioc->get('org_tubepress_api_player_PlayerHtmlGenerator');
        $provider = $ioc->get('org_tubepress_api_provider_Provider');
        $ms       = $ioc->get('org_tubepress_api_message_MessageService');
        
        $feedResult = $provider->getMultipleVideos();
        $videoArray = $feedResult->getVideoArray();
        $numVideos  = sizeof($videoArray);
        org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Provider has delivered %d videos', $numVideos);

        if ($numVideos == 0) {
            $context->returnValue = $ms->_('no-videos-found');
            return true;
        }

        $context->returnValue = $player->getHtml($videoArray[0]);

        /* signal that we've handled execution */
        return true;
    }
}