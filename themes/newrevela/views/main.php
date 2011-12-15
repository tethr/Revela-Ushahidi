<!-- main body -->
<div id="main" class="clearingfix">
	<div id="mainmiddle" class="floatbox withright">

	<?php if($site_message != '') { ?>
		<div class="green-box">
			<h3><?php echo $site_message; ?></h3>
		</div>
	<?php } ?>

		<!-- right column -->
		<div id="right" class="clearingfix">
	
			<!-- peter: category filters were here 
			
			started adding social etc here, above this, dont know what is the Layers (KML/KMZ) -->
			
			
	<div id="social">
			
	<!--
	<div id="socialicons">
			<ul class="socialicons">
			<li> <a href="#"><img src="http://www.revela.org.br/themes/newrevela/images/social_fb.png"></a></li>
			<li> <a href="#"><img src="http://www.revela.org.br/themes/newrevela/images/social_tw.png"></a></li>
			<li> <a href="#"><img src="http://www.revela.org.br/themes/newrevela/images/social_go.png"></a></li>
			<li> <a href="#"><img src="http://www.revela.org.br/themes/newrevela/images/social_or.png"></a></li>

			</ul>
		</div>
-->
								<a href="/reports/submit"><img src="http://www.revela.org.br/themes/newrevela/images/revalabutton.png" class="bigrevelabutton"> </a>

		<div id="threeclicks">




	

			<h4><a href="/blog/?page_id=70">Como participar &raquo;</a></h4>
 			<h4>Revela em 3 cliques!</h4> 
 			
<div id="threeclicknums">
	
<!-- <div class="threeclicksred"><img src="http://www.revela.org.br/themes/newrevela/images/123-new.png"></div> -->

			<ul>
			<li class="veja has_tooltip" title="<strong>Veja</strong><br><br>Registre tudo aquilo que você considera que vai tornar nosso planeta um lugar
melhor de morar. Viu alguém fazendo algo de errado? Destruiu, sujou ou
queimou? Revela!
<br><br>
Ou soube de uma ótima de idéia de um grupo de amigos, vizinhos, empresa , enfim,
algo que você acha que deveria ser divulgado de tão bacana que é? Revela
também!
<br><br>
Cuide do seu país, ajude a construir uma rede de informações da real situação de
nosso meio ambiente. Cadastre no mapa colaborativo todas as informações que você
tiver."> <img src="/themes/newrevela/images/num1.png"><a href="#">Veja</a></li>
			<li class="revele has_tooltip" title="<strong>Envie</strong><br><br>
			1. <a href='/reports/submit'>Preencha este formulário</a>
			<br>
2. Mande um SMS para o número: xx 91 9226-5118. Escreva se é uma denúncia
ou ação positiva e descreva o que está acontecendo. Coloque o endereço( rua,
cidade, CEP se souber) ou <a href='http://educacao.uol.com.br/geografia/coordenadas-geograficas-latitude-longitude-e-gps.jhtm'>Coordenadas geógraficas</a>. Assine, se quiser, e envie.
<br>
3. Aplicativos para Android e iPhone: Visite o site <a href='http://www.revela.org.br'>www.revela.org.br</a> a partir de
seu smartphone para baixá-los."><img src="/themes/newrevela/images/num2.png"><a href="#">Envie</a></li>
			<li class="esclareca has_tooltip" title="<strong>Transforme</strong><br><br>
As informações que você e todas as pessoas cadastram no mapa tornam-se
disponíveis para organizações não governamentais e instituições que protegem a
natureza, para o poder público, imprensa, enfim, a todos.
<br><br>
Com elas poderão ser feitas investigações sobre as denúncias, verificar o que está de
fato acontecendo.
<br><br>
Já as boas ações poderão ser divulgadas, seguidas, transformadas. Ou seja – podem
se transformar em exemplos para todos nós."><img src="/themes/newrevela/images/num3.png"> <a href="#">Transforme</a></li>

			</ul>
			</div>
		</div>

			
	<!--
	<div id="android">
			<h4>Baixe o Aplicativo Revela</h4>
			<ul>
			<li> <a href="#">iphone</a></li>
			<li> <a href="#">Android</a></li>

			</ul>
		</div>
