		</div>	
		<script>
			$(document).ready(function() {
				CKEDITOR.replace('news_content');
				CKEDITOR.replace('news_content_en');
				$.datepicker.regional['fr'] = {					
					monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
					'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
					monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
					'Jul','Aoû','Sep','Oct','Nov','Déc'],
					dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
					dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
					dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],	
					isRTL: false			
				};
				$.datepicker.setDefaults($.datepicker.regional['fr']);			
				$("#news_publishing_date").datepicker({			
					dateFormat: "yy-mm-dd",
					changeMonth: true,
					changeYear: true
				});		
			});
        </script>			
		<div id="contentfull">		
			<h2 id="Intro"><?if(!$news_id){?>Créer une nouvelle<?}else{?>Éditer une nouvelle<?}?></h2>
			<?if($news_id){?>
				<?=form_open('admin/news/form/news_id/'.$news_id);?>
			<?}else{?>
				<?=form_open('admin/news/form');?>
			<?}?>
				<?=$this->validation->error_string;?>	
				<label>Date de publication</label>
				<input type="text" class="styled" style="width:90px;cursor:pointer;" name="news_publishing_date" id="news_publishing_date" readonly="readonly" value="<?=$this->validation->news_publishing_date;?>"/><br/>														
				<label>Titre</label>
				<input type="text" class="styled" style="width: 35%;" name="news_title" value="<?=$this->validation->news_title;?>"/><br/>
				<label>Titre (Anglais)</label>
				<input type="text" class="styled" style="width: 35%;" name="news_title_en" value="<?=$this->validation->news_title_en;?>"/><br/>
				<label>Description</label>
				<input type="text" class="styled" style="width:99%;" name="news_desc" value="<?=$this->validation->news_desc;?>"/><br/>
				<label>Description (Anglais)</label>
				<input type="text" class="styled" style="width:99%;" name="news_desc_en" value="<?=$this->validation->news_desc_en;?>"/><br/>					
				<label>Contenu</label>
				<textarea name="news_content" id="news_content"><?=$this->validation->news_content;?></textarea><br/>
				<label>Contenu (Anglais)</label>
				<textarea name="news_content_en" id="news_content_en"><?=$this->validation->news_content_en;?></textarea><br/>
				<input type="submit" class="styled" name="btnSubmit" value="<?=$this->lang->line('button_submit');?>" />
			</form>
		</div>