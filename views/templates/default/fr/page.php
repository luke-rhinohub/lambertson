<? if($page["page_id"] == 4) : //accueil?>	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.bxslider-banner').bxSlider({									
				mode: 'fade',
				speed: 800,
				pause: 8000,
				autoControls:false,
				pager:false,
				auto:true,
				nextSelector: '.go-next-banner',
				prevSelector: '.go-prev-banner',
				prevText: '<img id="go-prev-banner" src="<?=base_url()?>images/bxslider_prev2.png" alt="prev"/>',   
				nextText: '<img id="go-next-banner" src="<?=base_url()?>images/bxslider_next2.png" alt="next"/>'	
			});	
		});	
	</script>	
	<div id="banner_home">
		<ul class="bxslider-banner">	
			<li>
				<div class="banner_home first" style="background-image:url('<?=base_url()?>images/banner_1.jpg');">
					<div class="wrap nopadding">
						<div class="container">
							<div class="height_line"></div>
							<div class="content">
								<div class="left">
									<img src="<?=base_url()?>images/financement.png"/>
								</div>
								<div class="right">
									<div class="big">Nouveaut&eacute;! <span>Financement en ligne disponible&nbsp;!</span></div>
									<div class="small">Obtenez votre approbation en moins d'une heure&nbsp;!</div>
									<a href="<?=base_url()?>fr/page/financement-en-ligne">D&eacute;couvrir</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="banner_home" style="background-image:url('<?=base_url()?>images/banner_2.jpg');">
					<div class="wrap nopadding">
						<div class="container">
							<div class="height_line"></div>
							<div class="content">
								<div class="title">La nouvelle g&eacute;n&eacute;ration de fours</div>
								<div class="line">Fabricant de fours commerciaux et industriels depuis 1957</div>
								<a href="<?=base_url()?>fr/fours">Trouver des fours</a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="banner_home" style="background-image:url('<?=base_url()?>images/banner_3.jpg');">
					<div class="wrap nopadding">
						<div class="container">
							<div class="height_line"></div>
							<div class="content">
								<div class="title">La nouvelle g&eacute;n&eacute;ration de fours</div>
								<div class="line">Fabricant de fours commerciaux et industriels depuis 1957</div>
								<a href="<?=base_url()?>fr/fours">Trouver des fours</a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="banner_home" style="background-image:url('<?=base_url()?>images/banner_4.jpg');">
					<div class="wrap nopadding">
						<div class="container">
							<div class="height_line"></div>
							<div class="content">
								<div class="title">La nouvelle g&eacute;n&eacute;ration de fours</div>
								<div class="line">Fabricant de fours commerciaux et industriels depuis 1957</div>
								<a href="<?=base_url()?>fr/fours">Trouver des fours</a>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<span class="go-prev-banner"></span>	
		<span class="go-next-banner"></span>
	</div>
	<div id="banner_families">
		<div class="wrap nopadding">
			<div class="col col1"><a href="<?=base_url()?>fr/fours/services-alimentaires">Services alimentaires</a></div>
			<div class="col"><a href="<?=base_url()?>fr/fours/boulangerie">Boulangerie</a></div>
			<div class="col col3"><a href="<?=base_url()?>fr/fours/epicerie">&Eacute;picerie</a></div>
		</div>
	</div>		
	<script type="text/javascript">	
		var width = $(window).width();
		var maxSlides = 0; 	
		var sliderclients = $('.bxslider-clients').bxSlider();
		var slider_packaging = $('.families.bakery .bxslider').bxSlider();
		var slider_processing = $('.bxslider-processing').bxSlider();
		
		$(document).ready(function() {	
			sliderclients = $('.bxslider-clients').bxSlider({
				minSlides: 4,
				maxSlides: 100,
				slideWidth: 49.4, // 791px / 16 img = 49.4px 
				slideMargin: 15,
				ticker: true,
				speed: 200000
			});
			var width = $('.families.bakery .wrap').width();	
			maxSlides = Math.floor(width/230); 
			if(maxSlides < 1)		
				maxSlides = 1;
			slider_packaging = $('.families.bakery .bxslider').bxSlider({
				minSlides: maxSlides,
				maxSlides: maxSlides,
				slideMargin: 40,
				slideWidth: 230,					
				autoControls: false,					
				pager : false,
				nextSelector: '.families.bakery .go-next',
				prevSelector: '.families.bakery .go-prev',
				prevText: '<img class="go-prev" src="<?=base_url()?>images/bxslider_prev.png" alt="prev"/>',   
				nextText: '<img class="go-next" src="<?=base_url()?>images/bxslider_next.png" alt="next"/>'
			});	
			slider_processing = $('.families.food_services .bxslider').bxSlider({
				minSlides: maxSlides,
				maxSlides: maxSlides,
				slideMargin: 40,
				slideWidth: 230,						
				autoControls: false,					
				pager : false,
				nextSelector: '.families.food_services .go-next',
				prevSelector: '.families.food_services .go-prev',
				prevText: '<img class="go-prev" src="<?=base_url()?>images/bxslider_prev.png" alt="prev"/>',   
				nextText: '<img class="go-next" src="<?=base_url()?>images/bxslider_next.png" alt="next"/>'
			});		
					
		});
		
		$(window).resize(function() {			
			if($(window).width() != width) //Android
			{	
				width = $(window).width();
				resize();
			}		
		});
		
		function resize()
		{
			var width = $('.families.bakery .wrap').width();
			maxSlides = Math.floor(width/230); 
			if(maxSlides < 1)		
				maxSlides = 1;
			
			slider_packaging.reloadSlider({
				minSlides: maxSlides,
				maxSlides: maxSlides,
				slideMargin: 40,				
				slideWidth: 230,					
				autoControls: false,					
				pager : false,
				nextSelector: '.families.bakery .go-next',
				prevSelector: '.families.bakery .go-prev',
				prevText: '<img class="go-prev" src="<?=base_url()?>images/bxslider_prev.png" alt="prev"/>',   
				nextText: '<img class="go-next" src="<?=base_url()?>images/bxslider_next.png" alt="next"/>'
			});
			slider_processing.reloadSlider({
				minSlides: maxSlides,
				maxSlides: maxSlides, 		
				slideMargin: 40,				
				slideWidth: 230,						
				autoControls: false,					
				pager : false,
				nextSelector: '.families.food_services .go-next',
				prevSelector: '.families.food_services .go-prev',
				prevText: '<img class="go-prev" src="<?=base_url()?>images/bxslider_prev.png" alt="prev"/>',   
				nextText: '<img class="go-next" src="<?=base_url()?>images/bxslider_next.png" alt="next"/>'
			});			
		}				
	</script>
	<div class="families bakery">
		<div class="wrap">
			<div class="title">
				<div class="text">Choose your bakery equipment</div>
				<div class="controls">
					<span class="go-next"></span><span class="go-prev"></span>
				</div>
			</div>					
			<ul class="bxslider">
				<?foreach($products_packaging as $product):?>			
					<li>	
						<a href="<?=base_url()?>fr/fours/boulangerie/<?=url_title($product->product_name)?>/<?=$product->product_id?>">					
							<div class="img">
								<div class="line"></div><img src="<?=base_url()?>images/contenu/products/photos/<?=$product->photo_file?>" alt="<?=utf8_decode($product->product_name)?>"/>
							</div>
						</a>
						<div class="name">
							<a href="<?=base_url()?>fr/fours/boulangerie/<?=url_title($product->product_name)?>/<?=$product->product_id?>"><?=utf8_decode($product->product_name)?></a>
						</div>													
					</li>
				<?endforeach;?>					
			</ul>
		</div>
	</div>
	<div id="about">
		<div class="borders">
			<div class="wrap nopadding">				
				<div class="about">
					<div class="title">&Agrave; propos des Fours Picard</div>
					<div class="text">
						Founded in 1957 Picard Ovens is the maker of the popular Revolution revolving oven. Its ovens are known for their compact size, versatility and economical cost of usage. The company's mission is to help their clients succeed in today's aggressive marketplace.  Picard Ovens currently serves customers in the food service and bakery industries worldwide. 
					</div>
					<div class="text"><b>It has won numerous awards for its innovative design and sustainability.</b></div>
					<div class="more"><a href="<?=base_url()?>fr/page/a-propos">En apprendre plus sur notre compagnie</a></div>
				</div>	
				<div class="img">
					<img src="<?=base_url();?>images/about_logo.png" alt="Logo Fours Picard"/>
				</div>
				<div class="news">
					<?foreach($news as $key => $new):?>					
						<div class="new">
							<div class="date"><?=strftime('%e %B %Y',strtotime($new->news_publishing_date))?></div>
							<div class="title"><?=utf8_decode($new->news_title)?></div>
							<div class="desc"><?=utf8_decode($new->news_desc)?></div>
							<a href="<?=base_url()?>fr/page/nouvelles#<?=$new->news_id?>" class="more<?=($key == count($news)-1) ? ' last' : ''?>">Lire la suite</a>
						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
	<div class="families food_services">
		<div class="wrap">
			<div class="title">
				<div class="text">Choose your food services equipment</div>
				<div class="controls">
					<span class="go-next"></span><span class="go-prev"></span>
				</div>
			</div>					
			<ul class="bxslider">
				<?foreach($products_processing as $product):?>			
					<li>
						<a href="<?=base_url()?>fr/fours/services-alimentaires/<?=url_title($product->product_name)?>/<?=$product->product_id?>">
							<div class="img">
								<div class="line"></div><img src="<?=base_url()?>images/contenu/products/photos/<?=$product->photo_file?>" alt="<?=utf8_decode($product->product_name)?>"/>
							</div>
						</a>
						<div class="name">
							<a href="<?=base_url()?>fr/fours/services-alimentaires/<?=url_title($product->product_name)?>/<?=$product->product_id?>"><?=utf8_decode($product->product_name)?></a>
						</div>													
					</li>
				<?endforeach;?>					
			</ul>
		</div>
	</div>
	<div id="pub">
		<div class="wrap">
			<a href="http://www.sipromac.com/fr" target="_blank">
				<div class="left">
					<img src="<?=base_url()?>images/pub1.jpg"/>
				</div>
				<div class="right">
					<div class="desc">Bake and package</div>
					<div class="title">Combinez les &eacute;quipements Picard et Sipromac</div>
					<div class="increase">Increase your benefits</div>
				</div>	
			</a>
		</div>
	</div>
	<div id="contact_home">
		<div class="wrap">
			<div class="left">
				<div class="title">Contactez-nous</div>
				<div style="position:relative;">
					<div class="l">
						240, boulevard Industriel<br>
						Saint-Germain-de-Grantham<br>
						QC, Canada  J0C 1K0
					</div>
					<div class="r">
						<b>Sans frais :</b> 1 855-395-5252 (Canada et &Eacute;.-U.)<br>
						<b>T&eacute;l&eacute;phone :</b> 819 395-5151<br>
						<b>T&eacute;l&eacute;copieur :</b> 819 395-5343<br>
						<b>Courriel :</b> <a href="mailto:info@picardovens.com">info@picardovens.com</a>
					</div>
				</div>
			</div>
			<div class="right">
				<a href="<?=base_url()?>fr/page/trouver-un-distributeur">Touver un distributeur</a>
			</div>			
		</div>
	</div>
	<div id="clients">
		<img src="<?=base_url();?>images/clients-confiance.jpg" alt="" id="confiance-logo"/>		
		<ul class="bxslider-clients">
			<li><img src="<?=base_url();?>images/clients/fresh-market.jpg" alt="Fresh Market"/></li>
			<li><img src="<?=base_url();?>images/clients/giordani.jpg" alt="Giordani"/></li>
			<li><img src="<?=base_url();?>images/clients/home-run.jpg" alt="Home Run Inn"/></li>
			<li><img src="<?=base_url();?>images/clients/iga.jpg" alt="IGA"/></li>
			<li><img src="<?=base_url();?>images/clients/metro.jpg" alt="Metro"/></li>			
			<li><img src="<?=base_url();?>images/clients/paradise.jpg" alt="paradise"/></li>
			<li><img src="<?=base_url();?>images/clients/ris.jpg" alt="ris"/></li>
			<li><img src="<?=base_url();?>images/clients/saladier.jpg" alt="saladier"/></li>
			<li><img src="<?=base_url();?>images/clients/sobeys.jpg" alt="sobeys"/></li>
			<li><img src="<?=base_url();?>images/clients/st-hubert.jpg" alt="st-hubert"/></li>
			<li><img src="<?=base_url();?>images/clients/table.jpg" alt="à table!"/></li>
			<li><img src="<?=base_url();?>images/clients/walt-disney.jpg" alt="Walt Disney"/></li>
			<li><img src="<?=base_url();?>images/clients/whole.jpg" alt="whole"/></li>
			<li><img src="<?=base_url();?>images/clients/fresh-market.jpg" alt="Fresh Market"/></li>
			<li><img src="<?=base_url();?>images/clients/giordani.jpg" alt="Giordani"/></li>
			<li><img src="<?=base_url();?>images/clients/home-run.jpg" alt="Home Run Inn"/></li>
			<li><img src="<?=base_url();?>images/clients/iga.jpg" alt="IGA"/></li>
			<li><img src="<?=base_url();?>images/clients/metro.jpg" alt="Metro"/></li>			
			<li><img src="<?=base_url();?>images/clients/paradise.jpg" alt="paradise"/></li>
			<li><img src="<?=base_url();?>images/clients/ris.jpg" alt="ris"/></li>
			<li><img src="<?=base_url();?>images/clients/saladier.jpg" alt="saladier"/></li>
			<li><img src="<?=base_url();?>images/clients/sobeys.jpg" alt="sobeys"/></li>
			<li><img src="<?=base_url();?>images/clients/st-hubert.jpg" alt="st-hubert"/></li>
			<li><img src="<?=base_url();?>images/clients/table.jpg" alt="à table!"/></li>
			<li><img src="<?=base_url();?>images/clients/walt-disney.jpg" alt="Walt Disney"/></li>
			<li><img src="<?=base_url();?>images/clients/whole.jpg" alt="whole"/></li>
		</ul>
	</div>	
