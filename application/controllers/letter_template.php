<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Letter_template extends CI_Controller {
	private $tblName;
	private $field;

	public function __construct() {
		parent::__construct();
		$this->load->model('md_lettertemplate');
		$this->tblName = $this->config->item('tmst_lettertemplate');
		$this->field = 'id';
	}

	public function index()	{
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isPrivButton('list')) {
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
			
			$data['results'] = $this->md_lettertemplate->MDL_Select();
			
			$nm_title = $this->auth->Auth_getNameMenu();
			$data['title'] = sprintf("%s",$nm_title);
			$data['url_view'] = sprintf("%sletter_template/CTRL_View/",site_url());
			$data['page'] = 'letter_template/view';
			$data['plugin'] = 'letter_template/plugin';
			$this->load->view('template_admin', $data);
		}
	}

	public function CTRL_New() {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isPrivButton('add')) {
			$data['action'] = 'add';
			$data['page'] = 'error_sysmenu';
			$this->load->view('template_admin', $data);
		} else {
			if ($this->input->post('close')) {
				redirect('letter_template');
			} elseif ($this->input->post('submit')) {
				$isDuplicated = $this->md_lettertemplate->MDL_isPermInsert($this->input->post('id'));
				if($isDuplicated) {
					$this->md_lettertemplate->MDL_Insert();
					redirect('letter_template');
				} else {
					$data['id'] = $this->input->post('id');
					$data['page'] = 'error_duplicated';
					$this->load->view('template_admin', $data);
				}
				
			} else {
				/* Bread crum */
				$this->load->model('md_ref_json');
				$params = $this->router->fetch_class();
				$hasil = $this->md_ref_json->MDL_SelectMenu($params);
				$parentt = $hasil->parentt;
				$nm_menu = $hasil->custom_title;
				$url_menu = $hasil->url_menu;
				$path_icon = $hasil->path_icon;
				$this->breadcrumbs->add($parentt, '#', $path_icon);
				$this->breadcrumbs->add($nm_menu, base_url().$url_menu);
				$this->breadcrumbs->add('Add New', base_url());
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
				$this->load->helper('plugin_helper');
				$data['content'] = '';
				
				$data['id'] = $this->md_lettertemplate->MDL_getAutoID();
				
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title_head'] = sprintf("%s - Add New",$nm_title);
				$data['title'] = sprintf("%s",$nm_title);
				
				$data['url'] = 'letter_template/CTRL_New';
				$data['page'] = 'letter_template/form';
				$data['plugin'] = 'letter_template/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }

	public function CTRL_Edit($id='') {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isPrivButton('edit')) {
			$data['action'] = 'edit';
			$data['page'] = 'error_sysmenu';
			$this->load->view('template_admin', $data);
		} elseif(!$this->auth->Auth_isRecID($id,$this->tblName,$this->field)) {
			$data['id'] = $id;
			$data['page'] = 'error_invalidID';
			$this->load->view('template_admin', $data);
		} else {
			if ($this->input->post('close')) {
				redirect('letter_template');
			} elseif ($this->input->post('submit')) {
				$id = $this->input->post('id');
				$this->md_lettertemplate->MDL_Update($id);
				redirect('letter_template');
			} else {
				/* Bread crum */
				$this->load->model('md_ref_json');
				$params = $this->router->fetch_class();
				$hasil = $this->md_ref_json->MDL_SelectMenu($params);
				$parentt = $hasil->parentt;
				$nm_menu = $hasil->custom_title;
				$url_menu = $hasil->url_menu;
				$path_icon = $hasil->path_icon;
				$this->breadcrumbs->add($parentt, '#', $path_icon);
				$this->breadcrumbs->add($nm_menu, base_url().$url_menu);
				$this->breadcrumbs->add('Update', base_url());
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
				$this->load->helper('plugin_helper');
				
				$hasil = $this->md_lettertemplate->MDL_SelectID($id);
				$data['id'] = $hasil->id;
				$data['template_name'] = $hasil->template_name;
				$data['used_on'] = $hasil->used_on;
				$data['status'] = $hasil->status;
				$data['content'] = $hasil->content;
			
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title_head'] = sprintf("%s - Update",$nm_title);
				$data['title'] = sprintf("%s",$nm_title);
				$data['url'] = 'letter_template/CTRL_Edit/'.$id;
				$data['url_del'] = 'letter_template/CTRL_Delete/'.$id;
				$data['page'] = 'letter_template/form_edit';
				$data['plugin'] = 'letter_template/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }

	public function CTRL_Delete($id='') {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isPrivButton('delete')) {
			$data['action'] = 'delete';
			$data['page'] = 'error_sysmenu';
			$this->load->view('template_admin', $data);
		} elseif(!$this->auth->Auth_isRecID($id,$this->tblName,$this->field)) {
			$data['id'] = $id;
			$data['page'] = 'error_invalidID';
			$this->load->view('template_admin', $data);
		} else {
			$this->md_lettertemplate->MDL_Delete($id);
			redirect('letter_template');
		}
    }

	public function CTRL_View($id='') {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isPrivButton('list')) {
			$data['action'] = 'list';
			$data['page'] = 'error_sysmenu';
			$this->load->view('template_admin', $data);
		} elseif(!$this->auth->Auth_isRecID($id,$this->tblName,$this->field)) {
			$data['id'] = $id;
			$data['page'] = 'error_invalidID';
			$this->load->view('template_admin', $data);
		} else {

			$AryCompany = $this->CTRL_Option_Company();
			
			$hasil = $this->md_branch->MDL_SelectID($id);
			$data['id'] = $hasil->id;
			$data['branch'] = $hasil->branch;
			$data['address'] = $hasil->address;
			$data['phone'] = $hasil->phone;
			$data['email'] = $hasil->email;
			$data['fax'] = $hasil->fax;
			$data['company'] = $AryCompany[$hasil->company_id];
			
			$nm_title = $this->auth->Auth_getNameMenu();
			$data['title_head'] = sprintf("%s - %s",$nm_title,$data['branch']);
			$data['title'] = sprintf("%s",$nm_title);

			$data['page'] = 'Branch/form_view';
			$data['plugin'] = 'Branch/plugin';
			$this->load->view('template_popupwindow', $data);
		}
    }
	
	public function CTRL_Option_Scheme() {
		$this->load->model('md_scheme');
		$AryScheme = $this->md_scheme->MDL_Select();
		$option[''] = 'Choose a Scheme...';
		foreach($AryScheme as $row) {
			$option[$row->id] = $row->scheme_name;
		}

		return $option;
	}
	
}
