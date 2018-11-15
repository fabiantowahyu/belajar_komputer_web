<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller {
	private $tblName;
	private $field;

	public function __construct() {
		parent::__construct();
		$this->load->model('md_personal');
		$this->tblName = $this->config->item('tmst_employee');
		$this->field = 'emp_id';
	}

	public function index()	{
		$id = $this->session->userdata('userid');
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
						
			$hasil = $this->md_personal->MDL_SelectID_Personal($id);
			
			if ($hasil->end_date =='0000-00-00'){
				$endate = "-";
			}
			else
			{
				$endate = date("d F Y",strtotime($hasil->end_date));
			}
				
			
			$data['id'] = $hasil->emp_id;
			$data['first_name'] = $hasil->first_name;
			$data['middle_name'] = $hasil->middle_name;
			$data['last_name'] = $hasil->last_name;
			$data['position_name'] = $hasil->position_name;
			$data['gender'] = $hasil->gender;
			$data['branch'] = $hasil->branch;
			$data['grade_code'] = $hasil->grade_code;
			$data['cost_center'] = $hasil->costcenter_name;
			$data['join_date'] = date("d F Y",strtotime($hasil->join_date));
			$data['end_date'] = $endate;
			$data['id_number'] = $hasil->id_number;
			$data['id_expireddate'] = date("d F Y",strtotime($hasil->id_expireddate));
			$data['birth_place'] = $hasil->birth_place;
			$data['birth_date'] = date("d F Y",strtotime($hasil->birth_date));
			$data['marital_status'] = $hasil->marital_status;
			$data['marital_date'] = date("d F Y",strtotime($hasil->marital_date));
			$data['religion'] = $hasil->religion;
			$data['marital_place'] = $hasil->marital_place;
			$data['email'] = $hasil->email;
			$data['employment_status'] = $hasil->employmentstatus_name;
			
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
			
			$file_signature = $hasil->signature;
			if(strlen($file_signature)) {
				$ary = @explode(".",$file_signature);
				$type = $ary[count($ary)-1];
				$data['file_signature'] = sprintf("file_upload/signature/%s.%s",$id,$type);
				$data['filesignature'] = sprintf("%s",$file_signature);
			} else {
				$data['file_signature'] = sprintf("file_upload/signature/no_photo.jpg");
				$data['filesignature'] = sprintf("no_photo.jpg");
			}
			
			//Address and Phone Information
			$hasil_address = $this->md_personal->MDL_SelectID_Address($id);
			
			$data['address1']  = $hasil_address->address1;
			$data['address2']  = $hasil_address->address2;
			$data['country1']  = $hasil_address->country1;
			$data['province1'] = $hasil_address->province1;
			$data['country2']  = $hasil_address->country2;
			$data['province2'] = $hasil_address->province2;
			$data['rt1'] 	   = $hasil_address->rt1;
			$data['rw1'] 	   = $hasil_address->rw1;
			$data['rt2'] 	   = $hasil_address->rt2;
			$data['rw2'] 	   = $hasil_address->rw2;
			$data['postal_code1'] = $hasil_address->postal_code1;
			$data['postal_code2'] = $hasil_address->postal_code2;
			$data['phone1']		  = $hasil_address->phone1;
			$data['phone2'] 	  = $hasil_address->phone2;
			$data['mobilephone1'] = $hasil_address->mobile_phone1;
			$data['mobilephone2'] = $hasil_address->mobile_phone2;
			
			//View
			$data['results_education'] 	= $this->md_personal->MDL_Select_Education($id);
			$data['results_training'] 	= $this->md_personal->MDL_Select_Training($id);
			$data['results_family'] 	= $this->md_personal->MDL_Select_Family($id);
			$data['results_bank'] 		= $this->md_personal->MDL_Select_Bank($id);
			$data['results_award'] 		= $this->md_personal->MDL_Select_Award($id);
			$data['results_disciplines']= $this->md_personal->MDL_Select_Disciplines($id);
			
			$nm_title = $this->auth->Auth_getNameMenu();
			$data['title'] = sprintf("%s",$nm_title);
			$data['url'] = 'Personal Info';
			$data['page'] = 'personal/form_edit';
			$data['plugin'] = 'personal/plugin';
			$this->load->view('template_admin', $data);
		}
	}

	public function CTRL_CekField($field,$id='') {
		if(!$this->auth->Auth_isPerm()) {
			$this->load->view('error_akses');
		} else {
			$result = $this->md_employee->MDL_CekField($field,$id);
			echo json_encode($result);
		}
    }
	
	public function CTRL_Option_Gender() {
		$this->load->model('md_ref_json');
		$AryEmployee = $this->md_ref_json->MDL_Select_MasterType('GENDER');
		$option[''] = 'Choose a Gender...';
		foreach($AryEmployee as $row) {
			$option[$row->id] = $row->name;
		}

		return $option;
	}
	
	public function CTRL_Option_MaritalStatus() {
		$this->load->model('md_ref_json');
		$AryEmployee = $this->md_ref_json->MDL_Select_MasterType('MARITALSTATUS');
		$option[''] = 'Choose a Marital Status...';
		foreach($AryEmployee as $row) {
			$option[$row->id] = $row->name;
		}

		return $option;
	}
	
	public function CTRL_Option_Religion() {
		$this->load->model('md_ref_json');
		$AryReligion = $this->md_ref_json->MDL_Select_MasterType('RELIGION');
		$option[''] = 'Choose a Religion...';
		foreach($AryReligion as $row) {
			$option[$row->id] = $row->name;
		}

		return $option;
	}
	
	public function CTRL_Option_Relationship() {
		$this->load->model('md_ref_json');
		$AryRelationship = $this->md_ref_json->MDL_Select_MasterType('RELATIONSHIP');
		$option[''] = 'Choose a Relationship...';
		foreach($AryRelationship as $row) {
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
	
	public function CTRL_Option_TrainingType() {
		$this->load->model('md_ref_json');
		$AryTrainingType = $this->md_ref_json->MDL_Select_MasterType('TRAINING_TYPE');
		foreach($AryTrainingType as $row) {
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
		$option[''] = 'Choose a Worklocation...';
		foreach($AryBranch as $row) {
			$option[$row->id] = $row->branch;
		}
		return $option;
	}
	
	public function CTRL_Option_Country() {
		$this->load->model('md_country');
		$AryCountry = $this->md_country->MDL_Select();
		$option[''] = 'Choose a Country...';
		foreach($AryCountry as $row) {
			$option[$row->country_code] = $row->country_name;
		}
		return $option;
	}
	
	public function CTRL_Option_Province() {
		$this->load->model('md_province');
		$AryProvince = $this->md_province->MDL_Select();
		$option[''] = 'Choose a Province...';
		foreach($AryProvince as $row) {
			$option[$row->province_code] = $row->province_name;
		}
		return $option;
	}
	
	public function CTRL_Option_Country2() {
		$this->load->model('md_country');
		$AryCountry2 = $this->md_country->MDL_Select();
		$option[''] = 'Choose a Country...';
		foreach($AryCountry2 as $row) {
			$option[$row->country_code] = $row->country_name;
		}
		return $option;
	}
	
	public function CTRL_Option_Province2() {
		$this->load->model('md_province');
		$AryProvince2 = $this->md_province->MDL_Select();
		$option[''] = 'Choose a Province...';
		foreach($AryProvince2 as $row) {
			$option[$row->province_code] = $row->province_name;
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
	
	public function CTRL_Option_Grade() {
		$this->load->model('md_job_grade');
		$AryData = $this->md_job_grade->MDL_Select();
		$option[''] = 'Choose a Grade...';
		foreach($AryData as $row) {
			$option[$row->id] = $row->grade_name;
		}
		return $option;
	}

}