-->
			
			
			</div> <!-- end social -->
			
			<div id="categorieswrapper">
						<div id="catwrapertop">&nbsp;</div>

							
				<!-- category filters 
				// peter: add the category filter here....
				-->
				<div id="cat-filters-placer">
			<!-- peter: 	this makes it hide and open, seems unnessary
<div class="cat-filters clearingfix">
				<strong><?php echo Kohana::lang('ui_main.category_filter');?> <span>[<a href="javascript:toggleLayer('category_switch_link', 'category_switch')" id="category_switch_link"><?php echo Kohana::lang('ui_main.hide'); ?></a>]</span></strong>
			</div>
-->

		
			<ul id="category_switch" class="category-filters">
				<li><a class="active" id="cat_0" href="#"><span class="swatch" style="background-color:<?php echo "#".$default_map_all;?>"></span><span class="category-title"><?php echo Kohana::lang('ui_main.all_categories');?></span></a></li>
				<?php
					foreach ($categories as $category => $category_info)
					{
						$category_title = $category_info[0];
						$category_color = $category_info[1];
						$category_image = '';
						$color_css = 'class="swatch" style="background-color:#'.$category_color.'"';
						if($category_info[2] != NULL && file_exists(Kohana::config('upload.relative_directory').'/'.$category_info[2])) {
							$category_image = html::image(array(
								'src'=>Kohana::config('upload.relative_directory').'/'.$category_info[2],
								'style'=>'float:left;padding-right:5px;'
								));
							$color_css = '';
						}
						echo '<li><a href="#" id="cat_'. $category .'"><span '.$color_css.'>'.$category_image.'</span><span class="category-title">'.$category_title.'</span></a>';
						// Get Children
						echo '<div class="hide" id="child_'. $category .'">';
                                                if( sizeof($category_info[3]) != 0)
                                                {
                                                    echo '<ul>';
                                                    foreach ($category_info[3] as $child => $child_info)
                                                    {
                                                            $child_title = $child_info[0];
                                                            $child_color = $child_info[1];
                                                            $child_image = '';
                                                            $color_css = 'class="swatch" style="background-color:#'.$child_color.'"';
                                                            if($child_info[2] != NULL && file_exists(Kohana::config('upload.relative_directory').'/'.$child_info[2])) {
                                                                    $child_image = html::image(array(
                                                                            'src'=>Kohana::config('upload.relative_directory').'/'.$child_info[2],
                                                                            'style'=>'float:left;padding-right:5px;'
                                                                            ));
                                                                    $color_css = '';
                                                            }
                                                            echo '<li style="padding-left:20px;"><a href="#" id="cat_'. $child .'"><span '.$color_css.'>'.$child_image.'</span><span class="category-title">'.$child_title.'</span></a></li>';
                                                    }
                                                    echo '</ul>';
                                                }
						echo '</div></li>';
					}
				?>
			</ul>
			
			
			
			
			
<div id="kml">
						
			<?php
			if ($layers)
			{
				?>
				<!-- Layers (KML/KMZ) -->
				<div class="cat-filters clearingfix" style="margin-top:20px;">
					<strong><?php echo Kohana::lang('ui_main.layers_filter');?> <span>[<a href="javascript:toggleLayer('kml_switch_link', 'kml_switch')" id="kml_switch_link"><?php echo Kohana::lang('ui_main.hide'); ?></a>]</span></strong>
				</div>
				<ul id="kml_switch" class="category-filters">
					<?php
					foreach ($layers as $layer => $layer_info)
					{
						$layer_name = $layer_info[0];
						$layer_color = $layer_info[1];
						$layer_url = $layer_info[2];
						$layer_file = $layer_info[3];
						$layer_link = (!$layer_url) ?
							url::base().Kohana::config('upload.relative_directory').'/'.$layer_file :
							$layer_url;
						echo '<li><a href="#" id="layer_'. $layer .'"
						onclick="switchLayer(\''.$layer.'\',\''.$layer_link.'\',\''.$layer_color.'\'); return false;"><div class="swatch" style="background-color:#'.$layer_color.'"></div>
						<div>'.$layer_name.'</div></a></li>';
					}
					?>
				</ul>
				<!-- /Layers -->
				<?php
			}
			?>
			
			</div> <!-- kml END -->
			
			
			
			
			
			</div>
			
			<!-- / category filters -->


			
			
			
			</div> <!-- end categories wrapper -->
			
			
	<!--
	<div id="florestral">
			
			<h4>Votação dia 20 de outubro.</h4>
			<div class="florestralwidget">
			
