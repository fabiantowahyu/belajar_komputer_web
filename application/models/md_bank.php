<?php
class Md_bank extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tblbank = $this->config->item('tmst_bank');

		$hasil = array();
		
		$sSQL = "
			SELECT id,bank_code,bank_name,bank_address,bank_branch,bank_group
			FROM $tblbank 
			WHERE 1=1 
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

	public function MDL_SelectID($id){
		$tblbank = $this->config->item('tmst_bank');
		
        return $this->db->get_where($tblbank, array('id' => $id))->row();
    }

	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tblbank = $this->config->item('tmst_bank');

		$bank_code		= strtoupper($this->input->post('bank_code'));
		$bank_name 		= $this->input->post('bank_name');
		$bank_address 	= $this->input->post('bank_address');
		$bank_branch 	= $this->input->post('bank_branch');
		$bank_group 	= $this->input->post('bank_group');
		
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");

		$data = array(
			'bank_code' => $bank_code,
			'bank_name' => $bank_name,
			'bank_address' => $bank_address,
			'bank_branch' => $bank_branch,
			'bank_group' => $bank_group,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);
		$this->db->insert($tblbank, $data);
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tblbank = $this->config->item('tmst_bank');

		$bank_name 		= $this->input->post('bank_name');
		$bank_address 	= $this->input->post('bank_address');
		$bank_branch 	= $this->input->post('bank_branch');
		$bank_group 	= $this->input->post('bank_group');
		
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'bank_name' => $bank_name,
			'bank_address' => $bank_address,
			'bank_branch' => $bank_branch,
			'bank_group' => $bank_group,
			'moduser' => $moduser,
			'moddate' => $moddate
			);

        $this->db->where('id', $id);
        $this->db->update($tblbank, $data);
    }

	public function MDL_isPermInsert($id){
		$tblbank = $this->config->item('tmst_bank');

		$res = $this->db->get_where($tblbank, array('bank_code' => $id))->num_rows();
		if($res) {
			return 0;
		} else {
			return 1;
		}
    }
	
	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$tblcountry = $this->config->item('tmst_country');
		
		$this->db->delete($tblcountry, array('country_code' => $id));
	}
	
	public function MDL_isPermDelete($id){
		//Nanti di set pada table transaksi
		$tblName = $this->config->item('tmst_empbank');

		$sSQL = "
			SELECT bank_code FROM $tblName WHERE bank_code = '$id' LIMIT 0,1
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