		</div>		
		<script>
			$(document).ready(function() {
				CKEDITOR.replace('product_desc');
				CKEDITOR.replace('product_desc_en');
				CKEDITOR.replace('product_advantages');
				CKEDITOR.replace('product_advantages_en');
				CKEDITOR.replace('product_text');
				CKEDITOR.replace('product_text_en');
				if ($("#category_hidden").val() != "")
					$('#product_category_id').val($("#category_hidden").val()); 
			});
         </script>
		 <style>
		 .error
		 {
			color:red;
			padding:5px 0;
		 }
		 .error p
		 {
			margin:0;
		 }
		 label
		 {
			margin-top:13px;
			margin-bottom:5px;
		 }
		 </style>
		<div id="contentfull">
			<h2 id="Intro"><?if(!$product_id){?>Créer un produit<?}else{?>Éditer un produit<?}?></h2>
			<div class="error"><?=$this->session->flashdata('save_message')?></div>	
			<?if($product_id){?>
				<?=form_open_multipart('admin/products/form/product_id/'.$product_id, array('id' => 'product_form'));?>
			<?}else{?>
				<?=form_open_multipart('admin/products/form', array('id' => 'product_form'));?>
			<?}?>
				<?if($message_error_file) : ?>
						<div class="error"><?=$message_error_file?></div>
				<?endif;?>				
				<?=$this->validation->error_string;?>					
				<label>Catégorie</label>	
				<select name="product_category_id"  id="product_category_id">
					<?var_dump($dropdownlist_categories)?>
				</select>
				<input type="hidden" id="category_hidden" value="<?=$this->validation->product_category_id?>"><br/>	
				<label>Nom du produit</label>
				<input type="text" class="styled" style="width: 35%;" name="product_name" value="<?=$this->validation->product_name;?>"/><br/>
				<label>Nom du produit (anglais)</label>
				<input type="text" class="styled" style="width: 35%;" name="product_name_en" value="<?=$this->validation->product_name_en;?>"/><br/>			
				<label>Description</label>
				<textarea name="product_desc" id="product_desc"><?=$this->validation->product_desc;?></textarea>
				<label>Description (anglais)</label>
				<textarea name="product_desc_en" id="product_desc_en"><?=$this->validation->product_desc_en;?></textarea>	
				<label>Avantages</label>
				<textarea name="product_advantages" id="product_advantages"><?=$this->validation->product_advantages;?></textarea>
				<label>Avantages (anglais)</label>
				<textarea name="product_advantages_en" id="product_advantages_en"><?=$this->validation->product_advantages_en;?></textarea>	
				<label>Texte</label>
				<textarea name="product_text" id="product_text"><?=$this->validation->product_text;?></textarea>
				<label>Texte (anglais)</label>
				<textarea name="product_text_en" id="product_text_en"><?=$this->validation->product_text_en;?></textarea>				
				<label>Fiche technique (PDF)</label>
				<input type="file" class="styled" style="width: 35%;" name="product_spec_pdf" value="" <?=$this->validation->product_spec_pdf_old == '' ? 'required' : '';?>/>
				<input type="hidden" class="styled" style="width: 35%;" name="product_spec_pdf_old" value="<?=$this->validation->product_spec_pdf_old?>" />
				<? if($this->validation->product_spec_pdf_old != '') :?>			
					<br><a href="<?=base_url();?>images/contenu/products/pdf/<?=$this->validation->product_spec_pdf_old?>" target="_blank"><?=$this->validation->product_spec_pdf_old?></a>
				<?endif;?>
				<label>Fiche technique (PDF) (anglais)</label>
				<input type="file" class="styled" style="width: 35%;" name="product_spec_pdf_en" value="" <?=$this->validation->product_spec_pdf_en_old == '' ? 'required' : '';?>/>
				<input type="hidden" class="styled" style="width: 35%;" name="product_spec_pdf_en_old" value="<?=$this->validation->product_spec_pdf_en_old?>" />
				<? if($this->validation->product_spec_pdf_en_old != '') :?>			
					<br><a href="<?=base_url();?>images/contenu/products/pdf/<?=$this->validation->product_spec_pdf_en_old?>" target="_blank"><?=$this->validation->product_spec_pdf_en_old?></a>
				<?endif;?>
				<br/>									
				<br/>
				<input type="submit" class="styled" name="btnSubmit" value="<?=$this->lang->line('button_submit');?>" />
			</form>
		</div>