		</div>
		<div id="contentfull">		
			<h2 id="Intro"><?=anchor('admin/distributors/form', '<img src="'.base_url().'css/admin/images/post_add.png" border="0">', "Ajouter un distributeur");?><?=anchor('admin/distributors/form', 'Ajouter un distributeur')?></h2>
			<?='<p style="color: red;">'.$this->session->flashdata('save_message').'</p>';?>				
			<table cellpadding="3" cellspacing="0" width="95%">
				<thead>
					<tr>								
						<th>Distributeur</th>	
						<th style="text-align:center;width:80px;">Éditer</th>
						<th style="text-align:center;width:100px;"><?=$this->lang->line('delete');?></th>
					</tr>
				</thead>				
				<?if ($distributors) {?>
				<?foreach($distributors as $p){					
					?>
					<tr>							
						<td><?=$p->distributor_name;?></td>		
						<td style="text-align:center;"><?=anchor('admin/distributors/form/distributor_id/' . $p->distributor_id, 'Éditer');?></td>
						<td style="text-align:center;"><?=anchor('admin/distributors/delete/distributor_id/' . $p->distributor_id, $this->lang->line('delete'), array("onclick"=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false"));?></td>
					</tr>
				<?}?>
				<?} else {?>
					<tr>
						<td colspan="5">Il n'y a pas de distributeur actuellement.</td>
					</tr>
				<?}?>
				<tfoot>
					<tr>
						<td colspan="5" align="center"><?=$nav;?></td>
					</tr>
				</tfoot>
			</table>
			<br>
		</div>

