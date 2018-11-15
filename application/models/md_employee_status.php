<?php
class Md_employee_status extends CI_Model {
	// Fungsi Ambil Data
	public function MDL_Select() {
		$tbl_empstatus = $this->config->item('tmst_empstatus');
		
		$hasil = array();
		
		$sSQL = "
			SELECT b.id,b.employmentstatus_code,b.employmentstatus_name
			FROM $tbl_empstatus b
			WHERE 1=1 
			ORDER BY b.id
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
		$tbl_empstatus = $this->config->item('tmst_empstatus');

        return $this->db->get_where($tbl_empstatus, array('id' => $id))->row();
    }

	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tbl_empstatus = $this->config->item('tmst_empstatus');

		$status_code = $this->input->post('status_code');
		$status_name = $this->input->post('status_name');
				
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");

		$data = array(
			'employmentstatus_code' => $status_code,
			'employmentstatus_name' => $status_name,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);
		$this->db->insert($tbl_empstatus, $data);
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tbl_empstatus = $this->config->item('tmst_empstatus');

		$status_name = $this->input->post('status_name');
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'employmentstatus_name' => $status_name,
			'moduser' 	=> $moduser,
			'moddate'	=> $moddate
			);

        $this->db->where('id', $id);
        $this->db->update($tbl_empstatus, $data);
    }

	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$tbl_empstatus = $this->config->item('tmst_empstatus');

		$this->db->delete($tbl_empstatus, array('id' => $id));
	}

	public function MDL_isPermInsert($status_code){
		$tblName = $this->config->item('tmst_empstatus');

		$res = $this->db->get_where($tblName, array('employmentstatus_code' => $status_code))->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }

	public function MDL_isPermDelete($id){
		$tblName = $this->config->item('tmst_employee');

		//$res = $this->db->get_where($tblName, array('empstatus_id' => $id))->num_rows();
		$sSQL = "
			SELECT branch_id FROM $tblName WHERE branch_id = '$id' LIMIT 0,1
		";

		$ambil = $this->db->query($sSQL);
		$res = $ambil->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }
}
?>