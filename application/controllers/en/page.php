<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
   
    function Page() {	
        parent::__construct();
        $this->data = array();
    }
    
    function _remap() {
		if($_POST)
		{			
			if(isset($_POST['name_career'])) 	// START CAREER FORM VALIDATION
			{
				$message_error_career = '';
				$message_success_career = '';
				$fichier = '';
				if($_POST['name_career'] == '')							
					$message_error_career .= '&#x2718; The Name field is required.<br/>';	
				if($_POST['email_career'] == '')							
					$message_error_career .= '&#x2718; The Email field is required.<br/>';	
				else
				{			
					if(!preg_match('#^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[\.]{1}[a-z]{2,9}$#i', $_POST['email_career']))					
						$message_error_career .= '&#x2718; The Email field must contain a valid email address.<br/>';									
				}
				if($_FILES['cv']['name'] == '')							
					$message_error_career .= '&#x2718; The R&eacute;sum&eacute; field is required.<br/>';	
				else 
				{					
					$allowed =  array('doc', 'docx', 'pdf', 'zip');
					$filename = $_FILES['cv']['name'];
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					if(!in_array($ext,$allowed)) 
						$message_error_career .= '&#x2718; Invalid file format. Only extensions doc, docx, pdf and zip are allowed.<br/>';		
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
					//$this->email->to("jbergeron@485marketing.com"); //sales@lambertson.com
					$this->email->to("sales@lambertson.com"); //sales@lambertson.com
					$this->email->cc("web@rhinohub.com"); //		*RH - ensure updates work properly
					$this->email->bcc_batch_mode = TRUE;
					$this->email->bcc("tracker@miracomdev.ca");
					$this->email->from("web@lambertson.com");
					$this->email->reply_to($_POST['email_career'], $_POST['name_career']);	
					
					$this->email->subject("New application lead from : lambertson.com (English)");
					$this->email->message("New application received (".$_POST['name_career'].")");
					$this->email->attach('images/contenu/cv/'.$fichier);
					
					if($this->email->send())							
						$message_success_career = "&#10004; Your résumé has been sent.";							
					else			
						$message_error_career = "&#x2718; An error has occurred. Your résumé has not been sent.";	
					
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
				$this->load->view('templates/default/en/header', $this->data);
				$this->load->view('templates/default/en/page', $this->data);
				$this->load->view('templates/default/en/footer', $this->data);
			}
			// END CAREER FORM VALIDATION

			// START NEWSLETTER FORM VALIDATION
			elseif(isset($_POST['email_newsletter']))
			{
				$message_error = '';
				$message_success = '';
				
				if($_POST['email_newsletter'] == '')							
					$message_error .= '&#x2718; The Email field is required.<br/>';	
				else
				{			
					if(!preg_match('#^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[\.]{1}[a-z]{2,9}$#i', $_POST['email_newsletter']))					
						$message_error .= '&#x2718; The Email field must contain a valid email address.<br/>';									
				}											
				if($message_error == "")
				{				
					//Subscribe to mailchimp list
					$this->configMailChimp = array(
						'apikey' => 		'957cc9b710249a99250670feb10f3d8c-us9',      // pour le compte sipromac
						'secure' => 		FALSE
						// 'merge_fields' => 	['SIGNUP'=>'Lambertson'],
					);
					$this->load->library('MCAPI', $this->configMailChimp);					
					$this->mcapi->listSubscribe('2a5f85b74e',$_POST['email_newsletter']);	//Liste sipromac
					
					if($this->mcapi->errorCode)
						$message_error = "&#x2718; ".$this->mcapi->errorMessage;					
					else
						$message_success = "&#10004; Subscribed - look for the confirmation email!";	
				}
				if($message_error != '')
					echo '<div class="message_error">'.utf8_decode($message_error).'</div>';
				elseif($message_success != '')
					echo '<div class="message_success">'.utf8_decode($message_success).'</div>';
			}
			// END NEWSLETTER FORM VALIDATION

			// START GENERAL CONTACT FORM VALIDATION
			else 
			{			
				$message_error = '';
			
				if($_POST['company'] == '')							
					$message_error .= '&#x2718; The Company field is required.<br/>';	
				if($_POST['first_name'] == '')							
					$message_error .= '&#x2718; The First name field is required.<br/>';
				if($_POST['last_name'] == '')							
					$message_error .= '&#x2718; The Last name field is required.<br/>';		// *RH
				if($_POST['email'] == '')							
					$message_error .= '&#x2718; The Email field is required.<br/>';
				else
				{			
					if(!preg_match('#^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[\.]{1}[a-z]{2,9}$#i', $_POST['email']))					
						$message_error .= '&#x2718; The Email field must contain a valid email address.<br/>';									
				}
				if($_POST['phone'] == '')							
					$message_error .= '&#x2718; The Phone field is required.<br/>';
				else
				{
					if(!preg_match("#^(\([0-9]{3}\) [0-9]{3}( |-)[0-9]{4}|^[0-9]{3}( |-)[0-9]{3}( |-)[0-9]{4})( ?x[0-9]{1,5})?$#", trim($_POST['phone'])))
						$message_error .= '&#x2718; The Phone field must be in the format 123 456-7890 x123.<br/>';		
				}
				if($_POST['country'] == '')							
					$message_error .= '&#x2718; The Country field is required.<br/>';		// *RH
				if($_POST['subject'] == '')							
					$message_error .= '&#x2718; The Subject field is required.<br/>';		// *RH
				if($_POST['message'] == '')							
					$message_error .= '&#x2718; The Request field is required.<br/>';
				if($message_error != '')
					echo '<div class="message_error">'.utf8_decode($message_error).'</div>';
				else
				{
					// send email
					$this->load->library('email', $config);
					$this->email->mailtype = 'html'; 
					// $this->email->to("webleads@lambertson.com");
					$this->email->to("luke@rhinohub.com");  // *RH - Testing
					$this->email->cc("web@rhinohub.com"); //		*RH - ensure updates work properly
					$this->email->bcc_batch_mode = TRUE;
					// $this->email->bcc("tracker@miracomdev.ca");
					$this->email->from("web@lambertson.com");
					$this->email->reply_to($_POST['email']);
					$this->email->subject("Lead from : lambertson.com");
					$this->email->message('Company : '.$_POST['company'].'<br/>First name : '.$_POST['first_name'].'<br/>Last name : '.$_POST['last_name'].'<br/>Email : '.$_POST['email'].'<br/>Phone : '.$_POST['phone'].'<br/>Country : '.$_POST['country'].'<br/>Province / State : '.$_POST['province'].'<br/>City : '.$_POST['city'].'<br/>Address : '.$_POST['address'].'<br/>Postal / ZIP Code : '.$_POST['postal_code'].'<br/><br/>Subject : '.$_POST['subject'].'<div style="padding-top:7px;">'.$_POST['message'].'</div>');

					if($this->email->send())
					{

						echo "<div class='message_success'>&#10004; Your message has been sent.</div>";	
						
						// Save lead													
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
						$this->mdl_leads->lead_is_en = 1;
						$this->mdl_leads->save();
					}
					else
					{
						echo "<div class='message_error'>&#x2718; An error has occurred. Your message has not been sent.</div>";
					}

				}
								
			}		
		}
		else
		{
			$this->url_title_en = $this->uri->segment(3);

			if(trim($_SERVER['REQUEST_URI'], '/') == "en" || trim($_SERVER['REQUEST_URI'], '/') == "en/page/home")
			{	
				$this->mdl_pages->parse_vars = TRUE;
				$this->mdl_pages->published_only = TRUE;
				$this->mdl_pages->page_id = 4;   
				$page = $this->mdl_pages->get();
				$this->data['news'] =  $this->mdl_news->getNewsHomepage(1);
			}
			elseif ($this->url_title_en <> '0') {			
			
				$this->mdl_pages->parse_vars = TRUE;
				$this->mdl_pages->published_only = TRUE;
				$this->mdl_pages->url_title_en = $this->url_title_en;
				$page = $this->mdl_pages->get();	
				
				if($page['page_id'] == 18)//Nouvelles
				{	
					//url like  pn/1/id/4
					$uri = $this->uri->uri_to_assoc(4);
					if(isset($uri['id'])) 
						$id = $uri['id'];
					if(isset($uri['pn'])) 
						$pn = $uri['pn'];						
					if(!$pn)
						$pn = 1;
					$this->mdl_news->page = $pn;				
					$this->data['news'] =  $this->mdl_news->getNews(1);	
					
					//TODO GET PN if missing
					
					//Pagination
					$numpages = $this->mdl_news->numpages;	
					if($pn > 1) 
						$this->data['prev'] = $pn - 1;
					if($pn < $numpages) 
						$this->data['next'] = $pn + 1;
					$this->data['pn'] = $pn;
					$this->data['numpages'] = $numpages;
					$this->data['url'] = base_url().'en/page/news/';
					
					if($this->data['news'])
					{
						if($id)
						{
							$this->mdl_news->news_id = $id;
							$this->mdl_news->news_is_active = 1;
							$new = $this->mdl_news->get();		
							if(!$new)
								$new = $this->data['news'][0];							
						}						
						else
							$new = $this->data['news'][0];
												
						$this->data['news_id'] = $new->news_id;
					}			
					$this->data['url_fr'] = 'page/'.$page['url_title'].'/pn/'.$pn;	
					if($id)	
						$this->data['url_fr'] .= '/id/'.$id;
				}
			}

			if(empty($page)) 
			{		
				$this->data['url_fr'] = '';		
				$this->data['parent_url_title'] = '';				
				$this->data['child_url_title'] = '';
				$this->data['children'] = false;
				
				$page = array();
				$page['title_en'] = 'Page Not Found';
				$page['url_title_en'] = '';	
				$this->data['pages'] = $this->mdl_pages->getPagesForMenu();			
				$this->data['page'] = $page;	
				$this->load->view('templates/default/en/header', $this->data);
				$this->load->view('templates/default/en/404', $this->data);
				$this->load->view('templates/default/en/footer', $this->data);			
			}				
			else
			{		
				//Check for children pages
				if($page['parent_id'] !=0)	
				{			
					$this->mdl_pages->parent_id = $page['parent_id'];
					$this->data['parent_url_title'] = $this->mdl_pages->getParentUrl()->url_title_en;				
					$this->data['child_url_title'] = $page['url_title_en'];
					$this->data['children'] = $this->mdl_pages->getChildrenPages();
				}
				else
				{
					$this->data['parent_url_title'] = $page['url_title_en'];
					$this->data['child_url_title'] = '';					
					$this->mdl_pages->parent_id = $page['page_id'];
					$this->data['children'] = $this->mdl_pages->getChildrenPages();
				}
				if(!isset($this->data['url_fr']))
					$this->data['url_fr'] = 'page/'.$page['url_title'];		
				$this->data['pages'] = $this->mdl_pages->getPagesForMenu();				
				$this->data['page'] = $page;
				$this->load->view('templates/default/en/header', $this->data);
				$this->load->view('templates/default/en/page', $this->data);
				$this->load->view('templates/default/en/footer', $this->data);		
			}		
		}
    }
}
?>
