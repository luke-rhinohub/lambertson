<?php /*
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Equipements extends CI_Controller {
    var $settings;
    
    function Equipements() {

		parent::__construct();
		$this->data = array();
    }
    
    function _remap() {
		
	
			$this->data['url'] = $this->uri->segment(3);
			$product_id = end($this->uri->segments);
			
			if(!$this->uri->segment(3))
			{
				$this->mdl_pages->parent_id = 5;
				$page = $this->mdl_pages->getFirstChildren();
				$this->data['url'] = $page->url_title;
			}
			if($this->data['url'] == 'emballage-alimentaire')			
			{
				$this->mdl_pages->page_id = 13;   
				$page = $this->mdl_pages->get();			
				$this->mdl_products->product_category_id = 7;
			}
			else
			{
				$this->mdl_pages->page_id = 14;   
				$page = $this->mdl_pages->get();			
				$this->mdl_products->product_category_id = 1;
			}
			$this->data['products'] = $this->mdl_products->getProductsFromCategory();
					
			//page 404
			if (empty($page)) {  
			
				$this->data['url_en'] = '';				
				$this->data['parent_url_title'] = '';				
				$this->data['child_url_title'] = '';
				$this->data['children'] = false;
				
				$page = array();
				$page['title'] = $this->lang->line('page_not_found');	
				$page['url_title_en'] = '';	
				$this->data['pages'] = $this->mdl_pages->getPagesForMenu();			
				$this->data['page'] = $page;	
				$this->load->view('templates/default/fr/header', $this->data);
				$this->load->view('templates/default/fr/404', $this->data);
				$this->load->view('templates/default/fr/footer', $this->data);
			}
			else
			{	
				$this->mdl_pages->parent_id = $page['parent_id'];
				$this->data['parent_url_title'] = $this->mdl_pages->getParentUrl()->url_title;				
				$this->data['child_url_title'] = $page['url_title'];	
				$this->data['children'] = $this->mdl_pages->getChildrenPages();	

				$this->data['pages'] = $this->mdl_pages->getPagesForMenu();				
				$this->data['page'] = $page;
				$this->data['product_id'] = $product_id;
			
				$this->mdl_products->product_id = $product_id;
				$this->mdl_products->product_is_active = 1;		
				$this->data['product'] = $this->mdl_products->get();
				
				$this->data['url_en'] = 'equipment/';
				if($this->data['url'] == 'emballage-alimentaire')
					$this->data['url_en'] .= 'food-packaging';
				else
					$this->data['url_en'] .= 'food-processing';				
				
				if(!$this->data['product'])
				{
					$this->load->view('templates/default/fr/header', $this->data);
					$this->load->view('templates/default/fr/equipements', $this->data);
					$this->load->view('templates/default/fr/footer', $this->data);
				}
				else
				{						
					$this->data['url_en'] .= '/'.url_title($this->data['product']->product_name_en).'/'.$this->data['product']->product_id;
					$this->data['models'] = $this->mdl_products->getModels();	
					$this->mdl_photos->photo_product_id = $product_id;
					$this->data['photos'] = $this->mdl_photos->get();
					$this->load->view('templates/default/fr/header', $this->data);
					$this->load->view('templates/default/fr/produit', $this->data);
					$this->load->view('templates/default/fr/footer', $this->data);
				}			
			}
		
    }
}*/
?>
