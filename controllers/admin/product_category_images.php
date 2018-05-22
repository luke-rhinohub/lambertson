<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_category_images extends CI_Controller {
	var $image_id;
	
	var $page;
	var $prevpage;
	var $nextpage;
	var $nav;

	function Product_category_images() {
		parent::__construct();

		$this->lib_admin->check_credentials();

		$uri = $this->uri->uri_to_assoc(4);
		if (isset($uri['image_id'])) 
			$this->image_id = $uri['image_id'];
		
		if (isset($uri['page'])) 
			$this->page = $uri['page'];
		
		if (isset($uri['category_id'])) 
			$this->category_id = $uri['category_id'];    
	}	
	
	function index() {
	
		if($this->category_id)
		{
			if (!$this->page) 
				$this->page = 1;

			$this->mdl_product_category_images->page = $this->page;

			$this->mdl_product_category_images->paginate = false;
			$this->mdl_product_category_images->image_category_id = $this->category_id;
			$photos = $this->mdl_product_category_images->get();
			
			$this->mdl_product_categories->category_id = $this->category_id;
			$category = $this->mdl_product_categories->get();
			
			$data = $this->lib_admin->data();
			$data['managestyle'] = 'active';
			$data['manageproductcategoriesstyle'] = 'active';			
			$data['photos'] = $photos;
			$data['category'] = $category;
			$data['nav'] = $this->lib_paginate->paginate_admin('admin/product_category_images/index', $this->mdl_product_category_images->numpages);
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/header_manage', $data);
			$this->load->view('admin/product_category_images', $data);
			$this->load->view('admin/footer');
		}
	}

	function form() {	
		$rules = array(
			'image_title'	=>	'',
			'image_file'	=>	'',
			'ancienfichier'	=>	''	
		);
		$this->validation->set_rules($rules);

		$fields = array(
			'image_title'	=>	"Titre",
			'image_file'	=>	"Fichier",
			'ancienfichier'	=>	''
		);
		$this->validation->set_fields($fields);

		if ($this->validation->run()) {			
			$this->_save();
			$this->session->set_flashdata('save_message', "La photo a été enregistrée.");
			redirect('admin/product_category_images/index/category_id/'.$this->category_id);
			
		} else {
			$data = $this->lib_admin->data();
			if (!$_POST AND $this->image_id) {
				$this->mdl_product_category_images->image_id = $this->image_id;				
				$db_photo = $this->mdl_product_category_images->get();	
				$this->validation->image_category_id = $db_photo->image_category_id;				
				$this->validation->image_title = $db_photo->image_title;		
				$this->validation->ancienfichier = $db_photo->image_file;
			}	
			
			$this->mdl_product_categories->category_id = $this->category_id;
			$category = $this->mdl_product_categories->get();
			$data['category'] = $category;

			$data['image_id'] = $this->image_id;			
			
			$data['managestyle'] = 'active';
			$data['manageproductcategoriesstyle'] = 'active';
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/header_manage', $data);		
			$this->load->view('admin/product_category_images_form', $data);
			$this->load->view('admin/footer', $data);
		}
	}

	function _save() {
		
		$config1['upload_path'] = 'images/contenu/product_categories/images/';
		$config1['allowed_types'] = 'gif|jpg|jpeg|png';
		$config1['max_size'] = 0;
		$config1['max_width'] = 0;
		$config1['max_height'] = 0;
		$config1['encrypt_name'] = true;
		$this->load->library('upload', $config1);
		$error = "<p>Vous n'avez pas s&eacute;lectionn&eacute; de fichier &agrave; envoyer.</p>";
		$erreur = "";
		$fichier = '';
		
		if (!$this->upload->do_upload("image_file")) {
			if($error != $this->upload->display_errors()) {
				$erreur .= str_replace($error, "", $this->upload->display_errors());			
				$this->session->set_flashdata('save_message', $erreur);
				if($this->image_id)
					redirect('admin/product_category_images/form/category_id/'.$this->category_id.'/image_id/'.$this->image_id);
				else
					redirect('admin/product_category_images/form/category_id/'.$this->category_id);			
				$go = false;
			} else {
				$fichier = $this->input->post('ancienfichier');
				$go = true;
			}
		}else{
			$data = $this->upload->data();
			$fichier = $data['file_name'];
			
			if($this->input->post('ancienfichier')!=''){
				$file = "images/contenu/product_categories/images/".$this->input->post('ancienfichier');
				if(file_exists($file)){				
					unlink($file);
				}
			}

			$file = "images/contenu/product_categories/images/".$fichier;
			list($origw, $origh, $imgtype, $attr) = getimagesize($file);
			switch($imgtype) {
				case 1: // GIF
					$src_img = imagecreatefromgif($file);
					break;
				case 2: // JPG
					$src_img = imagecreatefromjpeg($file);
					break;
				case 3: // PNG
					$src_img = imagecreatefrompng($file);
					break;
				case 6: // BMP
					$src_img = imagecreatefrombmp($file);
				break;
				default:
					break;
			}
			if($origw>$origh) {
				if($origw >= 800) {
					$new_w = 800;
					$new_h = round(800*$origh/$origw);
					$dst_img = imagecreatetruecolor($new_w, $new_h);
					imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, $origw, $origh);
					imagejpeg($dst_img, $file, 100);
				}
				list($largew, $largeh) = getimagesize($file);

				if($largeh >= 600) {
					$new_h = 600;
					$new_w = round(600*$origw/$origh);
					$dst_img = imagecreatetruecolor($new_w, $new_h);
					imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, $origw, $origh);
					imagejpeg($dst_img, $file, 100);
				}
				list($largew2, $largeh2) = getimagesize($file);
			}else{
				if($origh >= 600) {
					$new_h = 600;
					$new_w = round(600*$origw/$origh);
					$dst_img = imagecreatetruecolor($new_w, $new_h);
					imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, $origw, $origh);
					imagejpeg($dst_img, $file, 100);
				}
				list($largew, $largeh) = getimagesize($file);
				
				if($largew >= 800) {
					$new_w = 800;
					$new_h = round(800*$origh/$origw);
					$dst_img = imagecreatetruecolor($new_w, $new_h);
					imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, $origw, $origh);
					imagejpeg($dst_img, $file, 100);
				}
			}
			$go = true;
		}

		if($go) {
			$this->mdl_product_category_images->image_id = $this->image_id;
			$this->mdl_product_category_images->image_category_id = $this->category_id;
			$this->mdl_product_category_images->image_title = $this->input->post('image_title');
			$this->mdl_product_category_images->image_file = $fichier;
			$this->mdl_product_category_images->save();
		}
	}

	function delete() {
		$this->mdl_product_category_images->image_id = $this->image_id;		
		$image = $this->mdl_product_category_images->get();
		
		if(file_exists("images/contenu/product_categories/images/".$image->image_file))
			unlink("images/contenu/product_categories/images/".$image->image_file);
	
		$this->mdl_product_category_images->delete();	
		redirect('admin/product_category_images/index/category_id/'.$this->category_id);
	}
	
	function move_down() {
        $this->mdl_product_category_images->image_category_id = $this->category_id;
		$this->mdl_product_category_images->image_id = $this->image_id;
        $this->mdl_product_category_images->move_down();
        redirect('admin/product_category_images/index/category_id/'.$this->category_id);
    }
    
    function move_up() {
        $this->mdl_product_category_images->image_category_id = $this->category_id;
		 $this->mdl_product_category_images->image_id = $this->image_id;
        $this->mdl_product_category_images->move_up();
       	redirect('admin/product_category_images/index/category_id/'.$this->category_id);
    }
}

?>
