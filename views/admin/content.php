<style>
.heading {
	background:#4F9EC9;
	color: white;
	font-weight: bold;
	font-family: arial;
	padding: 3px;
}	
.imgTable
{
	width:19%;
}
</style>
<div id="contentnorightbar">
	<h2 id="Intro"><a href="#">Administration du site</a></h2>				
	<div class="imgTable">
		<?=anchor('admin/pages', '<img src="'.base_url().'images/admin/icones/icone_pages.png" class="icons">', 'attribute="here"');?>
		<h3>Gérer les pages</h3>
	</div>		
	<div class="imgTable">
		<?=anchor('admin/news', '<img src="'.base_url().'images/admin/icones/icone_nouvelles.png" class="icons">', 'attribute="here"');?>
		<h3>Gérer les nouvelles</h3>
	</div>	
	<!--<div class="imgTable">
		<?=anchor('admin/products', '<img src="' . base_url() . 'images/admin/icones/icone_produits.png" class="icons">', 'attribute="here"');?>
		<h3>G&eacute;rer les produits</h3>
	</div>-->
	<div class="imgTable">
		<?=anchor('admin/product_categories', '<img src="' . base_url() . 'images/admin/icones/icone_categories_produits.png" class="icons">', 'attribute="here"');?>
		<h3>G&eacute;rer les catégories de produits</h3>
	</div>
	<!--<div class="imgTable">
		<?=anchor('admin/distributors', '<img src="'.base_url().'images/admin/icones/icone_distributeurs.png" class="icons">', 'attribute="here"');?>
		<h3>G&eacute;rer les distributeurs</h3>
	</div>	-->	
	<div class="imgTable">
		<?=anchor('admin/users', '<img src="' . base_url() . 'images/admin/icones/icone_utilisateurs.png" class="icons">', 'attribute="here"');?>
		<h3><?=$this->lang->line('user_manage');?></h3>
	</div>
</div>