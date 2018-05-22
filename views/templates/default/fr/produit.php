<script type="text/javascript">		
	$(document).ready(function() {
		updateFinanceButton();		
		
		$("select[name=model]").change(function() {
			updateFinanceButton();
		});
		
	});	
	function updateFinanceButton()
	{
		if($("select[name=model]") != '')
		{
			$.ajax({
				'type': "POST",					
				'url': document.URL,						
				'data' : {
					model_id : $("select[name=model]").val()			
				},
				'success': function(data){	
					data = JSON.parse(data);
					$(".finance .right a").attr("href", "https://www.leaseq.com/applications/start?dealer_id=551c42955cd6a2000b000017&amount="+data.model_price);
					$(".finance .btn_quote .price span").text(data.model_price_formated);
					
					if(!$(".finance .right > div").is(":visible"))
						$(".finance .right > div").css('display','inline-block'); 
				},
				'error': function(data){					
					$(".finance .right > div").css('display','none'); 
				}					
			});				
		}
		else
			$(".finance .right > div").css('display','none'); 
	}	
</script>
<div class="split_content" id="equipment">
	<div class="left"<?if($url == 'transformation-alimentaire'):?> style="background-image: url('<?=base_url();?>images/food-processing.jpg')"<?endif;?>>
		<div class="content">
			<div class="title"><?=utf8_decode($page["title"])?></div>	
			<?foreach($products as $p):?>		
				<div class="model">			
					<a href="<?=base_url()?>fr/equipements/<?=url_title($url)?>/<?=url_title($p->product_name)?>/<?=$p->product_id?>" <?=$p->product_id == $product_id ? 'class="selected"' : ''?>>
						<span class="title_model"><?=utf8_decode($p->product_name)?></span>
					</a>
				</div>
			<?endforeach;?>
			<div class="desc_family"><?=utf8_decode($page["content"])?></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="right">
		<div class="content">
			<div class="product">
				<?if(count($photos) > 1):?>
					<script type="text/javascript">		
						$(document).ready(function() {
							$('.bxslider-product').bxSlider({
								mode: 'fade',
								speed: 600,
								adaptiveHeight: true,
								autoControls: false,
								controls: false,
								pager: true,
								auto: false								
							});							
						});						
					</script>		
					<div class="img">	
						<ul class="bxslider-product">
							<?foreach($photos as $image):?>
								<li>									
									<img src="<?=base_url()?>images/contenu/products/photos/<?=$image->photo_file?>" alt="<?=utf8_decode($image->photo_title)?>"/>
									<?if($image->photo_title != ''):?>
										<div class="title"><?=utf8_decode($image->photo_title)?></div>				
									<?endif;?>	
								</li>	
							<?endforeach;?>	
						</ul>
					</div>
				<?else:?>					
					<div class="img">
						<img src="<?=base_url()?>images/contenu/products/photos/<?=$photos[0]->photo_file?>" alt="<?=utf8_decode($photos[0]->photo_title)?>"/>
						<?if($photos[0]->photo_title != ''):?>
							<div class="title"><?=utf8_decode($photos[0]->photo_title)?></div>				
						<?endif;?>	
					</div>					
				<?endif;?>
				<div class="description">
					<div class="title">
						<?=utf8_decode($product->product_name)?>
					</div>	
					<div class="desc">
						<div class="models"><?=utf8_decode($product->product_desc)?></div>
						<div style="padding-top:5px;">
							<a href="<?=base_url()?>images/contenu/products/pdf/<?=$product->product_spec_pdf?>" target="_blank" class="dl_btn"><div class="icon"><img src="<?=base_url()?>images/download.png"/></div><div class="text_btn">Brochure <?=utf8_decode($product->product_name)?></div></a>
							<a href="<?=base_url()?>images/contenu/brochures/<?=$page["page_id"] == 13 ? 'Sipromac_EmballageAlimentaire.pdf' : 'Sipromac_TransformationAlimentaire.pdf'?>" target="_blank" class="dl_btn family"><div class="icon"><img src="<?=base_url()?>images/download.png"/></div><div class="text_btn">Brochure <?=utf8_decode($page["title"])?></div></a>
						</div>
					</div>	
				</div>		
			</div>
		</div>
		<?if($models):?>
			<div class="zone_separator_gray">
				<div class="content">
					<div class="finance">
						<?if($models):?>
							<div class="left">
								<div class="title2">Choisissez votre mod&egrave;le&nbsp;:</div>
								<select name="model">
									<?foreach($models as $model):?>
										<option value="<?=$model['product_model_id']?>"><?=$model['model_name']?></option>
									<?endforeach;?>
								</select>
							</div>					
							<div class="right">
								<div>
									<a href="https://www.leaseq.com/dealer/start?dealer_id=551c42955cd6a2000b000017" target="_blank">
										<div class="btn_quote">
											<div class="big">Financement pour<br>aussi bas que :</div>
											<div class="price"><span> $</span> / mois</div>
										</div>
										<div class="apply">Cliquez ici pour appliquer</div>
									</a>	
								</div>								
							</div>
						<?else:?>
							<div class="title2"><?=utf8_decode($product->product_name)?> :</div>
							<a href="<?=base_url()?>fr/page/contact" style="text-decoration:underline;">S'il vous plait, contactez-nous pour obtenir un prix!</a>
						<?endif;?>						
					</div>
				</div>
			</div>
		<?endif;?>
		<div class="zone_separator">
			<div class="content">
				<div class="advantages">
					<?=utf8_decode($product->product_advantages)?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="text">
				<?=utf8_decode($product->product_text)?>				
			</div>
		</div>
	</div>
</div>