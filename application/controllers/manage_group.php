<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_group extends CI_Controller {
	private $tblName;
	private $field;

	public function __construct() {
		parent::__construct();
		//date_default_timezone_set("Asia/Jakarta");
		$this->load->model('md_manage_group');
		$this->tblName = $this->config->item('tmst_group');
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
			//$this->breadcrumbs->add('Spring Tutorial', base_url().'tutorials/spring-tutorials');
			$breadcrum = $this->breadcrumbs->output();
			$data['breadcrum'] = $breadcrum;
			/* end */
						
			$data['results'] = $this->md_manage_group->MDL_Select();
			
			$nm_title = $this->auth->Auth_getNameMenu();
			$data['title'] = sprintf("%s",$nm_title);
			$data['page'] = 'ManageGroup/view';
			$data['plugin'] = 'ManageGroup/plugin';
			$this->load->view('template_admin', $data);
		}
	}

	public function CTRL_SelectData() {
		if($this->auth->Auth_isPerm()) {
			$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
			$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
			$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
			$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc'; 
			$item = isset($_POST['item']) ? mysql_real_escape_string($_POST['item']) : ''; 

			$data = $this->md_manage_group->MDL_Select_DGtabel($page,$rows,$sort,$order,$item);
			//$result['total'] = count($data);
			//$result['rows'] = $data;

			echo json_encode($data);
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
				redirect('manage_group');
			} elseif ($this->input->post('submit')) {
				$isDuplicated = $this->md_manage_group->MDL_isPermInsert($this->input->post('id'));
				if($isDuplicated) {
					$this->md_manage_group->MDL_Insert();
					redirect('manage_group');
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
				//$this->breadcrumbs->add('Spring Tutorial', base_url().'tutorials/spring-tutorials');
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
								
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title'] = sprintf("%s - Add New",$nm_title);
				$data['url'] = 'manage_group/CTRL_New';
				$data['page'] = 'ManageGroup/form';
				$data['plugin'] = 'ManageGroup/plugin';
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
				redirect('manage_group');
			} elseif ($this->input->post('submit')) {
				$id = $this->input->post('id');
				$this->md_manage_group->MDL_Update($id);
				redirect('manage_group');
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
				//$this->breadcrumbs->add('Spring Tutorial', base_url().'tutorials/spring-tutorials');
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
							
				$hasil = $this->md_manage_group->MDL_SelectID($id);
				$data['id'] = $hasil->id;
				$data['nama'] = $hasil->nama;
				$data['description'] = $hasil->description;
				$data['active'] = $hasil->active;
				
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title'] = sprintf("%s - Update",$nm_title);
				$data['url'] = 'manage_group/CTRL_Edit/'.$id;
				$data['url_del'] = 'manage_group/CTRL_Delete/'.$id;
				$data['page'] = 'ManageGroup/form_edit';
				$data['plugin'] = 'ManageGroup/plugin';
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
			if (isset($id)) {
				$isDeleted = $this->md_manage_group->MDL_isPermDelete($id);
				if($isDeleted) {
					$this->md_manage_group->MDL_Delete($id);
					redirect('manage_group');
				} else {
					$data['page'] = 'error_delete';
					$this->load->view('template_admin', $data);
				}
			} else {
				redirect('manage_group');
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
				redirect('manage_group');
			} elseif ($this->input->post('submit')) {
				$id = $this->input->post('pid');
				$this->md_manage_group->MDL_InsertPriv_User($id);
				redirect('manage_group/CTRL_Privileges_User/'.$id);
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
				$this->breadcrumbs->add('Admin Authorization Group', base_url());
				//$this->breadcrumbs->add('Spring Tutorial', base_url().'tutorials/spring-tutorials');
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
				$hasil = $this->md_manage_group->MDL_SelectID($id);
				$data['id'] = $hasil->id;
				$data['nama'] = $hasil->nama;
				$data['description'] = $hasil->description;
				$data['search_not_member'] = $search_not_member;
				$data['search_member'] = $search_member;

				$AryNotMember = $this->CTRL_Option_NotMember($id,$search_not_member);
				$AryMember = $this->CTRL_Option_Member($id,$search_member);
				$data['option_not_member'] = $AryNotMember;
				$data['option_member'] = $AryMember;

				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title'] = sprintf("%s - Admin Group",$nm_title);
				$data['url'] = 'manage_group/CTRL_Privileges_User/'.$id;
				$data['page'] = 'ManageGroup/privileges_user';
				$data['plugin'] = 'ManageGroup/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }
	
	public function CTRL_Privileges_Menu($id='') {
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
				redirect('manage_group');
			} elseif ($this->input->post('submit')) {
				$id = $this->input->post('pid');
				$this->md_manage_group->MDL_InsertPriv_Menu($id);
				redirect('manage_group/CTRL_Privileges_Menu/'.$id);
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
				$this->breadcrumbs->add('User Authorization Group', base_url());
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
				$hasil = $this->md_manage_group->MDL_SelectID($id);
				$data['id'] = $hasil->id;
				$data['nama'] = $hasil->nama;
				$data['description'] = $hasil->description;
				list($DATA_MENU,$cekAll) = $this->CTRL_getData_Parent($id);
				$data['DATA_MENU'] = $DATA_MENU;
				$data['cekall'] = ($cekAll==1) ? 'checked="true"' : '';
				//$data['ARYDATA'] = $this->md_manage_group->MDL_SelectDetail($id);
				//$data['ARYPARENT'] = $this->md_manage_group->MDL_SelectMenuParent();

				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title'] = sprintf("%s - User Authorization Group",$nm_title);
				$data['url'] = 'manage_group/CTRL_Privileges_Menu/'.$id;
				$data['page'] = 'ManageGroup/privileges_menu';
				$data['plugin'] = 'ManageGroup/plugin_viewtree';
				$this->load->view('template_admin', $data);
			}
		}
    }

	//List Menu Parent
	public function CTRL_getData_Parent($pid) {

		$this->load->model('md_manage_menu');
		$AryData = $this->md_manage_menu->MDL_getDataParent();
		$AryValue = $this->md_manage_group->MDL_SelectDetail($pid);

		if(count($AryData)) {
			$aryL = array();
			$aryTMP = array();
			$rows = array();
			$aX = array();
			$tmp = "";
			foreach($AryData as $row2) {
				if(isset($aryL[$row2->parentt])) {
					$aryL[$row2->id] = $aryL[$row2->parentt]."-".$row2->parentt;
				} else {
					$aryL[$row2->id] = $row2->parentt;
				}
				
				$x = @explode("-",$aryL[$row2->id]);
				$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$row2->id."']['id'] = '".$row2->id."';\n";
				$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$row2->id."']['title'] = '".addslashes($row2->custom_title)."';\n";

				if(strlen($row2->parentt)) {
					$aryTMP[$row2->id] = $row2;
				}
				//$rows[$k]['sub'] = $parent[$k];
			}

			@reset($aryL);
			foreach($aryTMP as $rowTMP) {
				if(isset($aryL[$rowTMP->parentt])) {
					$aryL[$rowTMP->id] = $aryL[$rowTMP->parentt]."-".$rowTMP->parentt;
					$x = @explode("-",$aryL[$rowTMP->id]);
					$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$rowTMP->id."']['id'] = '".$rowTMP->id."';\n";
					$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$rowTMP->id."']['title'] = '".addslashes($rowTMP->custom_title)."';\n";

				}
			}

			eval($tmp);
			$rows = $aX['']['sub'];
			$hasil = $this->CTRL_addList('KC',$rows,$AryValue);
		}

		$cekALL = count($AryValue)>0 ? 1 : 0;
		return array($hasil,$cekALL);
	}

	public function CTRL_addList($name,$arymenu,$aryvalue,$step=0) {
		@reset($arymenu);
		@reset($aryvalue);

		if(is_array($arymenu) && count($arymenu)) {
			$step += 1;
			$content = '';
			if($step > 1) {
				$content .= str_repeat("\t",$step) . "<ul>\n";
			}
			$i=0;

			while(list($k,$v) = @each($arymenu)) {
				$title = $v['title'];
				$id = $v['id'];
				$name = sprintf("frmChk_%s",$v['id']);
				$name_access = sprintf("frmRdo_%s",$v['id']);
				$checked = isset($aryvalue[$id]) ? 'checked="true"' : '';
				
				$checked_list = '';
				$checked_add = '';
				$checked_edit = '';
				$checked_delete = '';
				$isList = @$aryvalue[$id]['isList'];
				$isAdd = @$aryvalue[$id]['isAdd'];
				$isEdit = @$aryvalue[$id]['isEdit'];
				$isDelete = @$aryvalue[$id]['isDelete'];
				if($isList==1 && $isAdd==1 && $isEdit==1 && $isDelete==1) {
					$checked_delete = 'checked="true"';
				} elseif($isList==1 && $isAdd==1 && $isEdit==1 && $isDelete==0) {
					$checked_edit = 'checked="true"';
				} elseif($isList==1 && $isAdd==1 && $isEdit==0 && $isDelete==0) {
					$checked_add = 'checked="true"';
				} else {
					$checked_list = 'checked="true"';
				}

				if(isset($v['sub'])) {
					$content .= str_repeat("\t",$step + 1) . "<li class='collapsed'>";
					if($step > 1) {
						$content .= '
							<div class="row-fluid">
								<div class="span7">
									<label>
										<input name="' . $name . '" class="ace-checkbox-2" type="checkbox" value="' . $id . '" ' . $checked . '>
										<span class="lbl"> ' . $title . '</span>
									</label>
								</div>
								<div class="span5 form-inline">
									<span>Access : </span>
									<label>
										<input name="' . $name_access . '" type="radio" value="list" ' . $checked_list . '>
										<span class="lbl"> List</span>
									</label>
									<label>
										<input name="' . $name_access . '" type="radio" value="add" ' . $checked_add . '>
										<span class="lbl"> Add</span>
									</label>
									<label>
										<input name="' . $name_access . '" type="radio" value="edit" ' . $checked_edit . '>
										<span class="lbl"> Edit</span>
									</label>
									<label>
										<input name="' . $name_access . '" type="radio" value="delete" ' . $checked_delete . '>
										<span class="lbl"> Delete</span>
									</label>
								</div>
							</div>
						';
					} else {
						$content .= '
							<div class="row-fluid">
								<div class="span7">
									<label>
										<input name="' . $name . '" class="ace-checkbox-2" type="checkbox" value="' . $id . '" ' . $checked . '>
										<span class="lbl"> ' . $title . '</span>
									</label>
								</div>
								<div class="span5 form-inline">
									<span>Access : </span>
									<label>
										<input name="' . $name_access . '" type="radio" value="list" ' . $checked_list . '>
										<span class="lbl"> List</span>
									</label>
									<label>
										<input name="' . $name_access . '" type="radio" value="add" ' . $checked_add . '>
										<span class="lbl"> Add</span>
									</label>
									<label>
										<input name="' . $name_access . '" type="radio" value="edit" ' . $checked_edit . '>
										<span class="lbl"> Edit</span>
									</label>
									<label>
										<input name="' . $name_access . '" type="radio" value="delete" ' . $checked_delete . '>
										<span class="lbl"> Delete</span>
									</label>
								</div>
							</div>
						';
					}
					$content .= "\n";
					$content .= $this->CTRL_addList($v['title'],$v['sub'],$aryvalue,$step + 1);
					$content .= str_repeat("\t",$step + 1);
					
				} else {
					$content .= str_repeat("\t",$step + 1) . "<li>";
					$content .= '
						<div class="row-fluid">
							<div class="span7">
								<label>
									<input name="' . $name . '" class="ace-checkbox-2" type="checkbox" value="' . $id . '" ' . $checked . '>
									<span class="lbl"> ' . $title . '</span>
								</label>
							</div>
							<div class="span5 form-inline">
								<span>Access : </span>
								<label>
									<input name="' . $name_access . '" type="radio" value="list" ' . $checked_list . '>
									<span class="lbl"> List</span>
								</label>
								<label>
									<input name="' . $name_access . '" type="radio" value="add" ' . $checked_add . '>
									<span class="lbl"> Add</span>
								</label>
								<label>
									<input name="' . $name_access . '" type="radio" value="edit" ' . $checked_edit . '>
									<span class="lbl"> Edit</span>
								</label>
								<label>
									<input name="' . $name_access . '" type="radio" value="delete" ' . $checked_delete . '>
									<span class="lbl"> Delete</span>
								</label>
							</div>
						</div>
					';
				}
				$content .= "</li>\n";
				
			}
			$i++;
			if($step > 1) {
				$content .= str_repeat("\t",$step) . "</ul>\n";
			}
		}
		return $content;
	}

	public function CTRL_Option_NotMember($gid,$item) {

		$option = array();
		$AryData = $this->md_manage_group->MDL_Select_NotMember($gid,$item);
		//$option[''] = 'Choose a Company...';
		foreach($AryData as $row) {
			$option[$row->userid] = $row->username;
		}

		return $option;
	}
	
	public function CTRL_Option_Member($gid,$item) {

		$option = array();
		$AryData = $this->md_manage_group->MDL_Select_Member($gid,$item);
		//$option[''] = 'Choose a Company...';
		foreach($AryData as $row) {
			$option[$row->userid] = $row->username;
		}

		return $option;
	}
	
}
