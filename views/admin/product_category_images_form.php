		</div>		
		<div id="contentfull">		
			<h2>Catégorie : <?=$category->category_name?></h2><br/>
			<h2 id="Intro"><?if(!$image_id){?>Créer une photo<?}else{?>Éditer une photo<?}?></h2>
			<p style="color: red;"><?=$this->session->flashdata('save_message')?></p>				
			<?if($image_id){?>
				<?=form_open_multipart('admin/product_category_images/form/category_id/'.$category->category_id.'/image_id/'.$image_id);?>
			<?}else{?>
				<?=form_open_multipart('admin/product_category_images/form/category_id/'.$category->category_id);?>
			<?}?>
				<?=$this->validation->error_string;?>				
				<label>Titre </label>
				<input type="text" class="styled" style="width: 35%;" name="image_title" value="<?=$this->validation->image_title;?>"/><br/>	
				<label>Image</label>
				<input type="file" class="styled" style="width: 35%;" name="image_file" value="" <?=$this->validation->ancienfichier == '' ? 'required' : '';?>/>
				<input type="hidden" class="styled" style="width: 35%;" name="ancienfichier" value="<?=$this->validation->ancienfichier;?>" />
				<? if($this->validation->ancienfichier != '') {			
					print '<br><br><img src="'.base_url().'images/contenu/product_categories/images/'.$this->validation->ancienfichier.'">';
				}
				?>
				<br/><br/>
				<input type="submit" class="styled" name="btnSubmit" value="<?=$this->lang->line('button_submit');?>" />
			</form>
		</div>