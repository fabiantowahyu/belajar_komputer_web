<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	$default = $this->config->item('themes');
	$theme = $this->session->userdata['themes'];

	if(!empty($theme)) {
		$page = sprintf("Themes/%s/admin",$theme);
		$this->load->view($page);
	} else {
		$page = sprintf("Themes/%s/admin",$default);
		$this->load->view($page);
	}
?>