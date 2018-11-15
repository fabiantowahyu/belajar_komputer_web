<?php
class Md_chg_password extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_SelectID($id){
		$tbluser = $this->config->item('tmst_users');

        return $this->db->get_where($tbluser, array('emp_id' => $id))->row();
    }

	// Fungsi Ubah Data
	public function MDL_Update($emp_id){
		//$tbluser = $this->config->item('tmst_users');
		$tblemployee = $this->config->item('tmst_employee');

		$password = MD5($this->input->post('password_new'));
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");

		$data = array(
			'password' => $password,
			'moduser' => $moduser,
			'moddate' => $moddate
			);

        $this->db->where('emp_id', $emp_id);
        $this->db->update($tblemployee, $data);
    }


}
?>