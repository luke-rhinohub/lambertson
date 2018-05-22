		</div>		
		<div id="contentfull">		
			<h2>Produit : <?=$product->product_name?></h2><br/>
			<h2 id="Intro"><?if(!$photo_id){?>Créer une photo<?}else{?>Éditer une photo<?}?></h2>
			<p style="color: red;"><?=$this->session->flashdata('save_message')?></p>				
			<?if($photo_id){?>
				<?=form_open_multipart('admin/photos/form/product_id/'.$product->product_id.'/photo_id/'.$photo_id);?>
			<?}else{?>
				<?=form_open_multipart('admin/photos/form/product_id/'.$product->product_id);?>
			<?}?>
				<?=$this->validation->error_string;?>				
				<label>Titre </label>
				<input type="text" class="styled" style="width: 35%;" name="photo_title" value="<?=$this->validation->photo_title;?>"/><br/>	
				<label>Titre (anglais)</label>
				<input type="text" class="styled" style="width: 35%;" name="photo_title_en" value="<?=$this->validation->photo_title_en;?>"/><br/>						
				<label>Image</label>
				<input type="file" class="styled" style="width: 35%;" name="photo_file" value="" <?=$this->validation->ancienfichier == '' ? 'required' : '';?>/>
				<input type="hidden" class="styled" style="width: 35%;" name="ancienfichier" value="<?=$this->validation->ancienfichier;?>" />
				<? if($this->validation->ancienfichier != '') {			
					print '<br><br><img src="'.base_url().'images/contenu/products/photos/'.$this->validation->ancienfichier.'">';
				}
				?>
				<br/><br/>
				<input type="submit" class="styled" name="btnSubmit" value="<?=$this->lang->line('button_submit');?>" />
			</form>
		</div>