<?php
class Md_province extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tblprovince 	= $this->config->item('tmst_province');
		$tblcountry 	= $this->config->item('tmst_country');
		
		$hasil = array();
		
		$sSQL = "
			SELECT a.id,a.province_code,a.province_name,b.country_name
			FROM $tblprovince a, $tblcountry b
			WHERE 1=1 
				AND a.country_code = b.country_code
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
		$tblprovince = $this->config->item('tmst_province');
		
        return $this->db->get_where($tblprovince, array('id' => $id))->row();
    }

	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tblprovince = $this->config->item('tmst_province');

		$province_code = $this->input->post('province_code');
		$province_code = strtoupper($province_code);
		$province_name = $this->input->post('province_name');
		$country = $this->input->post('country');
		
		
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");

		$data = array(
			'province_code' => $province_code,
			'province_name' => $province_name,
			'country_code' => $country,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);
		$this->db->insert($tblprovince, $data);
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tblprovince = $this->config->item('tmst_province');

		$province_name = $this->input->post('province_name');
		$country = $this->input->post('country');
		
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'province_name' => $province_name,
			'country_code' => $country,
			'moduser' => $moduser,
			'moddate' => $moddate
			);

        $this->db->where('id', $id);
        $this->db->update($tblprovince, $data);
    }

	public function MDL_isPermInsert($id){
		$tblprovince = $this->config->item('tmst_province');

		$res = $this->db->get_where($tblprovince, array('province_code' => $id))->num_rows();
		if($res) {
			return 0;
		} else {
			return 1;
		}
    }
	
	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$tblprovince = $this->config->item('tmst_province');
		
		$this->db->delete($tblprovince, array('province_code' => $id));
	}
	
	/*
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
    } */
	
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