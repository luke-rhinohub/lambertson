<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title><?=$SiteName?> - Interface d'administration</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>images/favicons/favicon.ico" />
	<link rel="stylesheet" href="<?=base_url();?>css/admin/css/1.css" type="text/css" media="screen,projection" />
	<link rel="stylesheet" href="<?=base_url();?>css/admin/table_design.css" type="text/css">
	<script type="text/javascript" src="<?=base_url()?>jscripts/ckeditor/ckeditor.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>	
	<script type="text/javascript" src="<?=base_url()?>jscripts/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
</head>
<body>
<div id="wrapper">
	<div id="innerwrapper">	
		<div id="header">			
			<h1><img src="<?=base_url()?>images/admin/logo.jpg" border="0" height="60" ></h1>
			<h2><?=$this->lang->line('site_administration');?>: <span style="font-size: 75%"><?=anchor_popup('', $this->lang->line('view_site'), array());?></span></h2>
			<ul id="nav">
				<li><?=anchor('admin/admin', $this->lang->line('dashboard'), array('class'=>@$dashboardstyle));?></li>
				<li><?=anchor('admin/products/form', "Ajouter", array('class'=>@$writestyle));?></li>
				<li><?=anchor('admin/pages', $this->lang->line('manage'), array('class'=>@$managestyle));?></li>			
				<li><?=anchor('admin/admin/logout', $this->lang->line('log_out'));?></li>
			</ul>