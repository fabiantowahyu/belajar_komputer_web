<?php
class Md_master_type extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tbltypevar = $this->config->item('tmst_typevar');

		$hasil = array();
		
		$sSQL = "
			SELECT id, name, table_name, tid FROM $tbltypevar WHERE 1=1 ORDER BY table_name
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
		$tbltypevar = $this->config->item('tmst_typevar');

		$offset = ($page-1)*$rows;  
  
		$hasil = array(); 
		$tmpData = array(); 
		
		$FILTER = strlen($item) ? "AND (id LIKE '%$item%' OR name LIKE '%$item%')" : "";  
		$rs = $this->db->query("SELECT count(*) as jum FROM $tbltypevar WHERE 1=1 $FILTER");
		$row = $rs->row();  
		$total_rows = $row->jum;  

		$sSQL = "
			SELECT id, name FROM $tbltypevar 
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
		$tbltypevar = $this->config->item('tmst_typevar');

        return $this->db->get_where($tbltypevar, array('id' => $id))->row();
    }
	
	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tbltypevar = $this->config->item('tmst_typevar');

		$id = strtoupper($this->input->post('id'));
		$name = $this->input->post('name');
		$table_name = $this->input->post('table_name');
		$table_name = ($table_name=='other' || $table_name=='OTHER') ? $this->input->post('table_name_other') : $table_name;
		$table_name = strtoupper($table_name);
		$tid = $this->input->post('tid');
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		$data = array(
			'id' => $id,
			'name' => $name,
			'table_name' => $table_name,
			'tid' => $tid,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);
		$res = $this->db->insert($tbltypevar, $data);
		if($res) {
			//Update Order Number
			$sSQL = "
				SELECT id, tid
				FROM $tbltypevar
				WHERE 1=1
					AND id <> '$id'
					AND table_name = '$table_name'
					AND tid >= $tid
				ORDER BY tid
			";

			$ambil = $this->db->query($sSQL);
			if ($ambil->num_rows() > 0) {
				foreach ($ambil->result() as $rows) {
					$tid++;
					$data = array(
						'tid' => $tid
					);

					$this->db->where('id', $rows->id);
					$this->db->update($tbltypevar, $data);
				}
			} 
		}
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tbltypevar = $this->config->item('tmst_typevar');

		//$id = $this->input->post('id');
		$name = $this->input->post('name');
		$table_name = $this->input->post('table_name');
		$table_name = ($table_name=='other' || $table_name=='OTHER') ? $this->input->post('table_name_other') : $table_name;
		$table_name = strtoupper($table_name);
		$tid = $this->input->post('tid');
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		$data = array(
			'name' => $name,
			'table_name' => $table_name,
			'tid' => $tid,
			'moduser' => $moduser,
			'moddate' => $moddate
			);

        $this->db->where('id', $id);
		$res = $this->db->update($tbltypevar, $data);
		if($res) {
			//Update Order Number
			$sSQL = "
				SELECT id, tid
				FROM $tbltypevar
				WHERE 1=1
					AND id <> '$id'
					AND table_name = '$table_name'
					AND tid >= $tid
				ORDER BY tid
			";

			$ambil = $this->db->query($sSQL);
			if ($ambil->num_rows() > 0) {
				foreach ($ambil->result() as $rows) {
					$tid++;
					$data = array(
						'tid' => $tid
					);

					$this->db->where('id', $rows->id);
					$this->db->update($tbltypevar, $data);
				}
			} 
		}
    }

	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$tbltypevar = $this->config->item('tmst_typevar');

		$this->db->delete($tbltypevar, array('id' => $id));
	}

	public function MDL_isPermInsert($id){
		$tblName = $this->config->item('tmst_typevar');

		$res = $this->db->get_where($tblName, array('id' => $id))->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }

	public function MDL_isPermDelete($id){

		$dt = $this->MDL_SelectID($id);
		$table_name = $dt->table_name;
		switch($table_name) {
			case 'CURRENCY':
				$tblName = $this->config->item('tmst_company');
				$field = 'currency';
			break;
			case 'COMPANY_TYPE':
				$tblName = $this->config->item('tmst_company');
				$field = 'type';
			break;
			case 'SCHEME_CALCULATION':
				$tblName = $this->config->item('tmst_scheme');
				$field = 'blk_calculation';
			break;
			case 'SCHEME_SELECTION':
				$tblName = $this->config->item('tmst_scheme');
				$field = 'spk_selection';
			break;
			case 'PRODUCT_TYPE':
				$tblName = $this->config->item('tmst_scheme_det');
				$field = 'product_type';
			break;
			case 'UOM':
				$tblName = $this->config->item('tmst_scheme_det');
				$field = 'unit_code';
			break;
			case 'ANALYTE_BASE':
				$tblName = $this->config->item('tmst_scheme_det');
				$field = 'base';
			break;
			case 'ANALYTE_METHODE':
				$tblName = $this->config->item('tmst_scheme_det');
				$field = 'methode';
			break;
			case 'ROUND_TABLE':
				$tblName = $this->config->item('tmst_scheme_det');
				$field = 'rt_code';
			break;
			default:
				return 1;
			break;
			
		}

		$sSQL = "
			SELECT $field FROM $tblName WHERE $field = '$id' LIMIT 0,1
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
		$tbltypevar = $this->config->item('tmst_typevar');

		$sSQL = "
			SELECT MAX(p.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(id,5,5) AS UNSIGNED INTEGER) AS num
				FROM $tbltypevar
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

		$hasil = sprintf("CMPY%05d",$no_urut);

		return $hasil;	
	}
	
	public function MDL_getMax_OrderNumber() {
		$tbltypevar = $this->config->item('tmst_typevar');

		$id = $_REQUEST['table_name'];
		
		$sSQL = "
			SELECT MAX(tid) AS tid
			FROM $tbltypevar
			WHERE 1=1
				AND table_name = '$id'
			GROUP BY table_name
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			$data = $ambil->row();
			$hasil = $data->tid + 1;
		} else {
			$hasil = 1;
		}

		return $hasil;	
	}
	
}
?>