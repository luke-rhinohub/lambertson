		</div>
		<div id="contentfull">		
			<h2 id="Intro"><?=anchor('admin/products/form', '<img src="'.base_url().'css/admin/images/post_add.png" border="0">', "Ajouter un produit");?><?=anchor('admin/products/form', 'Ajouter un produit')?></h2>
			<?='<p style="color: red;">'.$this->session->flashdata('save_message').'</p>';?>				
			<table cellpadding="3" cellspacing="0" width="95%">
				<thead>
					<tr>	
						<th style="text-align: center;width:150px;"><?=$this->lang->line('page_order');?></th>							
						<th>Produit</th>						
						<th style="text-align: center;width:100px;"><?=$this->lang->line('status');?></th>
						<th style="text-align:center;width:80px;">Photos</th>				
						<th style="text-align:center;width:80px;">Éditer</th>
						<th style="text-align:center;width:100px;"><?=$this->lang->line('delete');?></th>
					</tr>
				</thead>				
				<?if ($products) {?>
				<?foreach($products as $p){					
					?>
					<tr>	
						<td><?=$p->product_order;?> <?=anchor('admin/products/move_up/product_id/'.$p->product_id, 'Monter')?> <?=anchor('admin/products/move_down/product_id/'.$p->product_id, 'Descendre')?></td>																	
						<td><?=$p->product_name;?></td>						
						<td style="text-align: center;">
							<?if($p->product_is_active){?>
								<?=anchor('admin/products/change_status/product_id/'.$p->product_id.'/status/0', $this->lang->line('published'));?>
							<?}else{?>
								<?=anchor('admin/products/change_status/product_id/'.$p->product_id.'/status/1', $this->lang->line('unpublished'));?>
							<?}?>
						</td>
						<td style="text-align:center;"><a href="<?=base_url().'admin/photos/index/product_id/'.$p->product_id?>">Gérer</a></td>						
						<td style="text-align:center;"><?=anchor('admin/products/form/product_id/' . $p->product_id, 'Éditer');?></td>
						<td style="text-align:center;"><?=anchor('admin/products/delete/product_id/' . $p->product_id, $this->lang->line('delete'), array("onclick"=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false"));?></td>
					</tr>
				<?}?>
				<?} else {?>
					<tr>
						<td colspan="6">Il n'y a pas de produit actuellement.</td>
					</tr>
				<?}?>
				<tfoot>
					<tr>
						<td colspan="6" align="center"><?=$nav;?></td>
					</tr>
				</tfoot>
			</table>
			<br>
		</div>

