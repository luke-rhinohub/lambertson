<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
    var $news_id;
   
	var $page;
    var $numpages;
    var $prevpage;
    var $nextpage;
    var $nav;
    
    function News() {
        parent::__construct();
        $this->lib_admin->check_credentials();
        $uri = $this->uri->uri_to_assoc(4);
        
        if (isset($uri['news_id'])) {
            $this->news_id = $uri['news_id'];
        }
        
        if (isset($uri['page'])) {
            $this->page = $uri['page'];
        }
        
        if (isset($uri['status'])) {
            $this->status = $uri['status'];
        }
		date_default_timezone_set('America/Montreal');	
    }
    
    function index() {
        
        if (!$this->page) 
            $this->page = 1;
        
        $this->mdl_news->page = $this->page;
        $this->mdl_news->paginate = FALSE;
        $news = $this->mdl_news->get();
        $data = $this->lib_admin->data();
        $data['news'] = $news;
        $data['managestyle'] = 'active';
        $data['managenewsstyle'] = 'active';    
        $data['page'] = $this->page;
        $data['numpages'] = $this->mdl_news->numpages;
        $data['prevpage'] = $this->prevpage;
        $data['nextpage'] = $this->nextpage;
        $data['nav'] = $this->lib_paginate->paginate_admin('admin/news/index', $this->mdl_news->numpages);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/header_manage', $data);
        $this->load->view('admin/news', $data);
        $this->load->view('admin/footer', $data);
    }
    
    function form() {
	
		$rules = array(			
			'news_publishing_date'	=>	'required',
			'news_title'	=>	'required',
			'news_title_en'	=>	'required',
			'news_desc'	=>	'required',
			'news_desc_en'	=>	'required',
			'news_content'	=>	'required',
			'news_content_en'	=>	'required'
		);
	
		$this->validation->set_rules($rules);

		$fields = array(	
			'news_publishing_date'	=>	'Date de publication',		
			'news_title'	=>	'Titre',
			'news_title_en'	=>	'Titre (Anglais)',
			'news_desc'	=>	'Description',
			'news_desc_en'	=>	'Description (Anglais)',
			'news_content'	=>	'Contenu',
			'news_content_en'	=>	'Contenu (Anglais)'			
		);

		$this->validation->set_fields($fields);	
		
		if ($this->validation->run()) {
			$this->mdl_news->news_id = $this->news_id;
			$this->mdl_news->news_publishing_date = $this->input->post(news_publishing_date);
			$this->mdl_news->news_title = $this->input->post('news_title');
			$this->mdl_news->news_title_en = $this->input->post('news_title_en');
			$this->mdl_news->news_desc = $this->input->post('news_desc');
			$this->mdl_news->news_desc_en = $this->input->post('news_desc_en');
			$this->mdl_news->news_content = $this->input->post('news_content');	
			$this->mdl_news->news_content_en = $this->input->post('news_content_en');	
			$this->mdl_news->save();	
		
			$this->session->set_flashdata('save_message', 'La nouvelle a été enregistrée.');
			redirect('admin/news');	
		}

		else {
			if (!$_POST AND $this->news_id) {
				$this->mdl_news->news_id = $this->news_id;
				$db_news = $this->mdl_news->get();
				
				$this->validation->news_publishing_date = $db_news->news_publishing_date;
				$this->validation->news_title = $db_news->news_title;
				$this->validation->news_title_en = $db_news->news_title_en;
				$this->validation->news_desc = $db_news->news_desc;
				$this->validation->news_desc_en = $db_news->news_desc_en;
				$this->validation->news_content = $db_news->news_content;
				$this->validation->news_content_en = $db_news->news_content_en;
			}	
			else if(!$_POST)		
				$this->validation->news_publishing_date = date('Y-m-d');

			$data = $this->lib_admin->data();
			$data['news_id'] = $this->news_id;
			
			if($this->news_id)
			{
				$data['managestyle'] = 'active';
				$data['managenewsstyle'] = 'active';
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_manage', $data);
				$this->load->view('admin/news_form', $data);
				$this->load->view('admin/footer', $data);
			}
			else
			{
				$data['writestyle'] = 'active';
				$data['writenewsstyle'] = 'active';
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_write', $data);
				$this->load->view('admin/news_form', $data);
				$this->load->view('admin/footer', $data);			
			}		
		}
    }
    
    function delete() {
        $this->mdl_news->news_id = $this->news_id;
        $this->mdl_news->delete();
        redirect('admin/news');
    }
    
    function change_status() {
        $this->mdl_news->news_id = $this->news_id;
        $this->mdl_news->news_is_active = $this->status;
        $this->mdl_news->change_status();
        redirect('admin/news');
    }    
}
?>
