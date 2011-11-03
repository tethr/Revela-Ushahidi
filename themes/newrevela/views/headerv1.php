<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php echo $header_block; ?>
	<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>
</head>

<body id="page">
	<!-- wrapper -->
	<div class="rapidxwpr floatholder">

		<!-- header -->
		<div id="header">

			<!-- searchbox -->
			<div id="searchbox">
				
				<!-- user actions -->
				<div id="loggedin_user_action" class="clearingfix">
					<?php if($loggedin_username != FALSE){ ?>
						<a href="<?php echo url::site().$loggedin_role;?>"><?php echo $loggedin_username; ?></a> [<a href="<?php echo url::site();?>logout/front"><?php echo Kohana::lang('ui_admin.logout');?></a>]
					<?php } else { ?>
						<a href="<?php echo url::site()."members/";?>"><?php echo Kohana::lang('ui_main.login'); ?></a>
					<?php } ?>
				</div><br/>
				<!-- / user actions -->
				
				<!-- languages -->
				<?php echo $languages;?>
				<!-- / languages -->

				<!-- searchform -->
				<?php echo $search; ?>
				<!-- / searchform -->

			</div>
			<!-- / searchbox -->
			
			<!-- added by peter -->
			<div id="beta">
			
			</div>
			
				<!-- submit incident -->
			<?php echo $submit_btn; ?>
			<!-- / submit incident -->
			
			
			<!-- logo -->
			<?php if($banner == NULL){ ?>
			<div id="logo">
			<!-- Peter: fix to make header logo linkable -->
			<a href="#" class="logolink">&nbsp;</a>
			
				<h1><a href="<?php echo url::site();?>"><?php echo $site_name; ?></a></h1>
				<span><?php echo $site_tagline; ?></span>
			</div>
			<?php }else{ ?>
			<a href="<?php echo url::site();?>"><img src="<?php echo url::base().Kohana::config('upload.relative_directory')."/".$banner; ?>" alt="<?php echo $site_name; ?>" /></a>
			<?php } ?>
			<!-- / logo -->
			
		
			
			
			<!-- peter: sponsors -->
		
			<div id="apoios">
			<div class="smalltext">
			Apoios e Patrocínios:
			</div>
			
			
			<img src="http://www.revela.org.br/themes/newrevela/images/apoios.gif">
			
			</br>
			Powered by the Ushahidi Platform
			
			
			</div>
			
		</div>
		<!-- / header -->

		<!-- main body -->
		<div id="middle">
			<div class="background layoutleft">

				<!-- mainmenu -->
				<div id="mainmenu" class="clearingfix">
					<ul>
						<?php nav::main_tabs($this_page); ?>
					</ul>

				</div>
				<!-- / mainmenu -->
