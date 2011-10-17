<div id="infowindow-settings">
	<fieldset>
		<legend><?php print form::label("show_custom_forms",kohana::lang("ui_main.showcustomform_infowindow")); ?></legend>
		<?php print form::label("show_custom_forms",kohana::lang("ui_main.showcustomform")); ?>: 
		<?php print form::checkbox("show_custom_forms","show",$form["show_custom_forms"]); ?>
	</fieldset>
	<br />
	<fieldset>
		<legend><?php print form::label("show_images",kohana::lang("ui_main.showimages_infowindow")); ?></legend>
		<?php print form::label("show_images",kohana::lang("ui_main.showimages")); ?>: 
		<?php print form::checkbox("show_images","show",$form["show_images"]); ?>
	</fieldset>
</div>

