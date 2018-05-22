<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_categories extends CI_Controller {

	var $category_id;

	function Product_categories() {

		parent::__construct();
		
		$this->lib_admin->check_credentials();

		$uri = $this->uri->uri_to_assoc(4);

		if (isset($uri['category_id']))
			$this->category_id = $uri['category_id'];
	}

	function index() {	
		
		$categories = $this->mdl_product_categories->getCategories();		
        $category = array(
            'categories' => array(),
            'parent_cats' => array()
        );
		foreach($categories as $key => $c)
		{
			$category['categories'][$c->category_id] = $c;
			$category['parent_cats'][$c->category_parent_id][] = $c->category_id;
		}	
		$categories = array();
		$this->buildCategoriesArray(0, $category, $categories);

		$data = $this->lib_admin->data();
		$data['categories'] = $categories;
		$data['managestyle'] = 'active';
		$data['manageproductcategoriesstyle'] = 'active';	

		$this->load->view('admin/header', $data);
		$this->load->view('admin/header_manage', $data);
		$this->load->view('admin/product_categories', $data);
		$this->load->view('admin/footer', $data);
	}
	
	function buildCategoriesArray($parent, $category, &$categories_in_order, $level = 0) 
	{          
		if (isset($category['parent_cats'][$parent])) {               
			foreach ($category['parent_cats'][$parent] as $cat_id) {
				$category['categories'][$cat_id]->category_name = $this->trailingMark($level).$this->trailingMark($level).$category['categories'][$cat_id]->category_name;
				$categories_in_order[] = $category['categories'][$cat_id];
				
				if(isset($category['parent_cats'][$cat_id]))
				   $this->buildCategoriesArray($cat_id, $category, $categories_in_order, $level+1);
			}
		}
    }
	function buildDropDownListCategories($parent, $category, $level = 0) 
	{
		$html = "";
		if (isset($category['parent_cats'][$parent])) {
			foreach ($category['parent_cats'][$parent] as $cat_id) {
				$html .= '<option value="'.$category['categories'][$cat_id]->category_id.'">' . $this->trailingMark($level).$category['categories'][$cat_id]->category_name . "</option>";
				
				if(isset($category['parent_cats'][$cat_id]))
					$html .= $this->buildDropDownListCategories($cat_id, $category, $level+1);
			}
		}
		return $html;
    }
	function trailingMark($nb)
	{
		$html = '';
		for($i = 0;$i < $nb;$i ++)	
			$html .= '&nbsp;&nbsp;';
		return $html;
	}

	function form() {	
		
		$rules = array(		
			'category_parent_id'	=>	'required',		
			'category_name'	=>	'required',
			'category_name_en'	=>	'required',
			'category_name_singular'	=>	'',
			'category_name_singular_en'	=>	'',
			'category_desc'	=>	'',
			'category_desc_en'	=>	'',
			'category_text'	=>	'',
			'category_text_en'	=>	'',
			'category_file' =>	'',	
			'category_file_old' =>	''			
		);

		$this->validation->set_rules($rules);

		$fields = array(		
			'category_parent_id'	=>	'Catégorie parent',
			'category_name'	=>	'Titre',
			'category_name_en'	=>	'Titre (anglais)',
			'category_name_singular'	=>	'Nom complet singulier',
			'category_name_singular_en'	=>	'Nom complet singulier (anglais)',
			'category_desc'	=>	'Description',
			'category_desc_en'	=>	'Description (anglais)',
			'category_text'	=>	'Texte',
			'category_text_en'	=>	'Texte (anglais)',
			'category_file'	=>	'Fiche (PDF)',
			'category_file_old'	=>	''
		);

		$this->validation->set_fields($fields);

		if ($this->validation->run()) {
			if($this->_save())
			{
				$this->session->set_flashdata('save_message', "La catégorie de produit a été enregistrée.");
				redirect('admin/product_categories');	
			}			
		}

		else {
			if (!$_POST AND $this->category_id) {
				$this->mdl_product_categories->category_id = $this->category_id;
				$db_category = $this->mdl_product_categories->get();
				$this->validation->category_parent_id = $db_category->category_parent_id;
				$this->validation->category_name = $db_category->category_name;
				$this->validation->category_name_en = $db_category->category_name_en;
				$this->validation->category_name_singular = $db_category->category_name_singular;
				$this->validation->category_name_singular_en = $db_category->category_name_singular_en;
				$this->validation->category_desc = $db_category->category_desc;
				$this->validation->category_desc_en = $db_category->category_desc_en;
				$this->validation->category_text = $db_category->category_text;
				$this->validation->category_text_en = $db_category->category_text_en;
				$this->validation->category_file_old = $db_category->category_file;
			}		

			$data = $this->lib_admin->data();
			$data['category_id'] = $this->category_id;
			
			//Dropdownlist
            $categories = $this->mdl_product_categories->getCategories();			
			$category = array(
				'categories' => array(),
				'parent_cats' => array()
			);
			foreach($categories as $key => $c)
			{
				$category['categories'][$c->category_id] = $c;
				$category['parent_cats'][$c->category_parent_id][] = $c->category_id;
			}
			$data['dropdownlist_categories'] = $this->buildDropDownListCategories(0, $category);
			
			
			if($this->category_id)
			{
				$data['managestyle'] = 'active';
				$data['manageproductcategoriesstyle'] = 'active';
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_manage', $data);
				$this->load->view('admin/product_categories_form', $data);
				$this->load->view('admin/footer', $data);
			}
			else
			{
				$data['writestyle'] = 'active';
				$data['writecategoriesstyle'] = 'active';
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_write', $data);
				$this->load->view('admin/product_categories_form', $data);
				$this->load->view('admin/footer', $data);			
			}		
		}		
	}
	
	function _save() {
		
		$config1['upload_path'] = 'images/contenu/product_categories/pdf';
		$config1['allowed_types'] = 'pdf';
		$config1['max_size'] = 0;
		$config1['max_width'] = 0;
		$config1['max_height'] = 0;		
		$this->load->library('upload', $config1);
		$error = "<p>Vous n'avez pas s&eacute;lectionn&eacute; de fichier &agrave; envoyer.</p>";
		$erreur = "";
		$fichier = '';
	
		if(!$this->upload->do_upload("category_file")) 
		{
			if($error != $this->upload->display_errors()) 
			{
				$erreur .= str_replace($error, "", $this->upload->display_errors());					
				if($this->category_id)
				{
					$this->session->set_flashdata('save_message', $erreur);
					redirect('admin/product_categories/form/category_id/'.$this->category_id);
				}
				else
				{
					$data['category_id'] = $this->category_id;
			
					//Dropdownlist
					$categories = $this->mdl_product_categories->getCategories();			
					$category = array(
						'categories' => array(),
						'parent_cats' => array()
					);
					foreach($categories as $key => $c)
					{
						$category['categories'][$c->category_id] = $c;
						$category['parent_cats'][$c->category_parent_id][] = $c->category_id;
					}
					$data['dropdownlist_categories'] = $this->buildDropDownListCategories(0, $category);
			
					$data['message_error_file'] = $erreur;
					$data['writestyle'] = 'active';
					$data['writecategoriesstyle'] = 'active';			
					$this->load->view('admin/header', $data);
					$this->load->view('admin/header_write', $data);		
					$this->load->view('admin/product_categories_form', $data);
					$this->load->view('admin/footer', $data);	
				}						
				$go = false;
			} 
			else 
			{
				$fichier = $this->input->post('category_file_old');
				$go = true;
			}
		}
		else
		{
			$data = $this->upload->data();
			$fichier = $data['file_name'];	
			$go = true;
		}			
		
		if($go)
		{
			$this->mdl_product_categories->category_id = $this->category_id;
			$this->mdl_product_categories->category_parent_id = $this->input->post('category_parent_id');			
			$this->mdl_product_categories->category_name = $this->input->post('category_name');
			$this->mdl_product_categories->category_name_en = $this->input->post('category_name_en');
			$this->mdl_product_categories->category_name_singular = $this->input->post('category_name_singular');
			$this->mdl_product_categories->category_name_singular_en = $this->input->post('category_name_singular_en');
			$this->mdl_product_categories->category_desc = $this->input->post('category_desc');
			$this->mdl_product_categories->category_desc_en = $this->input->post('category_desc_en');
			$this->mdl_product_categories->category_text = $this->input->post('category_text');
			$this->mdl_product_categories->category_text_en = $this->input->post('category_text_en');	
			$this->mdl_product_categories->category_file = $fichier;		
			$this->mdl_product_categories->save();		
						
			//delete old files
			if($this->input->post('category_file_old')!='' && $fichier != '' && $fichier != $this->input->post('category_file_old')){
				$file = "images/contenu/product_categories/pdf/".$this->input->post('category_file_old');
				if(file_exists($file))			
					unlink($file);
			}
		}			
				
			
		return $go;		
	}

	function delete() {
		
		// Suppression des pdfs
		$this->mdl_product_categories->category_id = $this->category_id;		
		$product_category = $this->mdl_product_categories->get();
		
		if(file_exists("images/contenu/product_categories/pdf/".$product_category->category_file))
			unlink("images/contenu/product_categories/pdf/".$product_category->category_file);
		
		$this->mdl_product_categories->delete();
		redirect('admin/product_categories');
	}
	
	function move_down() {
        $this->mdl_product_categories->category_id = $this->category_id;
        $this->mdl_product_categories->move_down();
        redirect('admin/product_categories');
    }
    
    function move_up() {
        $this->mdl_product_categories->category_id = $this->category_id;
        $this->mdl_product_categories->move_up();
        redirect('admin/product_categories');
    }
}
?>
