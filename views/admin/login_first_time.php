		</div>
		<div id="contentfull">
		
				<h2 id="Intro"><?=$this->lang->line('first_admin_setup');?></h2><br />
				
				<?=form_open('admin/admin/first_login');?>
				
				<p><?=$this->lang->line('first_time_login');?></p>
				
				<?=$this->validation->error_string;?>
				
				<table>
					<tr>
						<td><?=$this->lang->line('email_address');?>: </td>
						<td><input type="text" name="email_address"></td>
					</tr>
					<tr>
						<td><?=$this->lang->line('password');?>: </td>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td><?=$this->lang->line('account_password_conf');?>: </td>
						<td><input type="password" name="password_conf"></td>
					</tr>
					<tr>
						<td><?=$this->lang->line('display_name');?>: </td>
						<td><input type="text" name="display_name"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="btnSubmit" value="<?=$this->lang->line('button_submit');?>"></td>
					</tr>
				</table>
				
				</form>
		
		</div>