<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
    var $page_id;
    var $page;
    var $numpages;
    var $prevpage;
    var $nextpage;
    var $nav;
    
    function Pages() {
        parent::__construct();
        $this->lib_admin->check_credentials();
        $uri = $this->uri->uri_to_assoc(4);
        
        if (isset($uri['page_id'])) {
            $this->page_id = $uri['page_id'];
        }
        
        if (isset($uri['page'])) {
            $this->page = $uri['page'];
        }
        
        if (isset($uri['status'])) {
            $this->status = $uri['status'];
        }
    }
    
    function index() {
        
        if (!$this->page) {
            $this->page = 1;
        }
        $this->mdl_pages->page = $this->page;
        $this->mdl_pages->paginate = FALSE;
        $pages = $this->mdl_pages->get();
        $data = $this->lib_admin->data();
        $data['pages'] = $pages;
        $data['managestyle'] = 'active';
        $data['managepagesstyle'] = 'active';
        $data['pagetitle'] = 'InkType ' . $this->lang->line('administration_panel') . ' - ' . $this->lang->line('page_manage');
        $data['page'] = $this->page;
        $data['numpages'] = $this->mdl_pages->numpages;
        $data['prevpage'] = $this->prevpage;
        $data['nextpage'] = $this->nextpage;
        $data['nav'] = $this->lib_paginate->paginate_admin('admin/pages/index', $this->mdl_pages->numpages);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/header_manage', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('admin/footer', $data);
    }
    
    function form() {
	
        $this->mdl_users->nosubscribers = TRUE;
        $users = $this->mdl_users->get();
        $rules = array(        
			'title' => 'required',		
			'title_en' => 'required',					
            'content' => '',
			'content_en' => '',	
			'parent' => ''
        );
	
        $this->validation->set_rules($rules);
        $fields = array(
            'title' => 'Titre',			
            'title_en' => 'Titre (anglais)',
            'content' => 'Contenu',
            'content_en' => 'Contenu (anglais)',
			'parent' => 'Parent'			
        );
	
        $this->validation->set_fields($fields);

        if ($this->validation->run()) {
		
            $this->mdl_pages->page_id = $this->page_id;
            $this->mdl_pages->title = $this->input->post('title');	
			$this->mdl_pages->title_en = $this->input->post('title_en');		  			
            $this->mdl_pages->content = $this->input->post('content');    
			$this->mdl_pages->content_en = $this->input->post('content_en');       			
            $this->mdl_pages->user_id = $this->session->userdata('user_id');         
            $this->mdl_pages->parent = $this->input->post('parent_id');			
            $this->mdl_pages->save();
            $this->session->set_flashdata('save_message', $this->lang->line('page_saved'));
            redirect('admin/pages');
        }
        else {
            $pageid = $this->mdl_pages->page_id;
            $this->mdl_pages->page_id = null;
            $this->mdl_pages->paginate = FALSE;
            $this->mdl_pages->parent = TRUE;
            $pages = $this->mdl_pages->get();
            
            $this->mdl_pages->parent_id = null;
            $this->mdl_pages->page_id = $pageid;
            
            if (!$_POST AND $this->page_id) {
                $this->mdl_pages->page_id = $this->page_id;
                $this->mdl_pages->parent = FALSE;
                $dbPage = $this->mdl_pages->get();
                $this->validation->title = $dbPage['title'];
				$this->validation->title_en = $dbPage['title_en'];
                $this->validation->content = $dbPage['content'];   
				$this->validation->content_en = $dbPage['content_en'];         					
				$this->validation->user_id = $dbPage['user_id'];
                $this->validation->status = $dbPage['status'];
                $this->validation->parent = $dbPage['parent_id'];
            }
            $data = $this->lib_admin->data();
            $data['page_id'] = $this->page_id;
            $data['users'] = $users;        
            $data['pages'] = $pages;
			
			//parent		
            $data['parents'] = $this->mdl_pages->getParents();
            
            if ($this->page_id) {
				$data['managestyle'] = 'active';
				$data['managepagesstyle'] = 'active';
                $data['pagetitle'] = 'InkType ' . $this->lang->line('administration_panel') . ' - ' . $this->lang->line('page_edit');
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_manage', $data);         
				$this->load->view('admin/pages_form', $data);
				$this->load->view('admin/footer', $data);
            }
            else {
				$data['writestyle'] = 'active';
				$data['writepagesstyle'] = 'active';
                $data['pagetitle'] = 'InkType ' . $this->lang->line('administration_panel') . ' - ' . $this->lang->line('page_write_new');
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_write', $data);         
				$this->load->view('admin/pages_form', $data);
				$this->load->view('admin/footer', $data);
            }        
        }
    }
    
    function delete() {
        $this->mdl_pages->page_id = $this->page_id;
        $this->mdl_pages->delete();
        redirect('admin/pages');
    }
    
    function change_status() {
        $this->mdl_pages->page_id = $this->page_id;
        $this->mdl_pages->status = $this->status;
        $this->mdl_pages->change_status();
        redirect('admin/pages');
    }
    
    function move_down() {
        $this->mdl_pages->page_id = $this->page_id;
        $this->mdl_pages->move_down();
        redirect('admin/pages');
    }
    
    function move_up() {
        $this->mdl_pages->page_id = $this->page_id;
        $this->mdl_pages->move_up();
        redirect('admin/pages');
    }
}
?>
