<?php

class Md_log_notification extends CI_Model {

    // Fungsi Ambil Data
    public function MDL_Select() {
	$userid = $this->session->userdata('userid');

	//if($userid == 'Admin'){$where=""}else
	$where = "AND l.emp_id = '$userid'";

	$hasil = array();

	$sSQL = "
			SELECT l.*,e.first_name,e.middle_name,e.last_name
			FROM ttrs_log_notification l join tmst_employee e on l.userid = e.emp_id
			WHERE 1=1 $where order by recdate desc
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[] = $data;
	    }
	}
	return $hasil;
    }

}

?>