<?php
class Md_manage_user extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tbluser = $this->config->item('tmst_users');

		$hasil = array();
		
		$sSQL = "
			SELECT emp_id as id, userid, username, email, active, last_login
			FROM $tbluser 
			WHERE 1=1 
			ORDER BY username
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$data->last_login = $data->last_login<>"0000-00-00 00:00:00" ? date("d-m-Y H:i:s",strtotime($data->last_login)) : "";
				$data->active = ($data->active==1) 
					? '<span class="label label-info arrowed-in-right">Active</span>' 
					: '<span class="label label-warning arrowed-in-right">Not Active</span>';
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}

	public function MDL_Select_Userdata($id) {
		$tblgroup = $this->config->item('tmst_group');
		$tbluser_group = $this->config->item('tmst_users_group');

		$hasil = array();
		$tmpGroup = array();
		$tmpBranch = array();

		//GROUP ACCESS
		$sSQL = "
			SELECT g.id, g.nama 
			FROM $tbluser_group u, $tblgroup g
			WHERE 1=1
				AND g.id = u.group_id
				AND u.user_id = '$id'
			ORDER BY g.nama
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$tmpGroup[] = $data->nama;
			}
		}

		$hasil['group'] = @join(", ",$tmpGroup);

		return $hasil;	
	}

	public function MDL_SelectID($id){
		$tbluser = $this->config->item('tmst_users');
		$tblmst_user = $this->config->item('tbl_user');
		$tblemployee = $this->config->item('tmst_employee');

		$hasil = $this->db->get_where($tbluser, array('emp_id' => $id))->row();
		if(@$hasil->tabel == "emp") {
			
			$sSQL = "
				SELECT e.emp_id as userid, e.username as userid2, e.first_name, e.middle_name, e.last_name, e.email, e.status as active
					, CONCAT(first_name,' ',middle_name,' ',last_name) as username
				FROM $tblemployee e
				WHERE 1=1 
					AND e.emp_id = '$id'
			";
			
			$ambil = $this->db->query($sSQL);
			return array($ambil->row(),$hasil->tabel);
			
		} elseif(@$hasil->tabel == "usr") {
			//$dt = $this->db->get_where($tblmst_user, array('userid' => $id))->row();
			//return array($dt,$hasil->tabel);
			$sSQL = "
				SELECT e.userid, e.userid as userid2, e.first_name, e.middle_name, e.last_name, e.email, e.active
					, CONCAT(first_name,' ',middle_name,' ',last_name) as username
				FROM $tblmst_user e
				WHERE 1=1 
					AND e.userid = '$id'
			";
			
			$ambil = $this->db->query($sSQL);
			return array($ambil->row(),$hasil->tabel);
			
		} else {
			return array("","");
		}
       
    }

	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tbluser = $this->config->item('tbl_user');

		$userid = $this->input->post('userid');
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$last_name = $this->input->post('last_name');
		$password = MD5($this->input->post('password'));
		$email = $this->input->post('email');
		$active = $this->input->post('active');
		
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		$data = array(
			'userid' => $userid,
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'password' => $password,
			'email' => $email,
			'active' => $active,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);
		$this->db->insert($tbluser, $data);
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tbluser = $this->config->item('tbl_user');

		$userid = $this->input->post('userid');
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$last_name = $this->input->post('last_name');
		$moduser = $this->session->userdata('userid');
		$email = $this->input->post('email');
		$active = $this->input->post('active');
		$moddate = date("Y-m-d H:i:s");
		 
		if($this->input->post('choice_pwd')) {
			$password = MD5($this->input->post('password'));
			$data = array(
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				'password' => $password,
				'email' => $email,
				'active' => $active,
				'moduser' => $moduser,
				'moddate' => $moddate
				);
		} else {
			$data = array(
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				'email' => $email,
				'active' => $active,
				'moduser' => $moduser,
				'moddate' => $moddate
				);
		}

        $this->db->where('userid', $id);
        $this->db->update($tbluser, $data);
    }
	
	public function MDL_Update_Employee($id){
		$tblemployee = $this->config->item('tmst_employee');
		
		$userid = $this->input->post('userid2');
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$active = $this->input->post('active');
		$moddate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		 
		if($this->input->post('choice_pwd')) {
			$password = MD5($this->input->post('password'));
			$data = array(
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				'username' => $userid,
				'password' => $password,
				'email' => $email,
				'status' => $active,
				'moduser' => $moduser,
				'moddate' => $moddate
				);
		} else {
			$data = array(
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				'username' => $userid,
				'email' => $email,
				'status' => $active,
				'moduser' => $moduser,
				'moddate' => $moddate
				);
		}

        $this->db->where('emp_id', $id);
        $this->db->update($tblemployee, $data);
    }

	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$tbluser = $this->config->item('tbl_user');
		$tbluser_group = $this->config->item('tmst_users_group');

		$this->db->delete($tbluser_group, array('user_id' => $id));
		$this->db->delete($tbluser, array('userid' => $id));
	}

	//Fungsi Ambil Data User Group
	public function MDL_Select_UserGroup($userid) {
		$tbluser_group = $this->config->item('tmst_users_group');

		$hasil = array();
		
		$sSQL = "
			SELECT id, group_id
			FROM $tbluser_group
			WHERE user_id = '$userid'
		";
	
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[$data->group_id] = $data->id;
			}
		}
		return $hasil;	
	}
	
	public function MDL_Select_NotMember($userid,$item='') {
		$tblgroup = $this->config->item('tmst_group');
		$tbluser_group = $this->config->item('tmst_users_group');

		$hasil = array();
		
		$FILTER = strlen($item) ? "AND (nama LIKE '%$item%')" : "";  
		
		$sSQL = "
			SELECT id, nama
			FROM $tblgroup
			WHERE 1=1
				AND id NOT IN (
					SELECT group_id
					FROM $tbluser_group
					WHERE user_id = '$userid'
				)
				$FILTER
			ORDER BY nama
		";
	
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}
	
	public function MDL_Select_Member($userid,$item='') {
		$tblgroup = $this->config->item('tmst_group');
		$tbluser_group = $this->config->item('tmst_users_group');

		$hasil = array();
		
		$FILTER = strlen($item) ? "AND (nama LIKE '%$item%')" : "";  
		
		$sSQL = "
			SELECT id, nama
			FROM $tblgroup
			WHERE 1=1
				AND id IN (
					SELECT group_id
					FROM $tbluser_group
					WHERE user_id = '$userid'
				)
				$FILTER
			ORDER BY nama
		";
	
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}

	// Fungsi Tambah Data Group User
	public function MDL_InsertPriv_User() {
		$tbluser_group = $this->config->item('tmst_users_group');

		$user_id = $this->input->post('user_id');
		$AryData = @explode(",",$this->input->post('selMember_value'));
		
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");

		//Insert & Update Data yang baru
		$AryDel = array();
		$AryMember = $this->MDL_Select_UserGroup($user_id);
	
		$AryDel = $AryMember;	
		while(list($k,$v) = @each($AryData)) {
			if(isset($AryMember[$v])) {
				$id = $AryMember[$v];
				
				$data = array(
					'user_id' => $user_id,
					'group_id' => $v,
					'moduser' => $moduser,
					'moddate' => $moddate
				);
				$this->db->where('id', $id);
				$this->db->update($tbluser_group, $data);
				
				unset($AryDel[$v]);
			} elseif(strlen($v)) {
				$data = array(
					'user_id' => $user_id,
					'group_id' => $v,
					'recdate' => $recdate,
					'moduser' => $moduser,
					'moddate' => $moddate
				);
				$this->db->insert($tbluser_group, $data);
			}
		}
		
		//Delete Data Not Member
		while(list($k,$v) = @each($AryDel)) {
			$this->db->delete($tbluser_group, array('id' => $v));
		}

	}

	// Fungsi Hapus Data Group User
	public function MDL_DeletePriv() {
		$tbluser_group = $this->config->item('tmst_users_group');

		$userid = $this->input->post('user_id');
		//$gid = $this->input->post('group_id');
		$AryGroupID = $this->input->post('group_id');

		while(list($k,$gid) = @each($AryGroupID)) {
			$this->db->delete($tbluser_group, array('user_id' => $userid,'group_id' => $gid));
		}
	}

	// Fungsi Uniq ID
	public function MDL_nextuniqueid() {
		srand((double)microtime()*1000000);
		return sprintf("%s%06d",date("YmdHis"),rand(0, 999999));
	}

	public function MDL_isPermInsert($id){
		$tblName = $this->config->item('tmst_users');

		$res = $this->db->get_where($tblName, array('userid' => $id))->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }
	
	public function MDL_isPermDelete($id){
		$tblusers_group = $this->config->item('tmst_users_group');
		$isAdmin = $this->config->item('isAdmin');

		if($id == $isAdmin) {
			return 0;
		} 
		//$res = $this->db->get_where($tblName, array('empstatus_id' => $id))->num_rows();
		
		$sSQL = "
			SELECT user_id FROM $tblusers_group WHERE user_id = '$id' LIMIT 0,1
		";

		$ambil = $this->db->query($sSQL);
		$res = $ambil->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }
	
	public function MDL_CekField($field,$id='') {
		$tbluser = $this->config->item('tmst_users');

		$fvalue = $_REQUEST['fvalue'];
        $res = ($fvalue == $id) ? 0 : $this->db->get_where($tbluser, array($field => $fvalue))->num_rows();

		if(!$res) {
			return true;
		} else {
			return false;
		}
    }

    public function MDL_IsEmailExist($email){
    	$tbluser = $this->config->item('tmst_employee');
    	$this->db->where('email', $email);
    	$this->db->from('tmst_employee');
    	$result = $this->db->get();
    	//var_dump($result->result());exit();
    	return $result->result();
    }

    public function MDL_ResetPassword($password, $id){
    	$user = array(
    		'password' => $password
    	);
    	$this->db->where('username', $id);
    	$this->db->update('tmst_employee', $user);
    }
	
}
?>