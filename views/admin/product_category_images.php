		</div>
		<div id="contentfull">
			<h2 id="Intro">Catégorie : <?=$category->category_name?></h2>
			<h2 id="Intro"><?=anchor('admin/product_category_images/form/category_id/'.$category->category_id, '<img src="'.base_url().'css/admin/images/post_add.png" border="0">', "Ajouter une photo");?><?=anchor('admin/product_category_images/form/category_id/'.$category->category_id, 'Ajouter une photo')?></h2>
			<?='<p style="color: red;">'.$this->session->flashdata('save_message').'</p>';?>				
			<table cellpadding="3" cellspacing="0" width="95%">
				<thead>
					<tr>	
						<th style="text-align:center;width:150px;">Ordre</th>					
						<th>Titre</th>
						<th style="text-align:center;width:80px;">Image</th>					
						<th style="text-align:center;width:80px;">Éditer</th>
						<th style="text-align:center;width:100px;"><?=$this->lang->line('delete');?></th>
					</tr>
				</thead>				
				<?if ($photos) {?>
				<?foreach($photos as $key => $p){					
					?>
					<tr>	
						<td style="text-align:center;"><?=$key +1;?> <?=anchor('admin/product_category_images/move_up/category_id/'.$category->category_id.'/image_id/'.$p->image_id, 'Monter')?> <?=anchor('admin/product_category_images/move_down/category_id/'.$category->category_id.'/image_id/'.$p->image_id, 'Descendre')?></td>					
						<td><?=$p->image_title;?></td>
						<td><a target="_blank" href="<?=base_url()?>images/contenu/product_categories/images/<?=$p->image_file?>"><img src="<?=base_url()?>images/contenu/product_categories/images/<?=$p->image_file;?>" width="100px"></td>
						<td style="text-align:center;"><?=anchor('admin/product_category_images/form/category_id/'.$category->category_id.'/image_id/' . $p->image_id, 'Éditer');?></td>
						<td style="text-align:center;"><?=anchor('admin/product_category_images/delete/category_id/'.$category->category_id.'/image_id/' . $p->image_id, $this->lang->line('delete'), array("onclick"=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false"));?></td>
					</tr>
				<?}?>
				<?} else {?>
					<tr>
						<td colspan="5">Il n'y a pas de photo actuellement.</td>
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

