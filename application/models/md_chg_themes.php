<?php
class Md_chg_themes extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_SelectID($id){
		$tbluser = $this->config->item('tmst_users');

        return $this->db->get_where($tbluser, array('userid' => $id))->row();
    }

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tbluser = $this->config->item('tmst_users');

		$themes = $this->input->post('themes');
		$data = array(
			'themes' => $themes
			);

        $this->db->where('userid', $id);
        $this->db->update($tbluser, $data);
		
		$session_data = array(
		'themes'   => $themes
		);
		// buat session
		$this->session->set_userdata($session_data);
    }


}
?>