Antes de se preocupar com o mundo, preocupe se com si mesmo.Se a questão é a fome, parem de exportar e negociem com a população faminta do Brasil. Plenário esta dividido.
			</div>
			
		</div>
--> <!-- end florestral -->
			
			
			<!--<div id="poststweeterwrapper">
			
			<div id="noticias">
			what goes here? i recommend an iFrame for both, quick and easy.
			</div>
			
			<div id="tweets">
			twweeettss!
		
			</div>
			
			
			</div>  end posts tweeter wrapper -->
			
		<!--	<div id="gallery">
			<h4>Ativismo e arte</h4>
			<div id="gallerywrapper">
			gallery here
			</div>  
			
			<div id="gallerymenu">
			<ul>
			<li> <a href="#">Galeria</a></li>
			<li> <a href="#">Participe</a></li>

			</ul>
			</div>
			</div>
			--> <!-- end gallery div -->

			
			
			<?php
			if ($shares)
			{
				?>
				<!-- Layers (Other Ushahidi Layers) -->
				<div class="cat-filters clearingfix" style="margin-top:20px;">
					<strong><?php echo Kohana::lang('ui_main.other_ushahidi_instances');?> <span>[<a href="javascript:toggleLayer('sharing_switch_link', 'sharing_switch')" id="sharing_switch_link"><?php echo Kohana::lang('ui_main.hide'); ?></a>]</span></strong>
				</div>
				<ul id="sharing_switch" class="category-filters">
					<?php
					foreach ($shares as $share => $share_info)
					{
						$sharing_name = $share_info[0];
						$sharing_color = $share_info[1];
						echo '<li><a href="#" id="share_'. $share .'"><div class="swatch" style="background-color:#'.$sharing_color.'"></div>
						<div>'.$sharing_name.'</div></a></li>';
					}
					?>
				</ul>
				<!-- /Layers -->
				<?php
			}
			?>
			
			
			<br />
		
			<!-- additional content -->
			
			
			
			
		<!-- peter: this is for leaving reports, maby should be cut somewhere but where...
	<?php
			if (Kohana::config('settings.allow_reports'))
			{
				?>
				<div class="additional-content">
					<h5><?php echo Kohana::lang('ui_main.how_to_report'); ?></h5>
					<ol>
						<?php if (!empty($phone_array)) 
						{ ?><li><?php echo Kohana::lang('ui_main.report_option_1')." "; ?> <?php foreach ($phone_array as $phone) {
							echo "<strong>". $phone ."</strong>";
							if ($phone != end($phone_array)) {
								echo " or ";
							}
						} ?></li><?php } ?>
						<?php if (!empty($report_email)) 
						{ ?><li><?php echo Kohana::lang('ui_main.report_option_2')." "; ?> <a href="mailto:<?php echo $report_email?>"><?php echo $report_email?></a></li><?php } ?>
						<?php if (!empty($twitter_hashtag_array)) 
									{ ?><li><?php echo Kohana::lang('ui_main.report_option_3')." "; ?> <?php foreach ($twitter_hashtag_array as $twitter_hashtag) {
						echo "<strong>". $twitter_hashtag ."</strong>";
						if ($twitter_hashtag != end($twitter_hashtag_array)) {
							echo " or ";
						}
						} ?></li><?php
						} ?><li><a href="<?php echo url::site() . 'reports/submit/'; ?>"><?php echo Kohana::lang('ui_main.report_option_4'); ?></a></li>
					</ol>

				</div>
			<?php } ?>
-->
			<!-- / additional content -->
			
	
	
		</div>
		<!-- / right column -->
	
		<!-- content column -->
		<div id="content" class="clearingfix">
			<div class="floatbox">

				<!-- filters -->
				<div class="filters clearingfix">
				
					<!-- peter: hide this, random horizontal filter menu
