<?php

class Md_Quiz extends CI_Model {

    // Fungsi Ambil Data
    public function MDL_Select() {
	$tblscore = $this->config->item('tmst_score');



	$hasil = array();

	$sSQL = "select id_information,id,

group_concat('<li>',urutan order by urutan asc separator '<li/>') as urutan,
group_concat('<li>',question order by urutan asc separator '<li/>') as question,
group_concat('<li>',question_usa order by urutan asc separator '<li/>') as question_usa,
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

    public function get_all_score($id_information) {

	$this->db->select('*');

	$this->db->from('tmst_quiz');
	$this->db->where('id_information', $id_information);
	$this->db->order_by("urutan", "desc");
	$get = $this->db->get();
	$result = $get->result();
	return $result;
    }

    public function MDL_SelectID($id_information) {
	$tmst_quiz = $this->config->item('tmst_quiz');

	return $this->db->get_where($tmst_quiz, array('id_information' => $id_information))->row();
    }

    // Fungsi Tambah Data
    public function MDL_Insert() {
	$tmst_quiz = $this->config->item('tmst_quiz');


	$userid = $this->session->userdata('userid');
	$recdate = date("Y-m-d H:i:s");
	$moduser = $this->session->userdata('userid');
	$moddate = date("Y-m-d H:i:s");

	$id_information = $this->input->post('id_information');
	$quiz = $this->input->post('quiz');

	foreach ($quiz as $key => $value) {
	    $data = array(
		'id_information' => $id_information,
		'question' => $value['question'],
                'question_usa' => $value['question_usa'],
                'urutan' => $value['urutan'],
		'option_a' => $value['option_a'],
		'option_b' => $value['option_b'],
		'option_c' => $value['option_c'],
		'option_d' => $value['option_d'],
                'answer' => $value['answer'],
		'userid' => $userid,
		'recdate' => $recdate,
		'moduser' => $moduser,
		'moddate' => $moddate
	    );
	    $this->db->insert($tmst_quiz, $data);
	}
    }

    // Fungsi Ubah Data
    public function MDL_Update($id_information) {
	$tmst_quiz = $this->config->item('tmst_quiz');

	$moduser = $this->session->userdata('userid');
	$moddate = date("Y-m-d H:i:s");

	$quiz = $this->input->post('quiz');

	for ($i = 0; $i < count($quiz); $i++) {
	    $data = array(
		'id_information' => $this->uri->segment(3),
		'question' => $score[$i]['question'],
                'question_usa' => $score[$i]['question_usa'],
		'urutan' => $score[$i]['urutan'],
		'option_a' => $score[$i]['option_a'],
		'option_b' => $score[$i]['option_b'],
		'option_c' => $score[$i]['option_c'],
		'option_d' => $score[$i]['option_d'],
                'answer' => $score[$i]['answer'],
		'moduser' => $moduser,
		'moddate' => $moddate
	    );

	    if (!$quiz[$i]['id_information']) {
		$this->db->insert($tmst_quiz, $data);
	    } else {
		$this->db->where('id', $quiz[$i]['id_information']);
		$this->db->update($tmst_quiz, $data);
	    }
	}
    }

    public function MDL_isPermInsert($id_information) {
	$tmst_quiz = $this->config->item('tmst_quiz');

	$res = $this->db->get_where($tmst_quiz, array('id_information' => $id_information))->num_rows();
	if ($res) {
	    return 0;
	} else {
	    return 1;
	}
    }

    // Fungsi Hapus Data
    public function MDL_Delete($id_information) {
	$tmst_quiz = $this->config->item('tmst_quiz');

	$this->db->delete($tmst_quiz, array('id_information' => $id_information));
    }

    public function MDL_Delete_Item($id) {
	$tmst_quiz = $this->config->item('tmst_quiz');
        
	$this->db->delete($tmst_quiz, array('id' => $id));
    }

    public function MDL_isPermDelete($id_information) {
	$tmst_quiz = $this->config->item('tmst_quiz');
	$this->db->from($tmst_quiz);
	$this->db->where('id_information', $id_information);
	$result = $this->db->get()->num_rows();


	if ($result) {
	    return 0;
	} else {
	    return 1;
	}
    }

}

?>