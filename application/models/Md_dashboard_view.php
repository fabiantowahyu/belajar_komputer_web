<?php
class Md_dashboard_view extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select_View() {
		$this->db->from('tmst_view_dashboard');
		$result = $this->db->get();

		return $result->result();
	}

	public function MDL_Select_View_Previlege($group_id, $view_id){
		$this->db->from("tmst_previlege");
		$this->db->where("group_id", $group_id);
		$this->db->where("view_id", $view_id);
		$result = $this->db->get()->result();

		return reset($result);
	}

	public function MDL_Select_View_ID($group_id, $position = FALSE){
		$this->db->select('view_name');
		$this->db->select('view_title');
		$this->db->select('tmst_previlege.id previlege_id');
		$this->db->from('tmst_previlege');
		$this->db->join('tmst_view_dashboard', 'tmst_view_dashboard.id = tmst_previlege.view_id');
		$this->db->where('group_id', $group_id);
		$this->db->where('position', $position);
		$result = $this->db->get();

		return $result->result();
	}

	public function MDL_Insert_New_View($data){
		$response = $this->db->insert("tmst_view_dashboard", $data);
		return $response;
	}

	public function MDL_Insert_Previlege($data){
		$response = $this->db->insert("tmst_previlege", $data);
		return $response;
	}

	public function MDL_Update_Previlege($group_id, $view_id, $status){
		$data = array(
			'status' => $status
		);

		$this->db->where("group_id", $group_id);
		$this->db->where("view_id", $view_id);
		$response = $this->db->update("tmst_previlege", $data);

		return $response;
	}

	public function MDL_DeletePrevilege($id){
    	$this->db->where('id', $id);
    	$response = $this->db->delete('tmst_previlege');
    	return $response;
    }
}