<div style="float:left; width: 100%">
						<strong><?php echo Kohana::lang('ui_main.filters'); ?></strong>
						<ul>
							<li><a id="media_0" class="active" href="#"><span><?php echo Kohana::lang('ui_main.reports'); ?></span></a></li>
							<li><a id="media_4" href="#"><span><?php echo Kohana::lang('ui_main.news'); ?></span></a></li>
							<li><a id="media_1" href="#"><span><?php echo Kohana::lang('ui_main.pictures'); ?></span></a></li>
							<li><a id="media_2" href="#"><span><?php echo Kohana::lang('ui_main.video'); ?></span></a></li>
							<li><a id="media_0" href="#"><span><?php echo Kohana::lang('ui_main.all'); ?></span></a></li>
						</ul>
					</div>
-->


					<?php
					// Action::main_filters - Add items to the main_filters
					Event::run('ushahidi_action.map_main_filters');
					?>
				</div>
				<!-- / filters -->

				<div id="mapwrapper">
				<?php								
				// Map and Timeline Blocks
				echo $div_map;
				?>
				
				
<!-- MAP CATEGORIES WERE HERE -->




				<!-- peter: seems that this is not used -->
				<?php
 				echo $div_timeline; 
				?>
				
				</div> <!-- end map wrapper -->
				
								
				
			</div>
		</div>
		<!-- / content column -->

	</div>
</div>
<!-- / main body -->

<!-- content -->

<div id="footcontent">

<table width="980" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <div id="tickerbox">
    <a href="/blog" class="noticiaslink">&nbsp;</a>
					
						<!-- content blocks -->
	<div class="content-blocks clearingfix">
		<ul class="content-column">
			<?php blocks::render(); ?>
		</ul>
	</div>
	<!-- /content blocks -->
	
	
					</div> <!-- end tickerbox -->
					</td>
    <td>
							<div id="videoswrapper">
							<div id="videoplayer">
					
<!-- <iframe src="http://player.vimeo.com/video/30072405?title=0&amp;byline=0&amp;portrait=0" width="350" height="240" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe> -->




<?php print TubePressPro::getHtmlForShortcode('mode="vimeoUploadedBy" vimeoUploadedByValue="user8703154" embeddedWidth="350"  embeddedHeight="200" vimeoKey="218b52de9297d15c7ad833b97779b29b" vimeoSecret="cb9f8aa02471138d"'); ?>
					</div>
					
					
					</div> <!-- end videoswrapper -->
					
					</td>
    <td>
    <div id="tweeterwrapper">

<div id="tweets">
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '#PortalRevela OR @imaflora OR @imazon OR from:imazon OR from:imaflora',
  interval: 30000,
  title: 'Revela Tweets',
  subject: '',
  width: 'auto',
  height: 300,
  theme: {
    shell: {
      background: 'none',
      color: '`'
    },
    tweets: {
      background: 'none',
      color: '#444444',
      links: '#1985b5'
    }
  },
  features: {
    scrollbar: true,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    toptweets: true,
    behavior: 'default'
  }
}).render().start();
</script>
</div>
</div>

</td>
  </tr>
</table>


					
					
					
		<div id="gallerycontainer">

			<div id="gallerywrapperusha">				
								
			<!-- <ul id="cycle"></ul> -->
			
						<?php
						// Action::main_sidebar - Add Items to the Entry Page Sidebar
						//Event::run('ushahidi_action.main_sidebar');
						?>
						<div id="artemenu"> 
								<ul>
									<li> <a href="/blog/?page_id=56">Galeria</a> </li>					
									<li> <a href="/blog/?page_id=121">Participe</a> </li>	
								</ul>
						</div> <!-- end galmenu div -->
						
						<iframe src="/blog/?page_id=31" width="100%" height="400" frameborder="0" scrolling="no">
			  				<p>Your browser does not support iframes.</p>
						</iframe>
			</div>	<!-- end gallery wraper -->
		</div>





	

				<div id="legaltext">
Texto Legal - Política de Privacidade


			<a href="http://ushahidi.com" class="footerushahidilink" target="_blank>">&nbsp;</a>

				</div> <!-- end legal text -->

<!-- span class="patrons"><img src="http://www.revela.org.br/themes/newrevela/images/patrons1.jpg"></span -->
</div> <!-- end foot content -->




