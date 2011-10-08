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
				

				<!-- searchform -->
				<?php echo $search; ?>
				<!-- / searchform -->


	<div id="socialicons">
			<ul class="socialicons">
			<li> <a href="#"><img src="http://revela.dev.tethr.org/themes/newrevela/images/social_fb.png"></a></li>
			<li> <a href="#"><img src="http://revela.dev.tethr.org/themes/newrevela/images/social_tw.png"></a></li>
			<li> <a href="#"><img src="http://revela.dev.tethr.org/themes/newrevela/images/social_or.png"></a></li>

			</ul>
		</div>
		
			<div id="android">
			<ul>
			<li> <a href="#">iphone</a></li>
			<li> <a href="#">Android</a></li>

			</ul>
		</div>
		
		
			</div>
			<!-- / searchbox -->
			

			
			
			
			
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
			
			
				<!-- submit incident -->
			<?php echo $submit_btn; ?>
			<!-- / submit incident -->
			
			
			<!-- peter: sponsors -->
		<!--

			<div id="apoios">
			<div class="smalltext">
			Apoios e Patrocínios:
			</div>
			
			
			<img src="http://revela.dev.tethr.org/themes/newrevela/images/apoios.gif">
			
			</br>
			Powered by the Ushahidi Platform
			
			
			</div>
-->
			
						<!-- added by peter -->
			<div id="beta">
				<a href="#"><img src="http://revela.dev.tethr.org/themes/newrevela/images/rss.png" class="rssbutton"></a>
			</div>
			
			<div id="logomenu" class="clearingfix">
					<ul>
						<li> <a href="#">Quem Somo?</a> </li>					
						<li> <a href="#">Links Úteis</a> </li>	
						<li> <a href="#">Contatos</a> </li>	
					</ul>
			</div> <!-- end logo menu -->
			
			<div id="slogan">
			A sua plataforma</br> de ativismo digital.
			
			<div id="sms">
			SMS: xx 91 9226 5118
			</div>
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
