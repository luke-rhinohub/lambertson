		</div>
		<div id="contentfull">

				<?foreach ($user_groups as $user_group) {
					if($user_group['user_level'] == "Administrator") {
					?>
			
				<h2 id="Intro"><?=anchor('admin/users/form/user_level/' . $user_group['user_level'], '<img src="' . base_url() . 'css/admin/images/user_add.png" border="0">', array('title'=>'Cr&eacute;er un nouvel utilisateur'));?><?=anchor('admin/users/form/user_level/' . $user_group['user_level'], 'Cr&eacute;er un nouvel utilisateur')?></h2>

				<?='<p style="color: red;">' . $this->session->flashdata('save_message') . '</p>';?>
				
				<?if ($user_group['users']) {?>
				
					<table cellpadding="3" cellspacing="3" width="95%">
						<thead>
							<tr>
								<th><?=$this->lang->line('display_name');?></th>
								<th><?=$this->lang->line('last_name');?></th>
								<th><?=$this->lang->line('first_name');?></th>
								<th><?=$this->lang->line('email_address');?></th>
								<!--<th><?=$this->lang->line('user_level');?></th>-->
								<th style="text-align: center;"><?=$this->lang->line('edit');?></th>
								<th style="text-align: center;"><?=$this->lang->line('delete');?></th>
							</tr>
						</thead>
						<?foreach ($user_group['users'] as $user) {?>
							<tr>
								<td><?=$user->display_name;?></td>
								<td><?=$user->last_name;?></td>
								<td><?=$user->first_name;?></td>
								<td><?=$user->email_address;?></td>
								<!--<td><?=$user->user_level;?></td>-->
								<td style="text-align: center;" width="10%"><?=anchor('admin/users/form/user_id/' . $user->user_id, $this->lang->line('edit'));?></td>
								<td style="text-align: center;" width="10%"><?=anchor('admin/users/delete/user_id/' . $user->user_id, $this->lang->line('delete'), array("onclick"=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false"));?></td>
							</tr>
						<?}?>
						<tfoot>
							<tr>
								<td colspan="7" align="center"><?=$nav;?></td>
							</tr>
						</tfoot>
					</table>
					
					<br /><br />
				
					<?} else {?>
					
						<p><?=$this->lang->line('users_none_exist');?></p>
					
					<?}?>
					<?}?>
				<?}?>
		
		</div>