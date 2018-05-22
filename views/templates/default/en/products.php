<!-- <div id="header_products">
	<div class="wrap">
		<script type="text/javascript">
			$(document).ready(function() {
				$('.bxslider-pub').bxSlider({									
					mode: 'fade',
					speed: 800,
					pause: 6000,
					autoControls:false,
					controls:false,
					pager:false,
					auto:true,
					autoHover:true
				});	
			});	
		</script>	
		<ul class="bxslider-pub">			
			<?if($category->category_id != 82):?>		
				<li>
					<a href="<?=base_url()?>en/products/food-service/tables/bullnose/82"><img src="<?=base_url()?>images/products/pub_bullnose_tables.jpg" alt="Build your Bullnose Table"/></a>
				</li>
			<?endif;?>			
			<?if($category->category_id != 40):?>				
				<li>
					<a href="<?=base_url()?>en/products/food-service/sinks/compartment/40"><img src="<?=base_url()?>images/products/pub_compartment_sinks.jpg" alt="Build your Compartment Sink"/></a>
				</li>
			<?endif;?>
			<?if($category->category_id != 81):?>			
				<li>
					<a href="<?=base_url()?>en/products/food-service/tables/standard/81"><img src="<?=base_url()?>images/products/pub_standard_tables.jpg" alt="Build your Standard Table"/></a>
				</li>
			<?endif;?>
		</ul>
	</div>			
