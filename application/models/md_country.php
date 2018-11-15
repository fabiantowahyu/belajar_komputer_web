<?php
class Md_country extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tblcountry = $this->config->item('tmst_country');

		$hasil = array();
		
		$sSQL = "
			SELECT id,country_code,country_name
			FROM $tblcountry 
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
		$tblcountry = $this->config->item('tmst_country');
		
        return $this->db->get_where($tblcountry, array('id' => $id))->row();
    }

	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tblcountry = $this->config->item('tmst_country');

		$country_code = $this->input->post('country_code');
		$country_code = strtoupper($country_code);
		$country_name = $this->input->post('country_name');
		
		
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");

		$data = array(
			'country_code' => $country_code,
			'country_name' => $country_name,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);
		$this->db->insert($tblcountry, $data);
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tblcountry = $this->config->item('tmst_country');

		$country_name = $this->input->post('country_name');
		
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'country_name' => $country_name,
			'moduser' => $moduser,
			'moddate' => $moddate
			);

        $this->db->where('id', $id);
        $this->db->update($tblcountry, $data);
    }

	public function MDL_isPermInsert($id){
		$tblcountry = $this->config->item('tmst_country');

		$res = $this->db->get_where($tblcountry, array('country_code' => $id))->num_rows();
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
		$tblName = $this->config->item('tmst_employee');

		$sSQL = "
			SELECT country FROM $tblName WHERE country = '$id' LIMIT 0,1
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
		$tbljob_grade = $this->config->item('tmst_job_grade');

		$fvalue = $_REQUEST['fvalue'];
        $res = ($fvalue == $id) ? 0 : $this->db->get_where($tbljob_grade, array($field => $fvalue))->num_rows();

		if(!$res) {
			return true;
		} else {
			return false;
		}
    }

	/*
	public function MDL_getAutoID() {
		$tbljob_grade = $this->config->item('tmst_job_grade');

		$sSQL = "
			SELECT MAX(p.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(Equipment_Id,5,5) AS UNSIGNED INTEGER) AS num
				FROM $tbljob_grade
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

		$hasil = sprintf("EQP%05d",$no_urut);

		return $hasil;	
	}
	*/
}
?>