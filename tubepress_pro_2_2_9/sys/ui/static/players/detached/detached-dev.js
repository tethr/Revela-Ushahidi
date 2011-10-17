/**
 * Copyright 2006 - 2011 Eric D. Hough (http://ehough.com)
 * 
 * This file is part of TubePress (http://tubepress.org) and is released 
 * under the General Public License (GPL) version 3
 *
 * Shrink your JS: http://developer.yahoo.com/yui/compressor/
 */
var TubePressDomPlayer = (function () {
	
	/* this stuff helps compression */
	var events	= TubePressEvents,
		name	= 'detached',
		doc		= jQuery(document),
		jquery	= jQuery,
		tpAjax	= TubePressAjax,
		
		invoke = function (e, videoId, galleryId, width, height) {

			var selector = '#tubepress_detached_player_' + galleryId;
		
			tpAjax.applyLoadingStyle(selector);
			jquery(selector)[0].scrollIntoView(true);
		},
		
		populate = function (e, title, html, height, width, videoId, galleryId) {
			
			var selector = '#tubepress_detached_player_' + galleryId;
			
			jQuery(selector).html(html);
			tpAjax.removeLoadingStyle(selector);
		};

	doc.bind(events.PLAYER_INVOKE + name, invoke);
	doc.bind(events.PLAYER_POPULATE + name, populate);
}());