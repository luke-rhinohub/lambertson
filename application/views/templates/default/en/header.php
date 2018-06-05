<?
header("Content-type: text/html; charset=iso-8859-1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="page-id-<?echo $page["page_id"]?>">
	<head>
		<title><?=(@$page['title_en'] != "" ? utf8_decode($page['title_en'])." | " : "")?>Lambertson</title>

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-MNBBXBP');</script>
		<!-- End Google Tag Manager -->

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

		<!-- Viewport from Bootstrap only carousel -->
		<meta name="viewport" content="width=device-width">
		
		<link rel="stylesheet" href="<?=base_url()?>css/style.css?<?=filemtime('css/style.css')?>" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Open+Sans:400,700" rel="stylesheet">
		
		<!-- Websites jQuery and Bxslider scripts -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>jscripts/bxslider/jquery.bxslider.js" type="text/javascript"></script>	
		<!-- <link href="<?=base_url()?>jscripts/bxslider/jquery.bxslider.css" rel="stylesheet" type="text/css"/> -->

		<!-- Bootstrap only carousel -->
		<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" type="text/css" /> -->

		<!-- Bootstrap and Slick carousel -->
		<!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script> -->
		
		<script src="<?=base_url()?>jscripts/carousel.js" type="text/javascript"></script>
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
		<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
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

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MNBBXBP"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		

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
		<div id="menu_alert" class="full no-max" style="display:none;">
			<p class="o-menu_alert white"><strong>NOTIFICATION BAR:</strong> Aliquam ipsum metus, volutpat at nisl eu, faucibus semper tellus</p>
		</div>
		<div id="menu_top">
			<div class="wrap nopadding">
				<a href="tel:18005483324">1.800.548.3324</a>
				<div class="separator">|</div>
				<a href="mailto:info@lambertson.com">INFO@LAMBERTSON.COM</a>
			</div>
		</div>
		<div id="menu">	
			<div class="wrap nopadding" id="menu_container">
				<a href="<?=base_url()?>en/page/home"><img src="<?=base_url()?>images/logo.png" alt="Logo Lambertson" class="logo"></a>
				<div id="menu_onglets">	
					<ul>
						<li><a href="http://www.lambertson.rhinohubdev.com/en/page/home">Home</a></li>
						<li class="separator">|</li>
						<li>
							<a href="http://www.lambertson.rhinohubdev.com/en/page/about-us">About Us</a>
						</li>
						<li class="separator">|</li>
						<li>
							<a href="http://www.lambertson.rhinohubdev.com/products">Products</a>
							<ul class="submenu">
								<li><a href="http://www.lambertson.rhinohubdev.com/products/plumbing">Plumbing</a></li>
								<li class="separator"></li>
								<li><a href="http://www.lambertson.rhinohubdev.com/products/hood-systems">Hood Systems</a></li>
								<li class="separator"></li>
								<li><a href="http://www.lambertson.rhinohubdev.com/products/food-service">Food Service</a></li>
							</ul>
						</li>
						<li class="separator">|</li>
						<li><a href="http://www.lambertson.rhinohubdev.com/en/page/restaurant-packages">Restaurant Packages</a>
							<ul class="submenu">
								<li><a href="http://www.lambertson.rhinohubdev.com/en/page/the-essentials-package">The Essentials Package</a></li>
								<li class="separator"></li>
								<li><a href="http://www.lambertson.rhinohubdev.com/en/page/the-perfect-package">The Perfect Package</a></li>
								<li class="separator"></li>
								<li><a href="http://www.lambertson.rhinohubdev.com/en/page/the-master-package">The Master Package</a></li>
							</ul>
						</li>
						<li class="separator">|</li>
						<li><a href="http://www.lambertson.rhinohubdev.com/en/page/contact-us">Contact us</a></li>
					</ul>
					<!-- <ul>				
						<?if(isset($pages)) :
							$need_close_submenu = 0;		
							foreach ($pages as $key => $p) :
								if($p->page_id != 9 && $p->page_id != 20 && $p->page_id != 21 && $p->page_id != 26 && $p->page_id != 27 && $p->page_id != 7 && $p->page_id != 28 && $p->page_id != 5 && $p->page_id != 22 && $p->page_id != 23 && $p->page_id != 32 && $p->page_id != 24 && $p->page_id != 38 && $p->page_id != 39):?>
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
											<li <?=($p->url_title_en == $parent_url_title) ? "class='activeM'" : ""?>>
											<?if($p->page_id == 5)/*Products*/
												$url = 'products/food-service';
											else
												$url = 'page/'.$p->url_title_en;?>
											<a href="<?=base_url()?>en/<?=$url?>"><?=utf8_decode($p->title_en)?></a>			
									<?else :?>	
										<?if(!$need_close_submenu): $need_close_submenu = 1;?>
											<ul class="submenu">
										<?else:?>
											</li> 								
											<li class="separator"></li>
										<?endif;?>										
										<?if($p->page_id == 22 || $p->page_id == 23 || $p->page_id == 24)
											$url = 'products/'.$p->url_title_en;
										else
											$url = 'page/'.$p->url_title_en;?>
											<li <?=($p->url_title_en == $child_url_title)? "class='activeM'" : ""?>><a href="<?=base_url()?>en/<?=$url?>"><?=utf8_decode($p->title_en)?></a> 							
									<?endif;?>					
								<?endif;
							endforeach;?>
							<?if($need_close_submenu) : ?>
									</li>
								</ul>
							<?endif;?>
							</li>
						<?endif;?>	
					</ul> -->					
				</div>						
			</div>
		</div>
		<div id="menu_small">
			<div class="wrap nopadding">
				<a href="#" id="show-menu"><i class="fas fa-bars"></i></a>
				<a href="<?=base_url()?>en"><img src="<?=base_url()?>images/logo.png" alt="Logo Lambertson" class="logo"></a>
				<!--<a href="<?=base_url()?>fr/<?=$url_fr?>" id="menu_language">Fran&ccedil;ais</a>		-->	
				<!-- <ul>	
						<?if(isset($pages)) :
						$need_close_submenu = 0;		
						foreach ($pages as $key => $p) :
							if($p->page_id != 9 && $p->page_id != 20 && $p->page_id != 21 && $p->page_id != 26 && $p->page_id != 27 && $p->page_id != 7 && $p->page_id != 28 && $p->page_id != 5 && $p->page_id != 22 && $p->page_id != 23 && $p->page_id != 32 && $p->page_id != 24):?>
								<?if($p->parent_id == 0):?>
									<?if($need_close_submenu): $need_close_submenu = 0;?>
										</li>
										</ul>
									<?endif;?>
									<?if($key != 0):?>
										</li>
									<?endif;?>
										<li <?=($p->url_title_en == $parent_url_title) ? "class='activeM'" : ""?>>
										<?if($p->page_id == 5)/*Products*/
											$url = 'products/food-service';	
										else
											$url = 'page/'.$p->url_title_en;?>
										<a href="<?=base_url()?>en/<?=$url?>"><?=utf8_decode($p->title_en)?></a>			
								<?else :?>	
									<?if(!$need_close_submenu): $need_close_submenu = 1;?>
										<ul class="submenu">
									<?else:?>
										</li>
									<?endif;?>
									<?if($p->page_id == 22 || $p->page_id == 23 || $p->page_id == 24)
										$url = 'products/'.$p->url_title_en;
									else
										$url = 'page/'.$p->url_title_en;?>
										<li <?=($p->url_title_en == $child_url_title)? "class='activeM'" : ""?>><a href="<?=base_url()?>en/<?=$url?>"><?=utf8_decode($p->title_en)?></a> 							
								<?endif;?>					
							<?endif;
						endforeach;?>
						<? if ($need_close_submenu) : ?>
								</li>
							</ul>
						<?endif;?>
						</li>
					<?endif;?>						
				</ul> -->

				<ul>
						<li><a href="http://www.lambertson.rhinohubdev.com/en/page/home">Home</a></li>
						<li><a href="http://www.lambertson.rhinohubdev.com/en/page/about-us">About Us</a></li>
						<li>
							<a href="http://www.lambertson.rhinohubdev.com/products">Products</a>
							<ul class="submenu">
								<li><a href="http://www.lambertson.rhinohubdev.com/products/plumbing">Plumbing</a></li>
								<li><a href="http://www.lambertson.rhinohubdev.com/products/hood-systems">Hood Systems</a></li>
								<li><a href="http://www.lambertson.rhinohubdev.com/products/food-service">Food Service</a></li>
							</ul>
						</li>
						<li><a href="http://www.lambertson.rhinohubdev.com/en/page/restaurant-packages">Restaurant Packages</a>
							<ul class="submenu">
								<li><a href="http://www.lambertson.rhinohubdev.com/en/page/the-essentials-package">The Essentials Package</a></li>
								<li><a href="http://www.lambertson.rhinohubdev.com/en/page/the-perfect-package">The Perfect Package</a></li>
								<li><a href="http://www.lambertson.rhinohubdev.com/en/page/the-master-package">The Master Package</a></li>
							</ul>
						</li>
						<li><a href="http://www.lambertson.rhinohubdev.com/en/page/contact-us">Contact us</a></li>
					</ul>

			</div>
		</div>