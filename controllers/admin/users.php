<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	var $user_id;

	var $uri_user_level;

	var $page;
	var $numpages;
	var $prevpage;
	var $nextpage;
	var $nav;

	function Users() {

		parent::__construct();
		
		$this->lib_admin->check_credentials();

		$uri = $this->uri->uri_to_assoc(4);

		if (isset($uri['user_id'])) {
			$this->user_id = $uri['user_id'];
		}

		if (isset($uri['page'])) {
			$this->page = $uri['page'];
		}

		if (isset($uri['user_level'])) {
			$this->uri_user_level = $uri['user_level'];
		}

	}

	function index() {

		if (!$this->page) {
			$this->page = 1;
		}

		$this->mdl_users->page = $this->page;
		$this->mdl_users->paginate = true;
		$user_groups = $this->mdl_users->get_by_group();

		$data = $this->lib_admin->data();

		$data['user_groups'] = $user_groups;
		$data['managestyle'] = 'active';
		$data['manageusersstyle'] = 'active';
		$data['pagetitle'] = 'InkType ' . $this->lang->line('administration_panel') . ' - ' . $this->lang->line('user_manage');
		$data['page'] = $this->page;
		$data['numpages'] = $this->mdl_users->numpages;
		$data['prevpage'] = $this->prevpage;
		$data['nextpage'] = $this->nextpage;
		$data['nav'] = $this->lib_paginate->paginate_admin('admin/users/index', $this->mdl_users->numpages);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/header_manage', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('admin/footer', $data);

	}

	function form() {

		$user_levels = array('Administrator', 'Author', 'Subscriber');

		$rules = array(
		'email_address'	=>	'required',
		'display_name'	=>	'required',
		'user_level'	=>	'required');

		if (!$this->user_id) {
			$rules['password'] = 'required';
		}

		$this->validation->set_rules($rules);

		$fields = array(
		'password'		=>	$this->lang->line('password'),
		'first_name'	=>	$this->lang->line('first_name'),
		'last_name'		=>	$this->lang->line('last_name'),
		'display_name'	=>	$this->lang->line('display_name'),
		'email_address'	=>	$this->lang->line('email_address'),
		'user_level'	=>	$this->lang->line('user_level'));

		$this->validation->set_fields($fields);

		if ($this->validation->run()) {

			$this->mdl_users->user_id = $this->user_id;

			if ($this->input->post('password')) 
				$this->mdl_users->password = $this->input->post('password');			

			$this->mdl_users->first_name = $this->input->post('first_name');
			$this->mdl_users->last_name = $this->input->post('last_name');
			$this->mdl_users->display_name = $this->input->post('display_name');
			$this->mdl_users->email_address = $this->input->post('email_address');
			$this->mdl_users->user_level = $this->input->post('user_level');
			$this->mdl_users->save();

			if ($this->input->post('user_level') == 'Administrator') {

				if ($this->input->post('uses_wysiwyg')) 
					$this->mdl_user_meta->save($this->mdl_users->user_id, 'uses_wysiwyg', 1);
				else 
					$this->mdl_user_meta->save($this->mdl_users->user_id, 'uses_wysiwyg', 0);
			}
			$this->session->set_flashdata('save_message', 'The user has been saved');
			redirect('admin/users');
		}

		else {

			if (!$_POST AND $this->user_id) {
				$this->mdl_users->user_id = $this->user_id;
				$db_user = $this->mdl_users->get();
				$this->validation->first_name = $db_user->first_name;
				$this->validation->last_name = $db_user->last_name;
				$this->validation->display_name = $db_user->display_name;
				$this->validation->email_address = $db_user->email_address;
				$this->validation->user_level = $db_user->user_level;

				if ($db_user->user_level == 'Administrator') 
					$this->validation->uses_wysiwyg = $this->mdl_user_meta->uses_wysiwyg($this->user_id);
			}

			elseif (!$_POST and !$this->user_id) 
				$this->validation->user_level = $this->uri_user_level;			

			$data = $this->lib_admin->data();

			$data['user_id'] = $this->user_id;
			$data['user_levels'] = $user_levels;
			$data['pagetitle'] = 'InkType ' . $this->lang->line('administration_panel') . ' - ' . $this->lang->line('user_manage');
			
			if($this->user_id)
			{				
				$data['managestyle'] = 'active';
				$data['manageusersstyle'] = 'active';
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_manage', $data);
				$this->load->view('admin/users_form', $data);
				$this->load->view('admin/footer', $data);
			}
			else
			{				
				$data['writestyle'] = 'active';
				$data['writeusersstyle'] = 'active';
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_write', $data);
				$this->load->view('admin/users_form', $data);
				$this->load->view('admin/footer', $data);
			}
		}
	}

	function delete() {
		$this->mdl_users->user_id = $this->user_id;
		$this->mdl_users->delete();
		redirect('admin/users');
	}
}
?>
