		</div>	
		<script>
			$(document).ready(function() {
				CKEDITOR.replace('category_desc');
				CKEDITOR.replace('category_desc_en');
				CKEDITOR.replace('category_text');
				CKEDITOR.replace('category_text_en');
				if ($("#parent_hidden").val() != "")
					$('#category_parent_id').val($("#parent_hidden").val()); 
			});
         </script>
		<div id="contentfull">		
			<h2 id="Intro"><?if(!$category_id){?>Créer une catégorie de produits<?}else{?>Éditer une catégorie de produits<?}?></h2>
			<br/>
			<?if($category_id){?>
				<?=form_open_multipart('admin/product_categories/form/category_id/'.$category_id);?>
			<?}else{?>
				<?=form_open_multipart('admin/product_categories/form');?>
			<?}?>
				<?=$this->validation->error_string;?>	
				<?if($message_error_file) : ?>
					<div class="error"><?=$message_error_file?></div>
				<?endif;?>	
				<label>Catégorie parent</label>				
				<select name="category_parent_id"  id="category_parent_id">
					<?var_dump($dropdownlist_categories)?>
				</select>	
				<input type="hidden" id="parent_hidden" value="<?=$this->validation->category_parent_id?>"><br/>					
				<label>Titre</label>
				<input type="text" class="styled" style="width: 35%;" name="category_name" value="<?=$this->validation->category_name;?>"/><br/>
				<label>Titre (anglais)</label>
				<input type="text" class="styled" style="width: 35%;" name="category_name_en" value="<?=$this->validation->category_name_en;?>"/><br/>
				<label>Nom complet singulier</label>
				<input type="text" class="styled" style="width: 35%;" name="category_name_singular" value="<?=$this->validation->category_name_singular;?>"/><br/>
				<label>Nom complet singulier (anglais)</label>
				<input type="text" class="styled" style="width: 35%;" name="category_name_singular_en" value="<?=$this->validation->category_name_singular_en;?>"/><br/>
				<label>Description</label>
				<textarea name="category_desc" id="category_desc"><?=$this->validation->category_desc;?></textarea>	
				<label>Description (anglais)</label>
				<textarea name="category_desc_en" id="category_desc_en"><?=$this->validation->category_desc_en;?></textarea>	
				<label>Texte</label>
				<textarea name="category_text" id="category_text"><?=$this->validation->category_text;?></textarea>	
				<label>Texte (anglais)</label>
				<textarea name="category_text_en" id="category_text_en"><?=$this->validation->category_text_en;?></textarea>
				<label>Fiche (PDF)</label>
				<input type="file" class="styled" style="width: 35%;" name="category_file" value=""/>
				<input type="hidden" class="styled" style="width: 35%;" name="category_file_old" value="<?=$this->validation->category_file_old?>" />
				<? if($this->validation->category_file_old != '') :?>			
					<br><a href="<?=base_url();?>images/contenu/product_categories/pdf/<?=$this->validation->category_file_old?>" target="_blank"><?=$this->validation->category_file_old?></a>
				<?endif;?>								
				<br/><br/>
				<input type="submit" class="styled" name="btnSubmit" value="<?=$this->lang->line('button_submit');?>" />
			</form>
		</div>