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

class_exists('org_tubepress_impl_classloader_ClassLoader') || require dirname(__FILE__) . '/../../../classloader/ClassLoader.class.php';
org_tubepress_impl_classloader_ClassLoader::loadClasses(array(
    'org_tubepress_api_const_options_CategoryName',
    'org_tubepress_api_const_template_Variable',
    'org_tubepress_api_const_template_Variable',
    'org_tubepress_api_message_MessageService',
    'org_tubepress_api_exec_ExecutionContext',
    'org_tubepress_api_provider_Provider',
    'org_tubepress_api_template_Template',
    'org_tubepress_impl_ioc_IocContainer',
    'org_tubepress_impl_options_OptionsReference',
));

/**
 * Handles applying video meta info to the gallery template.
 */
class org_tubepress_impl_plugin_filters_gallerytemplate_VideoMeta
{
    public function alter_galleryTemplate(org_tubepress_api_template_Template $template, org_tubepress_api_provider_ProviderResult $providerResult, $page, $providerName)
    {
        $ioc            = org_tubepress_impl_ioc_IocContainer::getInstance();
        $context        = $ioc->get('org_tubepress_api_exec_ExecutionContext');
        $messageService = $ioc->get('org_tubepress_api_message_MessageService');

        $metaNames  = org_tubepress_impl_options_OptionsReference::getOptionNamesForCategory(org_tubepress_api_const_options_CategoryName::META);
        $shouldShow = array();
        $labels     = array();

        foreach ($metaNames as $metaName) {
            $shouldShow[$metaName] = $context->get($metaName);
            $labels[$metaName]     = $messageService->_('video-' . $metaName);
        }

        $template->setVariable(org_tubepress_api_const_template_Variable::META_SHOULD_SHOW, $shouldShow);
        $template->setVariable(org_tubepress_api_const_template_Variable::META_LABELS, $labels);

        return $template;
    }
}
