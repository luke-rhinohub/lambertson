<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
    
    function Products() {

        parent::__construct();
        $this->data = array();
    }
    
    function _remap() {
	
		if(isset($_POST['attribute_pos']) && isset($_POST['attributes']))
		{
			$category_id = end($this->uri->segments);		
			$data = $this->mdl_products->getStepOptions($_POST['attribute_pos'], $_POST['attributes'], $category_id);
			if(count($_POST['attributes']) + 1 != $_POST['attribute_pos'])
				echo json_encode(array('options' => $data));
			else
				echo json_encode(array('product' => $data));
		}
		else
		{
			$this->data['url'] = $this->uri->segment(3);
			$category_id = end($this->uri->segments);	
			
			$this->mdl_product_categories->category_id = $category_id;
			$category = $this->mdl_product_categories->get();
			
			if($this->data['url'] == 'contractors')			
			{
				$this->mdl_pages->page_id = 24;   
				$page = $this->mdl_pages->get();
				$category_id_top = 4;
				if($category_id == 'contractors')
					$category_id = $category_id_top;
				$this->data['bg'] = 'bg_contractors';
			}
			elseif($this->data['url'] == 'plumbing-wholesaler')		
			{
				$this->mdl_pages->page_id = 23;   
				$page = $this->mdl_pages->get();
				$category_id_top = 3;
				if($category_id == 'plumbing-wholesaler')
					$category_id = $category_id_top;
				$this->data['bg'] = 'bg_plumbing_wholesaler';				
			}
			else
			{
				//Par défaut : Food Service
				$this->data['url'] ='food-service';
				$this->mdl_pages->page_id = 22;   
				$page = $this->mdl_pages->get();
				$category_id_top = 2;
				if($category_id == 'food-service')
					$category_id = $category_id_top;
				$this->data['bg'] = 'bg_food_service';				
			}
			if(!$category)
			{
				$this->mdl_product_categories->category_id = $category_id;
				$category = $this->mdl_product_categories->get();
			}
			
			$categories_db = $this->mdl_product_categories->getCategories();		
			$categories_array = array(
				'categories' => array(),
				'parent_cats' => array()
			);
			foreach($categories_db as $key => $c)
			{
				$categories_array['categories'][$c->category_id] = $c;
				$categories_array['parent_cats'][$c->category_parent_id][] = $c->category_id;
			}
						
			$this->mdl_products->product_category_id = $category_id;
			$steps = $this->mdl_products->getSteps();
			
			//page 404
			if (empty($page) || !$category) {  //
				$this->data['url_fr'] = '';	
				$this->data['parent_url_title'] = '';				
				$this->data['child_url_title'] = '';
				$this->data['children'] = false;
				
				$page = array();
				$page['title_en'] = 'Page Not Found';
				$page['url_title_en'] = '';	
				$this->data['pages'] = $this->mdl_pages->getPagesForMenu();			
				$this->data['page'] = $page;
				$this->load->view('templates/default/en/header', $this->data);
				$this->load->view('templates/default/en/404', $this->data);
				$this->load->view('templates/default/en/footer', $this->data);			
			}
			else
			{	
				$this->mdl_pages->parent_id = $page['parent_id'];
				$this->data['parent_url_title'] = $this->mdl_pages->getParentUrl()->url_title_en;
				$this->data['child_url_title'] = $page['url_title_en'];	
				$this->data['children'] = $this->mdl_pages->getChildrenPages();	
				$this->data['pages'] = $this->mdl_pages->getPagesForMenu();				
				$this->data['page'] = $page;
				$this->data['category'] = $category;
				
				$this->mdl_product_category_images->image_category_id = $category_id;
				$this->data['category_images'] = $this->mdl_product_category_images->get();
				if($category->category_parent_id != 1)
				{
					$this->mdl_product_categories->category_id = $category->category_parent_id;
					$this->data['parent_category'] = $this->mdl_product_categories->get();
					if($this->data['parent_category']->category_parent_id == 1)
						$this->data['parent_category'] = false;
				}
				else
					$this->data['parent_category'] = false;
				$this->data['type'] = $type;
				$this->data['steps'] = $steps;
				
				$category_url_selected = str_replace('en/products/'.$this->data['url'].'/','', uri_string());
				$url_selected_parts = explode ('/', $category_url_selected);			
				$this->data['menu_cat_html'] = $this->buildMenuCategories($category_id_top, $categories_array, $this->data['url'].'/', $url_selected_parts);
					
				$this->load->view('templates/default/en/header', $this->data);
				$this->load->view('templates/default/en/products', $this->data);
				$this->load->view('templates/default/en/footer', $this->data);
			}
		}
    }
		
	function buildMenuCategories($parent, $category, $url, $url_selected_parts, $level = 0) 
	{		
		$html = "";
		if (isset($category['parent_cats'][$parent])) {
			foreach ($category['parent_cats'][$parent] as $cat_id) {
				if($level == 0 || isset($category['parent_cats'][$cat_id]))
				{	
					$html .= '<div class="onglet'.(url_title($category['categories'][$cat_id]->category_name) == $url_selected_parts[$level] ? ' selected linked': '').'">';
						$html .= '<div class="t">';
							if(isset($category['parent_cats'][$cat_id]))
								$html .= '<a href="javascript:;" class="collapsible">'.$category['categories'][$cat_id]->category_name."</a>";
							else
								$html .= '<a href="'.base_url().'en/products/'.$url.url_title($category['categories'][$cat_id]->category_name).'/'.$cat_id.'">'.$category['categories'][$cat_id]->category_name."</a>";
						$html .= '</div>';
						if(isset($category['parent_cats'][$cat_id]))
						{
							$html .= '<div class="c">';
								$html .= $this->buildMenuCategories($cat_id, $category, $url.url_title($category['categories'][$cat_id]->category_name).'/',$url_selected_parts, $level+1);
							$html .= '</div>';
						}
					$html .= '</div>';
				}
				else
				{
					$html .= '<div'.(url_title($category['categories'][$cat_id]->category_name) == $url_selected_parts[$level] ? ' class="selected"': '').'><a href="'.base_url().'en/products/'.$url.url_title($category['categories'][$cat_id]->category_name).'/'.$cat_id.'">'.$category['categories'][$cat_id]->category_name."</a></div>";
				}
			}
		}		
		return $html;
    }
}
?>
