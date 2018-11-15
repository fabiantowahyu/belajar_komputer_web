<?php
class Md_branch extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tblbranch = $this->config->item('tmst_branch');
		$tblcompany = $this->config->item('tmst_company');

		$hasil = array();
		
		$sSQL = "
			SELECT b.id, b.branch, b.address, b.phone, b.email, b.fax, c.name as company 
			FROM $tblbranch b 
				LEFT JOIN $tblcompany c ON c.id = b.company_id
			WHERE 1=1 
			ORDER BY b.id
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}

	public function MDL_Select_DGtabel($page,$rows,$sort,$order,$item) {
		$tblbranch = $this->config->item('tmst_branch');

		$offset = ($page-1)*$rows;  
  
		$hasil = array(); 
		$tmpData = array(); 
		
		$FILTER = strlen($item) ? "AND (id LIKE '%$item%' OR name LIKE '%$item%')" : "";  
		$rs = $this->db->query("SELECT count(*) as jum FROM $tblbranch WHERE 1=1 $FILTER");
		$row = $rs->row();  
		$total_rows = $row->jum;  

		$sSQL = "
			SELECT id, name FROM $tblbranch 
			WHERE 1=1 
				$FILTER
			ORDER BY $sort $order
			LIMIT $offset,$rows
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$tmpData[] = $data;
			}
		}

		
		$hasil[] = array(
		   'TotalRows' => $total_rows,
		   'Rows' => $tmpData
		);

		return $hasil;	
	}

	public function MDL_SelectID($id){
		$tblbranch = $this->config->item('tmst_branch');

        return $this->db->get_where($tblbranch, array('id' => $id))->row();
    }

	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tblbranch = $this->config->item('tmst_branch');

		$id = $this->input->post('id');
		$branch = $this->input->post('branch');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$fax = $this->input->post('fax');
		$company_id = $this->input->post('company_id');
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");

		$data = array(
			'id' => $id,
			'branch' => $branch,
			'address' => $address,
			'phone' => $phone,
			'email' => $email,
			'fax' => $fax,
			'company_id' => $company_id,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);
		$this->db->insert($tblbranch, $data);
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tblbranch = $this->config->item('tmst_branch');

		//$id = $this->input->post('id');
		$branch = $this->input->post('branch');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$fax = $this->input->post('fax');
		$company_id = $this->input->post('company_id');
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		$data = array(
			'branch' => $branch,
			'address' => $address,
			'phone' => $phone,
			'email' => $email,
			'fax' => $fax,
			'company_id' => $company_id,
			'moduser' => $moduser,
			'moddate' => $moddate
			);

        $this->db->where('id', $id);
        $this->db->update($tblbranch, $data);
    }

	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$tblbranch = $this->config->item('tmst_branch');

		$this->db->delete($tblbranch, array('id' => $id));
	}

	public function MDL_isPermInsert($id){
		$tblName = $this->config->item('tmst_branch');

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
		$tblbranch = $this->config->item('tmst_branch');

		$sSQL = "
			SELECT MAX(p.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(id,5,5) AS UNSIGNED INTEGER) AS num
				FROM $tblbranch
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

		$hasil = sprintf("BRNC%05d",$no_urut);

		return $hasil;	
	}

}
?>