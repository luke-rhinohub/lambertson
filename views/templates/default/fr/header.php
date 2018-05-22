<?
header("Content-type: text/html; charset=iso-8859-1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?=(@$page['title'] != "" ? utf8_decode($page['title'])." | " : "")?>Lambertson</title>
		<link rel="apple-touch-icon" sizes="57x57" href="<?=base_url()?>images/favicons/apple-touch-icon-57x57.png"/>
		<link rel="apple-touch-icon" sizes="60x60" href="<?=base_url()?>images/favicons/apple-touch-icon-60x60.png"/>
		<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url()?>images/favicons/apple-touch-icon-72x72.png"/>
		<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>images/favicons/apple-touch-icon-76x76.png"/>
		<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url()?>images/favicons/apple-touch-icon-114x114.png"/>
		<link rel="apple-touch-icon" sizes="120x120" href="<?=base_url()?>images/favicons/apple-touch-icon-120x120.png"/>
		<link rel="apple-touch-icon" sizes="144x144" href="<?=base_url()?>images/favicons/apple-touch-icon-144x144.png"/>
		<link rel="apple-touch-icon" sizes="152x152" href="<?=base_url()?>images/favicons/apple-touch-icon-152x152.png"/>
		<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>images/favicons/apple-touch-icon-180x180.png"/>
		<link rel="icon" type="image/png" href="<?=base_url()?>images/favicons/favicon-32x32.png" sizes="32x32"/>
		<link rel="icon" type="image/png" href="<?=base_url()?>images/favicons/favicon-194x194.png" sizes="194x194"/>
		<link rel="icon" type="image/png" href="<?=base_url()?>images/favicons/favicon-96x96.png" sizes="96x96"/>
		<link rel="icon" type="image/png" href="<?=base_url()?>images/favicons/android-chrome-192x192.png" sizes="192x192"/>
		<link rel="icon" type="image/png" href="<?=base_url()?>images/favicons/favicon-16x16.png" sizes="16x16"/>
		<link rel="manifest" href="<?=base_url()?>images/favicons/manifest.json"/>
		<link rel="shortcut icon" href="<?=base_url()?>images/favicons/favicon.ico"/>
		<link rel="mask-icon" href="<?=base_url()?>images/favicons/safari-pinned-tab.svg" color="#5bbad5"/>
		<meta name="msapplication-TileColor" content="#2b5797"/>
		<meta name="msapplication-TileImage" content="<?=base_url()?>images/favicons/mstile-144x144.png"/>
		<meta name="msapplication-config" content="<?=base_url()?>images/favicons/browserconfig.xml"/>
		<meta name="theme-color" content="#ffffff"/>
		<link rel="stylesheet" href="<?=base_url()?>css/style.css" type="text/css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>	
		<script src="<?=base_url()?>jscripts/bxslider/jquery.bxslider.js" type="text/javascript"></script>	
		<link href="<?=base_url()?>jscripts/bxslider/jquery.bxslider.css" rel="stylesheet" type="text/css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>		
		<!--[if lte IE 8]>
		<style type="text/css">
			@font-face
			{
				font-family: ArialNarrow;	
				src: url('../assets/fonts/arial-narrow.eot');
				src: url('../assets/fonts/arial-narrow.eot?#iefix') format('embedded-opentype');		 
			}
			@font-face
			{
				font-family: Hero;	
				src: url('../assets/fonts/hero.eot');
				src: url('../assets/fonts/hero.eot?#iefix') format('embedded-opentype');		 
			}
			@font-face
			{
				font-family: HeroLight;	
				src: url('../assets/fonts/hero-light.eot');
				src: url('../assets/fonts/hero-light.eot?#iefix') format('embedded-opentype');		 
			}			
		</style>
		<![endif]--> 
	</head>	
	<body>
		<script type="text/javascript">	
			$(document).ready(function() {	
				$("#show-menu").click(function() {				
					$('#menu_small .wrap > ul').toggle('fast');								
				});	
			});			
			$(window).resize(function() {			
				if($(window).width() > 1000)
					$('#menu_small .wrap > ul').removeAttr("style");
			});
		</script>
		<div id="menu_top">	
				<div class="wrap nopadding">
					<a href="<?=base_url()?>fr/page/financement-en-ligne" class="btn">Financement en ligne</a>
					<a href="<?=base_url()?>fr/page/documentation">Documentation</a>
					<div class="separator">|</div>
					<a href="<?=base_url()?>fr/page/demande-de-prix">Demande de prix</a>
					<!--<a href="<?=base_url()?>fr/page/distributeurs">Distributeurs</a>
					<div class="separator">|</div>
					<a href="<?=base_url()?>fr/page/acces-revendeur">Acc&egrave;s revendeur</a>-->
					<a href="<?=base_url()?>en/<?=$url_en?>" class="english">English</a>
				</div>
			</div>
			<div id="menu">	
				<div class="wrap nopadding" id="menu_container">
					<a href="<?=base_url()?>fr"><img src="<?=base_url()?>images/logo.png" alt="Sipromac" class="logo"></a>
					<div id="menu_onglets">	
						<ul>				
							<?if(isset($pages)) :
								$need_close_submenu = 0;		
								foreach ($pages as $key => $p) : 
									if($p->page_id != 9 && $p->page_id != 19 && $p->page_id != 20 && $p->page_id != 21):?>
										<?if($p->parent_id == 0):?>
											<?if($need_close_submenu): $need_close_submenu = 0;?>
												</li>
												</ul>
											<?endif;?>
											<?if($key != 0):?>
												</li>
												<li class="separator">
													|
												</li>
											<?endif;?>
												<li <?=($p->url_title == $parent_url_title) ? "class='activeM'" : ""?>>
												<?if($p->page_id == 5):
													$url = 'equipements';									
												else :
													$url = 'page/'.$p->url_title;
												endif;?>
												<a href="<?=base_url()?>fr/<?=$url?>"><?=utf8_decode($p->title)?></a>			
										<?else :?>	
											<?if(!$need_close_submenu): $need_close_submenu = 1;?>
												<ul class="submenu">
											<?else:?>
												</li> 								
												<li class="separator"></li>
											<?endif;?>
											<?if($p->page_id == 13 || $p->page_id == 14)
												$url = 'equipements';
											else
												$url = 'page';?>
												<li <?=($p->url_title == $child_url_title)? "class='activeM'" : ""?>><a href="<?=base_url()?>fr/<?=$url.'/'.$p->url_title?>"><?=utf8_decode($p->title)?></a> 							
										<?endif;?>					
									<?endif;
								endforeach;?>
								<?if($need_close_submenu) : ?>
										</li>
									</ul>
								<?endif;?>
								</li>
							<?endif;?>	
						</ul>
						<a href="http://www.partstown.com/sipromac/parts" target="_blank"><img src="<?=base_url();?>images/partstown_fr.png" alt="Partstown" id="partstown"/></a>
					</div>						
				</div>
			</div>
			<div id="menu_small">
				<div class="wrap nopadding">
					<img src="<?=base_url();?>images/menu-show-icon.jpg" alt="menu" id="show-menu"/>
					<a href="<?=base_url()?>fr"><img src="<?=base_url()?>images/logo.png" alt="Logo Sipromac" class="logo"></a>
					<a href="<?=base_url()?>en/<?=$url_en?>" id="menu_language">English</a>			
					<ul>	
						<?if(isset($pages)) :
						$need_close_submenu = 0;		
						foreach ($pages as $key => $p) :
							if($p->page_id != 9):?>
								<?if($p->parent_id == 0):?>
									<?if($need_close_submenu): $need_close_submenu = 0;?>
										</li>
										</ul>
									<?endif;?>
									<?if($key != 0):?>
										</li>
									<?endif;?>
										<li <?=($p->url_title == $parent_url_title) ? "class='activeM'" : ""?>>
										<?if($p->page_id == 5):
											$url = 'equipements';									
										else :
											$url = 'page/'.$p->url_title;
										endif;?>
										<a href="<?=base_url()?>fr/<?=$url?>"><?=utf8_decode($p->title)?></a>			
								<?else :?>	
									<?if(!$need_close_submenu): $need_close_submenu = 1;?>
										<ul class="submenu">
									<?else:?>
										</li>
									<?endif;?>
									<?if($p->page_id == 13 || $p->page_id == 14)
										$url = 'equipements';
									else
										$url = 'page';?>
										<li <?=($p->url_title == $child_url_title)? "class='activeM'" : ""?>><a href="<?=base_url()?>fr/<?=$url.'/'.$p->url_title?>"><?=utf8_decode($p->title)?></a> 							
								<?endif;?>					
							<?endif;
						endforeach;?>
						<? if ($need_close_submenu) : ?>
								</li>
							</ul>
						<?endif;?>
						</li>
					<?endif;?>						
				</ul>
			</div>
		</div>