		</div>		
			<div id="contentfull">		
				<h2 id="Intro"><?=anchor('admin/pages/form', '<img src="' . base_url() . 'css/admin/images/page_add.png" border="0">', array('title'=>$this->lang->line('page_create_new')));?><?=anchor('admin/pages/form', 'Cr&eacute;er une nouvelle page')?></h2>
				<?='<p style="color: red;">' . $this->session->flashdata('save_message') . '</p>';?>
				<table cellpadding="3" cellspacing="3" width="95%" class="sortit">
					<thead>
						<tr>
							<th style="text-align: center;width:150px;"><?=$this->lang->line('page_order');?></th>						
							<th>Parent</th>						
							<th><?=$this->lang->line('page_title');?></th>						
							<th style="text-align:center;width:170px;"><?=$this->lang->line('page_page');?></th>
							<th style="text-align:center;width:95px;"><?=$this->lang->line('status');?></th>							
							<th style="text-align:center;width:60px;"><?=$this->lang->line('edit');?></th>
							<th style="text-align:center;width:80px;"><?=$this->lang->line('delete');?></th>
						</tr>
					</thead>					
					<?if ($pages) {?>
					<?foreach($pages as $page){?>
						<tr<?=($page['parent'] == "" ? ' style="background-color:#fff;"' : "")?>>
							<td pageid="<?=$page['page_id']?>"><?=$page['display_order'];?> <?=anchor('admin/pages/move_up/page_id/'.$page['page_id'], 'Monter')?> <?=anchor('admin/pages/move_down/page_id/'.$page['page_id'], 'Descendre')?></td>												
							<td><?=($page['parent'] ? $page['parent'] : "")?></td>
							<td><?=$page['title'];?></td>						
							<td style="text-align:center;">Voir cette page (<a href="<?=site_url("fr/page/".$page['url_title'])?>" target="_blank">fr</a> | <a href="<?=site_url("en/page/".$page['url_title_en'])?>" target="_blank">en</a>)</td>
							<td style="text-align:center;">
								<?if($page['status']){?>
									<?=anchor('admin/pages/change_status/page_id/' . $page['page_id'] . '/status/0', $this->lang->line('published'));?>
								<?}else{?>
									<?=anchor('admin/pages/change_status/page_id/' . $page['page_id'] . '/status/1', $this->lang->line('unpublished'));?>
								<?}?>
							</td>						
							<td style="text-align:center;"><?=anchor('admin/pages/form/page_id/' . $page['page_id'], $this->lang->line('edit'));?></td>
							<td style="text-align:center;"><?=anchor('admin/pages/delete/page_id/' . $page['page_id'], $this->lang->line('delete'), array("onclick"=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false"));?></td>
						</tr>
					<?}?>
					<?} else {?>
						<tr>
							<td colspan="7"><?=$this->lang->line('pages_none_exist');?></td>
						</tr>
					<?}?>
					<tfoot>
						<tr>
							<td colspan="7" align="center"><?=$nav;?></td>
						</tr>
					</tfoot>
				</table>
			</div>