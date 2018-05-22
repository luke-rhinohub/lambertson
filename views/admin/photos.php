		</div>
		<div id="contentfull">
			<h2 id="Intro">Produit : <?=$product->product_name?></h2>
			<h2 id="Intro"><?=anchor('admin/photos/form/product_id/'.$product->product_id, '<img src="'.base_url().'css/admin/images/post_add.png" border="0">', "Ajouter une photo");?><?=anchor('admin/photos/form/product_id/'.$product->product_id, 'Ajouter une photo')?></h2>
			<?='<p style="color: red;">'.$this->session->flashdata('save_message').'</p>';?>				
			<table cellpadding="3" cellspacing="0" width="95%">
				<thead>
					<tr>	
						<th style="text-align:center;width:150px;">Ordre</th>					
						<th>Titre</th>
						<th style="text-align:center;width:80px;">Image</th>
						<th style="text-align: center;width:100px;"><?=$this->lang->line('status');?></th>
					
						<th style="text-align:center;width:80px;">Éditer</th>
						<th style="text-align:center;width:100px;"><?=$this->lang->line('delete');?></th>
					</tr>
				</thead>				
				<?if ($photos) {?>
				<?foreach($photos as $key => $p){					
					?>
					<tr>	
						<td style="text-align:center;"><?=$key +1;?> <?=anchor('admin/photos/move_up/product_id/'.$product->product_id.'/photo_id/'.$p->photo_id, 'Monter')?> <?=anchor('admin/photos/move_down/product_id/'.$product->product_id.'/photo_id/'.$p->photo_id, 'Descendre')?></td>					
						<td><?=$p->photo_title;?></td>
						<td><a target="_blank" href="<?=base_url()?>images/contenu/products/photos/<?=$p->photo_file?>"><img src="<?=base_url()?>images/contenu/products/photos/<?=$p->photo_file;?>" width="100px"></td>
						<td style="text-align: center;">
							<?if($p->photo_is_active){?>
								<?=anchor('admin/photos/change_status/product_id/'.$product->product_id.'/photo_id/'.$p->photo_id.'/status/0', $this->lang->line('published'));?>
							<?}else{?>
								<?=anchor('admin/photos/change_status/product_id/'.$product->product_id.'/photo_id/'.$p->photo_id.'/status/1', $this->lang->line('unpublished'));?>
							<?}?>
						</td>					
						<td style="text-align:center;"><?=anchor('admin/photos/form/product_id/'.$product->product_id.'/photo_id/' . $p->photo_id, 'Éditer');?></td>
						<td style="text-align:center;"><?=anchor('admin/photos/delete/product_id/'.$product->product_id.'/photo_id/' . $p->photo_id, $this->lang->line('delete'), array("onclick"=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false"));?></td>
					</tr>
				<?}?>
				<?} else {?>
					<tr>
						<td colspan="6">Il n'y a pas de photo actuellement.</td>
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

