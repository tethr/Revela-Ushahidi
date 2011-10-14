<div class="additional-content">
	<?php if( is_array($photos) ) { ?>
		<div id="thumb_img">
			<h5><?php echo Kohana::config('flickrwijit.flickrwijit_title')?></h5>             
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
<!--         		<a href="flickrwijit"><?php echo Kohana::lang('flickrwijit.flickrwijit_more')?></a> -->
    	</div>
	<?php } else { ?>
		No flickr photos
	<?php }?>
</div>