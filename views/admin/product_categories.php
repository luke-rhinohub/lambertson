		</div>
		<div id="contentfull">
			<h2 id="Intro"><?=anchor('admin/product_categories/form', '<img src="' . base_url() . 'css/admin/images/post_add.png" border="0">', "Ajouter une catégorie de produits");?><?=anchor('admin/product_categories/form', 'Ajouter une catégorie de produits')?></h2>
			<?='<p style="color: red;">' . $this->session->flashdata('save_message') . '</p>';?>				
			<table cellpadding="3" cellspacing="0" width="95%">
				<thead>
					<tr>		
						<th style="text-align: center;width:150px;">Ordre</th>						
						<th>Catégorie</th>		
						<th style="text-align:center;width:80px;">Photos</th>						
						<th style="text-align:center;width:80px;">Éditer</th>
						<th style="text-align:center;width:100px;"><?=$this->lang->line('delete');?></th>
					</tr>
				</thead>				
				<?if ($categories) {?>
					<?foreach($categories as $key => $c){?>
						<tr>
							<td><?=$c->category_order;?> <?=anchor('admin/product_categories/move_up/category_id/'.$c->category_id, 'Monter')?> <?=anchor('admin/product_categories/move_down/category_id/'.$c->category_id, 'Descendre')?></td>												
							<td><?=$c->category_name;?></td>
							<td style="text-align:center;"><a href="<?=base_url().'admin/product_category_images/index/category_id/'.$c->category_id?>">Gérer</a></td>						
							<td style="text-align:center;"><?=anchor('admin/product_categories/form/category_id/' . $c->category_id, 'Éditer');?></td>
							<td style="text-align:center;"><?=anchor('admin/product_categories/delete/category_id/' . $c->category_id, $this->lang->line('delete'), array("onclick"=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false"));?></td>
						</tr>
					<?}?>
				<?} else {?>
					<tr>
						<td colspan="5">Il n'y a pas de catégorie de produits actuellement.</td>
					</tr>
				<?}?>
				<tfoot>
					<tr>
						<td colspan="5"></td>
					</tr>
				</tfoot>
			</table>
		</div>
