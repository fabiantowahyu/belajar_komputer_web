<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_user extends CI_Controller {
	private $tblName;
	private $field;

	public function __construct() {
		parent::__construct();
		$this->load->model('md_manage_user');
		$this->tblName = $this->config->item('tmst_users');
		$this->field = 'emp_id';
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
			//$this->breadcrumbs->add('Spring Tutorial', base_url().'tutorials/spring-tutorials');
			$breadcrum = $this->breadcrumbs->output();
			$data['breadcrum'] = $breadcrum;
			/* end */
						
			$data['results'] = $this->md_manage_user->MDL_Select();
			
			$nm_title = $this->auth->Auth_getNameMenu();
			$data['title'] = sprintf("%s",$nm_title);
			$data['page'] = 'ManageUser/view';
			$data['plugin'] = 'ManageUser/plugin';
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
				redirect('manage_user');
			} elseif ($this->input->post('submit')) {
				$isDuplicated = $this->md_manage_user->MDL_isPermInsert($this->input->post('userid'));
				if($isDuplicated) {
					$this->md_manage_user->MDL_Insert();
					redirect('manage_user');
				} else {
					$data['id'] = $this->input->post('userid');
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
				$data['title'] = sprintf("%s - Add New",$nm_title);
				
				$data['url_cek_field'] = sprintf("%s%s/userid",site_url(),"manage_user/CTRL_CekField");
				$data['url'] = 'manage_user/CTRL_New';
				$data['page'] = 'ManageUser/form';
				$data['plugin'] = 'ManageUser/plugin';
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
				redirect('manage_user');
			} elseif($this->input->post('submit')) {
				if($this->input->post('tabel') == "emp") {
					$this->md_manage_user->MDL_Update_Employee($id);
				} else {
					$this->md_manage_user->MDL_Update($id);
				}
				
				redirect('manage_user');
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
				
				list($hasil,$tabel) = $this->md_manage_user->MDL_SelectID($id);
				$data['userid'] = $hasil->userid;
				$data['userid2'] = $hasil->userid2;
				$data['first_name'] = $hasil->first_name;
				$data['middle_name'] = $hasil->middle_name;
				$data['last_name'] = $hasil->last_name;
				$data['email'] = $hasil->email;
				$data['active'] = $hasil->active;
				$data['tabel'] = @$tabel;
				
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title'] = sprintf("%s - Update",$nm_title);

				$data['url'] = 'manage_user/CTRL_Edit/'.$id;
				$data['page'] = 'ManageUser/form_edit';
				$data['url_del'] = 'manage_user/CTRL_Delete/'.$id;
				$data['plugin'] = 'ManageUser/plugin';
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
		} elseif(!$this->auth->Auth_isRecID($id,$this->config->item('tbl_user'),'userid')) {
			$data['id'] = $id;
			$data['page'] = 'error_invalidID';
			$this->load->view('template_admin', $data);
		} else {
			if (isset($id)) {
				$isDeleted = $this->md_manage_user->MDL_isPermDelete($id);
				if($isDeleted) {
					$this->md_manage_user->MDL_Delete($id);
					redirect('manage_user');
				} else {
					$data['page'] = 'error_delete';
					$this->load->view('template_admin', $data);
				}
					
			} else {
				redirect('manage_user');
			}
		}
    }

	public function CTRL_Privileges_User($id='') {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isPrivButton('edit')) {
			$data['action'] = 'privileges';
			$data['page'] = 'error_sysmenu';
			$this->load->view('template_admin', $data);
		} elseif(!$this->auth->Auth_isRecID($id,$this->tblName,$this->field)) {
			$data['id'] = $id;
			$data['page'] = 'error_invalidID';
			$this->load->view('template_admin', $data);
		} else {
			if ($this->input->post('close')) {
				redirect('manage_user');
			} elseif ($this->input->post('submit')) {
				//$id = $this->input->post('user_id');
				$this->md_manage_user->MDL_InsertPriv_User();
				redirect('manage_user/CTRL_Privileges_User/'.$id);
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
				$this->breadcrumbs->add('Privileges', base_url());
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
				if($this->input->post('searchNotMember')) {
					$search_not_member = $this->input->post('search_not_member');
					$search_member = '';
				} elseif($this->input->post('searchMember')) {
					$search_not_member = '';
					$search_member = $this->input->post('search_member');
				} else {
					$search_not_member = '';
					$search_member = '';
				}
				
				list($hasil,$tabel) = $this->md_manage_user->MDL_SelectID($id);
				$data['userid'] = $hasil->userid;
				$data['userid2'] = $hasil->userid2;
				$data['username'] = $hasil->username;
				$data['search_not_member'] = $search_not_member;
				$data['search_member'] = $search_member;

				$AryNotMember = $this->CTRL_Option_NotMember($data['userid'],$search_not_member);
				$AryMember = $this->CTRL_Option_Member($data['userid'],$search_member);
				$data['option_not_member'] = $AryNotMember;
				$data['option_member'] = $AryMember;
				
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title'] = sprintf("%s - Admin Authorization Group",$nm_title);
				$data['url'] = 'manage_user/CTRL_Privileges_User/'.$id;
				$data['page'] = 'ManageUser/privileges_user';
				$data['plugin'] = 'ManageUser/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }

	public function CTRL_Option_NotMember($gid,$item) {

		$option = array();
		$AryData = $this->md_manage_user->MDL_Select_NotMember($gid,$item);
		//$option[''] = 'Choose a Company...';
		foreach($AryData as $row) {
			$option[$row->id] = $row->nama;
		}

		return $option;
	}
	
	public function CTRL_Option_Member($gid,$item) {

		$option = array();
		$AryData = $this->md_manage_user->MDL_Select_Member($gid,$item);
		//$option[''] = 'Choose a Company...';
		foreach($AryData as $row) {
			$option[$row->id] = $row->nama;
		}

		return $option;
	}
	
	public function CTRL_CekField($field,$id='') {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} else {
			$result = $this->md_manage_user->MDL_CekField($field,$id);
			echo json_encode($result);
		}
    }
	
}
