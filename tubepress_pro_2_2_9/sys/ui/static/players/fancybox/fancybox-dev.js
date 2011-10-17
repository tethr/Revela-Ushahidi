/**
 * Copyright 2006 - 2011 Eric D. Hough (http://ehough.com)
 * 
 * This file is part of TubePress (http://tubepress.org) and is released 
 * under the General Public License (GPL) version 3
 *
 * Shrink your JS: http://developer.yahoo.com/yui/compressor/
 */
var TubePressFancyboxPlayer = (function () {
	
	/* this stuff helps compression */
	var events	= TubePressEvents,
		name	= 'fancybox',
		doc		= jQuery(document),
		path	= getTubePressBaseUrl() + '/sys/ui/static/players/fancybox/lib/',
		
		invoke = function (e, videoId, galleryId, width, height) {

			jQuery.fancybox.showActivity();
		},
		
		populate = function (e, title, html, height, width, videoId, galleryId) {

			jQuery.fancybox({
				'content' 			: html,
				'height' 			: parseInt(height, 10) + 5,
				'width' 			: width,
				'autoDimensions' 	: false,
				'title' 			: title
			});
		};

	jQuery.getScript(path + 'jquery.fancybox-1.3.4.js', function () {}, true);
	TubePressCss.load(path + 'jquery.fancybox-1.3.4.css');
		
	doc.bind(events.PLAYER_INVOKE + name, invoke);
	doc.bind(events.PLAYER_POPULATE + name, populate);
}());