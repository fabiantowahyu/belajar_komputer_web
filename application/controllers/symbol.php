<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Symbol extends CI_Controller {
	private $tblName;
	private $field;

	public function __construct() {
		parent::__construct();
		$this->load->model('md_symbol');
		$this->tblName = $this->config->item('tmst_symbol');
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
			/* privilage */
			$data['add'] = $this->auth->Auth_isPrivButton('add');
			$data['edit'] = $this->auth->Auth_isPrivButton('edit');
			$data['delete'] = $this->auth->Auth_isPrivButton('delete');
			
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
			
			/*if($this->auth->Auth_isDataAuthorized('Master')){
				$data['results'] = $this->md_symbol->MDL_Select();
			}else{
				$data['results'] = NULL;
			}*/
			
			$data['results'] = $this->md_symbol->MDL_Select();

			$nm_title = $this->auth->Auth_getNameMenu();
			$data['title'] = sprintf("%s",$nm_title);
			//$data['url_view'] = sprintf("%ssymbol/CTRL_View/",site_url());
			$data['page'] = 'Symbol/view';
			$data['plugin'] = 'Symbol/plugin';
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
				redirect('symbol');
			} elseif ($this->input->post('submit')) {
				list($isDuplicated,$msg) = $this->md_symbol->MDL_isPermInsert($this->input->post('symbol'));
				if($isDuplicated) {
					$this->md_symbol->MDL_Insert();
					redirect('symbol');
				} else {
					$data['id'] = $msg; //$this->input->post('id');
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
				
				
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title_head'] = sprintf("%s - Add New",$nm_title);
				$data['title'] = sprintf("%s",$nm_title);
				
				$data['url'] = 'symbol/CTRL_New';
				$data['page'] = 'Symbol/form';
				$data['plugin'] = 'Symbol/plugin';
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
				redirect('symbol');
			} elseif ($this->input->post('submit')) {
				list($isDuplicated,$msg) = $this->md_symbol->MDL_isPermInsert_Update($this->input->post('symbol'),$this->input->post('symbol_old'));
				if($isDuplicated) {
					$id = $this->input->post('id');
					$this->md_symbol->MDL_Update($id);
					redirect('symbol');
				} else {
					$data['id'] = $msg; //$this->input->post('id');
					$data['page'] = 'error_duplicated';
					$this->load->view('template_admin', $data);
				}
			} else {
				/* privilage */
				$data['add'] = $this->auth->Auth_isPrivButton('add');
				$data['edit'] = $this->auth->Auth_isPrivButton('edit');
				$data['delete'] = $this->auth->Auth_isPrivButton('delete');
				
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
				
				$hasil = $this->md_symbol->MDL_SelectID($id);
				$data['id'] = $hasil->id;
				$data['symbol'] = $hasil->symbol;
				$data['description'] = $hasil->description;
												
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title_head'] = sprintf("%s - Update",$nm_title);
				$data['title'] = sprintf("%s",$nm_title);
				
				$data['url'] = 'symbol/CTRL_Edit/'.$id;
				$data['url_del'] = 'symbol/CTRL_Delete/'.$id;
				$data['page'] = 'Symbol/form_edit';
				$data['plugin'] = 'Symbol/plugin';
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
			$isDeleted = $this->md_symbol->MDL_isPermDelete($id);
			if($isDeleted) {
				$this->md_symbol->MDL_Delete($id);
				redirect('symbol');
			} else {
				$data['page'] = 'error_delete';
				$this->load->view('template_admin', $data);
			}
		}
    }

	public function CTRL_View() {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isPrivButton('list')) {
			$data['action'] = 'list';
			$data['page'] = 'error_sysmenu';
			$this->load->view('template_admin', $data);
		} else {			
			$data['results'] = $this->md_symbol->MDL_Select();
						
			$nm_title = $this->auth->Auth_getNameMenu();
			$data['title_head'] = sprintf("%s - %s",$nm_title,"Reserved Word");
			$data['title'] = sprintf("%s",$nm_title);

			$data['page'] = 'Symbol/view_reservedword';
			$data['plugin'] = 'Symbol/plugin';
			$this->load->view('template_popupwindow', $data);
		}
    }
}
