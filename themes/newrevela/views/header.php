<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
  
    $tubepress_base_url = "http://www.revela.org.br/tubepress_pro_2_2_9/";
  
    include "/opt/Revela-Ushahidi/tubepress_pro_2_2_9/sys/classes/TubePressPro.class.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php echo $header_block; ?>
	<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>
    
<script type='text/javascript' src='http://www.revela.org.br/tubepress_pro_2_2_9/sys/ui/static/js/tubepress.js'></script>
<link rel='stylesheet' href='http://www.revela.org.br/tubepress_pro_2_2_9/sys/ui/themes/default/style.css' type='text/css' />
<script type="text/javascript">function getTubePressBaseUrl(){return "http://www.revela.org.br/tubepress_pro_2_2_9";}</script>

<script src="/scripts/jquery.tools.min.js"></script>


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
			<li> <a href="http://www.facebook.com/pages/Revela/217569061637691" target="_blank"><img src="http://www.revela.org.br/themes/newrevela/images/social_fb.png"></a></li>
			<li> <a href="http://twitter.com/#!/search/revela" target="_blank"><img src="http://www.revela.org.br/themes/newrevela/images/social_tw.png"></a></li>
			<li> <a href="http://www.orkut.com.br/Community?rl=cpp&cmm=118347909"><img src="http://www.revela.org.br/themes/newrevela/images/social_or.png"></a></li>

			</ul>
		</div>
		
			<div id="android">
			<ul>
			<li> <a href="#">iphone</a></li>
			<li> <a href="#">Android</a></li>

			</ul>
		</div>
		
		<div id="sms">
			SMS: xx 91 9226 5118
			</div>
			
			
			</div>
			<!-- / searchbox -->
			

			
			
			
			
			<!-- logo -->
			<?php if($banner == NULL){ ?>
			<div id="logo">
			<!-- Peter: fix to make header logo linkable -->
			<a href="/" class="v">&nbsp;</a>
			
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
			
			
			<img src="http://www.revela.org.br/themes/newrevela/images/apoios.gif">
			
			</br>
			Powered by the Ushahidi Platform
			
			
			</div>
-->
			
						<!-- added by peter -->
			<div id="beta">
				<a href="#"><img src="http://www.revela.org.br/themes/newrevela/images/rss.png" class="rssbutton"></a>
			</div>
			
			<div id="logomenu" class="clearingfix">
					<ul>
						<li> <a href="/blog/?page_id=59">Quem Somos</a> </li>					
						<li> <a href="/blog/?page_id=67">Links Úteis</a> </li>	
						<li> <a href="/blog/?page_id=91">Contatos</a> </li>	 
					</ul>
			</div> <!-- end logo menu -->
			
			<div id="slogan">
			<span class="slogg">A sua plataforma</br> de ativismo digital.</span>
			
			
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
