<?php
class Md_ref_json extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select_MasterType($type) {
		$tbltypevar = $this->config->item('tmst_typevar');

		$hasil = array();
		switch($type) {
			case 'COMP_TYPE':
				$FILTER = 'COMPANY_TYPE';
			break;
			default:
				$FILTER = $type;
			break;
		}
		
		$sSQL = "
			SELECT id, name 
			FROM $tbltypevar 
			WHERE 1=1 
				AND table_name = '$FILTER'
			ORDER BY tid, name
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}
		}
		return $hasil;	
	}

	public function MDL_SelectMenu($params){
		$tblmenu = $this->config->item('tmst_menu');

        $sSQL = "
			SELECT m.id, det.custom_title as parentt, m.custom_title, m.url_menu , det.path_icon ,m.path_icon as icon_parent 
			FROM $tblmenu m LEFT JOIN $tblmenu det ON det.id = m.parent_id
			WHERE 1=1
				AND m.url_menu LIKE '$params%'
		";
		
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			$hasil = $ambil->row();
		}
		return $hasil;
    }
}
?>