<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	var $product_id;
	
	var $page;
	var $prevpage;
	var $nextpage;
	var $nav;

	function Products() {
		parent::__construct();

		$this->lib_admin->check_credentials();

		$uri = $this->uri->uri_to_assoc(4);
		if (isset($uri['product_id'])) 
			$this->product_id = $uri['product_id'];
		
		if (isset($uri['page'])) 
			$this->page = $uri['page'];		

		if (isset($uri['status'])) 
            $this->status = $uri['status'];  

		// set custom error delimiters
        $this->validation->set_error_delimiters('<div class="error">', '</div>');			
	}	
	
	function index() {
		
		if (!$this->page) 
			$this->page = 1;

		$this->mdl_products->page = $this->page;
		$this->mdl_products->paginate = false;
		$products = $this->mdl_products->get();
		
		$data = $this->lib_admin->data();
		$data['managestyle'] = 'active';
		$data['manageproductsstyle'] = 'active';
		$data['products'] = $products;
		
		$data['nav'] = $this->lib_paginate->paginate_admin('admin/products/index', $this->mdl_products->numpages);
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/header_manage', $data);
		$this->load->view('admin/products', $data);
		$this->load->view('admin/footer');		
	}

	function form() {			
		$rules = array(
			'product_category_id'	=>	'required',
			'product_name'	=>	'required',
			'product_name_en'	=>	'required',
			'product_desc'	=>	'required',
			'product_desc_en'	=>	'required',						
			'product_advantages'	=>	'required',
			'product_advantages_en'	=>	'required',			
			'product_text'	=>	'required',			
			'product_text_en'	=>	'required',
			'product_spec_pdf' =>	'',	
			'product_spec_pdf_old' =>	'',
			'product_spec_pdf_en' =>	'',	
			'product_spec_pdf_en_old' =>	''	
		);
		$this->validation->set_rules($rules);

		$fields = array(
			'product_category_id'	=>	'Catégorie',
			'product_name'	=>	"Nom du produit",
			'product_name_en'	=>	"Nom du produit (anglais)",
			'product_desc'	=>	"Description",
			'product_desc_en'	=>	"Description (anglais)",				
			'product_advantages'	=>	'Avantages',
			'product_advantages_en'	=>	'Avantages (anglais)',			
			'product_text'	=>	'Texte',			
			'product_text_en'	=>	'Texte (anglais)',
			'product_spec_pdf' =>	'Fiche technique (PDF)',
			'product_spec_pdf_old' =>	'',
			'product_spec_pdf_en' =>	'Fiche technique (PDF) (anglais)',
			'product_spec_pdf_en_old' =>	''
		);
		$this->validation->set_fields($fields);

		if ($this->validation->run()) {		
			if($this->_save())
			{
				$this->session->set_flashdata('save_message', "Le produit a été enregistré.");
				redirect('admin/products');	
			}
			
		} 
		else 
		{
			$data = $this->lib_admin->data();
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
			
			if (!$_POST AND $this->product_id) {
				$this->mdl_products->product_id = $this->product_id;				
				$db_product = $this->mdl_products->get();	
				
				$this->validation->product_category_id = $db_product->product_category_id;
				$this->validation->product_name = $db_product->product_name;
				$this->validation->product_name_en = $db_product->product_name_en;
				$this->validation->product_desc = $db_product->product_desc;
				$this->validation->product_desc_en = $db_product->product_desc_en;			
				$this->validation->product_advantages = $db_product->product_advantages;
				$this->validation->product_advantages_en = $db_product->product_advantages_en;
				$this->validation->product_text = $db_product->product_text;
				$this->validation->product_text_en = $db_product->product_text_en;
				$this->validation->product_spec_pdf_old = $db_product->product_spec_pdf;
				$this->validation->product_spec_pdf_en_old = $db_product->product_spec_pdf_en;
			}
		
			$data['product_id'] = $this->product_id;

			if($this->product_id)
			{	
				$data['managestyle'] = 'active';
				$data['manageproductsstyle'] = 'active';			
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_manage', $data);		
				$this->load->view('admin/products_form', $data);
				$this->load->view('admin/footer', $data);
			}
			else
			{
				$data['writestyle'] = 'active';
				$data['writeproductsstyle'] = 'active';			
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_write', $data);		
				$this->load->view('admin/products_form', $data);
				$this->load->view('admin/footer', $data);			
			}	
		}
	}
	
	function buildDropDownListCategories($parent, $category, $level = 0) 
	{
		$html = "";
		if (isset($category['parent_cats'][$parent])) {
			foreach ($category['parent_cats'][$parent] as $cat_id) {
				if(!isset($category['parent_cats'][$cat_id]))
					$html .= '<option value="'.$category['categories'][$cat_id]->category_id.'">' . $this->trailingMark($level).$category['categories'][$cat_id]->category_name . "</option>";
				else if(isset($category['parent_cats'][$cat_id]))
				{
					$html .= '<option value="'.$category['categories'][$cat_id]->category_id.'" disabled>' . $this->trailingMark($level).$category['categories'][$cat_id]->category_name . "</option>";
					$html .= $this->buildDropDownListCategories($cat_id, $category, $level+1);
				}
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

	function _save() {
		
		$config1['upload_path'] = 'images/contenu/products/pdf';
		$config1['allowed_types'] = 'pdf';
		$config1['max_size'] = 0;
		$config1['max_width'] = 0;
		$config1['max_height'] = 0;		
		$this->load->library('upload', $config1);
		$error = "<p>Vous n'avez pas s&eacute;lectionn&eacute; de fichier &agrave; envoyer.</p>";
		$erreur = "";
		$fichier = '';
		$fichier_en = '';
		
		if(!$this->upload->do_upload("product_spec_pdf")) 
		{
			if($error != $this->upload->display_errors()) 
			{
				$erreur .= str_replace($error, "", $this->upload->display_errors());					
				if($this->product_id)
				{
					$this->session->set_flashdata('save_message', $erreur);
					redirect('admin/products/form/product_id/'.$this->product_id);
				}
				else
				{
					$data['message_error_file'] = $erreur;
					$data['categories'] = $this->mdl_product_categories->get();
					$data['writestyle'] = 'active';
					$data['writeproductsstyle'] = 'active';			
					$this->load->view('admin/header', $data);
					$this->load->view('admin/header_write', $data);		
					$this->load->view('admin/products_form', $data);
					$this->load->view('admin/footer', $data);	
				}						
				$go = false;
			} 
			else 
			{
				$fichier = $this->input->post('product_spec_pdf_old');
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
			if(!$this->upload->do_upload("product_spec_pdf_en")) 
			{
				$error2 = "<p>Vous n'avez pas s&eacute;lectionn&eacute; de fichier &agrave; envoyer.</p><p>Vous n'avez pas s&eacute;lectionn&eacute; de fichier &agrave; envoyer.</p>";
				if($error != $this->upload->display_errors() && $error2 != $this->upload->display_errors()) 
				{
					$erreur .= str_replace($error, "", $this->upload->display_errors());					
					if($this->product_id)
					{
						$this->session->set_flashdata('save_message', $erreur);
						redirect('admin/products/form/product_id/'.$this->product_id);
					}
					else
					{
						$data['message_error_file'] = $erreur;
						$data['categories'] = $this->mdl_product_categories->get();
						$data['writestyle'] = 'active';
						$data['writeproductsstyle'] = 'active';			
						$this->load->view('admin/header', $data);
						$this->load->view('admin/header_write', $data);		
						$this->load->view('admin/products_form', $data);
						$this->load->view('admin/footer', $data);	
					}						
					$go = false;
				} 
				else 
				{
					$fichier_en = $this->input->post('product_spec_pdf_en_old');
					$go = true;
				}
			}
			else
			{
				$data = $this->upload->data();
				$fichier_en = $data['file_name'];	
				$go = true;
			}
			
			if($go)
			{
				$this->mdl_products->product_id = $this->product_id;	
				$this->mdl_products->product_category_id = $this->input->post('product_category_id');
				$this->mdl_products->product_name = $this->input->post('product_name');
				$this->mdl_products->product_name_en = $this->input->post('product_name_en');
				$this->mdl_products->product_desc = $this->input->post('product_desc');
				$this->mdl_products->product_desc_en = $this->input->post('product_desc_en');	
				$this->mdl_products->product_advantages = $this->input->post('product_advantages');
				$this->mdl_products->product_advantages_en = $this->input->post('product_advantages_en');	
				$this->mdl_products->product_text = $this->input->post('product_text');
				$this->mdl_products->product_text_en = $this->input->post('product_text_en');		
				$this->mdl_products->product_spec_pdf = $fichier;	
				$this->mdl_products->product_spec_pdf_en = $fichier_en;			
				$product_id = $this->mdl_products->save();	
				
				//delete old pdfs
				if($this->input->post('product_spec_pdf_old')!='' && $fichier != '' && $fichier != $this->input->post('product_spec_pdf_old')){
					$file = "images/contenu/products/pdf/".$this->input->post('product_spec_pdf_old');
					if(file_exists($file))			
						unlink($file);
				}
				if($this->input->post('product_spec_pdf_en_old')!='' && $fichier_en != '' && $fichier_en != $this->input->post('product_spec_pdf_en_old')){
					$file = "images/contenu/products/pdf/".$this->input->post('product_spec_pdf_en_old');
					if(file_exists($file))				
						unlink($file);
				}
			}
			else
			{
				//unlink new pdf fr
				if($fichier !=''){
					$file = "images/contenu/products/pdf/".$fichier;
					if(file_exists($file))			
						unlink($file);
				}
			}			
		}		
		return $go;		
	}

	function delete() {
		// Suppression des images	
		$this->mdl_photos->photo_product_id = $this->product_id;		
		$images = $this->mdl_photos->get();
		foreach($images as $image)
		{
			if(file_exists("images/contenu/products/photos/".$image->photo_file))
				unlink("images/contenu/products/photos/".$image->photo_file);
		}
		// Suppression des pdfs
		$this->mdl_products->product_id = $this->product_id;		
		$product = $this->mdl_products->get();
		
		if(file_exists("images/contenu/products/pdf/".$product->product_spec_pdf))
			unlink("images/contenu/products/pdf/".$product->product_spec_pdf);
		if(file_exists("images/contenu/products/pdf/".$product->product_spec_pdf_en))
			unlink("images/contenu/products/pdf/".$product->product_spec_pdf_en);
		
		$this->mdl_products->delete();	
		redirect('admin/products');
	}
	
	function change_status() {
        $this->mdl_products->product_id = $this->product_id;
        $this->mdl_products->product_is_active = $this->status;
        $this->mdl_products->change_status();	
      	redirect('admin/products');
    }
	
	function move_down() {
        $this->mdl_products->product_id = $this->product_id;
        $this->mdl_products->move_down();
        redirect('admin/products');
    }
    
    function move_up() {
        $this->mdl_products->product_id = $this->product_id;
        $this->mdl_products->move_up();
        redirect('admin/products');
    }
	
	function update_spec_sheets()
	{ 
		 $data = array();
		 $dir = 'images/products/pdf/';
		 if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					//var_dump($file);
					//var_dump(str_replace(" SPEC.PDF", "", $file));
					$data[] = array(
						'product_no' => str_replace(" SPEC.PDF", "", $file),
						'product_spec_sheet_en' => $file						
					);
				}
				closedir($dh);
			}
		}
		var_dump($data);
		$this->db->update_batch('products', $data, 'product_no');
	}
}

?>
