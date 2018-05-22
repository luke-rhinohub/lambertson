<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cronjobs extends CI_Controller {
       
    function Cronjobs() {

        parent::__construct();
		set_time_limit(0);		
    }
	function index() {		
	}
    
    function leads($cron_key = NULL) {
		if($cron_key == 'wy1vb23kcmF4GhOpC3DY8V8RxAZ1') {		
			$start_date = new DateTime("first day of last month");
			$end_date = new DateTime("last day of last month");
			$start_date = $start_date->format('Y-m-d 00:00:00');
			$end_date = $end_date->format('Y-m-d'); 
			
			$leads = $this->mdl_leads->getBetween($start_date, date('Y-m-d 00:00:00'));
			//$leads = $this->mdl_leads->getBetween($start_date, date('2016-01-01 00:00:00'));
			
			$file="leads-".$end_date.".xls";	
						
			$this->load->library('PHPExcel');
			$this->load->library('PHPExcel/IOFactory');

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle("List of leads from ".date('Y-m-d', strtotime($start_date))." to ".$end_date);

			// Assign cell values
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
			
			$headerStyle = array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb'=>'000000')
					),
					'font' => array(
						'color' => array('rgb' => 'FFFFFF')
					)
			);		
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1', "lambertson.com : Leads from ".date('Y-m-d', strtotime($start_date))." to ".$end_date)->getStyle()->getFont()->setBold(true);
			$subject = '';
			$count = 2;
			
			foreach($leads as $key => $l)
			{
				if($subject !=$l->cat)
				{	
					$count++;
					$subject = $l->cat;
					if($key != 0)
						$count++;
						
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$count, $subject);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':M'.$count)->applyFromArray($headerStyle);
					$count++;
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$count, 'Date');
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$count, 'Company');
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$count, 'First name');
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$count, 'Last name');
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$count, 'Email');
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$count, 'Phone');
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$count, 'Country');
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$count, 'State');
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$count, 'City');
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$count, 'Address');
					$objPHPExcel->getActiveSheet()->setCellValue('K'.$count, 'Postal/ZIP Code');
					//$objPHPExcel->getActiveSheet()->setCellValue('L'.$count, 'Subject');
					$objPHPExcel->getActiveSheet()->setCellValue('L'.$count, 'Request');
					$objPHPExcel->getActiveSheet()->setCellValue('M'.$count, 'Language');
					
					$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':M'.$count)->getFont()->setBold(true);
					
				}
					$count++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$count, $l->lead_date);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$count, $l->lead_company);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$count, $l->lead_first_name);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$count, $l->lead_last_name);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$count, $l->lead_email);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$count, $l->lead_phone);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$count, $l->lead_country);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$count, $l->lead_state);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$count, $l->lead_city);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$count, $l->lead_address);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$count, $l->lead_postal_code);
			//	$objPHPExcel->getActiveSheet()->setCellValue('L'.$count, $l->lead_subject);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$count, $l->lead_request);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$count, ($l->lead_is_en == 1 ? 'EN' : 'FR'));
				
			}

			try 
			{
				// Save it as an excel 2003 file
				$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('images/contenu/'.$file);
				
				//send email with attachement
				$this->load->library('email');
				$this->email->to("vtourigny@sipromac.com");
				$this->email->bcc_batch_mode = TRUE;
				$this->email->bcc("tracker@miracomdev.ca, maxim.jacques@lespretentieux.com");
				//$this->email->to("jbergeron@485marketing.com");
				$this->email->from('web@lambertson.com');
				$this->email->subject("Contact Us from lambertson.com");
				$this->email->message("Leads from ".date('Y-m-d', strtotime($start_date))." to ".$end_date);
				$this->email->attach('images/contenu/'.$file);
				
				if(!$this->email->send())							
				{
					//throw error
					echo 'error not sent';
				}
				else
					echo 'sent';
			}
			catch (Exception $e) {
				die('Failed: ' . $e->getMessage());
			}
			
			unlink('images/contenu/'.$file);
		}
		//else
		//	echo 'denied';		
    }
	
	function leads_joany($cron_key = NULL) {
		if($cron_key == 'wy1vb23kcmF4GhOpC3DY8V8RxAZ1') {		
			$start_date = new DateTime("2015-05-01");
			$end_date = new DateTime("2015-07-31");
			$start_date = $start_date->format('Y-m-d 00:00:00');
			$end_date = $end_date->format('Y-m-d'); 
			
			//$leads = $this->mdl_leads->getBetween($start_date, date('Y-m-d 00:00:00'));
			$leads = $this->mdl_leads->getBetween($start_date, date('2015-08-01 00:00:00'));
			
			$file="leads-".$end_date.".xls";	
						
			$this->load->library('PHPExcel');
			$this->load->library('PHPExcel/IOFactory');

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle("List of leads from ".date('Y-m-d', strtotime($start_date))." to ".$end_date);

			// Assign cell values
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
			
			$headerStyle = array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb'=>'000000')
					),
					'font' => array(
						'color' => array('rgb' => 'FFFFFF')
					)
			);		
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1', "lambertson.com : Leads from ".date('Y-m-d', strtotime($start_date))." to ".$end_date)->getStyle()->getFont()->setBold(true);
			$subject = '';
			$count = 2;
			
			foreach($leads as $key => $l)
			{
				if($subject !=$l->cat)
				{	
					$count++;
					$subject = $l->cat;
					if($key != 0)
						$count++;
						
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$count, $subject);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':M'.$count)->applyFromArray($headerStyle);
					$count++;
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$count, 'Date');
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$count, 'Company');
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$count, 'First name');
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$count, 'Last name');
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$count, 'Email');
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$count, 'Phone');
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$count, 'Country');
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$count, 'State');
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$count, 'City');
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$count, 'Address');
					$objPHPExcel->getActiveSheet()->setCellValue('K'.$count, 'Postal/ZIP Code');
					//$objPHPExcel->getActiveSheet()->setCellValue('L'.$count, 'Subject');
					$objPHPExcel->getActiveSheet()->setCellValue('L'.$count, 'Request');
					$objPHPExcel->getActiveSheet()->setCellValue('M'.$count, 'Language');
					
					$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':M'.$count)->getFont()->setBold(true);
					
				}
					$count++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$count, $l->lead_date);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$count, $l->lead_company);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$count, $l->lead_first_name);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$count, $l->lead_last_name);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$count, $l->lead_email);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$count, $l->lead_phone);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$count, $l->lead_country);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$count, $l->lead_state);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$count, $l->lead_city);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$count, $l->lead_address);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$count, $l->lead_postal_code);
			//	$objPHPExcel->getActiveSheet()->setCellValue('L'.$count, $l->lead_subject);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$count, $l->lead_request);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$count, ($l->lead_is_en == 1 ? 'EN' : 'FR'));
				
			}

			try 
			{
				// Save it as an excel 2003 file
				$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('images/contenu/'.$file);
				
				//send email with attachement
				$this->load->library('email');
				$this->email->to("jbergeron@485marketing.com");
				$this->email->bcc_batch_mode = TRUE;
				$this->email->bcc("tracker@miracomdev.ca");
				$this->email->from('web@lambertson.com');
				$this->email->subject("Leads from lambertson.com");
				$this->email->message("Leads from ".date('Y-m-d', strtotime($start_date))." to ".$end_date);
				$this->email->attach('images/contenu/'.$file);
				
				if(!$this->email->send())							
				{
					//throw error
					echo 'error not sent';
				}
				else
					echo 'sent';
			}
			catch (Exception $e) {
				die('Failed: ' . $e->getMessage());
			}
			
			unlink('images/contenu/'.$file);
		}
		//else
		//	echo 'denied';		
    }
}
?>
