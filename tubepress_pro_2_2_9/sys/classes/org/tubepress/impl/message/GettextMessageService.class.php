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
    'org_tubepress_api_environment_Detector',
    'org_tubepress_impl_ioc_IocContainer',
    'org_tubepress_impl_log_Log',
    'org_tubepress_impl_message_AbstractMessageService',
));

/**
 * Gettext functionality for TubePress
 */
class org_tubepress_impl_message_GettextMessageService extends org_tubepress_impl_message_AbstractMessageService
{
    const LOG_PREFIX = 'Gettext Message Service';
    
    public function __construct()
    {
        $ioc      = org_tubepress_impl_ioc_IocContainer::getInstance();
        $detector = $ioc->get('org_tubepress_api_environment_Detector');
        
        if ($detector->isWordPress()) {
            
            org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'WordPress detected. Delegating language to it instead.');
            
            /* WordPress will handle language switching */
            return;
        }
        
        
        if (function_exists('gettext')) {
             org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Built-in gettext detected.');
        } else {
            org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Built-in gettext not-detected.');
        }
                    
        require dirname(__FILE__) . '/phpgettext/gettext.inc';
        
        
        if (defined('LANG')) {
             org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'LANG defined as %s.', LANG);
            $lang = LANG === '' ? 'en' : LANG;
        } else {
             org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'LANG undefined.');
            $lang = 'en';
        } 

        org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Locales supported: %s', implode(', ', get_list_of_locales($lang)));

        $textDir = realpath(dirname(__FILE__) . '/../../../../../i18n');
        org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Binding text domain to %s', $textDir);
        
        putenv("LC_ALL=" . $lang);
        _setlocale(LC_ALL, $lang);
        _bindtextdomain('tubepress', $textDir);
        _textdomain('tubepress');    
        _bind_textdomain_codeset('tubepress', 'UTF-8');
    }
    
    /**
     * Retrieves a message for TubePress
     *
     * @param string $msgId The message ID
     *
     * @return string The corresponding message, or "" if not found
     */
    public function _($msgId)
    {
        $message = $this->_keyToMessage($msgId);
        return $message == '' ? '' : _gettext($message);
    }
}
