<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php 
/**
 * This file demonstrates how to use TubePress Pro in standalone PHP. There are
 * 4 steps. Please see the documentation for full details.
 */

/*
 * STEP 1/4
 * 
 * Set $tubepress_base_url to the web-accessible URL of your TubePress installation. Make sure this
 *  variable is in global scope (i.e. not inside any code block)
 */
$tubepress_base_url = 'http://3hough.pb/wp-content/plugins/tubepress-pro/';

/*
 * STEP 2/4
 * 
 * Include TubePressPro.class.php. An absolute path on your filesystem is the least error prone.
 */
include '/Applications/MAMP/htdocs/tubepress_testing_ground/wp-content/plugins/tubepress-pro/sys/classes/TubePressPro.class.php';
?>

<html>
	<head>
		<title>TubePress Pro in standalone PHP</title>

		<!-- STEP 3/4
		    
		     Include this statement inside the HEAD of your HTML document. getHtmlForHead() takes a single boolean
		      argument indicating whether or not to automatically include jQuery. If you are including jQuery elsewhere
		      in your project, use false.
		-->
		<?php print TubePressPro::getHtmlForHead(true); ?>

    </head>
    <body>
		<div>

			<!-- STEP 4/4
			
			     Invoke TubePress! See the documentation for all the different HTML that TubePress can generate for you.
			-->
            <?php print TubePressPro::getHtmlForShortcode("resultsPerPage='20' mode='user' playerLocation='fancybox' ajaxPagination='true'"); ?>

		</div>
	</body>
</html>