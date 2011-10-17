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
    'org_tubepress_api_const_options_names_Output',
    'org_tubepress_api_exec_ExecutionContext',
    'org_tubepress_api_provider_ProviderResult',
    'org_tubepress_impl_ioc_IocContainer',
    'org_tubepress_impl_log_Log',
    'org_tubepress_impl_options_OptionsReference',
    'org_tubepress_impl_provider_SimpleProvider',
));

/**
 * Video provider that can handle multiple sources.
 */
class org_tubepress_impl_provider_MultipleSourcesVideoFeedProvider extends org_tubepress_impl_provider_SimpleProvider
{
    const LOG_PREFIX = 'Multiple Sources Video Provider';
    
    const DELIM = ' + ';

    /**
     * Get the video feed result.
     *
     * @return org_tubepress_video_feed_FeedResult The feed result.
     */
    public function getMultipleVideos()
    {
        $ioc  = org_tubepress_impl_ioc_IocContainer::getInstance();
        $execContext = $ioc->get('org_tubepress_api_exec_ExecutionContext');

        /* see if we're using multiple modes */
	if (!$this->_usingMultipleModes($execContext)) {
            org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Multiple video sources not detected at the moment.');
            return parent::getMultipleVideos();
        }

	$originalCustomOptions = $execContext->getCustomOptions();

        /* do some initialization */
        $modes  = $this->_getModes($execContext);
        $result = new org_tubepress_api_provider_ProviderResult();
        
        org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Detected %d modes', sizeof($modes));

        /* iterate over each mode and collect the videos */
        foreach ($modes as $mode) {
            try {
                $result = $this->_getVideosForMode($mode, $result, $execContext);
            } catch (Exception $e) {
                org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Caught exception getting videos: ' . $e->getMessage());
            }
        }

	$execContext->setCustomOptions($originalCustomOptions);

        return $result;
    }

    private function _getVideosForMode($mode, org_tubepress_api_provider_ProviderResult $result, org_tubepress_api_exec_ExecutionContext $execContext)
    {
        $execContext->set(org_tubepress_api_const_options_names_Output::MODE, $mode);

        /* some modes, like 'mobile', don't really take a parameter */
        if (!org_tubepress_impl_options_OptionsReference::isOptionName($mode . 'Value')) {
             org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Now collecting videos for "%s" mode', $mode);
             $modeResult = parent::getMultipleVideos();
             return $this->_combineFeedResults($result, $modeResult);
        }

        $modeValues = $this->_getValuesForMode($execContext, $mode);
            
        foreach ($modeValues as $modeValue) {

            org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Now collecting videos for "%s" mode with value "%s"', $mode, $modeValue);

            $execContext->set($mode . 'Value', $modeValue);
            try {
                $modeResult = parent::getMultipleVideos();
                $result = $this->_combineFeedResults($result, $modeResult);
            } catch (Exception $e) {
                org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'Problem collecting videos for mode "%s" and value "%s": %s', $mode, $modeValue, $e->getMessage());
            }
            
            org_tubepress_impl_log_Log::log(self::LOG_PREFIX, 'After collecting videos for "%s" mode with value "%s", we have %d video(s)', 
                $mode, $modeValue, sizeof($result->getVideoArray()));
        }

        return $result;
    }

    private function _getValuesForMode(org_tubepress_api_exec_ExecutionContext $execContext, $mode)
    {
        $modeValues = $execContext->get($mode . 'Value');
        return explode(' + ', $modeValues);
    }

    private function _combineFeedResults(org_tubepress_api_provider_ProviderResult $first, org_tubepress_api_provider_ProviderResult $second)
    {
        $result = new org_tubepress_api_provider_ProviderResult();
        
        /* merge the two video arrays into a single one */
        $result->setVideoArray(array_merge($first->getVideoArray(), $second->getVideoArray()));
        
        /* the total result count is the max of the two total result counts */
        $result->setEffectiveTotalResultCount(max($first->getEffectiveTotalResultCount(), $second->getEffectiveTotalResultCount()));
        
        return $result;
    }

    private function _usingMultipleModes(org_tubepress_api_exec_ExecutionContext $execContext)
    {
        $mode = $execContext->get(org_tubepress_api_const_options_names_Output::MODE);
        if (strpos($mode, self::DELIM) !== false) {
            return true;
        }
        
        if (org_tubepress_impl_options_OptionsReference::isOptionName($mode . 'Value')) {
            $modeValue = $execContext->get($mode . 'Value');
            return strpos($modeValue, self::DELIM) !== false;
        }
        
        return false;
    }
    
    private function _getModes(org_tubepress_api_exec_ExecutionContext $execContext)
    {
        $mode = $execContext->get(org_tubepress_api_const_options_names_Output::MODE);
        return explode(self::DELIM, $mode);
    }
}
