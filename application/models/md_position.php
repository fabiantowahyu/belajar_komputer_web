<?php
class Md_position extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_getDataParent() {
		$tblposition = $this->config->item('tmst_position');

		$hasil = array();
		
		$sSQL = "
			SELECT position_id, position_parent, position_code, position_name, position_parentpath, position_flag
			FROM $tblposition
			WHERE 1=1 
				AND position_active = '1'
			ORDER BY position_parentpath, position_parent
		";
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}	
		}
		return $hasil;
	}
	
	public function MDL_getDataParent_Detail($parentpath) {
		$tblposition = $this->config->item('tmst_position');

		$hasil = array();
		
		$parentpath = sprintf("'%s'",str_replace(",","','",$parentpath));
		$sSQL = "
			SELECT position_id, position_parent, position_code, position_name, position_parentpath, position_flag
			FROM $tblposition
			WHERE 1=1 
				AND position_active = '1'
				AND position_id IN ($parentpath)
			ORDER BY position_parentpath, position_parent
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}	
		}

		return $hasil;
	}
	
	public function MDL_SelectID($id){
		$tblposition = $this->config->item('tmst_position');

        return $this->db->get_where($tblposition, array('position_id' => $id))->row();
    }
	
	public function MDL_Select_Company() {
		$tblcompany = $this->config->item('tmst_company');

		$hasil = array();

		$sSQL = "
			SELECT id, type, name 
			FROM $tblcompany
			WHERE status = '1'
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil = sprintf("%s %s",$data->type,$data->name);
			}
		}
		return $hasil;	
	}
	
	public function MDL_Select_Position($flag) {
		$tblposition = $this->config->item('tmst_position');

		$hasil = array();
		$FILTER = ($flag == "3") ? "AND position_flag IN ('1','2','$flag')" : "AND position_flag IN ('1','$flag')";
		
		$sSQL = "
			SELECT position_id, position_parent, position_code, position_name, position_parentpath, position_flag
			FROM $tblposition
			WHERE 1=1 
				AND position_active = '1'
				AND position_parent <> '0'
				$FILTER
			ORDER BY position_parentpath, position_parent
		";
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}	
		}
		return $hasil;
	}

	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tblposition = $this->config->item('tmst_position');
		
		$radNeck = $this->input->post('radNeck');
		$data = $this->input->post();
		unset($data['chkNeck']);
		unset($data['radNeck']);
		unset($data['selNonMember']);
		unset($data['selNonGrade']);
		unset($data['submit']);
	
		$data['userid'] = $this->session->userdata('userid');
		$data['recdate'] = date("Y-m-d H:i:s");
		$data['moduser'] = $this->session->userdata('userid');
		$data['moddate'] = date("Y-m-d H:i:s");
		if(strlen($radNeck)) { $data['pos_in_neck'] = $radNeck; }
		if(!strlen($data['jobstatus_code'])) { unset($data['jobstatus_code']); }
		if(!strlen($data['pos_jobtitle'])) { unset($data['pos_jobtitle']); }
		if(!strlen($data['pos_costcenter'])) { unset($data['pos_costcenter']); }
		if(!strlen($data['work_location'])) { unset($data['work_location']); }
		if(!strlen($data['grade_code'])) { unset($data['grade_code']); }
		if(!strlen($data['market_salary'])) { unset($data['market_salary']); }
		if(!strlen($data['maxmarket_salary'])) { unset($data['maxmarket_salary']); }
		if(!strlen($data['pos_job_desc'])) { unset($data['pos_job_desc']); }
		if(!strlen($data['pos_man_req'])) { unset($data['pos_man_req']); }
		if(!strlen($data['pos_tech_req'])) { unset($data['pos_tech_req']); }

		$this->db->insert($tblposition, $data);
	}

	// Fungsi Ubah Data
	public function MDL_Update($id) {
		$tblposition = $this->config->item('tmst_position');
		
		$radNeck = $this->input->post('radNeck');
		$data = $this->input->post();
		unset($data['chkNeck']);
		unset($data['radNeck']);
		unset($data['selNonMember']);
		unset($data['selNonGrade']);
		unset($data['submit']);
	
		//$data['userid'] = $this->session->userdata('userid');
		//$data['recdate'] = date("Y-m-d H:i:s");
		$data['moduser'] = $this->session->userdata('userid');
		$data['moddate'] = date("Y-m-d H:i:s");
		if(strlen($radNeck)) { $data['pos_in_neck'] = $radNeck; } else { $data['pos_in_neck'] = NULL; }
		if(!strlen($data['jobstatus_code'])) { $data['jobstatus_code'] = NULL; }
		if(!strlen($data['pos_jobtitle'])) { $data['pos_jobtitle'] = NULL; }
		if(!strlen($data['pos_costcenter'])) { $data['pos_costcenter'] = NULL; }
		if(!strlen($data['work_location'])) { $data['work_location'] = NULL; }
		if(!strlen($data['grade_code'])) { $data['grade_code'] = NULL; }
		if(!strlen($data['market_salary'])) { $data['market_salary'] = NULL; }
		if(!strlen($data['maxmarket_salary'])) { $data['maxmarket_salary'] = NULL; }
		if(!strlen($data['pos_job_desc'])) { $data['pos_job_desc'] = NULL; }
		if(!strlen($data['pos_man_req'])) { $data['pos_man_req'] = NULL; }
		if(!strlen($data['pos_tech_req'])) { $data['pos_tech_req'] = NULL; }

		$this->db->where('position_id', $id);
        $this->db->update($tblposition, $data);
	}
	
	public function MDL_Update_Position($id) {
		$tblposition = $this->config->item('tmst_position');
		
		$posparent = $this->input->post('posparent');
		$tmpData = $this->MDL_SelectID($posparent);
		$parentpath = sprintf("%s,%s",$tmpData->position_parentpath,$tmpData->position_id);
		//$data = $this->input->post();
		
		//$data['userid'] = $this->session->userdata('userid');
		//$data['recdate'] = date("Y-m-d H:i:s");
		$data['moduser'] = $this->session->userdata('userid');
		$data['moddate'] = date("Y-m-d H:i:s");
		$data['division_id'] = $posparent;
		$data['position_parent'] = $posparent;
		$data['position_level'] = $tmpData->position_level + 1;
		$data['position_parentpath'] = $parentpath;	

		$this->db->where('position_id', $id);
        $res = $this->db->update($tblposition, $data);
		
		if($res) {
			## update semua parentpath child nya
			$sSQL = "
				SELECT position_id, position_parent, position_code, position_name, position_parentpath, position_flag
				FROM $tblposition
				WHERE 1=1 
					AND position_parent = '$id'
				ORDER BY position_parent, position_parentpath
			";
			$ambil = $this->db->query($sSQL);
			if ($ambil->num_rows() > 0) {
				foreach ($ambil->result() as $rw) {
					$data2['position_level'] = $data['position_level'] + 1;	
					$data2['position_parentpath'] = sprintf("%s,%s",$parentpath,$id);	
					$this->db->where('position_id', $rw->position_id);
					$this->db->update($tblposition, $data2);
				}	
			}
		}
	}
	
	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$tblposition = $this->config->item('tmst_position');

		$this->db->delete($tblposition, array('position_id' => $id));
	}
	
	public function MDL_isPermDelete($id){
		$tblName = $this->config->item('tmst_employee');

		//$res = $this->db->get_where($tblName, array('empstatus_id' => $id))->num_rows();
		$sSQL = "
			SELECT position_id FROM $tblName WHERE position_id = '$id' LIMIT 0,1
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
		$tblposition = $this->config->item('tmst_position');

		$fvalue = $_REQUEST['fvalue'];
        $res = ($fvalue == $id) ? 0 : $this->db->get_where($tblposition, array($field => $fvalue))->num_rows();

		if(!$res) {
			return true;
		} else {
			return false;
		}
    }
	
}
?>