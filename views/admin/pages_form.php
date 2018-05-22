		</div>
		<script>
			$(document).ready(function() {
				CKEDITOR.replace('content');
				CKEDITOR.replace('content_en');
				
				if ($("#parent_hidden").val() != "")
					$('#parent_id').val($("#parent_hidden").val()); 
			});
         </script>
		<div id="contentfull">		
			<h2 id="Intro"><?if(!$page_id){?><?=$this->lang->line('page_write_new');?><?}else{?><?=$this->lang->line('edit_page');?><?}?></h2>
			<?if($page_id){?>
				<?=form_open('admin/pages/form/page_id/'.$page_id);?>
			<?}else{?>
				<?=form_open('admin/pages/form');?>
			<?}?>
				<?=$this->validation->error_string;?>		
				<label>Page parent</label>
				<select name="parent_id"  id="parent_id">
					<option value="0">-----</option>
					<?foreach($parents as $p) :?>
					  <option value="<?=$p->page_id?>"><?=$p->title?></option>
					<?endforeach;?>
				</select>	
				<input type="hidden" id="parent_hidden" value="<?=$this->validation->parent?>"><br/>	
				<label><?=$this->lang->line('page_title');?></label>
				<input class="styled" style="width: 95%;" type="text" name="title" value="<?=$this->validation->title;?>"><br/>
				<label><?=$this->lang->line('page_title');?> (anglais)</label>
				<input class="styled" style="width: 95%;" type="text" name="title_en" value="<?=$this->validation->title_en;?>"><br/>
				<label><?=$this->lang->line('page_content');?></label>
				<textarea name="content" id="content" ><?=$this->validation->content;?></textarea>		
				<label><?=$this->lang->line('page_content');?> (anglais)</label>
				<textarea name="content_en" id="content_en"><?=$this->validation->content_en;?></textarea><br/>		
			
				<input class="styled" type="submit" name="btnSubmit" id="sub" value="<?=$this->lang->line('button_submit');?>">				
			</form>
		</div>