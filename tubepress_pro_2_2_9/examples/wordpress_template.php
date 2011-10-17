<?php
/**
 * This example shows how to use TubePress Pro in a WordPress environment, but outside of a WordPress
 * post or page (e.g. in a WordPress template file). Most of the content here is copied from
 * the "World's Simplest Index Page": http://codex.wordpress.org/The_Loop_in_Action
 * 
 * In this example, we're adding a TubePress gallery just after the call to "get_header"
 */

/*
 * STEP 1/2
 * 
 * Include TubePressPro.class.php. An absolute path on your filesystem is the least error prone.
 */
include '/Applications/MAMP/htdocs/tubepress_testing_ground/wp-content/plugins/tubepress-pro/sys/classes/TubePressPro.class.php';

get_header();

/*
 * STEP 2/2
 * 
 * Invoke TubePress! See the documentation for all the different HTML that TubePress can generate for you.
 */
print TubePressPro::getHtmlForShortcode("resultsPerPage='20' mode='user' playerLocation='fancybox' ajaxPagination='true'");

if (have_posts()) :
   while (have_posts()) :
      the_post();
      the_content();
   endwhile;
endif;
get_sidebar();
get_footer(); 