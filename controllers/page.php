<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
    
    function Page() {

        parent::__construct();
		redirect("en/page/home"); 
    }
}
?>