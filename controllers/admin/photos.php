<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller {
	var $photo_id;
	
	var $page;
	var $prevpage;
	var $nextpage;
	var $nav;

	function Photos() {
		parent::__construct();

		$this->lib_admin->check_credentials();

		$uri = $this->uri->uri_to_assoc(4);
		if (isset($uri['photo_id'])) 
			$this->photo_id = $uri['photo_id'];
		
		if (isset($uri['page'])) 
			$this->page = $uri['page'];
		
		if (isset($uri['product_id'])) 
			$this->product_id = $uri['product_id'];
		
		if (isset($uri['status'])) 
            $this->status = $uri['status'];        
	}	
	
	function index() {
	
		if($this->product_id)
		{
			if (!$this->page) 
				$this->page = 1;

			$this->mdl_photos->page = $this->page;

			$this->mdl_photos->paginate = false;
			$this->mdl_photos->photo_product_id = $this->product_id;
			$photos = $this->mdl_photos->get();
			
			$this->mdl_products->product_id = $this->product_id;
			$product = $this->mdl_products->get();
			
			$data = $this->lib_admin->data();
			$data['managestyle'] = 'active';
			$data['manageproductsstyle'] = 'active';			
			$data['photos'] = $photos;
			$data['product'] = $product;
			$data['nav'] = $this->lib_paginate->paginate_admin('admin/photos/index', $this->mdl_photos->numpages);
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/header_manage', $data);
			$this->load->view('admin/photos', $data);
			$this->load->view('admin/footer');
		}
	}

	function form() {	
		$rules = array(
			'photo_title'	=>	'',
			'photo_title_en'	=>	'',
			'photo_file'	=>	'',
			'ancienfichier'	=>	''	
		);
		$this->validation->set_rules($rules);

		$fields = array(
			'photo_title'	=>	"Titre",
			'photo_title_en'	=>	"Titre (anglais)",
			'photo_file'	=>	"Fichier",
			'ancienfichier'	=>	''
		);
		$this->validation->set_fields($fields);

		if ($this->validation->run()) {			
			$this->_save();
			$this->session->set_flashdata('save_message', "La photo a été enregistrée.");
			redirect('admin/photos/index/product_id/'.$this->product_id);
			
		} else {
			$data = $this->lib_admin->data();
			if (!$_POST AND $this->photo_id) {
				$this->mdl_photos->photo_id = $this->photo_id;				
				$db_photo = $this->mdl_photos->get();	
				$this->validation->photo_product_id = $db_photo->photo_product_id;				
				$this->validation->photo_title = $db_photo->photo_title;
				$this->validation->photo_title_en = $db_photo->photo_title_en;			
				$this->validation->ancienfichier = $db_photo->photo_file;
			}	
			
			$this->mdl_products->product_id = $this->product_id;
			$product = $this->mdl_products->get();
			$data['product'] = $product;

			$data['photo_id'] = $this->photo_id;			
			
			$data['managestyle'] = 'active';
			$data['manageproductsstyle'] = 'active';
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/header_manage', $data);		
			$this->load->view('admin/photos_form', $data);
			$this->load->view('admin/footer', $data);
		}
	}

	function _save() {
		
		$config1['upload_path'] = 'images/contenu/products/photos/';
		$config1['allowed_types'] = 'gif|jpg|jpeg|png';
		$config1['max_size'] = 0;
		$config1['max_width'] = 0;
		$config1['max_height'] = 0;
		$config1['encrypt_name'] = true;
		$this->load->library('upload', $config1);
		$error = "<p>Vous n'avez pas s&eacute;lectionn&eacute; de fichier &agrave; envoyer.</p>";
		$erreur = "";
		$fichier = '';
		
		if (!$this->upload->do_upload("photo_file")) {
			if($error != $this->upload->display_errors()) {
				$erreur .= str_replace($error, "", $this->upload->display_errors());			
				$this->session->set_flashdata('save_message', $erreur);
				if($this->photo_id)
					redirect('admin/photos/form/product_id/'.$this->product_id.'/photo_id/'.$this->photo_id);
				else
					redirect('admin/photos/form/product_id/'.$this->product_id);			
				$go = false;
			} else {
				$fichier = $this->input->post('ancienfichier');
				$go = true;
			}
		}else{
			$data = $this->upload->data();
			$fichier = $data['file_name'];
			
			if($this->input->post('ancienfichier')!=''){
				$file = "images/contenu/products/photos/".$this->input->post('ancienfichier');
				if(file_exists($file)){				
					unlink($file);
				}
			}

			$file = "images/contenu/products/photos/".$fichier;
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
			$this->mdl_photos->photo_id = $this->photo_id;
			$this->mdl_photos->photo_product_id = $this->product_id;
			$this->mdl_photos->photo_title = $this->input->post('photo_title');
			$this->mdl_photos->photo_title_en = $this->input->post('photo_title_en');
			$this->mdl_photos->photo_file = $fichier;
			$this->mdl_photos->save();
		}
	}

	function delete() {
		$this->mdl_photos->photo_id = $this->photo_id;		
		$image = $this->mdl_photos->get();
		
		if(file_exists("images/contenu/products/photos/".$image->photo_file))
			unlink("images/contenu/products/photos/".$image->photo_file);
	
		$this->mdl_photos->delete();	
		redirect('admin/photos/index/product_id/'.$this->product_id);
	}
	
	function change_status() {
        $this->mdl_photos->photo_id = $this->photo_id;
        $this->mdl_photos->photo_is_active = $this->status;
        $this->mdl_photos->change_status();	
      	redirect('admin/photos/index/product_id/'.$this->product_id);
    }
	
	function move_down() {
        $this->mdl_photos->photo_product_id = $this->product_id;
		$this->mdl_photos->photo_id = $this->photo_id;
        $this->mdl_photos->move_down();
        redirect('admin/photos/index/product_id/'.$this->product_id);
    }
    
    function move_up() {
        $this->mdl_photos->photo_product_id = $this->product_id;
		 $this->mdl_photos->photo_id = $this->photo_id;
        $this->mdl_photos->move_up();
       	redirect('admin/photos/index/product_id/'.$this->product_id);
    }
}

?>
