<?php
/**
 * Help view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     API Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */
?>

<div id="content">
<div class="content-bg"><!-- start reports block -->
<div class="big-block">
<div id="page_wrapper"><?php if( is_array($photos) && count($photos) != 0 ) { ?>
<div id="thumb_img">
<h5><?php echo Kohana::config('flickrwijit.flickrwijit_title')?></h5>
<div class="thumb">
<ul id="thumbnails">
<?php
foreach( (array)$photos['photo'] as $photo ) {
	print "<li><a class=\"photothumb\" rel=\"lightbox-group1\" href=\"".$f->buildPhotoURL($photo)."\" title=\"".$photo['title']." \">
        				<img  alt=\"".$photo['title']."\" title=\"".$photo['title']."\" 
        				src=\"".$f->buildPhotoURL($photo,'Square')."\"/></a></li>";
	$owner = $f->people_getInfo( $photo['owner'] );
}
?>
</ul>
<?php echo $pagination; ?>
</div>
</div>
<?php } else { echo Kohana::lang('flickrwijit.flickrwijit_no_photo'); }?></div>

</div>
<!-- end reports block --></div>
</div>
