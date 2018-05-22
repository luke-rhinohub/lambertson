<script type="text/javascript" src="<?=base_url()?>jscripts/jquery.dotdotdot.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".desc").dotdotdot({
			ellipsis	: ' (...)',
			height		: 75
		});		
	});
</script>
<div id="equipments">
	<div class="equipments_bg"<?if($url == 'transformation-alimentaire'):?> style="background-image: url('<?=base_url()?>images/food-processing.jpg')"<?endif;?>>
	</div>
	<div class="wrap nopadding">
		<div class="left">
			<div class="title"><?=utf8_decode($page["title"])?></div>	
			<?=utf8_decode($page["content"])?>
		</div>
		<div class="right_bg">
		</div>
		<div class="right">
			<?foreach($products as $product):?>
				<div class="container">	
					<a href="<?=base_url()?>fr/equipements/<?=url_title($url)?>/<?=url_title($product->product_name)?>/<?=$product->product_id?>">				
						<div class="img">
							<img src="<?=base_url()?>images/contenu/products/photos/<?=$product->photo_file?>" alt="<?=utf8_decode($product->product_name)?>"/>
						</div>
						<div class="title">
							<?=utf8_decode($product->product_name)?>
						</div>
					</a>
				</div>	
			<?endforeach;?><div class="clear"></div>
		</div>	
		<div class="clear"></div>
	</div>
</div>