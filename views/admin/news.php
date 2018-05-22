		</div>
		<div id="contentfull">
			<h2 id="Intro"><?=anchor('admin/news/form', '<img src="' . base_url() . 'css/admin/images/post_add.png" border="0">', "Ajouter une nouvelle");?><?=anchor('admin/news/form', 'Ajouter une nouvelle')?></h2>
			<p style="color:red;"><?=$this->session->flashdata('save_message');?></p>				
			<table cellpadding="3" cellspacing="0" width="95%">
				<thead>
					<tr>
						<th style="text-align:center;width:100px;">Date de publication</th>									
						<th>Titre</th>
						<th style="text-align: center;width:80px;"><?=$this->lang->line('status');?></th>	
						<th style="text-align:center;width:80px;">Éditer</th>
						<th style="text-align:center;width:100px;"><?=$this->lang->line('delete');?></th>
					</tr>
				</thead>				
				<?if ($news) {?>
				<?foreach($news as $n){					
					?>
					<tr>							
						<td style="text-align:center;"><?=$n->news_publishing_date;?></td>								
						<td><?=$n->news_title;?></td>
						<td style="text-align: center;">
							<?if($n->news_is_active){?>
								<?=anchor('admin/news/change_status/news_id/'.$n->news_id.'/status/0', $this->lang->line('published'));?>
							<?}else{?>
								<?=anchor('admin/news/change_status/news_id/'.$n->news_id.'/status/1', $this->lang->line('unpublished'));?>
							<?}?>
						</td>
						<td style="text-align:center;"><?=anchor('admin/news/form/news_id/' . $n->news_id, 'Éditer');?></td>
						<td style="text-align:center;"><?=anchor('admin/news/delete/news_id/' . $n->news_id, $this->lang->line('delete'), array("onclick"=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false"));?></td>
					</tr>
				<?}?>
				<?} else {?>
					<tr>
						<td colspan="5">Il n'y a pas de nouvelles actuellement.</td>
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