<?elseif($page["page_id"] == 18) ://nouvelles?>
	<div id="header" style="background-image:url('<?=base_url();?>images/header_news.jpg');">
		<div class="wrap">
		</div>			
	</div>	
	<div id="page">	
		<div class="wrap">	
			<?if($news): 
				foreach($news as $key => $new):?>
				<div class="new" id="<?=$new->news_id?>">
					<div class="date"><?=strftime('%e %B %Y',strtotime($new->news_publishing_date))?></div>							
					<div class="title"><?=utf8_decode($new->news_title)?></div>
					<div class="content"><?=utf8_decode($new->news_content)?></div>
				</div>
				<?if($key != count($news)-1):?>
					<div class="separator"></div>
				<?endif;?>
				<?endforeach;
			else :?>
				Il n'y a aucune nouvelle pour le moment.
			<?endif;?>	
		</div>
	</div>		
<?elseif($page["page_id"] == 10 || $page["page_id"] == 24) ://contact?>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>	
	<script type="text/javascript">	
		function initialize() {		
			var markerImage = new google.maps.MarkerImage('<?=base_url()?>images/map-icon.png',
					new google.maps.Size(80, 23),
					new google.maps.Point(0, 0),
					new google.maps.Point(80, 14));
			var myLatlng = new google.maps.LatLng(45.850987,-72.588065);
			var myStyles =[			
				{
					featureType: "poi",
					elementType: "labels",
					stylers: [
						  { visibility: "off" }
					]
				}
			];
			var mapOptions = {
				zoom: 11,
				center: myLatlng,
				disableDefaultUI: true,
				draggable: true,
				scrollwheel: false,				
				styles: myStyles 
			};
		 
			var map = new google.maps.Map(document.getElementById("map-canvas"),
				mapOptions);
			var marker = new google.maps.Marker({		
				position: myLatlng,
				map: map,
				icon: markerImage,
				url: 'https://www.google.ca/maps/place/Sipromac+(Les+Industries)/@45.850737,-72.588097,17z/data=!3m1!4b1!4m2!3m1!1s0x4cc814f30b0c1fb3:0x209a8b8e4d7ef47?hl=fr',			/** TODO : prendre en pour version english**/
			});
		
			google.maps.event.addDomListener(window, "resize", function() {
				var center = map.getCenter();
				google.maps.event.trigger(map, "resize");
				map.setCenter(center); 
			});
			google.maps.event.addListener(marker, 'click', function () {	
				window.open(marker.url, "_blank");
			});
		}
		google.maps.event.addDomListener(window, 'load', initialize);
		
		$(document).ready(function() {		
			
			if($('#message_career').html() != '')
				$('html, body').animate({scrollTop:$('#career_title').offset().top}, 0);
				
			$("#submit_career").click(function() {	
				$(".redBorders").removeClass("redBorders");
				$('#message_contact').html('');
				var message_error = "";
				if($("#name_career").val() == '')
				{
					$("#name_career").addClass('redBorders');
					message_error += '&#x2718; Le champ Nom est requis.<br/>';						
				}
				if($("#email_career").val() == '')
				{
					$("#email_career").addClass('redBorders');
					message_error += '&#x2718; Le champ Adresse courriel est requis.<br/>';						
				}
				else
				{
					var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,9}$','i');
					if(!regEmail.test($("#email_career").val()))
					{
						$("#email_career").addClass('redBorders');
						message_error += '&#x2718; Le champ Adresse courriel doit contenir une adresse valide.<br/>';									
					}
				}
				if($("#cv").val() == '')
				{
					$("#cv").addClass('redBorders');
					message_error += '&#x2718; Le champ Curriculum vitae est requis.<br/>';						
				}
				else
				{					
					var extension = $("#cv").val().substr($("#cv").val().lastIndexOf('.') + 1).toLowerCase();
					var allowedExtensions = ['doc', 'docx', 'pdf', 'zip'];					 
					if (allowedExtensions.indexOf(extension) === -1) 
					{
					  	$("#cv").addClass('redBorders');
						message_error += '&#x2718; Format de fichier invalide. Seulement les extensions .doc, .docx, .pdf et .zip sont permises.<br/>';
					}
				}
				if(message_error != "")
				{	
					$("#message_career").html('<div class="message_error">' + message_error + '</div>');
					$('html, body').animate({scrollTop:$('#career_title').offset().top}, 'fast'); 	
					return false;
				}
				else									
					$("#form_career").submit();
			});			
			$("#submit_contact").click(function() {
				$(".redBorders").removeClass("redBorders");
				$('#message_career').html('');
				var message_error = "";				
				
				if($("#company").val() == '')
				{
					$("#company").addClass('redBorders');
					message_error += '&#x2718; Le champ Entreprise est requis.<br/>';						
				}
				if($("#first_name").val() == '')
				{
					$("#first_name").addClass('redBorders');
					message_error += '&#x2718; Le champ Pr&eacute;nom est requis.<br/>';						
				}
				if($("#last_name").val() == '')
				{
					$("#last_name").addClass('redBorders');
					message_error += '&#x2718; Le champ Nom est requis.<br/>';						
				}
				if($("#email").val() == '')
				{
					$("#email").addClass('redBorders');
					message_error += '&#x2718; Le champ Adresse courriel est requis.<br/>';						
				}
				else
				{
					var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,9}$','i');
					if(!regEmail.test($("#email").val()))
					{
						$("#email").addClass('redBorders');
						message_error += '&#x2718; Le champ Adresse courriel doit contenir une adresse valide.<br/>';									
					}
				}
				if($("#phone").val() == '')
				{
					$("#phone").addClass('redBorders');
					message_error += '&#x2718; Le champ T&eacute;l&eacute;phone est requis.<br/>';						
				}
				else
				{
					var regPhone = new RegExp('^(\([0-9]{3}\) [0-9]{3}( |-)[0-9]{4}|^[0-9]{3}( |-)[0-9]{3}( |-)[0-9]{4})( ?x[0-9]{1,5})?$','i');
					if(!regPhone.test($("#phone").val()))
					{
						$("#phone").addClass('redBorders');
						message_error += '&#x2718; Le champ T&eacute;l&eacute;phone doit &ecirc;tre au format 123 456-7890 x123.<br/>';									
					}
				}
				if($("#country").val() == '')
				{
					$("#country").addClass('redBorders');
					message_error += '&#x2718; Le champ Pays est requis.<br/>';						
				}
				if($("#subject").val() == '')
				{
					$("#subject").addClass('redBorders');
					message_error += '&#x2718; Le champ Sujet est requis.<br/>';						
				}
				if($("#message").val() == '')
				{
					$("#message").addClass('redBorders');
					message_error += '&#x2718; Le champ Demande est requis.<br/>';						
				}
				if(message_error != "")
				{					
					$("#message_contact").html('<div class="message_error">' + message_error + '</div>');
					$('html, body').animate({scrollTop:$('#form_contact').offset().top}, 'fast'); 
					return false;
				}
				else
				{	
					$.ajax({
						'type': "POST",					
						'url': document.URL,						
						'data' : {
							company : $("#company").val(),	
							first_name : $("#first_name").val(),
							last_name : $("#last_name").val(),	
							email : $("#email").val(),
							phone : $("#phone").val(),										
							country : $("#country").val(),
							province : $("#province").val(),				
							city : $("#city").val(),				
							address : $("#address").val(),				
							postal_code : $("#postal_code").val(),		
							subject : $("#subject").val(),	
							message : $("#message").val()
						},
						'success': function(message){							
							$("#message_contact").html(message);
							$('html, body').animate({scrollTop:$('#form_contact').offset().top}, 'fast'); 
							if(message.indexOf("message_success") >= 0)
							{
								$("input").val('');								
								$('select').prop('selectedIndex',0);
								$("textarea").val('');	
							}							
						}					
					});
				}				
			});
		});
	</script>
	<div id="contact">
		<div class="contact_bg">
		</div>
		<div class="wrap nopadding">
			<div class="left">
				<div class="title" style="margin:0 0 5px 0;">Fours Picard Inc.</div>
				<div class="address">
					Sans frais Canada / &Eacute;.-U. : 1 855 395-5252<br/>
					T&eacute;l&eacute;phone : 819 395-5151<br/>
					T&eacute;l&eacute;copieur : 819 395-5343<br/>
					Courriel  : <a href="mailto:info@picardovens.com">info@picardovens.com</a><br/>
					<div style="padding-top:10px;">
						240, boulevard Industriel<br/>
						Saint-Germain-de-Grantham<br/>
						Qu&eacute;bec, Canada JOC 1K0
					</div>
					<div class="text"><?=utf8_decode($page['content'])?></div>
				</div>			
			</div>
			<div class="right_bg"></div>
			<div class="right">		
				<div id="career">
					<div id="form_contact">
						<div class="title" style="margin-top:0;">Contactez-nous</div>
						<div>* Champs obligatoires</div>
						<div id="message_contact"></div>						
						<label for="company">Entreprise *</label>
						<input type="text" name="company" id="company"/><br/>		
						<label for="first_name">Pr&eacute;nom *</label>
						<input type="text" name="first_name" id="first_name"/><br/>
						<label for="last_name">Nom *</label>
						<input type="text" name="last_name" id="last_name"/><br/>
						<label for="email">Adresse courriel *</label>
						<input type="text" name="email" id="email"/><br/>	
						<label for="phone">T&eacute;l&eacute;phone *</label>
						<input type="text" name="phone" id="phone"/><br/>	
						<label for="country">Pays *</label>				
						<?=utf8_decode('<select name="country" id="country">
							<option value="">Choisir un pays</option>
							<option value="Afghanistan">Afghanistan</option>
							<option value="Afrique du Sud">Afrique du Sud</option>
							<option value="Albanie">Albanie</option>
							<option value="Algérie">Algérie</option>
							<option value="Allemagne">Allemagne</option>
							<option value="Andorre">Andorre</option>
							<option value="Angola">Angola</option>
							<option value="Antigua-et-Barbuda">Antigua-et-Barbuda</option>
							<option value="Arabie saoudite">Arabie saoudite</option>
							<option value="Argentine">Argentine</option>
							<option value="Arménie">Arménie</option>
							<option value="Australie">Australie</option>
							<option value="Autriche">Autriche</option>
							<option value="Azerbaïdjan">Azerbaïdjan</option>
							<option value="Bahamas">Bahamas</option>
							<option value="Bahreïn">Bahreïn</option>
							<option value="Bangladesh">Bangladesh</option>
							<option value="Barbade">Barbade</option>
							<option value="Belau">Belau</option>
							<option value="Belgique">Belgique</option>
							<option value="Belize">Belize</option>
							<option value="Bénin">Bénin</option>
							<option value="Bhoutan">Bhoutan</option>
							<option value="Biélorussie">Biélorussie</option>
							<option value="Birmanie">Birmanie</option>
							<option value="Bolivie">Bolivie</option>
							<option value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
							<option value="Botswana">Botswana</option>
							<option value="Brésil">Brésil</option>
							<option value="Brunei">Brunei</option>
							<option value="Bulgarie">Bulgarie</option>
							<option value="Burkina">Burkina</option>
							<option value="Burundi">Burundi</option>
							<option value="Cambodge">Cambodge</option>
							<option value="Cameroun">Cameroun</option>
							<option value="Canada">Canada</option>
							<option value="Cap-Vert">Cap-Vert</option>
							<option value="Chili">Chili</option>
							<option value="Chine">Chine</option>
							<option value="Chypre">Chypre</option>
							<option value="Colombie">Colombie</option>
							<option value="Comores">Comores</option>
							<option value="Congo">Congo</option>
							<option value="Cook">Cook</option>
							<option value="Corée du Nord">Corée du Nord</option>
							<option value="Corée du Sud">Corée du Sud</option>
							<option value="Costa Rica">Costa Rica</option>
							<option value="Côte d\'Ivoire">Côte d\'Ivoire</option>
							<option value="Croatie">Croatie</option>
							<option value="Cuba">Cuba</option>
							<option value="Danemark">Danemark</option>
							<option value="Djibouti">Djibouti</option>
							<option value="Dominique">Dominique</option>
							<option value="Égypte">Égypte</option>
							<option value="Émirats arabes unis">Émirats arabes unis</option>
							<option value="Équateur">Équateur</option>
							<option value="Érythrée">Érythrée</option>
							<option value="Espagne">Espagne</option>
							<option value="Estonie">Estonie</option>
							<option value="États-Unis">États-Unis</option>
							<option value="Éthiopie">Éthiopie</option>
							<option value="Fidji">Fidji</option>
							<option value="Finlande">Finlande</option>
							<option value="France">France</option>
							<option value="Gabon">Gabon</option>
							<option value="Gambie">Gambie</option>
							<option value="Géorgie">Géorgie</option>
							<option value="Ghana">Ghana</option>
							<option value="Grèce">Grèce</option>
							<option value="Grenade">Grenade</option>
							<option value="Guatemala">Guatemala</option>
							<option value="Guinée">Guinée</option>
							<option value="Guinée-Bissao">Guinée-Bissao</option>
							<option value="Guinée équatoriale">Guinée équatoriale</option>
							<option value="Guyana">Guyana</option>
							<option value="Haïti">Haïti</option>
							<option value="Honduras">Honduras</option>
							<option value="Hongrie">Hongrie</option>
							<option value="Inde">Inde</option>
							<option value="Indonésie">Indonésie</option>
							<option value="Iran">Iran</option>
							<option value="Iraq">Iraq</option>
							<option value="Irlande">Irlande</option>
							<option value="Islande">Islande</option>
							<option value="Israël">Israël</option>
							<option value="Italie">Italie</option>
							<option value="Jamaïque">Jamaïque</option>
							<option value="Japon">Japon</option>
							<option value="Jordanie">Jordanie</option>
							<option value="Kazakhstan">Kazakhstan</option>
							<option value="Kenya">Kenya</option>
							<option value="Kirghizistan">Kirghizistan</option>
							<option value="Kiribati">Kiribati</option>
							<option value="Koweït">Koweït</option>
							<option value="Laos">Laos</option>
							<option value="Lesotho">Lesotho</option>
							<option value="Lettonie">Lettonie</option>
							<option value="Liban">Liban</option>
							<option value="Liberia">Liberia</option>
							<option value="Libye">Libye</option>
							<option value="Liechtenstein">Liechtenstein</option>
							<option value="Lituanie">Lituanie</option>
							<option value="Luxembourg">Luxembourg</option>
							<option value="Macédoine">Macédoine</option>
							<option value="Madagascar">Madagascar</option>
							<option value="Malaisie">Malaisie</option>
							<option value="Malawi">Malawi</option>
							<option value="Maldives">Maldives</option>
							<option value="Mali">Mali</option>
							<option value="Malte">Malte</option>
							<option value="Maroc">Maroc</option>
							<option value="Marshall">Marshall</option>
							<option value="Maurice">Maurice</option>
							<option value="Mauritanie">Mauritanie</option>
							<option value="Mexique">Mexique</option>
							<option value="Micronésie">Micronésie</option>
							<option value="Moldavie">Moldavie</option>
							<option value="Monaco">Monaco</option>
							<option value="Mongolie">Mongolie</option>
							<option value="Mozambique">Mozambique</option>
							<option value="Namibie">Namibie</option>
							<option value="Nauru">Nauru</option>
							<option value="Népal">Népal</option>
							<option value="Nicaragua">Nicaragua</option>
							<option value="Niger">Niger</option>
							<option value="Nigeria">Nigeria</option>
							<option value="Niue">Niue</option>
							<option value="Norvège">Norvège</option>
							<option value="Nouvelle-Zélande">Nouvelle-Zélande</option>
							<option value="Oman">Oman</option>
							<option value="Ouganda">Ouganda</option>
							<option value="Ouzbékistan">Ouzbékistan</option>
							<option value="Pakistan">Pakistan</option>
							<option value="Panama">Panama</option>
							<option value="Papouasie - Nouvelle Guinée">Papouasie - Nouvelle Guinée</option>
							<option value="Paraguay">Paraguay</option>
							<option value="Pays-Bas">Pays-Bas</option>
							<option value="Pérou">Pérou</option>
							<option value="Philippines">Philippines</option>
							<option value="Pologne">Pologne</option>
							<option value="Portugal">Portugal</option>
							<option value="Qatar">Qatar</option>
							<option value="République centrafricaine">République centrafricaine</option>
							<option value="République dominicaine">République dominicaine</option>
							<option value="République tchèque">République tchèque</option>
							<option value="Roumanie">Roumanie</option>
							<option value="Royaume-Uni">Royaume-Uni</option>
							<option value="Russie">Russie</option>
							<option value="Rwanda">Rwanda</option>
							<option value="Saint-Christophe-et-Niévès">Saint-Christophe-et-Niévès</option>
							<option value="Sainte-Lucie">Sainte-Lucie</option>
							<option value="Saint-Marin">Saint-Marin</option>				
							<option value="Saint-Vincent-et-les-Grenadines">Saint-Vincent-et-les-Grenadines</option>
							<option value="Salomon">Salomon</option>
							<option value="Salvador">Salvador</option>
							<option value="Samoa occidentales">Samoa occidentales</option>
							<option value="Sao Tomé-et-Principe">Sao Tomé-et-Principe</option>
							<option value="Sénégal">Sénégal</option>
							<option value="Seychelles">Seychelles</option>
							<option value="Sierra Leone">Sierra Leone</option>
							<option value="Singapour">Singapour</option>
							<option value="Slovaquie">Slovaquie</option>
							<option value="Slovénie">Slovénie</option>
							<option value="Somalie">Somalie</option>
							<option value="Soudan">Soudan</option>
							<option value="Sri Lanka">Sri Lanka</option>
							<option value="Suède">Suède</option>
							<option value="Suisse">Suisse</option>
							<option value="Suriname">Suriname</option>
							<option value="Swaziland">Swaziland</option>
							<option value="Syrie">Syrie</option>
							<option value="Tadjikistan">Tadjikistan</option>
							<option value="Tanzanie">Tanzanie</option>
							<option value="Tchad">Tchad</option>
							<option value="Thaïlande">Thaïlande</option>
							<option value="Togo">Togo</option>
							<option value="Tonga">Tonga</option>
							<option value="Trinité-et-Tobago">Trinité-et-Tobago</option>
							<option value="Tunisie">Tunisie</option>
							<option value="Turkménistan">Turkménistan</option>
							<option value="Turquie">Turquie</option>
							<option value="Tuvalu">Tuvalu</option>
							<option value="Ukraine">Ukraine</option>
							<option value="Uruguay">Uruguay</option>
							<option value="Vanuatu">Vanuatu</option>
							<option value="Vatican">Vatican</option>
							<option value="Venezuela">Venezuela</option>
							<option value="Viêt Nam">Viêt Nam</option>
							<option value="Yémen">Yémen</option>
							<option value="Yougoslavie">Yougoslavie</option>
							<option value="Zaïre">Zaïre</option>
							<option value="Zambie">Zambie</option>
							<option value="Zimbabwe">Zimbabwe</option>
						</select>');?>			
						<label for="province">Province / &Eacute;tat</label>
						<?=utf8_decode('<select name="province" id="province">
							<option value="" selected="selected">Choisir une province / un &Eacute;tat</option>
							<option value="">---- Canada ----</option>					
							<option value="AB">Alberta</option>
							<option value="BC">Colombie-Britannique</option> 
							<option value="PE">Île-du-Prince-Édouard</option>					
							<option value="MB">Manitoba</option>
							<option value="NB">Nouveau-Brunswick</option>
							<option value="NS">Nouvelle-Écosse</option>
							<option value="NU">Nunavut</option>
							<option value="ON">Ontario</option>
							<option value="QC">Québec</option>
							<option value="SK">Saskatchewan</option>
							<option value="NL">Terre-Neuve-et-Labrador</option>
							<option value="NT">Territoires du Nord-Ouest</option>
							<option value="YT">Yukon</option>
							<option value=""></option>
							<option value="">---- États-Unis ----</option>
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">Californie</option>
							<option value="NC">Caroline du Nord</option>
							<option value="SC">Caroline du Sud</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="ND">Dakota du Nord</option>
							<option value="SD">Dakota du Sud</option>
							<option value="DE">Delaware</option>
							<option value="DC">District fédéral de Columbia</option>
							<option value="FL">Floride</option>
							<option value="GA">Géorgie</option>
							<option value="HI">Hawa&iuml;</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiane</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NY">New York</option>
							<option value="NM">Nouveau-Mexique</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvanie</option>
							<option value="RI">Rhode Island</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginie</option>
							<option value="WA">Washington</option>
							<option value="WV">Virginie-Occidentale</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option> 				
							<option value=""></option>		
							<option value="">---- Mexique ----</option>
							<option value="AGU">Aguascalientes</option>
							<option value="BCN">Basse-Californie</option>
							<option value="BCS">Basse-Californie du Sud</option>
							<option value="CAM">Campeche</option>
							<option value="CHP">Chiapas</option>
							<option value="CHH">Chihuahua</option>
							<option value="COA">Coahuila</option>
							<option value="COL">Colima</option>
							<option value="DIF">District fédéral</option>
							<option value="DUR">Durango</option>
							<option value="MEX">État de Mexico</option>
							<option value="GUA">Guanajuato</option>
							<option value="GRO">Guerrero</option>
							<option value="HID">Hidalgo</option>
							<option value="JAL">Jalisco</option>
							<option value="MIC">Michoacán</option>
							<option value="MOR">Morelos</option>
							<option value="NAY">Nayarit</option>
							<option value="NLE">Nuevo León</option>
							<option value="OAX">Oaxaca</option>
							<option value="PUE">Puebla</option>
							<option value="QUE">Querétaro</option>
							<option value="ROO">Quintana Roo</option>
							<option value="SLP">San Luis Potosí</option>
							<option value="SIN">Sinaloa</option>
							<option value="SON">Sonora</option>
							<option value="TAB">Tabasco</option>
							<option value="TAM">Tamaulipas</option>
							<option value="TLA">Tlaxcala</option>
							<option value="VER">Veracruz</option>
							<option value="YUC">Yucatán</option>
							<option value="ZAC">Zacatecas</option>					
						</select>');?>				
						<label for="city">Ville</label>
						<input type="text" name="city" id="city"/><br/>		
						<label for="address">Adresse</label>
						<input type="text" name="address" id="address"/><br/>	
						<label for="postal_code">Code postal</label>
						<input type="text" name="postal_code" id="postal_code"/><br/>					
						<label for="subject">Sujet *</label>
						<select name="subject" id="subject">
							<option value="">Choisir un sujet</option>
							<option value="Pi&egrave;ces et services">Pi&egrave;ces et services</option>
							<option value="&Eacute;quipements">&Eacute;quipements</option>  								
							<option value="Renseignements g&eacute;n&eacute;raux">Renseignements g&eacute;n&eacute;raux</option>
							<option value="Autres">Autres</option>		
						</select>			
						<label for="message">Votre demande *</label>			
						<textarea name="message" id="message"></textarea>
						<div style="text-align:right;"><a href="javascript:;" class="btn white" id="submit_contact">Envoyer</a></div>
					</div>
					<div class="title" id="career_title">Carri&egrave;res</div>
					<div>
						Remplissez les cases ci-dessous, joignez votre curriculum vitae et envoyez-le-nous.
						<div style="padding-top:5px;">* Champs obligatoires</div>					
					</div>
					<div id="message_career"><?=$message_career?></div>
					<form action="<?=base_url()?>fr/page/contactez-nous" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form_career">	
						<label for="name_career">Nom *</label>
						<input type="text" name="name_career" id="name_career"/><br/>	
						<label for="email_career">Adresse courriel *</label>
						<input type="text" name="email_career" id="email_career"/><br/>
						<label for="cv">Curriculum vitae (doc, docx, pdf, zip) *</label>
						<input type="file" name="cv" id="cv" value="" required/>				
						<div style="text-align:right;"><a href="javascript:;" class="btn white" id="submit_career">Envoyer</a></div>
					</form>										
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="map-canvas"/></div>
<?elseif($page["page_id"] == 9) ://distributeurs?>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>	
	<script type="text/javascript">	
		var icon = new google.maps.MarkerImage('<?=base_url()?>images/marker-distributors.png', null, null, new google.maps.Point(15, 41));
		google.maps.event.addDomListener(window, 'load', function() {
			var map = new google.maps.Map(document.getElementById('map-canvas'), {
				center: new google.maps.LatLng(45.8508,-72.5881),
				zoom: 4,
				minZoom: 2, 
				maxZoom: 5,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				disableDefaultUI: true,
				panControl: true,
				panControlOptions: {
					position: google.maps.ControlPosition.TOP_RIGHT
				},	
				zoomControl: true,
				zoomControlOptions: {   
					position: google.maps.ControlPosition.TOP_RIGHT
				}
			});		
			
			<?foreach($distributors as $d):?>
				var position = new google.maps.LatLng(<?=$d->distributor_lat?>,
													  <?=$d->distributor_lng?>);
				var marker = new google.maps.Marker({		
					position: position,
					map: map,
					icon: icon,
					clickable: false						
				});
			<?endforeach;?>
			
			google.maps.event.addDomListener(document.getElementById('an'), "click", function() {
				var center = new google.maps.LatLng(54.697596, -105.429688);
				map.setCenter(center);
				map.setZoom(3);
			});
			google.maps.event.addDomListener(document.getElementById('ac'), "click", function() {
				var center = new google.maps.LatLng(12.929089, -85.571878);
				map.setCenter(center);
				map.setZoom(3);
			});
			google.maps.event.addDomListener(document.getElementById('as'), "click", function() {
				var center = new google.maps.LatLng(-24.421431, -57.480469);
				map.setCenter(center);
				map.setZoom(3);
			});
			google.maps.event.addDomListener(document.getElementById('asie'), "click", function() {
				var center = new google.maps.LatLng(37.580743, 100.351562);
				map.setCenter(center);
				map.setZoom(3);
			});
			google.maps.event.addDomListener(window, "resize", function() {
				var center = map.getCenter();
				google.maps.event.trigger(map, "resize");
				map.setCenter(center); 
			});
			google.maps.event.addDomListener(window, "click", function() {
				var center = map.getCenter();
				google.maps.event.trigger(map, "resize");
				map.setCenter(center); 
			});
		});	
		$(document).ready(function() {	
			$(".store-list li").click(function() {	
				$('.store-list li.selected').removeClass();
				$(this).addClass('selected');			
			});			
		});
	</script>
	<div id="header" class="distributors-header">
		<div class="wrap">
		</div>			
	</div>	
	<div id="distributors">
		<div class="wrap">
			<?=utf8_decode($page['content'])?>	
		</div>
	</div>
	<div style="background-color:#e5e3df;" id="store_locator">	
		<div class="wrap nopadding" style="overflow:hidden;">				
			<div id="panel">
				<div>Choisissez une r&eacute;gion &agrave; afficher :</div>
				<ul class="store-list">
					<li id="asie">
						Asie
					</li>
					<li id="ac">
						Am&eacute;rique centrale
					</li>
					<li id="an">
						Am&eacute;rique du Nord
					</li>
					
					<li id="as">
						Am&eacute;rique du Sud
					</li>					
				</ul>
			</div>
			<div id="map-canvas"></div>
		</div>
	</div>
<?elseif($page["page_id"] == 20) ://Acheter en ligne?>	
	<div id="header" style="background-image:url('<?=base_url();?>images/header_buy_online.jpg');">
		<div class="wrap">
		</div>			
	</div>		
	<div id="page">	
		<div class="wrap">	
			<?=utf8_decode($page['content'])?>	
			<div class="title first underline">Boulangerie</div>			
			<div class="products_box">	
				<?foreach($products_packaging as $p):?><!--
					--><div class="families product_box">		
						<a href="<?=base_url()?>fr/fours/boulangerie/<?=url_title($p->product_name)?>/<?=$p->product_id?>"><div class="img">
							<div class="line"></div><img src="<?=base_url()?>images/contenu/products/photos/<?=$p->photo_file?>" alt="<?=utf8_decode($p->product_name)?>"/>
						</div></a>
						<div class="name">
							<a href="<?=base_url()?>fr/fours/boulangerie/<?=url_title($p->product_name)?>/<?=$p->product_id?>"><?=utf8_decode($p->product_name)?></a>
						</div>													
					</div><!--
				--><?endforeach;?>
				<div class="clear"></div>
			</div>
			<div class="title underline">Services alimentaires</div>
			<div class="products_box">	
				<?foreach($products_processing as $p):?><!--
					--><div class="families product_box">		
						<a href="<?=base_url()?>fr/fours/services-alimentaires/<?=url_title($p->product_name)?>/<?=$p->product_id?>"><div class="img">
							<div class="line"></div><img src="<?=base_url()?>images/contenu/products/photos/<?=$p->photo_file?>" alt="<?=utf8_decode($p->product_name)?>"/>
						</div></a>
						<div class="name">
							<a href="<?=base_url()?>fr/fours/services-alimentaires/<?=url_title($p->product_name)?>/<?=$p->product_id?>"><?=utf8_decode($p->product_name)?></a>
						</div>													
					</div><!--
				--><?endforeach;?>
				<div class="clear"></div>
			</div>
			<div class="title underline">&Eacute;picerie</div>
			<div class="products_box">	
				<?foreach($products_grocery as $p):?><!--
					--><div class="families product_box">	
						<?if($p->product_link_to_sipromac != ''):?>	
							<a href="<?=$p->product_link_to_sipromac?>" target="_blank">
						<?else:?>						
							<a href="<?=base_url()?>fr/fours/epicerie/<?=url_title($p->product_name)?>/<?=$p->product_id?>">
						<?endif;?>
							<div class="img">
								<div class="line"></div><img src="<?=base_url()?>images/contenu/products/photos/<?=$p->photo_file?>" alt="<?=utf8_decode($p->product_name)?>"/>
							</div>
						</a>
						<div class="name">
							<?if($p->product_link_to_sipromac != ''):?>	
								<a href="<?=$p->product_link_to_sipromac?>" target="_blank">
							<?else:?>						
								<a href="<?=base_url()?>fr/fours/epicerie/<?=url_title($p->product_name)?>/<?=$p->product_id?>">
							<?endif;?>
								<?=utf8_decode($p->product_name)?>
							</a>
						</div>													
					</div><!--
				--><?endforeach;?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
<?else :
	$bg = '';
	if($page["page_id"] == 7)://Services
		$bg = 'header_services.jpg';
	elseif($page["page_id"] == 11): //à propos
		$bg = 'header_about_us.jpg';
	elseif($page["page_id"] == 19): //Accès revendeur
		$bg = 'header_dealer_access.jpg';
	elseif($page["page_id"] == 23): //Documentation
		$bg = 'header_documentation.jpg';
	else: //Autres
		$bg = 'header_default.jpg';
	endif;?>
	<div id="header" style="background-image:url('<?=base_url();?>images/<?=$bg?>');">
		<div class="wrap">
		</div>			
	</div>		
	<div id="page">	
		<div class="wrap">	
			<?=utf8_decode(str_replace('="/','="/clients/picard/',$page['content']))?>
		</div>
	</div>
<? endif;?>