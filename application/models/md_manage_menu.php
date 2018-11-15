<?php
class Md_manage_menu extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tblmenu = $this->config->item('tmst_menu');

		$hasil = array();
		//$ambil = $this->db->get('kota');

		$sSQL = "
			SELECT m.id, det.custom_title as parentt, m.custom_title, m.tid,IF(m.active=1,'Active','Not Active') as active, m.url_menu 
			FROM $tblmenu m LEFT JOIN $tblmenu det ON det.id = m.parent_id
			WHERE 1=1
			ORDER BY m.parent_id,m.tid
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
		$tblmenu = $this->config->item('tmst_menu');

		$offset = ($page-1)*$rows;  
  
		$hasil = array(); 
		$tmpData = array(); 
		
		$FILTER = strlen($item) ? "AND (p.custom_title LIKE '%$item%' OR p.url_menu LIKE '%$item%')" : "";  

		$sSQL = "
			SELECT count(*) as jum
			FROM (
				SELECT m.id, det.custom_title as parentt, m.custom_title, m.tid,IF(m.active=1,'Active','Not Active') as active, m.url_menu 
				FROM $tblmenu m LEFT JOIN $tblmenu det ON det.id = m.parent_id
				WHERE 1=1
			) p
			WHERE 1=1
				$FILTER
		";
		$rs = $this->db->query($sSQL);
		$row = $rs->row();  
		$hasil["total"] = $row->jum;  

		$sSQL = "
			SELECT p.*
			FROM (
				SELECT m.id, det.custom_title as parentt, m.custom_title, m.tid,IF(m.active=1,'Active','Not Active') as active, m.url_menu 
				FROM $tblmenu m LEFT JOIN $tblmenu det ON det.id = m.parent_id
				WHERE 1=1
			) p
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

		$hasil["rows"] = $tmpData;  

		return $hasil;	
	}

	public function MDL_getDataParent() {
		$tblmenu = $this->config->item('tmst_menu');

		$hasil = array();
		//$ambil = $this->db->get('menu');
		$sSQL = "
			SELECT id,parent_id as parentt,custom_title,url_menu FROM $tblmenu
			WHERE 1=1
			ORDER BY parent_id,tid
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
		$tblmenu = $this->config->item('tmst_menu');

        return $this->db->get_where($tblmenu, array('id' => $id))->row();
    }

	// Fungsi Tambah Data
	public function MDL_Insert() {
		$tblmenu = $this->config->item('tmst_menu');
		
		$id = $this->MDL_nextuniqueid();
		$parent_id = $this->input->post('parent_id');
		$custom_title = $this->input->post('custom_title');
		$tid = $this->input->post('tid');
		$active = $this->input->post('active');
		$url_menu = $this->input->post('url_menu');
		$path_icon = $this->input->post('path_icon');
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'id' => $id,
			'custom_title' => $custom_title,
			'parent_id' => $parent_id,
			'tid' => $tid,
			'active' => $active,
			'url_menu' => $url_menu,
			'path_icon' => $path_icon,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
			);
		$res = $this->db->insert($tblmenu, $data);
		if($res) {
			//Update Order Number
			$sSQL = "
				SELECT id, tid
				FROM $tblmenu
				WHERE 1=1
					AND id <> '$id'
					AND parent_id = '$parent_id'
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
					$this->db->update($tblmenu, $data);
				}
			} 
		}
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tblmenu = $this->config->item('tmst_menu');

		$parent_id = $this->input->post('parent_id');
		$custom_title = $this->input->post('custom_title');
		$tid = $this->input->post('tid');
		$active = $this->input->post('active');
		$url_menu = $this->input->post('url_menu');
		$path_icon = $this->input->post('path_icon');
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		$data = array(
			'custom_title' => $custom_title,
			'parent_id' => $parent_id,
			'tid' => $tid,
			'active' => $active,
			'url_menu' => $url_menu,
			'path_icon' => $path_icon,
			'moduser' => $moduser,
			'moddate' => $moddate
			);

        $this->db->where('id', $id);
        $res = $this->db->update($tblmenu, $data);
		if($res) {
			//Update Order Number
			$sSQL = "
				SELECT id, tid
				FROM $tblmenu
				WHERE 1=1
					AND id <> '$id'
					AND parent_id = '$parent_id'
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
					$this->db->update($tblmenu, $data);
				}
			} 
		}
    }

	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$tblmenu = $this->config->item('tmst_menu');

		$this->db->delete($tblmenu, array('id' => $id));
	}

	// Fungsi Uniq ID
	public function MDL_nextuniqueid() {
		srand((double)microtime()*1000000);
		return sprintf("%s%06d",date("YmdHis"),rand(0, 999999));
	}

	public function MDL_isPermDelete($id){
		$tblName = $this->config->item('tmst_group_det');

		//$res = $this->db->get_where($tblName, array('empstatus_id' => $id))->num_rows();
		$sSQL = "
			SELECT menu_id FROM $tblName WHERE menu_id = '$id' LIMIT 0,1
		";

		$ambil = $this->db->query($sSQL);
		$res = $ambil->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }

	public function MDL_getMax_OrderNumber() {
		$tblmenu = $this->config->item('tmst_menu');

		$id = $_REQUEST['parent_id'];
		
		$sSQL = "
			SELECT MAX(tid) AS tid
			FROM $tblmenu
			WHERE 1=1
				AND parent_id = '$id'
			GROUP BY parent_id
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