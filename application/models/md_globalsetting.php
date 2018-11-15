<?php
class Md_globalsetting extends CI_Model {

	public function MDL_SelectID(){
		$tbl_globalsetting = $this->config->item('tmst_globalsetting');
		
       	$hasil = array();
		$sSQL = "
			SELECT *
			FROM $tbl_globalsetting
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil = $data;
			}
		}
		return $hasil;	
    }

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tbl_globalsetting = $this->config->item('tmst_globalsetting');
		
		$pension_age 			= $this->input->post('pension_age');
		$sender_email			= $this->input->post('sender_email');
		$career_lettersignee 	= $this->input->post('letter_signee');
		
		$moduser 	 = $this->session->userdata('userid');
		$moddate 	 = date("Y-m-d H:i:s");
		
		$data = array(
			'pension_age' => $pension_age,
			'sender_email' => $sender_email,
			'career_lettersignee' => $career_lettersignee,
			'moduser' => $moduser,
			'moddate' => $moddate
			);

        $this->db->update($tbl_globalsetting, $data);
    }
}
?>