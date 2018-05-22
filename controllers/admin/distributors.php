<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Distributors extends CI_Controller {
	var $distributor_id;
	
	var $page;
	var $prevpage;
	var $nextpage;
	var $nav;

	function Distributors() {
		parent::__construct();

		$this->lib_admin->check_credentials();

		$uri = $this->uri->uri_to_assoc(4);
		if (isset($uri['distributor_id'])) 
			$this->distributor_id = $uri['distributor_id'];
		
		if (isset($uri['page'])) 
			$this->page = $uri['page'];		

		// set custom error delimiters
        $this->validation->set_error_delimiters('<div class="error">', '</div>');			
	}	
	
	function index() {
		
		if (!$this->page) 
			$this->page = 1;

		$this->mdl_distributors->page = $this->page;
		$this->mdl_distributors->paginate = false;
		$distributors = $this->mdl_distributors->get();
		
		$data = $this->lib_admin->data();
		$data['managestyle'] = 'active';
		$data['managedistributorsstyle'] = 'active';
		$data['distributors'] = $distributors;
		
		$data['nav'] = $this->lib_paginate->paginate_admin('admin/distributors/index', $this->mdl_distributors->numpages);
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/header_manage', $data);
		$this->load->view('admin/distributors', $data);
		$this->load->view('admin/footer');		
	}

	function form() {	

		$rules = array(
			'distributor_name'	=>	'required',
			'distributor_address'	=>	'required',
			'distributor_city'	=>	'required',
			'distributor_province'	=>	'',
			'distributor_country'	=>	'required',						
			'distributor_postal_code'	=>	'',
			'distributor_phone'	=>	'required',			
			//'distributor_website'	=>	''	
		);
		$this->validation->set_rules($rules);

		$fields = array(
			'distributor_name'	=>	'Nom',
			'distributor_address'	=>	'Adresse',
			'distributor_city'	=>	'Ville',
			'distributor_province'	=>	'Province / État',
			'distributor_country'	=>	'Pays',						
			'distributor_postal_code'	=>	'Code postal / ZIP',
			'distributor_phone'	=>	'Téléphone',			
			//'distributor_website'	=>	'Site web'
		);
		$this->validation->set_fields($fields);

		if ($this->validation->run()) 
		{	
			//1- Get the english version with coords XY			
			//ex https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&language=en
			$url_address = str_replace(' ', '+', $this->input->post('distributor_address').', '.$this->input->post('distributor_city').', '.$this->input->post('distributor_province').', '.$this->input->post('distributor_country'));
			$request_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$url_address."&language=en";
			$requests = @file_get_contents($request_url);
			$error_en = false;
			if($requests)		
			{
				$distributor = json_decode($requests);	
				if($distributor->status != "ZERO_RESULTS")
				{	
					$address_en = '';
					$city_en = '';
					$country_en = '';
					foreach($distributor->results[0]->address_components as $component)
					{
						if($component->types[0] == 'street_number' || $component->types[0] == 'route')
						{
							if($address_en != '')
									$address_en .= ' ';
								$address_en .= $component->long_name;
						}
						else if($component->types[0] == 'locality')
							$city_en  = $component->long_name;
						else if(addressType == 'administrative_area_level_3')
							$city_en  = $component->long_name;
						else if(addressType == 'country')
							$country_en  = $component->long_name;
					}				
					if($address_en == '')
						$address_en = $this->input->post('distributor_address');
					if($city_en == '')
						$city_en = $this->input->post('distributor_city');
					if($country_en == '')
						$country_en = $this->input->post('distributor_country');
					//2 - save
					$this->mdl_distributors->distributor_id = $this->distributor_id;	
					$this->mdl_distributors->distributor_name = $this->input->post('distributor_name');			//TODO : name_en ?
					$this->mdl_distributors->distributor_address = $this->input->post('distributor_address');
					$this->mdl_distributors->distributor_address_en = $address_en;
					$this->mdl_distributors->distributor_city = $this->input->post('distributor_city');
					$this->mdl_distributors->distributor_city_en = $city_en;
					$this->mdl_distributors->distributor_province = $this->input->post('distributor_province');
					$this->mdl_distributors->distributor_country = $this->input->post('distributor_country');	
					$this->mdl_distributors->distributor_country_en = $country_en;
					$this->mdl_distributors->distributor_postal_code = $this->input->post('distributor_postal_code');
					$this->mdl_distributors->distributor_phone = $this->input->post('distributor_phone');	
					//$this->mdl_distributors->distributor_website = $this->input->post('distributor_website');
					$this->mdl_distributors->distributor_lat = $distributor->results[0]->geometry->location->lat;	
					$this->mdl_distributors->distributor_lng = $distributor->results[0]->geometry->location->lng;	
					$this->mdl_distributors->save();	
			
					$this->session->set_flashdata('save_message', "Le distributeur a été enregistré.");
					redirect('admin/distributors');	
				}
				else
					$error_en = true;
			}
			else
				$error_en = true;
			if($error_en)
			{
				//TODO : show MESSAGE ERROR			
				$data = $this->lib_admin->data();			
				$data['distributor_id'] = $this->distributor_id;
				$data['error_en'] =  "Une erreur est survenue. Les coordonnées en Anglais n'ont pas pu être trouvées.";
				if($this->distributor_id)
				{						
					$data['managestyle'] = 'active';
					$data['managedistributorsstyle'] = 'active';	
				}
				else
				{					
					$data['writestyle'] = 'active';
					$data['writedistributorsstyle'] = 'active';		
				}	
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_manage', $data);		
				$this->load->view('admin/distributors_form', $data);
				$this->load->view('admin/footer', $data);
			}
		} 
		else 
		{
			$data = $this->lib_admin->data();
			
			if (!$_POST AND $this->distributor_id) 
			{			
				$this->mdl_distributors->distributor_id = $this->distributor_id;				
				$db_distributor = $this->mdl_distributors->get();	
				
				$this->validation->distributor_id = $db_distributor->distributor_id;
				$this->validation->distributor_name = $db_distributor->distributor_name;
				$this->validation->distributor_address = $db_distributor->distributor_address;
				$this->validation->distributor_city = $db_distributor->distributor_city;
				$this->validation->distributor_province = $db_distributor->distributor_province;			
				$this->validation->distributor_country = $db_distributor->distributor_country;
				$this->validation->distributor_postal_code = $db_distributor->distributor_postal_code;
				$this->validation->distributor_phone = $db_distributor->distributor_phone;
				//$this->validation->distributor_website = $db_distributor->distributor_website;
				$this->validation->distributor_lat = $db_distributor->distributor_lat;
				$this->validation->distributor_lng = $db_distributor->distributor_lng;						
			}	
		
			$data['distributor_id'] = $this->distributor_id;

			if($this->distributor_id)
			{	
				$data['managestyle'] = 'active';
				$data['managedistributorsstyle'] = 'active';			
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_manage', $data);		
				$this->load->view('admin/distributors_form', $data);
				$this->load->view('admin/footer', $data);
			}
			else
			{
				$data['writestyle'] = 'active';
				$data['writedistributorsstyle'] = 'active';			
				$this->load->view('admin/header', $data);
				$this->load->view('admin/header_write', $data);		
				$this->load->view('admin/distributors_form', $data);
				$this->load->view('admin/footer', $data);			
			}	
		}
	}

	function delete() {
		$this->mdl_distributors->distributor_id = $this->distributor_id;
		$this->mdl_distributors->delete();	
		redirect('admin/distributors');
	}	
}

?>
