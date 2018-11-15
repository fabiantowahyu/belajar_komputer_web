<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_menu extends CI_Controller {
	private $tblName;
	private $field;

	public function __construct() {
		parent::__construct();
		//date_default_timezone_set("Asia/Jakarta");
		$this->load->model('md_manage_menu');
		$this->tblName = $this->config->item('tmst_menu');
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
			
			$data['results'] = $this->md_manage_menu->MDL_Select();
			
			$nm_title = $this->auth->Auth_getNameMenu();
			$data['title'] = sprintf("%s",$nm_title);
			$data['page'] = 'ManageMenu/view';
			$data['plugin'] = 'ManageMenu/plugin';
			$this->load->view('template_admin', $data);
		}
	}

	public function CTRL_SelectData() {
		if($this->auth->Auth_isPerm()) {
			$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
			$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
			$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'parentt';
			$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc'; 
			$item = isset($_POST['item']) ? mysql_real_escape_string($_POST['item']) : ''; 

			$data = $this->md_manage_menu->MDL_Select_DGtabel($page,$rows,$sort,$order,$item);

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
				redirect('manage_menu');
			} elseif ($this->input->post('submit')) {
				$this->md_manage_menu->MDL_Insert();
				redirect('manage_menu');
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
				

				$AryParent = $this->getData_Parent();
				$data['option_parent_id'] = $AryParent;
				$AryActive = array("Not Active","Active");
				$data['option_active'] = $AryActive;
				$data['parent_id'] = '';
				$data['active'] = 0;

				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title'] = sprintf("%s - Add New",$nm_title);
				$data['url_tid'] = sprintf("%s%s/",site_url(),"manage_menu/CTRL_Select_OrderNumber");
				$data['url'] = 'manage_menu/CTRL_New';
				$data['page'] = 'ManageMenu/form';
				$data['plugin'] = 'ManageMenu/plugin';
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
				redirect('manage_menu');
			} elseif ($this->input->post('submit')) {
				$id = $this->input->post('id');
				$this->md_manage_menu->MDL_Update($id);
				redirect('manage_menu');
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
				
				$hasil = $this->md_manage_menu->MDL_SelectID($id);
				$data['id'] = $hasil->id;
				$data['custom_title'] = $hasil->custom_title;
				$data['url_menu'] = $hasil->url_menu;
				$data['parent_id'] = $hasil->parent_id;
				$data['tid'] = $hasil->tid;
				$data['active'] = $hasil->active;
				$data['path_icon'] = $hasil->path_icon;

				$AryParent = $this->getData_Parent();
				$data['option_parent_id'] = $AryParent;
				$AryActive = array("Not Active","Active");
				$data['option_active'] = $AryActive;

				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title'] = sprintf("%s - Update",$nm_title);
				$data['url'] = 'manage_menu/CTRL_Edit/'.$id;
				$data['url_del'] = 'manage_menu/CTRL_Delete/'.$id;
				$data['url_tid'] = sprintf("%s%s/",site_url(),"manage_menu/CTRL_Select_OrderNumber");
				$data['page'] = 'ManageMenu/form_edit';
				$data['plugin'] = 'ManageMenu/plugin';
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
				$isDeleted = $this->md_manage_menu->MDL_isPermDelete($id);
				if($isDeleted) {
					$this->md_manage_menu->MDL_Delete($id);
					redirect('manage_menu');
				} else {
					$data['page'] = 'error_delete';
					$this->load->view('template_admin', $data);
				}
			} else {
				redirect('manage_menu');
			}
		}
    }

	public function CTRL_Select_OrderNumber() {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		}  else {
			$result = $this->md_manage_menu->MDL_getMax_OrderNumber();
			if ($result){
				echo json_encode(array('success'=>true,'tid'=>$result));
			} else {
				echo json_encode(array('msg'=>'Some errors occured.'));
			}
		}
    }
	
	//List Menu Parent
	public function getData_Parent() {

		$AryData = $this->md_manage_menu->MDL_getDataParent();
		$ary1 = array();
		$ary2 = array();
		$ary1[''] = "Top";

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
				//$rows[$k]['sub'] = $parent[$k];

				if(strlen($row2->parentt)) {
					$aryTMP[$row2->id] = $row2;
				}

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
			$ary2 = $this->addList('KC',$rows);
		}
		$option = array_merge($ary1,$ary2);

		return $option;
	}

	public function addList($name,$arymenu,$step=0) {
		@reset($arymenu);
			
		if(is_array($arymenu) && count($arymenu)) {
			$step += 1;
			$i=0;
			while(list($k,$v) = @each($arymenu)) {
				$title = $v['title'];

				$option[$k] = sprintf("- %s",$title);
				if(isset($v['sub'])) {
					$data = $this->addList($v['title'],$v['sub'],$step + 1);
					while(list($kk,$vv) = @each($data)) {
						$option[$kk] = sprintf("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; %s",$vv);
					}
				}
				$i++;
			}
		}
		return $option;
	}
}
