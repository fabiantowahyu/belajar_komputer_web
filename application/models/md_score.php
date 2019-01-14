<?php

class Md_Quiz extends CI_Model {

    // Fungsi Ambil Data
    public function MDL_Select() {
	$tblscore = $this->config->item('tmst_score');



	$hasil = array();

	$sSQL = "select id_information,id,

group_concat('<li>',urutan order by urutan asc separator '<li/>') as urutan,
group_concat('<li>',question order by urutan asc separator '<li/>') as question,
group_concat('<li>',option_a order by urutan asc separator '<li/>') as option_a,
group_concat('<li>',option_b order by urutan asc separator '<li/>') as option_b,
group_concat('<li>',option_c order by urutan asc separator '<li/>') as option_c,
group_concat('<li>',option_d order by urutan asc separator '<li/>') as option_d,
group_concat('<li>',answer order by urutan asc separator '<li/>') as answer

 from tmst_quiz group by id_information";

	$ambil = $this->db->query($sSQL);

	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[] = $data;
	    }
	}
	return $hasil;
    }

    public function get_all_score($score_type) {

	$this->db->select('*');

	$this->db->from('tmst_score');
	$this->db->where('score_type', $score_type);
	$this->db->order_by("score_order", "desc");
	$get = $this->db->get();
	$result = $get->result();
	return $result;
    }

    public function MDL_SelectID($id) {
	$tblscore = $this->config->item('tmst_score');

	return $this->db->get_where($tblscore, array('score_type' => $id))->row();
    }

    // Fungsi Tambah Data
    public function MDL_Insert() {
	$tblscore = $this->config->item('tmst_score');


	$userid = $this->session->userdata('userid');
	$recdate = date("Y-m-d H:i:s");
	$moduser = $this->session->userdata('userid');
	$moddate = date("Y-m-d H:i:s");

	$score_type = $this->input->post('score_type');
	$score = $this->input->post('score');

	foreach ($score as $key => $value) {
	    $data = array(
		'score_type' => $score_type,
		'score_value' => $value['score_value'],
		'score_mask' => $value['score_mask'],
		'score_order' => $value['score_order'],
		'score_description' => $value['score_description'],
		'userid' => $userid,
		'recdate' => $recdate,
		'moduser' => $moduser,
		'moddate' => $moddate
	    );
	    $this->db->insert($tblscore, $data);
	}
    }

    // Fungsi Ubah Data
    public function MDL_Update($score_type) {
	$tblscore = $this->config->item('tmst_score');

	$moduser = $this->session->userdata('userid');
	$moddate = date("Y-m-d H:i:s");

	$score = $this->input->post('score');

	for ($i = 0; $i < count($score); $i++) {
	    $data = array(
		'score_type' => $this->uri->segment(3),
		'score_value' => $score[$i]['score_value'],
		'score_mask' => $score[$i]['score_mask'],
		'score_order' => $score[$i]['score_order'],
		'score_description' => $score[$i]['score_description'],
		'moduser' => $moduser,
		'moddate' => $moddate
	    );

	    if (!$score[$i][id_score]) {
		$this->db->insert($tblscore, $data);
	    } else {
		$this->db->where('id', $score[$i][id_score]);
		$this->db->update($tblscore, $data);
	    }
	}
    }

    public function MDL_isPermInsert($id) {
	$tblscore = $this->config->item('tmst_score');

	$res = $this->db->get_where($tblscore, array('id' => $id))->num_rows();
	if ($res) {
	    return 0;
	} else {
	    return 1;
	}
    }

    // Fungsi Hapus Data
    public function MDL_Delete($id) {
	$tblscore = $this->config->item('tmst_score');

	$this->db->delete($tblscore, array('score_type' => $id));
    }

    public function MDL_Delete_Item($id) {
	$tblscore = $this->config->item('tmst_score');
	$this->db->delete($tblscore, array('id' => $id));
    }

    public function MDL_isPermDelete($id) {
	$tblscore = $this->config->item('tmst_score');
	$this->db->from($tblscore);
	$this->db->where('score_type', $id);
	$result = $this->db->get()->num_rows();


	if ($result) {
	    return 0;
	} else {
	    return 1;
	}
    }

}

?>