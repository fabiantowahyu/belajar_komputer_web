<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organization_level extends CI_Controller {
	private $tblName;
	private $field;

	public function __construct() {
		parent::__construct();
		$this->load->model('md_organization_level');
		$this->tblName = $this->config->item('tmst_position');
		$this->field = 'position_id';
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
		
			$nm_title = $this->auth->Auth_getNameMenu();
			$data['title'] = sprintf("%s",$nm_title);
			$data['url'] = 'organization_level/CTRL_New/';
			$data['url_view'] = sprintf("%sorganization_level/CTRL_Edit_Position/",site_url());
			$data['page'] = 'OrganizationLevel/view';
			$data['plugin'] = 'OrganizationLevel/plugin_viewtree';
			$this->load->view('template_admin', $data);
		}
	}
	
	public function CTRL_SelectData() {
		if($this->auth->Auth_isPerm()) {

			$company_name = $this->md_organization_level->MDL_Select_Company();
			$AryData = $this->md_organization_level->MDL_getDataParent();
			//$data2 = '[{"id":1,"text":"Root node","icon" : "jstree-orglevel","children":[{"id":2,"text":"Child node 1","icon" : "jstree-orglevel"},{"id":3,"text":"Child node 2","icon" : "jstree-position"}]},{"id":55,"text":"Root node 2","icon" : "jstree-orglevel"}]';

			if(count($AryData)) {
				$aryL = array();
				$aryTMP = array();
				$rows = array();
				$aX = array();
				$tmp = "";
				$ii = 0;
				foreach($AryData as $row2) {
					if(isset($aryL[$row2->position_parent])) {
						$aryL[$row2->position_id] = $aryL[$row2->position_parent]."-".$row2->position_parent;
					} else {
						$aryL[$row2->position_id] = $row2->position_parent;
					}
					$x = @explode("-",$aryL[$row2->position_id]);
					$icon = ($row2->position_flag == '3') ? "jstree-position" : "jstree-orglevel"; ## 3 : Position, 1 & 2 : Org. Level
					$text = ($row2->position_parent == '0') ? $company_name : sprintf("%s. %s",$row2->position_code,$row2->position_name);
					$text = '<a href="javascript:void(0);" onClick="clickOrgLevel('.$row2->position_id.');">' . $text . '</a>';
					$text2 = ($row2->position_parent == '0') ? '' : '&nbsp;&nbsp;<a href="javascript:void(0);" onClick="editOrgLevel('.$row2->position_id.');"><i class="icon-edit bigger-120"></i></a>';
					
					## With Array
					$tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$row2->position_id."']['id'] = '".$row2->position_id."';\n";
					$tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$row2->position_id."']['text'] = '" . $text . $text2 ."';\n";
					$tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$row2->position_id."']['icon'] = '".addslashes($icon)."';\n";
			
					## With Object
					// if(count($x) < 2) {
						// $tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$row2->position_id."']->id = '".$row2->position_id."';\n";
						// $tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$row2->position_id."']->text = '".addslashes($row2->position_name)."';\n";
						// $tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$row2->position_id."']->icon = '".addslashes($icon)."';\n";
					// } else {
						// $tmp .= "\$aX['".join("']['children']['",$x)."']->children['".$row2->position_id."']->id = '".$row2->position_id."';\n";
						// $tmp .= "\$aX['".join("']['children']['",$x)."']->children['".$row2->position_id."']->text = '".addslashes($row2->position_name)."';\n";
						// $tmp .= "\$aX['".join("']['children']['",$x)."']->children['".$row2->position_id."']->icon = '".addslashes($icon)."';\n";
					// }

					// if(strlen($row2->position_parent)) {
						// $aryTMP[$row2->position_id] = $row2;
					// }
					$ii++;
				}

				// @reset($aryL);
				// foreach($aryTMP as $rowTMP) {
					// if(isset($aryL[$rowTMP->position_parent])) {
						// $aryL[$rowTMP->position_id] = $aryL[$rowTMP->position_parent]."-".$rowTMP->position_parent;
						// $x = @explode("-",$aryL[$rowTMP->position_id]);
						// $tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$rowTMP->position_id."']['id'] = '".$rowTMP->position_id."';\n";
						// $tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$rowTMP->position_id."']['title'] = '".addslashes($rowTMP->position_name)."';\n";

					// }
				// }

				eval($tmp);
				$rows = $aX['0']['children'];
				$rows = $this->addList('KC',$rows);

			}

			echo json_encode(array_values($rows));
		}
	}
	
	public function CTRL_SelectData_Detail($pos_id,$type='') {
		if($this->auth->Auth_isPerm()) {

			$tmpData = $this->md_organization_level->MDL_SelectID($pos_id);
			$parentpath = ($type == "new") ? sprintf("%s,%s",$tmpData->position_parentpath,$pos_id) : $tmpData->position_parentpath;
			$company_name = $this->md_organization_level->MDL_Select_Company();
			$AryData = $this->md_organization_level->MDL_getDataParent_Detail($parentpath);

			if(count($AryData)) {
				$aryL = array();
				$aryTMP = array();
				$rows = array();
				$aX = array();
				$tmp = "";
				$ii = 0;
				foreach($AryData as $row2) {
					if(isset($aryL[$row2->position_parent])) {
						$aryL[$row2->position_id] = $aryL[$row2->position_parent]."-".$row2->position_parent;
					} else {
						$aryL[$row2->position_id] = $row2->position_parent;
					}
					$x = @explode("-",$aryL[$row2->position_id]);
					$icon = ($row2->position_flag == '3') ? "jstree-position" : "jstree-orglevel"; ## 3 : Position, 1 & 2 : Org. Level
					$text = ($row2->position_parent == '0') ? $company_name : sprintf("%s. %s",$row2->position_code,$row2->position_name);
					//$text = '<a href="javascript:void(0);" onClick="clickOrgLevel('.$row2->position_id.');">' . $text . '</a>';
					
					## With Array
					$tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$row2->position_id."']['id'] = '".$row2->position_id."';\n";
					$tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$row2->position_id."']['text'] = '".$text."';\n";
					$tmp .= "\$aX['".join("']['children']['",$x)."']['children']['".$row2->position_id."']['icon'] = '".addslashes($icon)."';\n";
	
					$ii++;
				}

				eval($tmp);
				$rows = $aX['0']['children'];
				$rows = $this->addList('KC',$rows);

			}

			echo json_encode(array_values($rows));
		}
	}
	
	public function addList($name,$arymenu,$step=0) {
		@reset($arymenu);
		
		if(is_array($arymenu) && count($arymenu)) {
			$step += 1;
			$i=0;
			$option = $arymenu;
			while(list($k,$v) = @each($arymenu)) {

				if(isset($v['children'])) {
					$data = $this->addList('',$v['children'],$step + 1);
					$option[$k]['children'] = array_values($data);
				}
				$i++;
			}
		}
		return $option;
	}
	
	public function CTRL_New($pos_id) {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isPrivButton('add')) {
			$data['action'] = 'add';
			$data['page'] = 'error_sysmenu';
			$this->load->view('template_admin', $data);
		} elseif(!$this->auth->Auth_isRecID($pos_id,$this->tblName,$this->field)) {
			$data['id'] = $pos_id;
			$data['page'] = 'error_invalidID';
			$this->load->view('template_admin', $data);
		} else {
			if ($this->input->post('close')) {
				redirect('organization_level');
			} elseif ($this->input->post('submit')) {
				$this->md_organization_level->MDL_Insert();
				redirect('organization_level');
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

				$aryData = $this->md_organization_level->MDL_SelectID($pos_id);
				$data['division_id'] = $aryData->position_id;
				$data['position_parent'] = $aryData->position_id;
				$data['position_level'] = $aryData->position_level + 1;
				$data['position_parentpath'] = sprintf("%s,%s",$aryData->position_parentpath,$aryData->position_id);
				

				$AryOrganizationLevel = $this->CTRL_Option_OrganizationLevel();
				$data['organization_level'] = '';
				$data['option_organization_level'] = $AryOrganizationLevel;
				
				$AryNotMember = $this->CTRL_Option_NotMember('');
				$AryMember = $this->CTRL_Option_Member(''); //$aryData->work_location
				$data['option_not_member'] = $AryNotMember;
				$data['option_member'] = $AryMember;
				
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title_head'] = sprintf("%s - Add New",$nm_title);
				$data['title'] = sprintf("%s",$nm_title);
				
				$data['url_cek_field'] = sprintf("%s%s/position_code",site_url(),"organization_level/CTRL_CekField");
				$data['url_view'] = sprintf("%s%s/%s/new",site_url(),"organization_level/CTRL_View_Tree",$pos_id);
				$data['url'] = 'organization_level/CTRL_New/'.$pos_id;
				$data['page'] = 'OrganizationLevel/form';
				$data['plugin'] = 'OrganizationLevel/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }

	public function CTRL_Edit($id) {
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
				redirect('organization_level');
			} elseif ($this->input->post('submit')) {
				$this->md_organization_level->MDL_Update($id);
				redirect('organization_level');
				//redirect('organization_level/CTRL_Edit/'.$id);
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
			
				$aryData = $this->md_organization_level->MDL_SelectID($id);
				$data['id'] = $aryData->position_id;
				$data['position_code'] = $aryData->position_code;
				$data['position_name'] = $aryData->position_name;
				$data['division_id'] = $aryData->division_id;
				$data['position_parent'] = $aryData->position_parent;
				$data['position_level'] = $aryData->position_level;
				$data['position_parentpath'] = $aryData->position_parentpath;
				$data['position_active'] = $aryData->position_active;
				$data['pos_in_neck'] = $aryData->pos_in_neck;
				

				$AryOrganizationLevel = $this->CTRL_Option_OrganizationLevel();
				$data['organization_level'] = $aryData->organization_level;
				$data['option_organization_level'] = $AryOrganizationLevel;
				
				$AryNotMember = $this->CTRL_Option_NotMember($aryData->work_location);
				$AryMember = $this->CTRL_Option_Member($aryData->work_location);
				$data['option_not_member'] = $AryNotMember;
				$data['option_member'] = $AryMember;
				
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title_head'] = sprintf("%s - Update",$nm_title);
				$data['title'] = sprintf("%s",$nm_title);
				
				$data['url_cek_field'] = sprintf("%s%s/position_code/%s",site_url(),"organization_level/CTRL_CekField",$data['position_code']);
				$data['url_view'] = sprintf("%s%s/%s",site_url(),"organization_level/CTRL_View_Tree",$id);
				$data['url'] = 'organization_level/CTRL_Edit/'.$id;
				$data['url_new'] = 'organization_level/CTRL_New/'.$id;
				$data['url_del'] = 'organization_level/CTRL_Delete/'.$id;
				$data['page'] = 'OrganizationLevel/form_edit';
				$data['plugin'] = 'OrganizationLevel/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }

	public function CTRL_Edit_Position($id) {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isPrivButton('list')) {
			$data['action'] = 'list';
			$data['page'] = 'error_sysmenu';
			$this->load->view('template_popupwindow', $data);
		} elseif(!$this->auth->Auth_isRecID($id,$this->tblName,$this->field)) {
			$data['id'] = $id;
			$data['page'] = 'error_invalidID';
			$this->load->view('template_popupwindow', $data);
		} else {
			if ($this->input->post('submit')) {
				$this->md_organization_level->MDL_Update_Position($id);
				//redirect('organization_level');
				//redirect('organization_level/CTRL_Edit_Position/'.$id);
				print("
					<script language=\"javascript\">
						self.close();
						window.opener.location.reload()
					</script>
				");
			} else {
				$tmpData = $this->md_organization_level->MDL_SelectID($id);
				
				$aryData = $this->md_organization_level->MDL_SelectID($tmpData->position_parent);
				$data['id'] = $aryData->position_id;
				$data['position_name'] = $aryData->position_name;
				$data['parentpath'] = $aryData->position_parentpath;
			
				$AryPosParent = $this->CTRL_Option_PosParent($id,$aryData->position_flag);
				$data['posparent'] = $aryData->position_id;
				$data['option_posparent'] = $AryPosParent;
			
				$nm_title = $this->auth->Auth_getNameMenu();
				$data['title'] = sprintf("%s",$nm_title);
				$data['url'] = 'organization_level/CTRL_Edit_Position/'.$id;

				$data['page'] = 'OrganizationLevel/form_edit_pos';
				$data['plugin'] = 'OrganizationLevel/plugin';
				$this->load->view('template_popupwindow', $data);
			}
		}
    }
	
	public function CTRL_Delete($id) {
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
			$id = $this->input->post('id');
			$isDeleted = $this->md_organization_level->MDL_isPermDelete($id);
			if($isDeleted) {
				$this->md_organization_level->MDL_Delete($id);
				redirect('organization_level');
			} else {
				$data['page'] = 'error_delete';
				$this->load->view('template_admin', $data);
			}
		}
    }
	
	public function CTRL_View_Tree($id,$type='') {
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
			
			$data['url_view'] = ($type == "new") 
				? sprintf("%s%s/%s/new",site_url(),"organization_level/CTRL_SelectData_Detail",$id)
				: sprintf("%s%s/%s",site_url(),"organization_level/CTRL_SelectData_Detail",$id);
			$this->load->view('OrganizationLevel/view_tree',$data);
		}
    }
	
	public function CTRL_CekField($field,$id='') {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} else {
			$result = $this->md_organization_level->MDL_CekField($field,$id);
			echo json_encode($result);
		}
    }
	
	public function CTRL_Option_OrganizationLevel() {
		$this->load->model('md_ref_json');
		$AryPosition = $this->md_ref_json->MDL_Select_MasterType('ORG_LEVEL');
		$option[''] = 'None';
		foreach($AryPosition as $row) {
			$option[$row->id] = $row->name;
		}
		return $option;
	}
	
	public function CTRL_Option_PosParent($id,$flag) {
		$AryPosition = $this->md_organization_level->MDL_Select_Position($flag);
		//$option[''] = 'None';
		foreach($AryPosition as $row) {
			if($id <> $row->position_id) {
				$option[$row->position_id] = sprintf("%s [%s]",$row->position_name,$row->position_code);
			}
		}
		return $option;
	}
	
	public function CTRL_Option_NotMember($gid) {
		$dtBranch = @explode(",",str_replace(" ","",$gid));
	
		$this->load->model('md_branch');
		$AryBranch = $this->md_branch->MDL_Select();
		//$option[''] = 'Choose a Branch...';
		$option = array();
		foreach($AryBranch as $row) {
			if(!in_array($row->id,$dtBranch)) {
				$option[$row->id] = sprintf("[%s] %s",$row->id,$row->branch);
			}
		}

		return $option;
	}
	
	public function CTRL_Option_Member($gid) {
		$dtBranch = @explode(",",str_replace(" ","",$gid));
	
		$this->load->model('md_branch');
		$AryBranch = $this->md_branch->MDL_Select();
		//$option[''] = 'Choose a Branch...';
		$option = array();
		foreach($AryBranch as $row) {
			if(in_array($row->id,$dtBranch)) {
				$option[$row->id] = sprintf("[%s] %s",$row->id,$row->branch);
			}
		}

		return $option;
	}
	

}
