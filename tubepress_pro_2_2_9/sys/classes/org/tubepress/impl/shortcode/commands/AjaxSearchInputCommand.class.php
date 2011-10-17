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
class org_tubepress_impl_shortcode_commands_AjaxSearchInputCommand extends org_tubepress_impl_shortcode_commands_SearchInputCommand
{
    /**
     * Returns true if this strategy is able to handle
     *  the request.
     *
     * @return boolean True if the strategy can handle the request, false otherwise.
     */
    public function execute($context)
    {
        $ioc         = org_tubepress_impl_ioc_IocContainer::getInstance();
        $execContext = $ioc->get('org_tubepress_api_exec_ExecutionContext');

        if ($execContext->get(org_tubepress_api_const_options_names_Output::OUTPUT) !== org_tubepress_api_const_options_values_OutputValue::AJAX_SEARCH_INPUT) {
            return false;
        }

        $th       = $ioc->get('org_tubepress_api_theme_ThemeHandler');
        $pm       = $ioc->get('org_tubepress_api_plugin_PluginManager');
        $template = $th->getTemplateInstance($this->getTemplatePath());

        /* this will need to be refactored, but it works */
        $shortcode = preg_replace('/\boutput\b/', 'xy', $execContext->getActualShortcodeUsed());
        $shortcode = org_tubepress_impl_util_StringUtils::replaceFirst(']', ' output="searchResults"]', $shortcode);
        
        $template->setVariable(org_tubepress_api_const_template_Variable::SHORTCODE, urlencode($shortcode));
        $template->setVariable(org_tubepress_api_const_template_Variable::SEARCH_TARGET_DOM_ID, $execContext->get(org_tubepress_api_const_options_names_Output::SEARCH_RESULTS_DOM_ID));

        $template = $pm->runFilters(org_tubepress_api_const_plugin_FilterPoint::TEMPLATE_SEARCHINPUT, $template);
        $html     = $pm->runFilters(org_tubepress_api_const_plugin_FilterPoint::HTML_SEARCHINPUT, $template->toString());
        
        $context->returnValue = $html;

        /* signal that we've handled execution */
        return true;
    }

    
    protected function getTemplatePath()
    {
        return 'search/ajax_search_input.tpl.php';
    }
}
