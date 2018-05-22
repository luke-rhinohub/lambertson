<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function Admin() {

		parent::__construct();

	}

	function index() {

		$this->_first_login();

		$this->lib_admin->check_credentials();

		$data = $this->lib_admin->data();

		$data['dashboardstyle'] = 'active';
		$data['pagetitle'] = 'InkType ' . $this->lang->line('administration_panel');

		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content', $data);
		$this->load->view('admin/footer', $data);

	}

	function login() {

		$this->_first_login();

		$rules = array(
		'email_address'	=>	'required',
		'password'		=>	'required');
		$this->validation->set_rules($rules);

		$fields = array(
		'email_address'	=>	$this->lang->line('email_address'),
		'password'		=>	$this->lang->line('password'));
		$this->validation->set_fields($fields);

		if (!$this->validation->run()) {

			if ($this->session->flashdata('login_error')) {
				$this->validation->error_string = $this->lang->line('login_error');
			}

			elseif ($this->session->flashdata('login_not_admin')) {
				$this->validation->error_string = $this->lang->line('login_not_admin');
			}

			$data = array(
			'pagetitle'	=>	'InkType ' . $this->lang->line('administration_panel'));

			$this->load->view('admin/header_login', $data);
			$this->load->view('admin/login');
			$this->load->view('admin/footer');

		}

		else {

			if ($user = $this->mdl_users->auth($this->input->post('email_address'), $this->input->post('password'))) {

				if ($user->user_level == 'Administrator') {

					$this->lib_login->set_session($user);

					redirect('admin/admin');

				}

				else {

					$this->session->set_flashdata('login_not_admin', 'TRUE');
					redirect('admin/admin/login');

				}

			}

			else {

				$this->session->set_flashdata('login_error', 'TRUE');
				redirect('admin/admin/login');

			}

		}

	}

	function logout() {

		$this->session->sess_destroy();
		redirect('admin/admin/login');

	}

	function _first_login() {
		if (!$this->mdl_users->check_admin()) {
			redirect('admin/admin/first_login');
		}
	}

	function first_login() {

		if (!$this->mdl_users->check_admin()) {

			$rules = array(
			'email_address'	=>	'required|valid_email',
			'password'		=>	'required',
			'password_conf'	=>	'required|matches[password]',
			'display_name'	=>	'required');
			$this->validation->set_rules($rules);

			$fields = array(
			'email_address'	=>	'Email Address',
			'password'		=>	'Password',
			'password_conf'	=>	'Password Confirmation',
			'display_name'	=>	'Display Name');
			$this->validation->set_fields($fields);

			if (!$this->validation->run()) {

				$this->load->view('admin/header_login');
				$this->load->view('admin/login_first_time');
				$this->load->view('admin/footer');

			}

			else {

				$this->mdl_users->email_address = $this->input->post('email_address');
				$this->mdl_users->password = $this->input->post('password');
				$this->mdl_users->display_name = $this->input->post('display_name');
				$this->mdl_users->user_level = 'Administrator';
				$this->mdl_users->save();

				$user = $this->mdl_users->auth($this->input->post('email_address'), $this->input->post('password'));

				$db_array = array(
				'user_id'	=>	$user->user_id);

				$this->mdl_user_meta->save($user->user_id, 'uses_wysiwyg', 1);

				$this->db->update('posts', $db_array);
				$this->db->update('pages', $db_array);

				$this->lib_login->set_session($user);

				redirect('admin/admin');

			}

		}

		else {

			redirect('admin/admin');

		}

	}

}

?>