</div> --> <!-- RH - Removed because table builder does not work -->
<div id="page_products">
	<div class="zone_left" style="background-image:url('<?=base_url()?>images/<?=(isset($bg) ? $bg : 'bg_food_service')?>.jpg');">
	</div>
	<div class="wrap nopadding">
		<div>
			<div class="left">	
				<script type="text/javascript">	
					$(document).ready(function() {	
						$("#show-menu-product").click(function() {	
							$('#menu_cat').toggle('fast');	
						});	
					});			
					$(window).resize(function() {			
						if($(window).width() > 1000)
							$('#menu_cat').removeAttr("style");
					});
				</script>
				<div class="table">	
					<div class="title">
						<div class="title-s">Standard stainless steel fabricated products</div>	
						<?=utf8_decode($page["title_en"])?>
					</div>	
					<div class="menu_icon_product">	
						<img src="<?=base_url()?>images/menu-show-icon.jpg" alt="Icone menu" id="show-menu-product"/>
					</div>	
				</div>
				<script type="text/javascript">	
					$(document).ready(function() {
						$("#menu_cat .onglet.selected" ).each(function() {
							
							if($(this).find('> .t a').hasClass('collapsible'))   //TODO pe mettre dans html direct
								$(this).find('> .t a').addClass('minus');
							$(this).find('> .c').show();
						});
						
						$('.onglet .t').click(function(){		
							//change l'img pour l'onglet cliquer only
							if($(this).find('a').hasClass('collapsible') && $(this).next().is(":visible"))
								$(this).find('a').removeClass('minus');	
							else
								$(this).find('a').addClass('minus');

							//Si clic sur principal onglet
							if($(this).parent().parent().attr("id") == 'menu_cat')
							{
								$('#menu_cat > .onglet').removeClass('selected');
								
								if($(this).next().is(":visible"))
									$(this).closest('#menu_cat > .onglet').removeClass('selected');
								else
									$(this).closest('#menu_cat > .onglet').addClass('selected');
							}
						
							//Expand or collapse this panel
							$(this).next().slideToggle('fast');
							//Hide the other panels
							$('.onglet .c').not($(this).parentsUntil("#menu_cat").filter('.onglet').find('> .c')).slideUp('fast');
							$('.onglet .c').not($(this).parentsUntil("#menu_cat").filter('.onglet').find('> .c')).parent().find('> .t a').removeClass('minus');								
						});
					});	
				</script>
				<div id="menu_cat">
					<?echo utf8_decode($menu_cat_html);?>
				</div>
			</div>
			<div class="right">
				<div class="title">
					<?if($parent_category):?>
						<?=utf8_decode($parent_category->category_name_en. ' / <b>'.$category->category_name_en)?></b>
					<?else:?>
						<b><?=utf8_decode($category->category_name_en)?></b>
					<?endif;?>
				</div>		
				<?if(!$category_images):?>
					<div class="list_available">
						<a href="<?=base_url()?>images/contenu/brochures/Lambertson_FoodService.pdf" target="_blank" class="dl_btn family">
							<div class="icon"><img src="<?=base_url()?>images/download.png"></div><div class="text_btn">Food Service brochure</div>									
						</a>
						<div class="title3">Sinks</div>
						<ul>
							<li><a href="<?=base_url()?>en/products/food-service/sinks/hand/39">Hand</a></li>
							<li><a href="<?=base_url()?>en/products/food-service/sinks/compartment/40">Compartment</a></li>
							<li><a href="<?=base_url()?>en/products/food-service/sinks/mop/41">Mop</a></li>
							<li><a href="<?=base_url()?>en/products/food-service/sinks/multi-user/42">Multi-User</a></li>							
						</ul>
						<div class="title3">INTEGRAL SINKS</div>
						<ul>
							<li><a href="<?=base_url()?>en/products/food-service/integral-sinks/compartment-fs/48">Compartment-FS</a></li>
							<li><a href="<?=base_url()?>en/products/food-service/integral-sinks/compartment-cs/49">Compartment-CS</a></li>						
						</ul>
						<div class="title3">TABLES</div>
						<ul>
							<li><a href="<?=base_url()?>en/products/food-service/tables/standard/81">Standard</a></li>
							<li><a href="<?=base_url()?>en/products/food-service/tables/bullnose/82">Bullnose</a></li>						
						</ul>
						<div class="title3">HOODS</div>
						<ul>
							<li><a href="<?=base_url()?>en/products/food-service/hoods/type-i/118">Type I</a></li>						
						</ul>
					</div>
				<?endif;?>
				<div class="infos">
					<?if($category_images):?>
						<div class="img">
							<div class="left">
								<?if(count($category_images) > 1):?>
									<script type="text/javascript">		
										$(document).ready(function() {
											$('.bxslider-product').bxSlider({
												mode: 'fade',
												speed: 600,
												pause: 4000,
												autoHover: true,
												adaptiveHeight: true,
												autoControls: false,
												controls: false,
												pager: false,
												//pager: true,
												auto: true								
											});							
										});						
									</script>
									<ul class="bxslider-product">
										<?foreach($category_images as $image):?>
											<li>									
												<img src="<?=base_url()?>images/contenu/product_categories/images/<?=$image->image_file?>" alt="<?=utf8_decode($image->image_title)?>"/>
												<?if($image->image_title != ''):?>
													<!--<div class="title2"><?=utf8_decode($image->image_title)?></div>-->
												<?endif;?>	
											</li>	
										<?endforeach;?>	
									</ul>
								<?else:?>
									<img src="<?=base_url()?>images/contenu/product_categories/images/<?=$category_images[0]->image_file?>" alt=""/>
									<?if($category_images[0]->image_title != ''):?>
										<!--<div class="title2"><?=utf8_decode($category_images[0]->image_title)?></div>-->
									<?endif;?>
								<?endif;?>
							</div>
							<div class="right">
								<?if($category->category_desc_en != ''):?>
									<div class="desc">
										<?=$category->category_desc_en?>
									</div>
								<?endif;?>
								<div class="contact">
									For information or pricing, call us (775 857-1100 or Toll-Free Canada and U.S.: 1 800 548-3324) or <a href="<?=base_url()?>en/page/contact-us">e-mail us</a>.
								</div>
								<?if($category->category_file != ''):?>
									<a href="<?=base_url()?>images/contenu/product_categories/pdf/<?=$category->category_file?>" target="_blank" class="dl_btn family">
										<div class="icon"><img src="<?=base_url()?>images/download.png"/></div><div class="text_btn">Price list</div>									
									</a>
								<?endif;?>		
								<a href="<?=base_url()?>images/contenu/brochures/Lambertson_FoodService.pdf" target="_blank" class="dl_btn family">
									<div class="icon"><img src="<?=base_url()?>images/download.png"></div><div class="text_btn">Food Service brochure</div>									
								</a>
							</div>
						</div>
					<?else:?>
						
						<div class="text_only">
							<?if($category->category_desc_en != ''):?>
								<div class="desc">
									<?=$category->category_desc_en?>
								</div>
							<?else:?>
								<div class="more">More to come!</div>
							<?endif;?>
							<div class="contact">
								For information or pricing, call us (775 857-1100 or Toll-Free Canada and U.S.: 1 800 548-3324) or <a href="<?=base_url()?>en/page/contact-us">e-mail us</a>.
							</div>
							<?if($category->category_file != ''):?>
								<a href="<?=base_url()?>images/contenu/product_categories/pdf/<?=$category->category_file?>" target="_blank" class="dl_btn family">
									<div class="icon"><img src="<?=base_url()?>images/download.png"/></div><div class="text_btn">Price list</div>									
								</a>
							<?endif;?>
						</div>						
					<?endif;?>					
				</div>				
				<?if($steps):?>
					<script type="text/javascript">	
						$(document).ready(function() {
							<?if($steps):?>
								getOptionsFromStep(1);
							<?endif;?>
							$("#page_products select[name^='product_attribute']:not(.last)").change(function() {
								var select = $(this).parent().parent().next().find('select');
								
								//if($(this).val() != '') // Pas mis pour NA = ''
								getOptionsFromStep(select.data('pos'));
							});
							
							$("#page_products select[name^='product_attribute'].last").change(function() {
								getOptionsFromStep($(this).data('pos') + 1);//get result
							});							
						});
						
						function getOptionsFromStep(attribute_pos)
						{
							var attributes = [];							
							$("#page_products select[name^='product_attribute']").each(function(key) {
								attributes[key] = {'position' : key + 1, 'name' : this.name, 'value' : this.value};		
							});
							
							$.ajax({
								'type': "POST",					
								'url': document.URL,						
								'data' : {
									attribute_pos : attribute_pos,
									attributes : attributes						
								},
								'success': function(data){
									
									data = jQuery.parseJSON(data);
									
									if(data.options !== undefined)
									{
										options = data.options;
										
										//cacher la section results
										$("#page_products .results").hide();
										$("#page_products .no-result").hide();
										
										// Reset le select à remplir
										$("select[name='product_attribute"+attribute_pos+"']").attr('disabled', 'disabled').find('option').remove();
										// Reset tous les selects suivants
										$("select[name='product_attribute"+attribute_pos+"']").parent().parent().nextAll().find('select').attr('disabled', 'disabled').find('option').remove().end().append('<option value=""></option>');
																		
										$("select[name='product_attribute"+attribute_pos+"']").parent().parent().removeClass('disabled');
										
										if(options.length > 0)
										{
											var count_na = 0;
											var text = '';
											$.each(options, function (i, option) {												
												if(option.attribute_value == '')
												{
													text = 'N/A';
													count_na++;
												}
												else
													text = option.attribute_value;
												$("select[name='product_attribute"+attribute_pos+"']").append($('<option>', { 
													value: option.attribute_value,
													text : text
												}));
											});
											
											if(count_na == options.length) //si tous les choix sont vides n/a : disable et check next
											{
												if($("select[name='product_attribute"+attribute_pos+"']").hasClass('last'))
													getOptionsFromStep($("select[name='product_attribute"+attribute_pos+"']").data('pos')+1);//get result
												else
												{
													var select_next = $("select[name='product_attribute"+attribute_pos+"']").parent().parent().next().find('select');
													getOptionsFromStep(select_next.data('pos'));
												}
											}
											else
											{
												$("select[name='product_attribute"+attribute_pos+"']").prepend('<option value="">-- Select --</option>');

												// remove "selected" from any options that might already be selected :: compliqué à cause de N/A = ''
												$("select[name='product_attribute"+attribute_pos+"'] option[selected='selected']").removeAttr('selected');
												
												// mark the first option as selected
												$("select[name='product_attribute"+attribute_pos+"'] option:first").attr('selected','selected');
												$("select[name='product_attribute"+attribute_pos+"']").removeAttr('disabled');
											}
										}
										else
										{
											$("#page_products .results").hide();
											$("#page_products .no-result").show();											
										}	
									}
									else if(data.product !== undefined)
									{
										product = data.product;								
										if(product != false)
										{						
											$("#page_products .results legend").text(product.product_no);
											<?if($category->category_id == 40):?>										
												$("#page_products .results .img_model").attr('src', '<?=base_url()?>images/products/' + product.product_image);
											<?endif;?>
									
											if(product.product_spec_sheet_en != '')
											{
												$("#page_products .results .btn_download").attr('href', '<?=base_url()?>images/products/pdf/' + product.product_spec_sheet_en);
												$("#page_products .results .btn_download").show();
											}
											else
												$("#page_products .results .btn_download").hide();
											$("#page_products .results .price span").html('$'+product.product_price);
											$("#page_products .results .desc").html(product.product_desc_en);
											$("#page_products .results .btn").attr('href', '<?=base_url()?>en/order_now/<?=$category->category_id?>/' + product.product_no);
											$("#page_products .results").show();
											$("#page_products .no-result").hide();
										}
										else
										{
											$("#page_products .results").hide();
											$("#page_products .no-result").show();											
										}	
									}
								}/*,
								error: function (xhr, ajaxOptions, thrownError) {
									console.log(xhr.responseText);
									console.log(thrownError);
								}*/
							});
						}
					</script>
					<?if($steps):?>
						<!-- <div class="content_steps">
							<div class="title_build">Build your <?=$category->category_name_singular_en?></div>
							<div class="steps">
								<?foreach($steps as $key => $s):?>
									<div class="">
										<div>
											<div class="name">
												<div class="no"><?=$key+1?></div>
												<div class="text">
													<div>Step <?=$key+1?></div><?=$s->attribute_name_en?>
													<a href="javascript:;" rel="tooltip" title="Click to view information" data-title="<?=$s->attribute_tooltip_en?>">
														<img src="<?=base_url()?>images/products/icon_info.jpg" alt="Show information"/>
													</a>
												</div>
											</div>
										</div>
										<div>
											<select name="product_attribute<?=$key+1?>" data-pos="<?=$key+1?>" disabled<?=$key == count($steps)-1 ? ' class="last"': ''?>>
												<option value=""></option>
											</select>
										</div>
									</div>
								<?endforeach;?>
								<div class="disabled">
									<div>
										<div class="name">
											<div class="no"><?=$key+2?></div>
											<div class="text">
												<div>Step <?=$key+2?></div>Result
											</div>
										</div>
									</div>
								</div>											
							</div>
							<div class="results">
								<fieldset>
									<legend></legend>
									<div class="table">
										<div class="left">	
											<?if($category->category_id == 40):?>										
												<img src="" class="img_model" alt=""/>
											<?endif;?>
											<a href="" class="btn_download" target="_blank">
												<div>
													<div class="icon">
														<img src="<?=base_url()?>images/products/icon_download.png">
													</div>											
													<div class="text_btn">Spec&nbsp;Sheet</div>
												</div>
											</a>
										</div>
										<div class="right">
											<div class="price">List price: <span></span></div>
											<div class="desc"></div>
											<div class="btns">
												<a href="" class="btn" target="_blank">Order Now</a>
											</div>
										</div>
									</div>
								</fieldset>
							</div>
							<div class="no-result">
								No result
							</div>
						</div> -->  <!-- RH - Removed because Table Builder does not work -->
					<?endif;?>
				<?else:?>
					<?if($category->category_text_en != ''):?>
						<script type="text/javascript">	
							$(document).ready(function() {							
								triggerListClick($('#price_list .title3:first'));
								$('#price_list .title3').click(function(){
									triggerListClick($(this));
								});
							});	
							function triggerListClick(title_div)
							{
								if(title_div.next().is(":visible"))
								{
									title_div.removeClass('open');	
									title_div.next().slideUp('slow');
								}
								else
								{
									$('#price_list .title3.open').removeClass('open').next().slideUp('slow');
									title_div.addClass('open');	
									title_div.next().slideDown('slow');
								}
							}
						</script>
						<div class="content_text">
							<?=utf8_decode($category->category_text_en);?>
						</div>
					<?endif;?>
				<?endif;?>
			</div>
		</div>
	</div>
	<div class="zone_right"></div>
</div>