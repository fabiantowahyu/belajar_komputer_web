<?php
class Md_lettertemplate extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tblletter_template = $this->config->item('tmst_lettertemplate');

		$hasil = array();
		
		$sSQL = "
			SELECT a.id,a.template_name,a.content,a.used_on,a.status as sts,IF(a.status=1,'Active','Not Active') AS status
			FROM $tblletter_template a
			WHERE 1=1
			ORDER BY a.id
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$data->status = ($data->sts==1) 
					? '<span class="label label-info arrowed-in-right">' . $data->status . '</span>' 
					: '<span class="label label-warning arrowed-in-right">' . $data->status . '</span>';
				$hasil[] = $data;
			}
		}
		return $hasil;
	}
	
	public function MDL_SelectID($id){
		$tblletter_template = $this->config->item('tmst_lettertemplate');

        return $this->db->get_where($tblletter_template, array('id' => $id))->row();
    }

	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tblletter_template = $this->config->item('tmst_lettertemplate');

		$id = $this->input->post('id');
		$template_name = $this->input->post('template_name');
		$content = $this->input->post('content');
		$used_on = $this->input->post('used_on');
		$status = $this->input->post('status');
		
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");

		$data = array(
			'id' => $id,
			'template_name' => $template_name,
			'used_on' => $used_on,
			'content' => $content,
			'status' => $status,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);
		$this->db->insert($tblletter_template, $data);
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tblletter_template = $this->config->item('tmst_lettertemplate');

		$id = $this->input->post('id');
		$template_name = $this->input->post('template_name');
		$used_on = $this->input->post('used_on');
		$content = $this->input->post('content');
		$status = $this->input->post('status');
		
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'template_name' => $template_name,
			'used_on' => $used_on,
			'content' => $content,
			'status' => $status,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);

        $this->db->where('id', $id);
        $this->db->update($tblletter_template, $data);
    }

	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$tblletter_template = $this->config->item('tmst_lettertemplate');

		$this->db->delete($tblletter_template, array('id' => $id));
	}

	public function MDL_isPermInsert($id){
		$tblName = $this->config->item('tmst_lettertemplate');
		
		$res = $this->db->get_where($tblName, array('id' => $id))->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }

	public function MDL_isPermDelete($id){
		$tblName = $this->config->item('tmst_laboratory');

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

	public function MDL_getAutoID() {
		$tblletter_template = $this->config->item('tmst_lettertemplate');

		$sSQL = "
			SELECT MAX(p.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(id,5,5) AS UNSIGNED INTEGER) AS num
				FROM $tblletter_template
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

		$hasil = sprintf("WRKS%05d",$no_urut);

		return $hasil;	
	}

}
?>