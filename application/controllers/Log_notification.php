<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log_notification extends CI_Controller {

    private $tblName;
    private $field;

    public function __construct() {
	parent::__construct();
	$this->load->model('md_log_notification');
	$this->tblName = $this->config->item('ttrs_log_notification');
	$this->field = 'id';
    }

    public function index() {
	if (!$this->auth->Auth_isPerm()) {
	    $this->load->view('error_akses');
	} elseif (!$this->auth->Auth_isPrivButton('list')) {
	    $data['action'] = 'list';
	    $data['page'] = 'error_sysmenu';
	    $this->load->view('template_admin', $data);
	} else {
	    /* Bread crum */
	    $this->load->model('md_ref_json');
	    $params = $this->router->fetch_class();
	    $hasil = $this->md_ref_json->MDL_SelectMenu($params);
	    $parentt = $hasil->parentt;
	    $nm_menu = $hasil->custom_title;
	    $path_icon = $hasil->path_icon;
	    $this->breadcrumbs->add($parentt, '#', $path_icon);
	    $this->breadcrumbs->add($nm_menu, base_url());
	    $breadcrum = $this->breadcrumbs->output();
	    $data['breadcrum'] = $breadcrum;
	    /* end */

	    $data['results'] = $this->md_log_notification->MDL_Select();

	    $nm_title = $this->auth->Auth_getNameMenu();
	    $data['title'] = sprintf("%s", $nm_title);
	    $data['url_view'] = sprintf("%sLog_notification/CTRL_View/", site_url());
	    $data['page'] = 'Log_notification/view';
	    $data['plugin'] = 'Log_notification/plugin';
	    $this->load->view('template_admin', $data);
	}
    }

}
