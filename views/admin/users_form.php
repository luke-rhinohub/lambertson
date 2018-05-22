		</div>
		<div id="contentfull">
		
				<h2 id="Intro"><?if(!$user_id){?><?=$this->lang->line('user_create');?><?}else{?><?=$this->lang->line('user_edit');?><?}?></h2>
				
				<?if($user_id){?>
					<?=form_open('admin/users/form/user_id/' . $user_id);?>
				<?}else{?>
					<?=form_open('admin/users/form');?>
				<?}?>

				<?=$this->validation->error_string;?>

					<input type="hidden" name="user_level" value="Administrator">

						<label><?=$this->lang->line('email_address');?></label>
						<input type="text" class="styled" style="width: 35%;" name="email_address" value="<?=$this->validation->email_address;?>" /><br /><br />
						<label><?=$this->lang->line('password');?> <?if($user_id){?><?=$this->lang->line('user_password_change');?><?}?></label>
						<input type="password" class="styled" style="width: 35%;" name="password" /><br /><br />
						<label><?=$this->lang->line('display_name');?></label>
						<input type="text" class="styled" style="width: 35%;" name="display_name" value="<?=$this->validation->display_name;?>" /><br /><br />
						<label><?=$this->lang->line('first_name');?></label>
						<input type="text" class="styled" style="width: 35%;" name="first_name" value="<?=$this->validation->first_name;?>" /><br /><br />
						<label><?=$this->lang->line('last_name');?></label>
						<input type="text" class="styled" style="width: 35%;" name="last_name" value="<?=$this->validation->last_name;?>" /><br /><br />

						<input type="hidden" name="uses_wysiwyg" value="1">
						<!--
						<?if ($this->validation->user_level == "Administrator") {?>
						
							<h3><?=$this->lang->line('user_editor');?></h3>
						
							<label><?=$this->lang->line('user_wysiwyg');?></label>
							<input type="checkbox" name="uses_wysiwyg" value="1" <?if(@$this->validation->uses_wysiwyg){?>checked<?}?>><br /><br />
						<?}?>
						-->
						
						<input type="submit" class="styled" name="btnSubmit" value="<?=$this->lang->line('button_submit');?>" />
				</form>
				
		</div>