			<ul id="subnav">
				<li>Navigation:</li>		
				<li><?=anchor('admin/pages', "Pages", array('class'=>$managepagesstyle));?></li>
				<li><?=anchor('admin/news', "Nouvelles", array('class'=>$managenewsstyle));?></li>	
				<li><?=anchor('admin/product_categories', "Catégories de produits", array('class'=>$manageproductcategoriesstyle));?></li>				
				<!--<li><?=anchor('admin/products', "Produits", array('class'=>$manageproductsstyle));?></li>
				<li><?=anchor('admin/distributors', "Distributeurs", array('class'=>$managedistributorsstyle));?></li>-->			
				<li><?=anchor('admin/users', $this->lang->line('users'), array('class'=>$manageusersstyle));?></li>
			</ul>
