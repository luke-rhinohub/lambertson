<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_now extends CI_Controller {
   
    function Order_now() {	
        parent::__construct();
        $this->data = array();
    }
    
    function _remap() {
		if($_POST)
		{		
			$message_error = '';
			
			if($_POST['product_no'] == '')							
				$message_error .= '&#x2718; The Model field is required.<br/>';	
			if($_POST['first_name'] == '')							
				$message_error .= '&#x2718; The First name field is required.<br/>';
			if($_POST['last_name'] == '')							
				$message_error .= '&#x2718; The Last name field is required.<br/>';
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
			if($_POST['message'] == '')							
				$message_error .= '&#x2718; The Additionnal informations field is required.<br/>';
			if($message_error != '')
				echo '<div class="message_error">'.utf8_decode($message_error).'</div>';
			else
			{
				$this->load->library('email');
				$this->email->mailtype = 'html';
				$this->email->to("sales@lambertson.com");
				$this->email->from("web@lambertson.com");
				$this->email->reply_to($_POST['email'],  $_POST['first_name'].' '.$_POST['last_name']);				
				$this->email->subject("Order Now : lambertson.com (English)");
				$this->email->message('Model : '.$_POST['product_no'].'<br/>First name : '.$_POST['first_name'].'<br/>Last name : '.$_POST['last_name'].'<br/>Email : '.$_POST['email'].'<br/>Phone : '.$_POST['phone'].'<div style="padding-top:7px;">'.$_POST['message'].'</div>');
				if($this->email->send())
					echo "<div class='message_success'>&#10004; Your order has been sent.</div>";
				else			
					echo "<div class='message_error'>&#x2718; An error has occurred. Your order has not been sent.</div>";	
			}
		}
		else
		{
			$product_no = end($this->uri->segments);
			$this->mdl_products->product_no = $product_no;
			$this->mdl_products->product_category_id = $this->uri->segments[count($this->uri->segments)-1];
			$product = $this->mdl_products->getProductFromTable();
			
			$this->data['parent_url_title'] = '';				
			$this->data['child_url_title'] = '';
			$this->data['children'] = false;
			$this->data['pages'] = $this->mdl_pages->getPagesForMenu();		
			$page = array();
		
			if(!$product) 
			{		
				$this->data['url_fr'] = '';
				$page['title_en'] = 'Page Not Found';
				$page['url_title_en'] = '';				
				$this->data['page'] = $page;	
				$this->load->view('templates/default/en/header', $this->data);
				$this->load->view('templates/default/en/404', $this->data);
				$this->load->view('templates/default/en/footer', $this->data);			
			}				
			else
			{	
				$this->mdl_pages->page_id = 10; // Page Contact to get page_content
				$db_page = $this->mdl_pages->get();
				$page['content_en'] = $db_page['content_en'];		
				
				$this->data['product'] = $product;
				$this->data['url_fr'] = 'fr/commander';
				$page['title_en'] = 'Order Now';
				$page['url_title_en'] = '';							
				$this->data['page'] = $page;
				$this->load->view('templates/default/en/header', $this->data);
				$this->load->view('templates/default/en/order_now', $this->data);
				$this->load->view('templates/default/en/footer', $this->data);		
			}		
		}
    }
}
?>