<?php
class Md_profile extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tblemployee = $this->config->item('tmst_employee');
		$tbltypevar = $this->config->item('tmst_typevar');
		$tblbranch = $this->config->item('tmst_branch');

		$hasil = array();
		
		$sSQL = "
			SELECT e.emp_id, CONCAT(e.first_name,' ',e.middle_name,' ',e.last_name) as emp_name, e.username, e.position_id, t.nm_type AS gender,d.nm_type AS position_name, e.hp, e.join_date, e.branch_id, c.branch
			FROM $tblemployee e
				LEFT JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'GENDER') t ON t.id = e.gender
				LEFT JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'POSITION' ) d ON d.id = e.position_id
				LEFT JOIN $tblbranch c ON c.id = e.branch_id
			WHERE 1=1 
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
	
	public function MDL_Select_Education($id) {
		$tblemp_education = $this->config->item('tmst_emp_education');
		$tbltypevar = $this->config->item('tmst_typevar');

		$hasil = array();
				
		$sSQL = "
			SELECT e.id, e.education_lvl, e.startdate, e.enddate, a.nm_type AS faculty, b.nm_type AS institution,c.nm_type AS education_lvl
			FROM $tblemp_education e
				LEFT JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'FACULTY') a ON a.id = e.faculty
				LEFT JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'INSTITUTION') b ON b.id = e.institution
				LEFT JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'EDUCATION_LEVEL') c ON c.id = e.education_lvl
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
	
	public function MDL_Select_Training($id) {
		$tblemp_training = $this->config->item('tmst_emp_training');
		$tbltypevar = $this->config->item('tmst_typevar');

		$hasil = array();
		
		$sSQL = "
			SELECT e.id, e.subject, e.startdate, e.enddate, e.topic, e.type
			FROM $tblemp_training e
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
	
	public function MDL_SelectID($id,$type=''){
		$tblemployee = $this->config->item('tmst_employee');
		$tblemp_education = $this->config->item('tmst_emp_education');
		$tblemp_training = $this->config->item('tmst_emp_training');

		if($type == 'education') {
			$tblName = $tblemp_education;
			$field = 'id';
		} elseif($type == 'training') {
			$tblName = $tblemp_training;
			$field = 'id';
		} else {
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
		$username = $this->input->post('username');
		$password = MD5($this->input->post('password'));
		$role = $this->input->post('role');
		$position_id = $this->input->post('position');
		$gender = $this->input->post('gender');
		$join_date = $this->input->post('join_date');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$hp = $this->input->post('hp');
		$post_code = $this->input->post('post_code');
		$branch_id = $this->input->post('branch_id');
		$email = $this->input->post('email');
		$status = $this->input->post('status');
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'emp_id' => $emp_id,
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'role' => $role,
			'position_id' => $position_id,
			'gender' => $gender,
			'join_date' => $join_date,
			'address' => $address,
			'phone' => $phone,
			'hp' => $hp,
			'post_code' => $post_code,
			'branch_id' => $branch_id,
			'status' => $status,
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
			
			/* //Insert User
			$data = array(
				'userid'   => $username,
				'username' => $username,
				'password' => $password,
				'emp_id'   => $emp_id,
				'active'   => 1,
				'recdate' => $recdate,
				'moduser' => $moduser,
				'moddate' => $moddate
			);
			$this->db->insert($tbluser, $data); */
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
	
	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tblemployee = $this->config->item('tmst_employee');
		$tbluser_group = $this->config->item('tmst_users_group');
	
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$last_name = $this->input->post('last_name');
		$gender = $this->input->post('gender');
		$join_date = $this->input->post('join_date');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$hp = $this->input->post('hp');
		$post_code = $this->input->post('post_code');
		$email = $this->input->post('email');
		
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'email' => $email,
			'gender' => $gender,
			'join_date' => $join_date,
			'address' => $address,
			'phone' => $phone,
			'hp' => $hp,
			'post_code' => $post_code,
			'moduser' => $moduser,
			'moddate' => $moddate
		);
		

        $this->db->where('emp_id', $id);
		$this->db->update($tblemployee, $data);
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
				$file_name = $hasil->photo;
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
			if($res) {
				$file_name = $_FILES['userfile']['name'];
				$file_type = $_FILES['userfile']['type'];
				
				$data = array(
					$field => $file_name
				);

				$this->db->where('emp_id', $id);
				$this->db->update($tblemployee, $data);
				
				# Upload Versi thumbnails nya
				if($upload_type=="Photo") {
					$datafile = $this->upload->data();

					$konfigurasi = array(
						'source_image' => $datafile['full_path'],
						'new_image' => $filepath . '/thumbnails',
						'maintain_ration' => true,
						'width' => 48,
						'height' =>48
					);

					$this->load->library('image_lib', $konfigurasi);
					$this->image_lib->resize();
				}
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
	
	public function MDL_Update_Password($id){
		$tblemployee = $this->config->item('tmst_employee');
		
		$password = MD5($this->input->post('password'));
		
		$data = array(
			'password' => $password
		);
		
        $this->db->where('emp_id', $id);
		$this->db->update($tblemployee, $data);
    }
	
	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$filepath_education = $this->config->item('filepath_education');
		$filepath_avatar = $this->config->item('filepath_avatar');
		$separator = $this->config->item('separator');
		$tblemployee = $this->config->item('tmst_employee');
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

		$id = $this->session->userdata('userid');
		$fvalue = $_REQUEST['fvalue'];
        $res = ($fvalue == $id) ? 0 : $this->db->get_where($tblemployee, array($field => $fvalue,'emp_id' => $id))->num_rows();

		if(!$res) {
			return true;
		} else {
			return false;
		}
    }
	
	public function MDL_CekField_PWD() {
		$tblemployee = $this->config->item('tmst_employee');

		$id = $this->session->userdata('userid');
		$fvalue = MD5($_REQUEST['fvalue']);
        $res = $this->db->get_where($tblemployee, array('password' => $fvalue,'emp_id' => $id))->num_rows();

		if($res) {
			return true;
		} else {
			return false;
		}
    }
}
?>