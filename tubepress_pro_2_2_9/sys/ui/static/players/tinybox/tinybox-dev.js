/**
 * Copyright 2006 - 2011 Eric D. Hough (http://ehough.com)
 * 
 * This file is part of TubePress (http://tubepress.org) and is released 
 * under the General Public License (GPL) version 3
 *
 * Shrink your JS: http://developer.yahoo.com/yui/compressor/
 */
var TubePressTinyBoxPlayer = (function () {
	
	/* this stuff helps compression */
	var events	= TubePressEvents,
		name	= 'tinybox',
		doc		= jQuery(document),
		path	= getTubePressBaseUrl() + '/sys/ui/static/players/tinybox/lib/',
		
		invoke = function (e, videoId, galleryId, width, height) {

			TINY.box.show('',0,width,height,1);
		},
		
		populate = function (e, title, html, height, width, videoId, galleryId) {

			var element = jQuery('#tinycontent');
			
			if (element.width() !== parseInt(width, 10)) {

				setTimeout(function () {
					populate(e, title, html, height, width, videoId, galleryId);
				}, 10);
				
			} else {
				jQuery('#tinycontent').html(html);
			}
		};

	jQuery.getScript(path + 'tinybox.js', function () {}, true);
	TubePressCss.load(path + 'style.css');
		
	doc.bind(events.PLAYER_INVOKE + name, invoke);
	doc.bind(events.PLAYER_POPULATE + name, populate);
}());