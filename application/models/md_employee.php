<?php
class Md_employee extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tblemployee = $this->config->item('tmst_employee');
		$tbltypevar = $this->config->item('tmst_typevar');
		$tblbranch = $this->config->item('tmst_branch');
		$tbl_position = $this->config->item('tmst_position');
		
		$hasil = array();
		
		$sSQL = "
			SELECT e.emp_id, CONCAT(e.first_name,' ',e.middle_name,' ',e.last_name) as emp_name, e.username, e.position_id, t.nm_type AS gender,
				   f.position_name, e.hp, e.join_date, e.branch_id, c.branch
			FROM $tbl_position f,$tblemployee e
				LEFT JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'GENDER') t ON t.id = e.gender
				LEFT JOIN $tblbranch c ON c.id = e.branch_id
			WHERE 1=1 
				AND f.position_id = e.position_id
			ORDER BY e.emp_id
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_SelectByID($emp_id) {
		$tblemployee = $this->config->item('tmst_employee');
		$tbltypevar = $this->config->item('tmst_typevar');
		$tblbranch = $this->config->item('tmst_branch');
		$tbl_position = $this->config->item('tmst_position');
		
		$hasil = array();
		
		$sSQL = "
			SELECT e.emp_id, CONCAT(e.first_name,' ',e.middle_name,' ',e.last_name) as emp_name, e.username, e.position_id, t.nm_type AS gender, e.grade_id,
				   f.position_name, e.hp, e.join_date, e.branch_id, c.branch, e.email
			FROM $tbl_position f,$tblemployee e
				LEFT JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'GENDER') t ON t.id = e.gender
				LEFT JOIN $tblbranch c ON c.id = e.branch_id
			WHERE 1=1 
				AND f.position_id = e.position_id
				AND e.emp_id = '$emp_id'
			ORDER BY e.emp_id
		";
		
		$hasil = $this->db->query($sSQL)->row();
		//$hasil = reset($ambil->result());
		return $hasil;	
	}

	public function MDL_Select_Position() {
		$tbl_position = $this->config->item('tmst_position');
		
		$hasil = array();
		
		$sSQL = "
			SELECT position_id,position_name
			FROM $tbl_position
			WHERE 1=1 
				AND position_flag ='3'
				AND POSITION_ACTIVE ='1'
			order by position_name ASC
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_Get_Position($id) {
		$tbl_position = $this->config->item('tmst_position');
		
		$hasil = array();
		
		$sSQL = "
			SELECT position_id,position_code,position_name
			FROM $tbl_position
			WHERE 1=1 
				AND position_flag ='3'
				AND position_active ='1'
				AND (position_parentpath like '%,$id,%' OR position_parentpath like '%,$id' OR position_parentpath like '$id,%')
			order by position_name ASC
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	public function MDL_Select_Address($id) {
		$tblemployee = $this->config->item('tmst_employee');
		$tbladdress  = $this->config->item('tmst_address');
		$tblcountry  = $this->config->item('tmst_country');
		$tblprovince = $this->config->item('tmst_province');

		$sSQL = "
			SELECT b.address1,b.country1,b.province1,b.rt1,b.rw1,b.phone1,b.postal_code1,b.address2,b.country2,b.province2,b.rt2,b.rw2,b.phone2,b.postal_code2,
					b.mobile_phone1,b.mobile_phone2
			FROM $tblemployee a, $tbladdress b
			WHERE 1=1 
			AND a.emp_id = b.emp_id
			AND a.emp_id ='$id'
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_Select_Education($id) {
		$tblemp_education = $this->config->item('tmst_emp_education');
		$tbltypevar = $this->config->item('tmst_typevar');

		$hasil = array();
				
		$sSQL = "
			SELECT e.id, e.education_lvl, e.startdate, e.enddate, a.nm_type AS faculty_name, b.nm_type AS institution_name,
			c.nm_type AS education_lvl,e.education_lvl as edu_levelid,e.faculty,e.institution,e.country,e.province,e.city,e.major,e.gpa,e.is_default
			FROM $tblemp_education e
			JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'FACULTY') a ON a.id = e.faculty
			JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'INSTITUTION') b ON b.id = e.institution
			JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'EDUCATION_LEVEL') c ON c.id = e.education_lvl
			WHERE 1=1 
				AND e.emp_id = '$id'
			ORDER BY e.id
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$data->startdate = date("d M Y",strtotime($data->startdate));
				$data->enddate = date("d M Y",strtotime($data->enddate));
				//Untuk ESS
				$data->startdate_edu = date("Y-m-d",strtotime($data->startdate));
				$data->enddate_edu = date("Y-m-d",strtotime($data->enddate));
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_Select_Training($id) {
		$tblemp_training = $this->config->item('tmst_emp_training');
		$tbltypevar = $this->config->item('tmst_typevar');

		$hasil = array();
		
		$sSQL = "
			SELECT e.id, e.subject, e.startdate, e.enddate, e.topic, a.nm_type as type
			FROM $tblemp_training e
			JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'TRAINING_TYPE') a ON a.id = e.type
			WHERE 1=1 
				AND e.emp_id = '$id'
			ORDER BY e.id
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$data->startdate = date("d M Y",strtotime($data->startdate));
				$data->enddate = date("d M Y",strtotime($data->enddate));
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_Select_Family($emp_id) {
		$tblemp_family	= $this->config->item('tmst_emp_family');
		$tbl_employee  	= $this->config->item('tmst_employee');
		$tbltypevar 	= $this->config->item('tmst_typevar');

		$hasil = array();
		
		$sSQL = "
			SELECT e.id,e.empfamily_name,e.family_birthplace,e.family_dob,e.alive_status,b.name as relationship,
			e.family_dependentsts,e.phone,e.family_relationship_id,e.family_gender,e.family_last_education
			FROM $tblemp_family e, $tbl_employee a, $tbltypevar b
			WHERE 1=1 
				AND e.emp_id = a.emp_id
				AND a.emp_id = '$emp_id'
				AND b.table_name = 'RELATIONSHIP'
				AND b.id = e.family_relationship_id
			ORDER BY e.id
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$data->family_dob = date("d M Y",strtotime($data->family_dob));
				if($data->family_dependentsts == 1) {$data->family_dependentsts ="Yes";} else {$data->family_dependentsts ="No";}
				if($data->alive_status == 1) {$data->alive_status ="Deceased";} else {$data->alive_status ="Alive status";}
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_Select_BankName($bank_group) {
		$tblbank = $this->config->item('tmst_bank');

		$hasil = array();
		
		$sSQL = "
			SELECT id,bank_code,bank_name,bank_address,bank_branch,bank_group
			FROM $tblbank 
			WHERE 1=1 
			AND bank_group ='$bank_group'
			ORDER BY id ASC
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	public function MDL_Select_Bank($emp_id) {
		$tbl_empbank	= $this->config->item('ttrs_empbank');
		$tbl_bank		= $this->config->item('tmst_bank');
		$tbl_employee  	= $this->config->item('tmst_employee');
		

		$hasil = array();
		
		$sSQL = "
			SELECT a.*,c.bank_name
			FROM $tbl_empbank a, $tbl_employee b, $tbl_bank c
			WHERE 1=1 
				AND a.emp_id = b.emp_id
				AND a.emp_id = '$emp_id'
				AND a.bank_code = c.bank_code
			ORDER BY a.id
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_Select_Award($emp_id) {
		$tbl_awardhistory = $this->config->item('ttrs_awardhistory');
		$tbl_employee  	  = $this->config->item('tmst_employee');
		$tbl_achievement  = $this->config->item('tmst_achievement');

		$hasil = array();
		
		$sSQL = "
			SELECT  a.id,a.reference_no,a.certificate_no,a.emp_id,a.achievement_id,a.date,a.remark,
					CONCAT(b.first_name,' ',b.middle_name,' ',b.last_name) as emp_name, c.achievement_name
			FROM $tbl_awardhistory a, $tbl_employee b, $tbl_achievement c
			WHERE 1=1
				AND a.emp_id = b.emp_id
				AND a.achievement_id = c.id
				AND a.emp_id = '$emp_id'
			ORDER BY id DESC
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$data->date = date("d M Y",strtotime($data->date));
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_Select_Disciplines($emp_id) {
		$tbl_disciplineshistory = $this->config->item('ttrs_disciplineshistory');
		$tblemployee 			= $this->config->item('tmst_employee');
		$tbl_disciplines 		= $this->config->item('tmst_disciplines');
		
		$hasil = array();
		
		$sSQL = "
			SELECT  a.id,a.reference_no,a.emp_id,a.disciplines_id,a.start_date,a.end_date,a.remark,
					CONCAT(b.first_name,' ',b.middle_name,' ',b.last_name) as emp_name, c.disciplines_name
			FROM $tbl_disciplineshistory a, $tblemployee b, $tbl_disciplines c
			WHERE 1=1
				AND a.emp_id = b.emp_id
				AND a.disciplines_id = c.id
				AND a.emp_id = '$emp_id'
			ORDER BY id DESC
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$data->start_date = date("d M Y",strtotime($data->start_date));
				$data->end_date   = date("d M Y",strtotime($data->end_date));
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_SelectID($id,$type=''){
		$tblemployee = $this->config->item('tmst_employee');
		$tblemp_education = $this->config->item('tmst_emp_education');
		$tblemp_training = $this->config->item('tmst_emp_training');
		$tblemp_family = $this->config->item('tmst_emp_family');
		$tblemp_bank = $this->config->item('ttrs_empbank');

		if($type == 'education') {
			$tblName = $tblemp_education;
			$field = 'id';
		} elseif($type == 'training') {
			$tblName = $tblemp_training;
			$field = 'id';
		} elseif($type == 'family') {
			$tblName = $tblemp_family;
			$field = 'id'; 
		} elseif($type == 'bank') {
			$tblName = $tblemp_bank;
			$field = 'id'; 
		} 
		else {
			$tblName = $tblemployee;
			$field = 'emp_id';
		}
		
        return $this->db->get_where($tblName, array($field => $id))->row();
    }
	
	// Fungsi Tambah Data
	public function MDL_Insert() {
		$filepath_avatar = $this->config->item('filepath_avatar');
		$filepath_signature = $this->config->item('filepath_signature');
		$tblemployee = $this->config->item('tmst_employee');
		$tbladdress = $this->config->item('tmst_address');
		$tbluser_group = $this->config->item('tmst_users_group');
		$tbluser = $this->config->item('tmst_users');

		//Konfigurasi Upload file
		$file_photo = '';
		$file_signature = '';
		$konfigurasi = array(
			'allowed_types' =>'jpg|jpeg|png|gif',
			'max_size' => 1200,
			'file_name' => $this->input->post('emp_id')
		);
		$this->load->library('upload', $konfigurasi);
		if(strlen($_FILES['userfile']['name'])) {
			$this->upload->set_upload_path($filepath_avatar);
			$res = $this->upload->do_upload('userfile');
			if($res) {
				$file_photo = $_FILES['userfile']['name'];
			} else {
				return array(false,$this->upload->display_errors());
			}
		}
		if(strlen($_FILES['signature']['name'])) {
			$this->upload->set_upload_path($filepath_signature);
			$res = $this->upload->do_upload('signature');
			if($res) {
				$file_signature = $_FILES['signature']['name'];
			} else {
				return array(false,$this->upload->display_errors());
			}
		}
		
		$emp_id = $this->input->post('emp_id');
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$last_name = $this->input->post('last_name');
		$position_id = $this->input->post('position');
		$birth_place = $this->input->post('birth_place');
		$birth_date = $this->input->post('birth_date');
                $religion = $this->input->post('religion');
		$marital_status = $this->input->post('marital_status');
		$marital_date = $this->input->post('marital_date');
		$marital_place = $this->input->post('marital_place');
		$gender = $this->input->post('gender');
		$grade_id = $this->input->post('grade_id');
		$join_date = $this->input->post('join_date');
		$branch_id = $this->input->post('branch_id');
		$email = $this->input->post('email');
		$status = $this->input->post('status');
		$address = $this->input->post('address');
		$country = $this->input->post('country');
		$province = $this->input->post('province');
		$phone = $this->input->post('phone');
		$hp = $this->input->post('hp');
		$post_code = $this->input->post('post_code');
		$end_date = $this->input->post('end_date');
		$company_id = $this->input->post('company');

		if(strlen($this->input->post('username'))) {
			$username = $this->input->post('username');
		} else {
			$username = '';
		}
		if(strlen($this->input->post('password'))) {
			$password = md5($this->input->post('password'));
		} else {
			$password = '';
		}
		if(strlen($this->input->post('role'))) {
			$role = $this->input->post('role');
		} else {
			$role = '';
		}
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'emp_id' => $emp_id,
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'position_id' => $position_id,
			'birth_place' => $birth_place,
			'birth_date' => $birth_date,
			'marital_status' => $marital_status,
			'marital_date' => $marital_date,
                        'religion' => $religion,
			'gender' => $gender,
			'grade_id' => $grade_id,
			'join_date' => $join_date,
			'end_date' => $end_date,
			'branch_id' => $branch_id,
			'status' => $status,
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'role' => $role,
			'company_id' => $company_id,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
		);

	
		if(strlen($_FILES['userfile']['name'])) {
			$data['photo'] = $file_photo;
		} 
		if(strlen($_FILES['signature']['name'])) {
			$data['signature'] = $file_signature;
		} 

		$res = $this->db->insert($tblemployee, $data);
		if($res) {
			//Insert User Group
			$data = array(
				'user_id' => $emp_id,
				'group_id' => $role,
				'recdate' => $recdate,
				'moduser' => $moduser,
				'moddate' => $moddate
			);
			$this->db->insert($tbluser_group, $data);
			
			//Insert Address and Phone Information
			$data = array(
				'emp_id' => $emp_id,
				'address1' => $address,
				'phone1' => $phone,
				'mobile_phone1' => $hp,
				'postal_code1' => $post_code,
				'recdate' => $recdate,
				'moduser' => $moduser,
				'moddate' => $moddate
			);
			$this->db->insert($tbladdress, $data);
			
		}
		return array(true,"");
	}

	public function MDL_Insert_Education() {
		$filepath_education = $this->config->item('filepath_education');
		$tblemp_education = $this->config->item('tmst_emp_education');

		$id = $this->MDL_nextuniqueid();
		//Konfigurasi Upload file
		$file_certificate = '';
		if(strlen($_FILES['file_certificate']['name'])) {
			$konfigurasi = array(
				'allowed_types' =>'jpg|jpeg|png|gif|pdf',
				'max_size' => 1200,
				'file_name' => $id
			);
			$this->load->library('upload', $konfigurasi);
			$this->upload->set_upload_path($filepath_education);
			$res = $this->upload->do_upload('file_certificate');
			if($res) {
				$file_certificate = $_FILES['file_certificate']['name'];
			} else {
				return array(false,$this->upload->display_errors());
			}
		}

		$emp_id = $this->input->post('emp_id');
		$education_lvl = $this->input->post('education_lvl');
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$faculty = $this->input->post('faculty');
		$institution = $this->input->post('institution');
		$country = $this->input->post('country');
		$province = $this->input->post('province');
		$city = $this->input->post('city');
		$major = $this->input->post('major');
		$gpa = $this->input->post('gpa');
		$is_default = $this->input->post('is_default');
		$certificate = $this->input->post('certificate');
		$certificate_num = $this->input->post('certificate_num');
		$certificate_date = $this->input->post('certificate_date');
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'id' => $id,
			'emp_id' => $emp_id,
			'education_lvl' => $education_lvl,
			'startdate' => $startdate,
			'enddate' => $enddate,
			'faculty' => $faculty,
			'institution' => $institution,
			'country' => $country,
			'province' => $province,
			'city' => $city,
			'major' => $major,
			'gpa' => $gpa,
			'certificate' => $certificate,
			'is_default' => $is_default,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
		if($certificate) {
			$data['certificate_num'] = $certificate_num;
			$data['certificate_date'] = $certificate_date;
			$data['certificate_file'] = $file_certificate;
		}

		$this->db->insert($tblemp_education, $data);
		return array(true,"");
	}
	
	public function MDL_Insert_Training() {
		$tblemp_training = $this->config->item('tmst_emp_training');

		$id = $this->MDL_nextuniqueid();
		$emp_id = $this->input->post('emp_id');
		$subject = $this->input->post('subject');
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$topic = $this->input->post('topic');
		$type = $this->input->post('type');
		$fee = $this->input->post('fee');
		$fee = str_replace(",","",$fee);
		$currency = $this->input->post('currency');
		$trainer = $this->input->post('trainer');
		$provider = $this->input->post('provider');
		$certificate_num = $this->input->post('certificate_num');
		$passed = $this->input->post('passed');
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'id' => $id,
			'emp_id' => $emp_id,
			'subject' => $subject,
			'startdate' => $startdate,
			'enddate' => $enddate,
			'topic' => $topic,
			'type' => $type,
			'fee' => $fee,
			'currency' => $currency,
			'trainer' => $trainer,
			'provider' => $provider,
			'certificate_num' => $certificate_num,
			'passed' => $passed,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
		$this->db->insert($tblemp_training, $data);
	}
	
	public function MDL_Insert_Family($emp_id) {
		$tblemp_family = $this->config->item('tmst_emp_family');
		$filepath_family = $this->config->item('filepath_family');
		
		$id = $this->MDL_nextuniqueid();
			
		//Konfigurasi Upload file
		$file_name = '';
		if(strlen($_FILES['userfile']['name'])) {
			$konfigurasi = array(
				'allowed_types' =>'jpg|jpeg|png|gif|pdf',
				'max_size' => 3000,
				'upload_path' => $filepath_family,
				'file_name' => $id
			);

			$this->load->library('upload', $konfigurasi);
			$res = $this->upload->do_upload();
			if($res) {
				$file_name = $_FILES['userfile']['name'];
				$ary = @explode("/",$_FILES['userfile']['type']);
				$file_type = $ary[count($ary)-1];
			} else {
				return array(false,$this->upload->display_errors());
			}
		}

		$empfamily_name = $this->input->post('emp_family');
		$family_relationship_id = $this->input->post('relationship');
		$family_birthplace = $this->input->post('birth_place');
		$family_dob = $this->input->post('date_birth');
		$family_dependentsts = $this->input->post('is_dependent');
		$family_gender = $this->input->post('gender');
		$alive_status = $this->input->post('family_status');
		$family_last_education = $this->input->post('education_lvl');
		$family_phone = $this->input->post('phone');
		
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");

		$data = array(
			'id' => $id,
			'emp_id' => $emp_id,
			'empfamily_name' => $empfamily_name,
			'family_relationship_id' => $family_relationship_id,
			'family_birthplace' => $family_birthplace,
			'family_dob' => $family_dob,
			'family_dependentsts' => $family_dependentsts,
			'family_gender' => $family_gender,
			'alive_status' => $alive_status,
			'family_last_education' => $family_last_education,
			'phone' => $family_phone,
			'file_family' => $file_name,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
		$this->db->insert($tblemp_family, $data);
	}
	
	public function MDL_Insert_Bank($emp_id) {
		$tblempbank = $this->config->item('ttrs_empbank');
		
		$bank_group		= $this->input->post('bank_group');
		$bank_name		= $this->input->post('bank_name');
		$bank_account 	= $this->input->post('bank_account');
		$account_name 	= $this->input->post('account_name');
		$saving_type 	= $this->input->post('saving_type');
		$bank_branch 	= $this->input->post('bank_branch');
		$currency_id 	= $this->input->post('currency');
		$isdefault 		= $this->input->post('isdefault');
		
		$userid  = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'emp_id' => $emp_id,
			'bank_group' => $bank_group,
			'bank_code'	 => $bank_name,
			'bank_account' => $bank_account,
			'account_name' => $account_name,
			'saving_type' => $saving_type,
			'bank_branch' => $bank_branch,
			'currency_id' => $currency_id,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
		$this->db->insert($tblempbank, $data);
		
	}
	
	public function MDL_Update_Bank($id) {
		$tblempbank = $this->config->item('ttrs_empbank');
		
		$bank_group		= $this->input->post('bank_group');
		$bank_name		= $this->input->post('bank_name');
		$bank_account 	= $this->input->post('bank_account');
		$account_name 	= $this->input->post('account_name');
		$saving_type 	= $this->input->post('saving_type');
		$bank_branch 	= $this->input->post('bank_branch');
		$currency_id 	= $this->input->post('currency');
		$isdefault 		= $this->input->post('isdefault');
		
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'bank_group' => $bank_group,
			'bank_code'	 => $bank_name,
			'bank_account' => $bank_account,
			'account_name' => $account_name,
			'saving_type' => $saving_type,
			'bank_branch' => $bank_branch,
			'currency_id' => $currency_id,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
		$this->db->where('emp_id', $id);
		$this->db->update($tblempbank, $data);
	}
	
	public function MDL_Update($id){
		$tblemployee = $this->config->item('tmst_employee');
		
		$emp_id = $this->input->post('emp_id');
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$last_name = $this->input->post('last_name');
		$position_id = $this->input->post('position_id');
		$gender = $this->input->post('gender');
		$grade_id = $this->input->post('grade_id');
		$join_date = $this->input->post('join_date');
		$branch_id = $this->input->post('branch_id');
		$id_number = $this->input->post('id_number');
		$id_expireddate = $this->input->post('id_expireddate');
		$birth_place = $this->input->post('birth_place');
		$birth_date = $this->input->post('birth_date');
		$marital_status = $this->input->post('marital_status');
		$marital_date = $this->input->post('marital_date');
		$marital_place = $this->input->post('marital_place');
		$religion = $this->input->post('religion');
		$email = $this->input->post('email');
		$emp_status = $this->input->post('emp_status');
		$end_date = $this->input->post('end_date');
		$cost_center = $this->input->post('cost_center');
				
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'email' => $email,
			'position_id' => $position_id,
			'gender' => $gender,
			'grade_id' => $grade_id,
			'cost_center' => $cost_center,
			'join_date' => $join_date,
			'end_date' => $end_date,
			'branch_id' => $branch_id,
			'birth_place' => $birth_place,
			'birth_date' => $birth_date,
			'marital_status' => $marital_status,
			'marital_date' => $marital_date,
			'religion' => $religion,
			'id_number' => $id_number,
			'id_expireddate' => $id_expireddate,
			'marital_place' => $marital_place,
			'emp_status' => $emp_status,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
        $this->db->where('emp_id', $id);
		$this->db->update($tblemployee, $data);
    }
	
	public function MDL_Update_Address($id){
		$tbladdress = $this->config->item('tmst_address');
		
		$address1 	= $this->input->post('address');
		$country1 	= $this->input->post('country');
		$province1 	= $this->input->post('province');
		$rt1		= $this->input->post('rt');
		$rw1 		= $this->input->post('rw');
		$postalcode1= $this->input->post('postalcode');
		$phone1		= $this->input->post('phone');
		
		$address2 	= $this->input->post('address2');
		$country2 	= $this->input->post('country2');
		$province2 	= $this->input->post('province2');
		$rt2 		= $this->input->post('rt2');
		$rw2 		= $this->input->post('rw2');
		$postalcode2= $this->input->post('postalcode2');
		$phone2		= $this->input->post('phone2');
		$mobile_phone1 = $this->input->post('mobilephone1');
		$mobile_phone2 = $this->input->post('mobilephone2');
		
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'address1' 		=> $address1,
			'country1' 		=> $country1,
			'province1' 	=> $province1,
			'rt1' 			=> $rt1,
			'rw1' 			=> $rw1,
			'postal_code1' 	=> $postalcode1,
			'phone1' 		=> $phone1,
			'address2' 		=> $address2,
			'country2' 		=> $country2,
			'province2' 	=> $province2,
			'rt2' 			=> $rt2,
			'rw2' 			=> $rw2,
			'postal_code2' 	=> $postalcode2,
			'phone2' 		=> $phone2,
			'mobile_phone1' => $mobile_phone1,
			'mobile_phone2' => $mobile_phone2,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
        $this->db->where('emp_id', $id);
		$this->db->update($tbladdress, $data);
	}
	public function MDL_Update_Education($id) {
		$tblemp_education = $this->config->item('tmst_emp_education');

		//Konfigurasi Upload file
		$file_certificate = '';
		/*
		$konfigurasi = array(
			'allowed_types' =>'jpg|jpeg|png|gif|pdf',
			'max_size' => 1200,
			'file_name' => $this->input->post('id')
		);
		$this->load->library('upload', $konfigurasi);
		if(strlen($_FILES['file_certificate']['name'])) {
			$this->upload->set_upload_path($filepath_education);
			$res = $this->upload->do_upload('file_certificate');
			if($res) {
				$file_certificate = $_FILES['file_certificate']['name'];
			} else {
				return array(false,$this->upload->display_errors());
			}
		}
		*/
	
		$emp_id = $this->input->post('emp_id');
		$education_lvl = $this->input->post('education_lvl');
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$faculty = $this->input->post('faculty');
		$institution = $this->input->post('institution');
		$country = $this->input->post('country');
		$province = $this->input->post('province');
		$city = $this->input->post('city');
		$major = $this->input->post('major');
		$gpa = $this->input->post('gpa');
		$is_default = $this->input->post('is_default');
		$certificate = $this->input->post('certificate');
		$certificate_num = $this->input->post('certificate_num');
		$certificate_date = $this->input->post('certificate_date');
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'emp_id' => $emp_id,
			'education_lvl' => $education_lvl,
			'startdate' => $startdate,
			'enddate' => $enddate,
			'faculty' => $faculty,
			'institution' => $institution,
			'country' => $country,
			'province' => $province,
			'city' => $city,
			'major' => $major,
			'gpa' => $gpa,
			'certificate' => $certificate,
			'is_default' => $is_default,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
		if($certificate) {
			$data['certificate_num'] = $certificate_num;
			$data['certificate_date'] = $certificate_date;
			$data['certificate_file'] = $file_certificate;
		}

		$this->db->where('id', $id);
		$this->db->update($tblemp_education, $data);
		return array(true,"");
	}
	
	public function MDL_Update_Family($id) {
		$tblemp_family = $this->config->item('tmst_emp_family');
		$filepath_family = $this->config->item('filepath_family');
		$separator = $this->config->item('separator');
		
		$empfamily_name = $this->input->post('emp_family');
		$family_relationship_id = $this->input->post('relationship');
		$family_birthplace = $this->input->post('birth_place');
		$family_dob = $this->input->post('date_birth');
		$family_dependentsts = $this->input->post('is_dependent');
		$family_gender = $this->input->post('gender');
		$alive_status = $this->input->post('family_status');
		$family_last_education = $this->input->post('education_lvl');
		$family_phone = $this->input->post('phone');
		
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'empfamily_name' => $empfamily_name,
			'family_relationship_id' => $family_relationship_id,
			'family_birthplace' => $family_birthplace,
			'family_dob' => $family_dob,
			'family_dependentsts' => $family_dependentsts,
			'family_gender' => $family_gender,
			'alive_status' => $alive_status,
			'family_last_education' => $family_last_education,
			'phone' => $family_phone,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
		$this->db->where('id', $id);
		$this->db->update($tblemp_family, $data);
		
			
		//Konfigurasi Upload file
		if(strlen($_FILES['userfile']['name'])) {
			
			//===== START Delete File yang lama
			$hasil = $this->MDL_SelectID($id,'family');
			$file_name = $hasil->file_family;
			
			$ary = @explode(".",$file_name);
			$type = $ary[count($ary)-1];
			$file = sprintf("%s%s%s.%s",$filepath_family,$separator,$id,$type);
			if(file_exists($file)) {
				unlink($file);
			}
			//===== END =====
			
			$konfigurasi = array(
				'allowed_types' =>'jpg|jpeg|png|gif|pdf',
				'max_size' => 3000,
				'upload_path' => $filepath_family,
				'file_name' => $id
			);

			$this->load->library('upload', $konfigurasi);
			$res = $this->upload->do_upload();
			if($res) {
				$file_name = $_FILES['userfile']['name'];
				$ary = @explode("/",$_FILES['userfile']['type']);
				$file_type = $ary[count($ary)-1];
				
				$data = array(
					'file_family' => $file_name
				);

				$this->db->where('id', $id);
				$this->db->update($tblemp_family, $data);
				
			} else {
				return array(false,$this->upload->display_errors());
			}
		}
	}
	
	public function MDL_Update_Training($id) {
		$tblemp_training = $this->config->item('tmst_emp_training');

		$emp_id = $this->input->post('emp_id');
		$subject = $this->input->post('subject');
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$topic = $this->input->post('topic');
		$type = $this->input->post('type');
		$fee = $this->input->post('fee');
		$fee = str_replace(",","",$fee);
		$currency = $this->input->post('currency');
		$trainer = $this->input->post('trainer');
		$provider = $this->input->post('provider');
		$certificate_num = $this->input->post('certificate_num');
		$passed = $this->input->post('passed');
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'emp_id' => $emp_id,
			'subject' => $subject,
			'startdate' => $startdate,
			'enddate' => $enddate,
			'topic' => $topic,
			'type' => $type,
			'fee' => $fee,
			'currency' => $currency,
			'trainer' => $trainer,
			'provider' => $provider,
			'certificate_num' => $certificate_num,
			'passed' => $passed,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		
		$this->db->where('id', $id);
		$this->db->update($tblemp_training, $data);
	}
	
	public function MDL_UpdateFoto($id) {
		$filepath_avatar = $this->config->item('filepath_avatar');
		$filepath_signature = $this->config->item('filepath_signature');
		$separator = $this->config->item('separator');
		$tblemployee = $this->config->item('tmst_employee');

		$upload_type = $this->input->post('upload_type');

		//Konfigurasi Upload file
		if(strlen($_FILES['userfile']['name'])) {
			//===== START Delete File yang lama
			$hasil = $this->MDL_SelectID($id);

			if($upload_type=="Photo") {
				if (($hasil->photo) == "") {
					$file_name = $id;
				} else {
					$file_name = $hasil->photo;	
				}

				$filepath = $filepath_avatar;
				$field = 'photo';
			} else {
				$file_name = $hasil->signature;
				$filepath = $filepath_signature;
				$field = 'signature';
			}
			
			$ary = @explode(".",$file_name);

			$type = $ary[count($ary)-1];
			$file = sprintf("%s%s%s.%s",$filepath,$separator,$id,$type);
			if(file_exists($file)) {
				unlink($file);
			}
			//===== END
			
			$konfigurasi = array(
				'allowed_types' =>'jpg|jpeg|png|gif',
				'max_size' => 1000,
				'upload_path' => $filepath,
				'file_name' => $id
			);

			$this->load->library('upload', $konfigurasi);
			$res = $this->upload->do_upload();

			if($upload_type=="Photo") {
				$config['image_library'] = 'gd2';
				$config['source_image'] = $file;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 48;
				$config['height'] = 48;

				$this->load->library('image_lib', $config); 

				$this->image_lib->resize();
			}
			
			if($res) {
				$file_name = $_FILES['userfile']['name'];
				$file_type = $_FILES['userfile']['type'];
				
				$data = array(
					$field => $file_name
				);

				$this->db->where('emp_id', $id);
				$this->db->update($tblemployee, $data);
			} 
		} else {
			return array(false,"Upload failed, no file selected");
		}
	}

	public function MDL_UpdateCertificate($id) {
		$filepath_education = $this->config->item('filepath_education');
		$separator = $this->config->item('separator');
		$tblemp_education = $this->config->item('tmst_emp_education');

		//Konfigurasi Upload file
		if(strlen($_FILES['userfile']['name'])) {

			//===== START Delete File yang lama
			$hasil = $this->MDL_SelectID($id,'education');
			$file_name = $hasil->certificate_file;
			$ary = @explode(".",$file_name);
			$type = $ary[count($ary)-1];
			$file = sprintf("%s%s%s.%s",$filepath_education,$separator,$id,$type);
			if(file_exists($file)) {
				unlink($file);
			}
			//===== END
			
			$konfigurasi = array(
				'allowed_types' =>'jpg|jpeg|png|gif|pdf',
				'max_size' => 1000,
				'upload_path' => $filepath_education,
				'file_name' => $id
			);

			$this->load->library('upload', $konfigurasi);
			$res = $this->upload->do_upload();
			if($res) {

				$data = array(
					'certificate_file' => $_FILES['userfile']['name']
				);

				$this->db->where('id', $id);
				$this->db->update($tblemp_education, $data);
				
				return array(true,"");
			} 
		} else {
			return array(false,"Upload failed, no file selected");
		}
	}
	
	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$filepath_education = $this->config->item('filepath_education');
		$filepath_avatar = $this->config->item('filepath_avatar');
		$separator = $this->config->item('separator');
		$tblemployee = $this->config->item('tmst_employee');
		$tbladdress  = $this->config->item('tmst_address');
		$tblemp_education = $this->config->item('tmst_emp_education');
		$tblemp_training = $this->config->item('tmst_emp_training');
		$tbluser_group = $this->config->item('tmst_users_group');

		//===== START Delete File yang lama
		$hasil = $this->MDL_SelectID($id);
		$file_name = $hasil->photo;
		//$username = $hasil->username;
		$ary = @explode(".",$file_name);
		$type = $ary[count($ary)-1];
		$file = sprintf("%s%s%s.%s",$filepath_avatar,$separator,$id,$type);
		if(file_exists($file)) {
			unlink($file);
		}
		//===== END
		
		//DELETE FILE PROGRESS
		$sSQL = "
			SELECT id, certificate_file
			FROM $tblemp_education
			WHERE 1=1
				AND emp_id = '$id'
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				//===== START Delete File yang lama
				$aryDet = @explode(".",$data->certificate_file);
				$typeDet = $aryDet[count($aryDet)-1];
				$fileDet = sprintf("%s%s%s.%s",$filepath_education,$separator,$data->id,$typeDet);
				if(file_exists($fileDet)) {
					unlink($fileDet);
				}
				//===== END
			}
		}
		
		$this->db->delete($tblemp_education, array('emp_id' => $id));
		$this->db->delete($tblemp_training, array('emp_id' => $id));
		$this->db->delete($tbluser_group, array('user_id' => $id));
		$this->db->delete($tbladdress, array('emp_id' => $id));
		$this->db->delete($tblemployee, array('emp_id' => $id));
		
	}

	public function MDL_Delete_Education($id) {
		$filepath_education = $this->config->item('filepath_education');
		$separator = $this->config->item('separator');
		$tblemp_education = $this->config->item('tmst_emp_education');

		//===== START Delete File yang lama
		$hasil = $this->MDL_SelectID($id,'education');
		$file_name = $hasil->certificate_file;
		$ary = @explode(".",$file_name);
		$type = $ary[count($ary)-1];
		$file = sprintf("%s%s%s.%s",$filepath_education,$separator,$id,$type);
		if(file_exists($file)) {
			unlink($file);
		}
		//===== END
		
		$this->db->delete($tblemp_education, array('id' => $id));
	}
	
	public function MDL_Delete_Family($id) {
		$tblemp_family = $this->config->item('tmst_emp_family');
		$separator = $this->config->item('separator');
		$filepath_family = $this->config->item('filepath_family');
		
		//===== START Delete File yang lama
		$hasil = $this->MDL_SelectID($id,'family');
		$file_name = $hasil->file_family;
		
		$ary = @explode(".",$file_name);
		$type = $ary[count($ary)-1];
		$file = sprintf("%s%s%s.%s",$filepath_family,$separator,$id,$type);
		if(file_exists($file)) {
			unlink($file);
		}
		//===== END =====
		
		$this->db->delete($tblemp_family, array('id' => $id));
	}
	
	public function MDL_Delete_Bank($id) {
		$tblemp_bank = $this->config->item('ttrs_empbank');
		
		$this->db->delete($tblemp_bank, array('id' => $id));
	}
	
	public function MDL_Delete_Training($id) {
		$tblemp_training = $this->config->item('tmst_emp_training');
		
		$this->db->delete($tblemp_training, array('id' => $id));
	}
	
	// Fungsi Uniq ID
	public function MDL_nextuniqueid() {
		srand((double)microtime()*1000000);
		return sprintf("%s%06d",date("YmdHis"),rand(0, 999999));
	}
	
	public function MDL_isPermInsert($id){
		$tblName = $this->config->item('tmst_employee');

		$res = $this->db->get_where($tblName, array('emp_id' => $id))->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }

	public function MDL_isPermDelete($id){
		$tblName = $this->config->item('tmst_prjres_employee');

		//$res = $this->db->get_where($tblName, array('empstatus_id' => $id))->num_rows();
		$sSQL = "
			SELECT emp_id FROM $tblName WHERE emp_id = '$id' LIMIT 0,1
		";

		$ambil = $this->db->query($sSQL);
		$res = $ambil->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }
	
	public function MDL_getAutoID() {
		$tblemployee = $this->config->item('tmst_employee');

		$sSQL = "
			SELECT MAX(p.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(emp_id,4,5) AS UNSIGNED INTEGER) AS num
				FROM $tblemployee
			) p
			WHERE 1=1
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			$data = $ambil->row();
			$no_urut = $data->no_urut + 1;
		} else {
			$no_urut = 1;
		}

		$hasil = sprintf("EMP%05d",$no_urut);

		return $hasil;	
	}
	
	public function MDL_CekField($field,$id='') {
		$tblemployee = $this->config->item('tmst_employee');

		$fvalue = $_REQUEST['fvalue'];
        $res = ($fvalue == $id) ? 0 : $this->db->get_where($tblemployee, array($field => $fvalue))->num_rows();

		if(!$res) {
			return true;
		} else {
			return false;
		}
    }
	
}
?>