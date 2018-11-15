<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	private $tblName;
	private $field;

	public function __construct() {
		parent::__construct();
		$this->load->model('md_profile');
		$this->tblName = $this->config->item('tmst_employee');
		$this->field = 'emp_id';
	}

	public function index()	{
		$id = $this->session->userdata('userid');
		if($this->auth->Auth_restrict()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isRecID($id,$this->tblName,$this->field)) {
			redirect("manage_user/CTRL_Edit/" . $id);
		} elseif($this->input->post('btnPassword')) {
			$this->md_profile->MDL_Update_Password($id);
			//redirect('profile');
			print("
				<script language=\"javascript\">
					alert('Change Password Successfully !!');
					window.location.href = '" . site_url() . "profile'
				</script>
			");
		} else {
			/* Bread crum */
			$this->load->model('md_ref_json');
			$params = 'admin'; //$this->router->fetch_class();
			$hasil = $this->md_ref_json->MDL_SelectMenu($params);
			$url_menu = $hasil->url_menu;
			$nm_menu = $hasil->custom_title;
			$path_icon = $hasil->icon_parent;
			$this->breadcrumbs->add($nm_menu, base_url().$url_menu, $path_icon);
			$this->breadcrumbs->add('Profile', '#');
			$breadcrum = $this->breadcrumbs->output();
			$data['breadcrum'] = $breadcrum;
			/* end */
		
			$hasil = $this->md_profile->MDL_SelectID($id);
			$data['id'] = $hasil->emp_id;
			$data['first_name'] = $hasil->first_name;
			$data['middle_name'] = $hasil->middle_name;
			$data['last_name'] = $hasil->last_name;
			$data['username'] = $hasil->username;
			$data['role'] = $hasil->role;
			$data['position_id'] = $hasil->position_id;
			$data['gender'] = $hasil->gender;
			$data['join_date'] = date("d F Y",strtotime($hasil->join_date));
			$data['address'] = $hasil->address;
			$data['phone'] = $hasil->phone;
			$data['hp'] = $hasil->hp;
			$data['post_code'] = $hasil->post_code;
			$data['photo'] = $hasil->photo;
			$data['signature'] = $hasil->signature;
			$data['branch_id'] = $hasil->branch_id;
			$data['status'] = $hasil->status;
			$data['email'] = $hasil->email;
			$tmpData = $data;
			
			$file_name = $hasil->photo;
			if(strlen($file_name)) {
				$ary = @explode(".",$file_name);
				$type = $ary[count($ary)-1];
				$data['file_name'] = sprintf("file_upload/avatar/%s.%s",$id,$type);
				$data['filename'] = sprintf("%s",$file_name);
			} else {
				$data['file_name'] = sprintf("file_upload/avatar/no_photo.jpg");
				$data['filename'] = sprintf("no_photo.jpg");
			}
			
			//Define Select Box
			//$AryGroup = $this->CTRL_Select_Group();
			$AryGender = $this->CTRL_Option_Gender();
			$data['option_gender'] = $AryGender;
			
			$AryPosition = $this->CTRL_Option_Position();
			$data['option_position'] = $AryPosition;
			
			$AryBranch = $this->CTRL_Option_Branch();
			$data['option_branch'] = $AryBranch;
			
			$AryGroup = $this->CTRL_Select_Group();
			$data['option_role'] = $AryGroup;
			
			$data['results_education'] = $this->md_profile->MDL_Select_Education($id);
			$data['results_training'] = $this->md_profile->MDL_Select_Training($id);
			$jumEdu = (count($data['results_education']) > 0) ? 0 : 1;
			$jumTrain = (count($data['results_training']) > 0) ? 0 : 1;
			$tmpData['education'] = (count($data['results_education']) > 0) ? count($data['results_education']) : "";
			$tmpData['training'] = (count($data['results_training']) > 0) ? count($data['results_training']) : "";
	
			# Menghitung Persentase Complete Profile
			unset($tmpData['breadcrum']);
			unset($tmpData['filename']);
			unset($tmpData['signature']);

			$totData = count($tmpData) + $jumEdu + $jumTrain;
			$totComplete = 0;
			while(list($k,$v) = @each($tmpData)) {
				if(strlen($v)) {
					$totComplete++;
				}
			}
			$persentase = ($totData > 0) ? round(($totComplete / $totData) * 100) : 0;
			$data['persentase'] = $persentase . "%";
			
			$data['title_head'] = sprintf("Profile");
			$data['title'] = sprintf("Profile");
			
			$data['isEdit'] = 1;
			$data['url_cek_field'] = sprintf("%s%s/",site_url(),"profile/CTRL_CekField_PWD");
			$data['url'] = 'profile';
			$data['page'] = 'Profile/view';
			$data['plugin'] = 'Profile/plugin';
			$this->load->view('template_admin', $data);
		}
	}

	public function CTRL_Edit() {
		$id = $this->session->userdata('userid');
		if($this->auth->Auth_restrict()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isRecID($id,$this->tblName,$this->field)) {
			redirect("manage_user/CTRL_Edit/" . $id);
		} else {
			if ($this->input->post('close')) {
				redirect('profile');
			} elseif ($this->input->post('upload')) {
				$this->md_profile->MDL_UpdateFoto($id);
				//redirect('profile');
				print("
					<script language=\"javascript\">
						alert('Change Photo Successfully !!');
						window.location.href = '" . site_url() . "profile'
					</script>
				");
			} elseif ($this->input->post('submit')) {
				$this->md_profile->MDL_Update($id);
				//redirect('profile');
				print("
					<script language=\"javascript\">
						alert('Change Profile Successfully !!');
						window.location.href = '" . site_url() . "profile'
					</script>
				");
			} elseif($this->input->post('btnPassword')) {
				$this->md_profile->MDL_Update_Password($id);
				//redirect('profile');
				print("
					<script language=\"javascript\">
						alert('Change Password Successfully !!');
						window.location.href = '" . site_url() . "profile'
					</script>
				");
			} else {
				/* Bread crum */
				$this->load->model('md_ref_json');
				$params = 'admin'; //$this->router->fetch_class();
				$hasil = $this->md_ref_json->MDL_SelectMenu($params);
				$url_menu = $hasil->url_menu;
				$nm_menu = $hasil->custom_title;
				$path_icon = $hasil->icon_parent;
				$this->breadcrumbs->add($nm_menu, base_url().$url_menu, $path_icon);
				$this->breadcrumbs->add('Profile', '#');
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
				$hasil = $this->md_profile->MDL_SelectID($id);
				$data['id'] = $hasil->emp_id;
				$data['first_name'] = $hasil->first_name;
				$data['middle_name'] = $hasil->middle_name;
				$data['last_name'] = $hasil->last_name;
				$data['username'] = $hasil->username;
				$data['role'] = $hasil->role;
				$data['position_id'] = $hasil->position_id;
				$data['gender'] = $hasil->gender;
				$data['join_date'] = $hasil->join_date;
				$data['address'] = $hasil->address;
				$data['phone'] = $hasil->phone;
				$data['hp'] = $hasil->hp;
				$data['post_code'] = $hasil->post_code;
				$data['photo'] = $hasil->photo;
				$data['signature'] = $hasil->signature;
				$data['branch_id'] = $hasil->branch_id;
				$data['status'] = $hasil->status;
				$data['email'] = $hasil->email;
				$tmpData = $data;
				
				$file_name = $hasil->photo;
				if(strlen($file_name)) {
					$ary = @explode(".",$file_name);
					$type = $ary[count($ary)-1];
					$data['file_name'] = sprintf("file_upload/avatar/%s.%s",$id,$type);
					$data['filename'] = sprintf("%s",$file_name);
				} else {
					$data['file_name'] = sprintf("file_upload/avatar/no_photo.jpg");
					$data['filename'] = sprintf("no_photo.jpg");
				}
				

				//Define Select Box
				//$AryGroup = $this->CTRL_Select_Group();
				$AryGender = $this->CTRL_Option_Gender();
				$data['option_gender'] = $AryGender;
				
				$AryPosition = $this->CTRL_Option_Position();
				$data['option_position'] = $AryPosition;
				
				$AryBranch = $this->CTRL_Option_Branch();
				$data['option_branch'] = $AryBranch;
				
				$AryGroup = $this->CTRL_Select_Group();
				$data['option_role'] = $AryGroup;
				
				$data['results_education'] = $this->md_profile->MDL_Select_Education($id);
				$data['results_training'] = $this->md_profile->MDL_Select_Training($id);
				$jumEdu = (count($data['results_education']) > 0) ? 0 : 1;
				$jumTrain = (count($data['results_training']) > 0) ? 0 : 1;
				$tmpData['education'] = (count($data['results_education']) > 0) ? count($data['results_education']) : "";
				$tmpData['training'] = (count($data['results_training']) > 0) ? count($data['results_training']) : "";
		
				# Menghitung Persentase Complete Profile
				unset($tmpData['breadcrum']);
				unset($tmpData['filename']);
				unset($tmpData['signature']);

				$totData = count($tmpData) + $jumEdu + $jumTrain;
				$totComplete = 0;
				while(list($k,$v) = @each($tmpData)) {
					if(strlen($v)) {
						$totComplete++;
					}
				}
				$persentase = ($totData > 0) ? round(($totComplete / $totData) * 100) : 0;
				$data['persentase'] = $persentase . "%";
				
				$data['title_head'] = sprintf("Profile");
				$data['title'] = sprintf("Profile");
				
				$data['isEdit'] = 1;
				$data['url_cek_field'] = sprintf("%s%s/",site_url(),"profile/CTRL_CekField_PWD");
				$data['url'] = 'profile/CTRL_Edit/';
				$data['page'] = 'Profile/form_edit';
				$data['plugin'] = 'Profile/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }
	
	//EDUCATION
	public function CTRL_New_Education($id) {
		$id = $this->session->userdata('userid');
		if($this->auth->Auth_restrict()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isRecID($id,$this->tblName,$this->field)) {
			redirect("manage_user/CTRL_Edit/" . $id);
		} else {
			if ($this->input->post('close')) {
				redirect('profile');
			} elseif ($this->input->post('submit')) {
				list($res,$msg) = $this->md_profile->MDL_Insert_Education();
				if($res) {
					redirect('profile');
				} else {
					$data['msg'] = $msg;
					$data['page'] = 'error_filetype';
					$this->load->view('template_admin', $data);
				}
			} else {
				/* Bread crum */
				$this->load->model('md_ref_json');
				$params = 'admin';
				$hasil = $this->md_ref_json->MDL_SelectMenu($params);
				$parentt = $hasil->parentt;
				$nm_menu = $hasil->custom_title;
				$url_menu = $hasil->url_menu;
				$path_icon = $hasil->icon_parent;
				$this->breadcrumbs->add($nm_menu, base_url().$url_menu, $path_icon);
				$this->breadcrumbs->add('Profile', base_url().'profile');
				$this->breadcrumbs->add('Education Add New', base_url());
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
				$Aryeducation_lvl = $this->CTRL_Option_EducationLevel();
				$data['education_lvl'] = '';
				$data['option_education_lvl'] = $Aryeducation_lvl;
				
				$Aryfaculty = $this->CTRL_Option_Faculty();
				$data['faculty'] = '';
				$data['option_faculty'] = $Aryfaculty;
				
				$Aryinstitution = $this->CTRL_Option_Institution();
				$data['institution'] = '';
				$data['option_institution'] = $Aryinstitution;
				
				$data['id'] = $id;
				
				$data['title_head'] = sprintf("Education - Add New");
				
				$data['url'] = 'profile/CTRL_New_Education/'.$id;
				$data['page'] = 'Profile/form_education';
				$data['plugin'] = 'Profile/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }
	
	public function CTRL_Edit_Education($empid, $id) {
		$empid = $this->session->userdata('userid');
		if($this->auth->Auth_restrict()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isRecID($empid,$this->tblName,$this->field)) {
			redirect("manage_user/CTRL_Edit/" . $id);
		} elseif(!$this->auth->Auth_isRecID($id,$this->config->item('tmst_emp_education'),'id')) {
			$data['id'] = $id;
			$data['page'] = 'error_invalidID';
			$this->load->view('template_admin', $data);
		} else {
			if ($this->input->post('close')) {
				redirect('profile');
			} elseif ($this->input->post('btnUpload')) {
				list($res,$msg) = $this->md_profile->MDL_UpdateCertificate($id);
				if($res) {
					redirect('profile/CTRL_Edit_Education/' . $empid . '/' . $id);
				} else {
					$data['msg'] = $msg;
					$data['page'] = 'error_filetype';
					$this->load->view('template_admin', $data);
				}
			}elseif ($this->input->post('submit')) {
				$id = $this->input->post('id');
				list($res,$msg) = $this->md_profile->MDL_Update_Education($id);
				if($res) {
					redirect('profile');
				} else {
					$data['msg'] = $msg;
					$data['page'] = 'error_filetype';
					$this->load->view('template_admin', $data);
				}
			} else {
				/* Bread crum */
				$this->load->model('md_ref_json');
				$params = 'admin';
				$hasil = $this->md_ref_json->MDL_SelectMenu($params);
				$parentt = $hasil->parentt;
				$nm_menu = $hasil->custom_title;
				$url_menu = $hasil->url_menu;
				$path_icon = $hasil->icon_parent;
				$this->breadcrumbs->add($nm_menu, base_url().$url_menu, $path_icon);
				$this->breadcrumbs->add('Profile', base_url().'profile');
				$this->breadcrumbs->add('Education Update', base_url());
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
				$hasil = $this->md_profile->MDL_SelectID($id,'education');
				$data['id'] = $hasil->id;
				$data['emp_id'] = $hasil->emp_id;
				$data['education_lvl'] = $hasil->education_lvl;
				$data['startdate'] = $hasil->startdate;
				$data['enddate'] = $hasil->enddate;
				$data['faculty'] = $hasil->faculty;
				$data['institution'] = $hasil->institution;
				$data['country'] = $hasil->country;
				$data['province'] = $hasil->province;
				$data['city'] = $hasil->city;
				$data['major'] = $hasil->major;
				$data['gpa'] = $hasil->gpa;
				$data['certificate'] = $hasil->certificate;
				$data['certificate_date'] = ($hasil->certificate_date=="0000-00-00") ? "" : $hasil->certificate_date;
				$data['certificate_num'] = $hasil->certificate_num;
				$data['certificate_file'] = $hasil->certificate_file;
				$data['is_default'] = $hasil->is_default;
				
				/* $AryStatus = $this->CTRL_Option_EquipStatus();
				$data['option_status'] = $AryStatus; */
				$Aryeducation_lvl = $this->CTRL_Option_EducationLevel();
				$data['option_education_lvl'] = $Aryeducation_lvl;
				
				$Aryfaculty = $this->CTRL_Option_Faculty();
				$data['option_faculty'] = $Aryfaculty;
				
				$Aryinstitution = $this->CTRL_Option_Institution();
				$data['option_institution'] = $Aryinstitution;
				
				$data['title_head'] = sprintf("Education - Update");
				
				$data['url'] = 'profile/CTRL_Edit_Education/'.$hasil->emp_id.'/'.$hasil->id;
				$data['url_del'] = 'profile/CTRL_Delete_Education/'.$hasil->emp_id;
				$data['page'] = 'Profile/form_edit_education';
				$data['plugin'] = 'Profile/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }
	
	//TRAINING
	public function CTRL_New_Training($id) {
		$id = $this->session->userdata('userid');
		if($this->auth->Auth_restrict()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isRecID($id,$this->tblName,$this->field)) {
			redirect("manage_user/CTRL_Edit/" . $id);
		} else {
			if ($this->input->post('close')) {
				redirect('profile');
			} elseif ($this->input->post('submit')) {
				$this->md_profile->MDL_Insert_Training();
				redirect('profile');
			} else {
				/* Bread crum */
				$this->load->model('md_ref_json');
				$params = 'admin';
				$hasil = $this->md_ref_json->MDL_SelectMenu($params);
				$parentt = $hasil->parentt;
				$nm_menu = $hasil->custom_title;
				$url_menu = $hasil->url_menu;
				$path_icon = $hasil->icon_parent;
				$this->breadcrumbs->add($nm_menu, base_url().$url_menu, $path_icon);
				$this->breadcrumbs->add('Profile', base_url().'profile');
				$this->breadcrumbs->add('Training Add New', base_url());
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
				$AryCurrency = $this->CTRL_Option_Currency();
				$data['currency'] = '';
				$data['option_currency'] = $AryCurrency;
				$data['id'] = $id;
				
				$data['title_head'] = sprintf("Training - Add New");
				
				$data['url'] = 'profile/CTRL_New_Training/'.$id;
				$data['page'] = 'Profile/form_training';
				$data['plugin'] = 'Profile/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }
	
	public function CTRL_Edit_Training($empid, $id) {
		$empid = $this->session->userdata('userid');
		if($this->auth->Auth_restrict()) {
			$this->load->view('error_akses');
		} elseif(!$this->auth->Auth_isRecID($empid,$this->tblName,$this->field)) {
			redirect("manage_user/CTRL_Edit/" . $id);
		} elseif(!$this->auth->Auth_isRecID($id,$this->config->item('tmst_emp_training'),'id')) {
			$data['id'] = $id;
			$data['page'] = 'error_invalidID';
			$this->load->view('template_admin', $data);
		} else {
			if ($this->input->post('close')) {
				redirect('profile');
			} elseif ($this->input->post('submit')) {
				$this->md_profile->MDL_Update_Training($id);
				redirect('profile');
			} else {
				/* Bread crum */
				$this->load->model('md_ref_json');
				$params = 'admin';
				$hasil = $this->md_ref_json->MDL_SelectMenu($params);
				$parentt = $hasil->parentt;
				$nm_menu = $hasil->custom_title;
				$url_menu = $hasil->url_menu;
				$path_icon = $hasil->icon_parent;
				$this->breadcrumbs->add($nm_menu, base_url().$url_menu, $path_icon);
				$this->breadcrumbs->add('Profile', base_url().'profile');
				$this->breadcrumbs->add('Training Update', base_url());
				$breadcrum = $this->breadcrumbs->output();
				$data['breadcrum'] = $breadcrum;
				/* end */
				
				$hasil = $this->md_profile->MDL_SelectID($id,'training');
				$data['id'] = $hasil->id;
				$data['emp_id'] = $hasil->emp_id;
				$data['subject'] = $hasil->subject;
				$data['startdate'] = $hasil->startdate;
				$data['enddate'] = $hasil->enddate;
				$data['topic'] = $hasil->topic;
				$data['type'] = $hasil->type;
				$data['fee'] = number_format($hasil->fee,0,".",",");
				$data['currency'] = $hasil->currency;
				$data['trainer'] = $hasil->trainer;
				$data['provider'] = $hasil->provider;
				$data['certificate_num'] = $hasil->certificate_num;
				$data['passed'] = $hasil->passed;
				
				$AryCurrency = $this->CTRL_Option_Currency();
				$data['option_currency'] = $AryCurrency;
				
				$data['title_head'] = sprintf("Training - Update");
				
				$data['url'] = 'profile/CTRL_Edit_Training/'.$hasil->emp_id.'/'.$hasil->id;
				$data['url_del'] = 'profile/CTRL_Delete_Training/'.$hasil->emp_id;
				$data['page'] = 'Profile/form_edit_training';
				$data['plugin'] = 'Profile/plugin';
				$this->load->view('template_admin', $data);
			}
		}
    }
	
	public function CTRL_CekField($field,$id='') {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} else {
			$result = $this->md_profile->MDL_CekField($field,$id);
			echo json_encode($result);
		}
    }
	
	public function CTRL_CekField_PWD() {
		if($this->auth->Auth_restrict()) {
			$this->load->view('error_akses');
		} else {
			$result = $this->md_profile->MDL_CekField_PWD();
			echo json_encode($result);
		}
    }
	
	public function CTRL_Option_Gender() {
		$this->load->model('md_ref_json');
		$AryProfile = $this->md_ref_json->MDL_Select_MasterType('GENDER');
		$option[''] = 'Choose a Gender...';
		foreach($AryProfile as $row) {
			$option[$row->id] = $row->name;
		}

		return $option;
	}
	
	public function CTRL_Option_Currency() {
		$this->load->model('md_ref_json');
		$AryCurrency = $this->md_ref_json->MDL_Select_MasterType('CURRENCY');
		//$option[''] = 'Choose a Currency...';
		foreach($AryCurrency as $row) {
			$option[$row->id] = $row->name;
		}
		return $option;
	}
	
	public function CTRL_Option_Position() {
		$this->load->model('md_ref_json');
		$AryPosition = $this->md_ref_json->MDL_Select_MasterType('POSITION');
		$option[''] = 'Choose a Position...';
		foreach($AryPosition as $row) {
			$option[$row->id] = $row->name;
		}
		return $option;
	}
	
	public function CTRL_Option_Branch() {
		$this->load->model('md_branch');
		$AryBranch = $this->md_branch->MDL_Select();
		$option[''] = 'Choose a Branch...';
		foreach($AryBranch as $row) {
			$option[$row->id] = $row->branch;
		}
		return $option;
	}
	
	public function CTRL_Select_Group() {
		$this->load->model('md_manage_group');
		$AryGroup = $this->md_manage_group->MDL_Select();
		$option = array();
		$option[''] = 'Choose a Role...';
		if(isset($AryGroup)) {
			foreach($AryGroup as $row) {
				$option[$row->id] = $row->nama;
			}
		}
		return $option;
	}
	
	public function CTRL_Option_EducationLevel() {
		$this->load->model('md_ref_json');
		$Aryeducation_lvl = $this->md_ref_json->MDL_Select_MasterType('EDUCATION_LEVEL');
		$option[''] = 'Choose a Education Level...';
		foreach($Aryeducation_lvl as $row) {
			$option[$row->id] = $row->name;
		}
		return $option;
	}
	
	public function CTRL_Option_Faculty() {
		$this->load->model('md_ref_json');
		$Aryfaculty = $this->md_ref_json->MDL_Select_MasterType('FACULTY');
		$option[''] = 'Choose a faculty...';
		foreach($Aryfaculty as $row) {
			$option[$row->id] = $row->name;
		}
		return $option;
	}
	
	public function CTRL_Option_Institution() {
		$this->load->model('md_ref_json');
		$Aryinstitution = $this->md_ref_json->MDL_Select_MasterType('INSTITUTION');
		$option[''] = 'Choose a Institution...';
		foreach($Aryinstitution as $row) {
			$option[$row->id] = $row->name;
		}
		return $option;
	}

}
