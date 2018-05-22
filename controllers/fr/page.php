<?php /*
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
    
    function Page() {
	
        parent::__construct();      
        $this->data = array();      
		setlocale(LC_TIME, 'fr_CA');
	}
    
    function _remap() {
		if($_POST)
		{			
			if(isset($_POST['name_career'])) 	//Carrière
			{
				$message_error_career = '';
				$message_success_career = '';
				$fichier = '';
				if($_POST['name_career'] == '')							
					$message_error_career .= '&#x2718; Le champ Nom est requis.<br/>';	
				if($_POST['email_career'] == '')							
					$message_error_career .= '&#x2718; Le champ Adresse courriel est requis.<br/>';	
				else
				{			
					if(!preg_match('#^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[\.]{1}[a-z]{2,9}$#i', $_POST['email_career']))					
						$message_error_career .= '&#x2718; Le champ Adresse courriel doit contenir une adresse valide.<br/>';									
				}
				if($_FILES['cv']['name'] == '')							
					$message_error_career .= '&#x2718; Le champ Curriculum vitae est requis.<br/>';	
				else 
				{					
					$allowed =  array('doc', 'docx', 'pdf', 'zip');
					$filename = $_FILES['cv']['name'];
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					if(!in_array($ext,$allowed)) 
						$message_error_career .= '&#x2718; Format de fichier invalide. Seulement les extensions .doc, .docx, .pdf et .zip sont permises.<br/>';		
					else
					{
						//upload file
						$config1['upload_path'] = 'images/contenu/cv/';
						$config1['allowed_types'] = '*';
						$config1['max_size'] = 0;
						$config1['max_width'] = 0;
						$config1['max_height'] = 0;						
						$this->load->library('upload', $config1);						
						if (!$this->upload->do_upload("cv")) 
							$message_error_career .= $this->upload->display_errors();							
						else
						{
							$data = $this->upload->data();
							$fichier = $data['file_name'];							
						}
					}				
				}								
				if($message_error_career == "")
				{				
					//send email with attachement
					$this->load->library('email');
					$this->email->to("spoupart@sipromac.com");
					$this->email->from("web@sipromac.com");
					$this->email->reply_to($_POST['email_career'], $_POST['name_career']);	
					
					$this->email->subject("New application lead from : sipromac.com (French)");
					$this->email->message("Nouvelle candidature reçue (".$_POST['name_career'].")");
					$this->email->attach('images/contenu/cv/'.$fichier);
					
					if($this->email->send())							
						$message_success_career = "&#10004; Votre Curriculum vitae a été envoyé.";							
					else			
						$message_error_career = "&#x2718; Une erreur est survenue. Le Curriculum vitae n'a pas été envoyé.";	
					
					unlink('images/contenu/cv/'.$fichier);					
				}
				
				//Load view	
				if($message_error_career != '')
					$this->data['message_career'] = '<div class="message_error">'.utf8_decode($message_error_career).'</div>';
				elseif($message_success_career != '')
					$this->data['message_career'] = '<div class="message_success">'.utf8_decode($message_success_career).'</div>';
				
				$this->mdl_pages->parse_vars = TRUE;
				$this->mdl_pages->published_only = TRUE;
				$this->mdl_pages->page_id = 10;   
				$page = $this->mdl_pages->get();
				$this->data['parent_url_title'] = $page['url_title'];
				$this->data['child_url_title'] = '';					
				$this->mdl_pages->parent_id = $page['page_id'];
				$this->data['children'] = $this->mdl_pages->getChildrenPages();				
				$this->data['pages'] = $this->mdl_pages->getPagesForMenu();				
				$this->data['page'] = $page;
				$this->load->view('templates/default/fr/header', $this->data);
				$this->load->view('templates/default/fr/page', $this->data);
				$this->load->view('templates/default/fr/footer', $this->data);
			}
			else //Demande d'informations
			{			
				$message_error = '';
			
				if($_POST['company'] == '')							
					$message_error .= '&#x2718; Le champ Entreprise est requis.<br/>';	
				if($_POST['first_name'] == '')							
					$message_error .= '&#x2718; Le champ Pr&eacute;nom est requis.<br/>';
				if($_POST['last_name'] == '')							
					$message_error .= '&#x2718; Le champ Nom est requis.<br/>';
				if($_POST['email'] == '')							
					$message_error .= '&#x2718; Le champ Adresse courriel est requis.<br/>';
				else
				{			
					if(!preg_match('#^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[\.]{1}[a-z]{2,9}$#i', $_POST['email']))					
						$message_error .= '&#x2718; Le champ Adresse courriel doit contenir une adresse valide.<br/>';									
				}
				if($_POST['phone'] == '')							
					$message_error .= '&#x2718; Le champ T&eacute;l&eacute;phone est requis.<br/>';
				else
				{
					if(!preg_match("#^(\([0-9]{3}\) [0-9]{3}( |-)[0-9]{4}|^[0-9]{3}( |-)[0-9]{3}( |-)[0-9]{4})( ?x[0-9]{1,5})?$#", trim($_POST['phone'])))
						$message_error .= '&#x2718; Le champ T&eacute;l&eacute;phone doit &ecirc;tre au format 123 456-7890 x123.<br/>';		
				}
				if($_POST['country'] == '')							
					$message_error .= '&#x2718; Le champ Pays est requis.<br/>';
				if($_POST['subject'] == '')							
					$message_error .= '&#x2718; Le champ Sujet est requis.<br/>';
				if($_POST['message'] == '')							
					$message_error .= '&#x2718; Le champ Demande est requis.<br/>';
				if($message_error != '')
					echo '<div class="message_error">'.utf8_decode($message_error).'</div>';
				else
				{
					$this->load->library('email');
					$this->email->mailtype = 'html';
					$this->email->to("sipromac@sipromac.com");
					$this->email->from("web@sipromac.com");
					$this->email->reply_to($_POST['email'], $_POST['first_name'].' '.$_POST['last_name']);
					$this->email->subject("Lead from : sipromac.com (French)");
					$this->email->message('Entreprise : '.$_POST['company'].'<br/>Prénom : '.$_POST['first_name'].'<br/>Nom : '.$_POST['last_name'].'<br/>Courriel : '.$_POST['email'].'<br/>Téléphone : '.$_POST['phone'].'<br/>Pays : '.$_POST['country'].'<br/>Province / État : '.$_POST['province'].'<br/>Ville : '.$_POST['city'].'<br/>Adresse : '.$_POST['address'].'<br/>Code postal / ZIP : '.$_POST['postal_code'].'<br/><br/>Sujet : '.$_POST['subject'].'<div style="padding-top:7px;">'.$_POST['message'].'</div>');
					if($this->email->send())
					{						
						echo "<div class='message_success'>&#10004; Votre message a été envoyé.</div>";	
						
						//Save lead						
						$this->mdl_leads->lead_date = date('Y-m-d H:i:s');
						$this->mdl_leads->lead_company = $_POST['company'];
						$this->mdl_leads->lead_first_name = $_POST['first_name'];
						$this->mdl_leads->lead_last_name = $_POST['last_name'];
						$this->mdl_leads->lead_email = $_POST['email'];
						$this->mdl_leads->lead_phone = $_POST['phone'];
						$this->mdl_leads->lead_country = $_POST['country'];
						$this->mdl_leads->lead_state = $_POST['province'];
						$this->mdl_leads->lead_city = $_POST['city'];
						$this->mdl_leads->lead_address = $_POST['address'];
						$this->mdl_leads->lead_postal_code = $_POST['postal_code'];
						$this->mdl_leads->lead_subject = $_POST['subject'];
						$this->mdl_leads->lead_request = $_POST['message'];
						$this->mdl_leads->lead_is_en = 0;
						$this->mdl_leads->save();
					}						
					else			
						echo "<div class='message_error'>&#x2718; Une erreur est survenue. Le message n'a pas été envoyé.</div>";	
				}				
			}		
		}		
		else
		{
			$this->url_title = $this->uri->segment(3);
			$this->page_id = $this->uri->segment(4); 
	
			if(trim($_SERVER['REQUEST_URI'], '/') == "clients/lambertson/fr" || trim($_SERVER['REQUEST_URI'], '/') == "clients/lambertson/fr/page/accueil")
			{			
				$this->mdl_pages->parse_vars = TRUE;
				$this->mdl_pages->published_only = TRUE;
				$this->mdl_pages->page_id = 4;   
				$page = $this->mdl_pages->get();				
				$this->data['categories'] = $this->mdl_product_categories->get();
				$this->mdl_products->product_category_id = 7;   
				$this->data['products_packaging'] = $this->mdl_products->getProductsFromCategoryHomepage();
				$this->mdl_products->product_category_id = 1;   
				$this->data['products_processing'] = $this->mdl_products->getProductsFromCategoryHomepage();
				$this->data['news'] =  $this->mdl_news->getNewsHomepage();
			}	
			else if ($this->page_id <> "") {
				//Check si page != equipements
				$this->mdl_pages->parse_vars = TRUE;
				$this->mdl_pages->published_only = TRUE;
				$this->mdl_pages->page_id = $this->page_id;
				$page = $this->mdl_pages->get();				
			}
			elseif ($this->url_title <> '0') {			
			
				$this->mdl_pages->parse_vars = TRUE;
				$this->mdl_pages->published_only = TRUE;
				$this->mdl_pages->url_title = $this->url_title;
				$page = $this->mdl_pages->get();
				
				if($page['page_id'] == 9)//Distributeurs
					$this->data['distributors'] = $this->mdl_distributors->getWhere();
				else if($page['page_id'] == 18)//Nouvelles
					$this->data['news'] =  $this->mdl_news->getNews();
				else if($page['page_id'] == 19)//Buy online
				{
					$this->mdl_products->product_category_id = 7;   
					$this->data['products_packaging'] = $this->mdl_products->getProductsFromCategoryHomepage();
					$this->mdl_products->product_category_id = 1;   
					$this->data['products_processing'] = $this->mdl_products->getProductsFromCategoryHomepage();
				}
					
			}				
		
			if (empty($page)) 
			{		
				$this->data['url_en'] = '';			
				$this->data['parent_url_title'] = '';				
				$this->data['child_url_title'] = '';
				$this->data['children'] = false;
				
				$page = array();
				$page['title'] = $this->lang->line('page_not_found');	
				$page['url_title_en'] = '';	
				$this->data['pages'] = $this->mdl_pages->getPagesForMenu();			
				$this->data['page'] = $page;
				$this->load->view('templates/default/fr/header', $this->data);
				$this->load->view('templates/default/fr/404', $this->data);
				$this->load->view('templates/default/fr/footer', $this->data);				
			}				
			else
			{		
				//Check for children pages
				if($page['parent_id'] !=0)	
				{			
					$this->mdl_pages->parent_id = $page['parent_id'];
					$this->data['parent_url_title'] = $this->mdl_pages->getParentUrl()->url_title;				
					$this->data['child_url_title'] = $page['url_title'];
					$this->data['children'] = $this->mdl_pages->getChildrenPages();
				}
				else
				{
					$this->data['parent_url_title'] = $page['url_title'];
					$this->data['child_url_title'] = '';					
					$this->mdl_pages->parent_id = $page['page_id'];
					$this->data['children'] = $this->mdl_pages->getChildrenPages();
				}
				$this->data['url_en'] = 'page/'.$page['url_title_en'];
				$this->data['pages'] = $this->mdl_pages->getPagesForMenu();				
				$this->data['page'] = $page;
				$this->load->view('templates/default/fr/header', $this->data);
				$this->load->view('templates/default/fr/page', $this->data);
				$this->load->view('templates/default/fr/footer', $this->data);
			}		
		}
    }
}*/
?>
