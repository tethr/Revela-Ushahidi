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
 */
/**
 * Handles generation of the HTML for an embedded player. This expects exactly 3 GET
 * paramters: embedName (the string name of the embedded player implementation),
 * video (the video ID to load), meta (true/false whether or not to include video meta info)
 */
class_exists('org_tubepress_impl_classloader_ClassLoader') || require dirname(__FILE__) . '/../../classes/org/tubepress/impl/classloader/ClassLoader.class.php';
org_tubepress_impl_classloader_ClassLoader::loadClasses(array(
    'org_tubepress_api_const_options_names_Advanced',
	'org_tubepress_api_querystring_QueryStringService',
    'org_tubepress_impl_ioc_IocContainer'
));

require dirname(__FILE__) . '/../wordpress/loader.php';

/* boot TubePress */
$booter = $ioc->get('org_tubepress_api_bootstrap_Bootstrapper');
$booter->boot();

$context  = $ioc->get('org_tubepress_api_exec_ExecutionContext');
$player   = $ioc->get('org_tubepress_api_player_PlayerHtmlGenerator');
$provider = $ioc->get('org_tubepress_api_provider_Provider');
$qss      = $ioc->get('org_tubepress_api_querystring_QueryStringService');
$sp       = $ioc->get('org_tubepress_api_shortcode_ShortcodeParser');

$shortcode = rawurldecode($qss->getShortcode($_GET));
$videoId   = $qss->getCustomVideo($_GET);

/* gather up the options */
$sp->parse($shortcode);
if ($context->get(org_tubepress_api_const_options_names_Embedded::LAZYPLAY)) {
    $context->set(org_tubepress_api_const_options_names_Embedded::AUTOPLAY, true);
}

/* grab the video! */
try {
    $video = $provider->getSingleVideo($videoId);
} catch (Exception $e) {
    org_tubepress_impl_log_Log::log('Player HTML', $e->getMessage());
    header("Status: 404 Not Found");
    exit;
}

$title = rawurlencode($video->getTitle());
$html  = rawurlencode($player->getHtml($video));

header('HTTP/1.1 200 OK');
echo "{ \"title\" : \"$title\", \"html\" : \"$html\" }";