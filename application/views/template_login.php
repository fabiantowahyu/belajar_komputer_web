<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	$theme = $this->config->item('themes');
	if(!empty($theme)) {
		$page = sprintf("Themes/%s/login",$theme);
		$this->load->view($page);
	} else {
		$this->load->view('error_page');
	}
?>