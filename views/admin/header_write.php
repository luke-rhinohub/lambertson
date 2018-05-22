			<ul id="subnav">
				<li>Navigation:</li>	
				<li><?=anchor('admin/pages/form', "Ajouter une page", array('class'=>@$writepagesstyle));?></li>
				<li><?=anchor('admin/news/form', "Ajouter une nouvelle", array('class'=>@$writenewsstyle));?></li>
				<li><?=anchor('admin/product_categories/form', "Ajouter une catégorie de produits", array('class'=>@$writeproductcategoriesstyle));?></li>
				<!--<li><?=anchor('admin/products/form', "Ajouter un produit", array('class'=>@$writeproductsstyle));?></li>
				<li><?=anchor('admin/distributors/form', "Ajouter un distributeur", array('class'=>@$writedistributorsstyle));?></li>	-->
				<li><?=anchor('admin/users/form', "Ajouter un utilisateur", array('class'=>@$writeusersstyle));?></li>
			</ul>
