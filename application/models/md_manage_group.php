<?php

class Md_manage_group extends CI_Model {

    // Fungsi Ambil Data
    public function MDL_Select() {
	$tblgroup = $this->config->item('tmst_group');

	$hasil = array();
	//$ambil = $this->db->get('kota');

	$sSQL = "
			SELECT id, nama, description, IF(active=1,'Active','Not Active') as active FROM $tblgroup WHERE 1=1 ORDER BY id
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[] = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Select_UserID($userid) {
	$this->db->select('group_id');
	$this->db->from('tmst_users_group');
	$this->db->where('user_id', $userid);
	$result = $this->db->get()->result();

	//echo $this->db->last_query();die();
	return reset($result);
    }

    public function MDL_Select_DGtabel($page, $rows, $sort, $order, $item) {
	$tblgroup = $this->config->item('tmst_group');

	$offset = ($page - 1) * $rows;

	$hasil = array();
	$tmpData = array();

	$FILTER = strlen($item) ? "AND (id LIKE '%$item%' OR nama LIKE '%$item%')" : "";
	$rs = $this->db->query("SELECT count(*) as jum FROM $tblgroup WHERE 1=1 $FILTER");
	$row = $rs->row();
	$hasil["total"] = $row->jum;

	$sSQL = "
			SELECT id, nama FROM $tblgroup 
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

    public function MDL_SelectDetail($pid) {
	$tblgroup_det = $this->config->item('tmst_group_det');

	$hasil = array();
	$this->db->where('pid', $pid);
	$ambil = $this->db->get($tblgroup_det);

	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[$data->menu_id]['isList'] = $data->isList;
		$hasil[$data->menu_id]['isAdd'] = $data->isAdd;
		$hasil[$data->menu_id]['isEdit'] = $data->isEdit;
		$hasil[$data->menu_id]['isDelete'] = $data->isDelete;
	    }
	}

	return $hasil;
    }

    public function MDL_SelectMenuParent() {
	$tblmenu = $this->config->item('tmst_menu');

	$hasil = array();
	$this->db->where('parent_id', '');
	$ambil = $this->db->get($tblmenu);

	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[$data->id] = $data->id;
	    }
	}

	return $hasil;
    }

    public function MDL_Select_NotMember($gid, $item = '') {
	$tbluser = $this->config->item('tmst_users');
	$tbluser_group = $this->config->item('tmst_users_group');

	$hasil = array();

	$FILTER = strlen($item) ? "AND (username LIKE '%$item%')" : "";

	$sSQL = "
			SELECT emp_id as userid, username
			FROM $tbluser
			WHERE 1=1
				AND emp_id NOT IN (
					SELECT user_id
					FROM $tbluser_group
					WHERE group_id = '$gid'
				)
				$FILTER
			ORDER BY username
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[] = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Select_Member($gid, $item = '') {
	$tbluser = $this->config->item('tmst_users');
	$tbluser_group = $this->config->item('tmst_users_group');

	$hasil = array();

	$FILTER = strlen($item) ? "AND (username LIKE '%$item%')" : "";

	$sSQL = "
			SELECT emp_id as userid, username
			FROM $tbluser
			WHERE 1=1
				AND emp_id IN (
					SELECT user_id
					FROM $tbluser_group
					WHERE group_id = '$gid'
				)
				$FILTER
			ORDER BY username
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[] = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Select_UserGroup($gid) {
	$tbluser_group = $this->config->item('tmst_users_group');

	$hasil = array();

	$sSQL = "
			SELECT id, user_id
			FROM $tbluser_group
			WHERE group_id = '$gid'
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[$data->user_id] = $data->id;
	    }
	}
	return $hasil;
    }

    public function MDL_SelectID($id) {
	$tblgroup = $this->config->item('tmst_group');

	return $this->db->get_where($tblgroup, array('id' => $id))->row();
    }

    // Fungsi Tambah Data
    public function MDL_Insert() {
	$tblgroup = $this->config->item('tmst_group');

	$nama = $this->input->post('nama');
	$description = $this->input->post('description');
	$active = $this->input->post('active');
	$userid = $this->session->userdata('userid');
	$recdate = date("Y-m-d H:i:s");
	$moduser = $this->session->userdata('userid');
	$moddate = date("Y-m-d H:i:s");
	$data = array(
	    'nama' => $nama,
	    'description' => $description,
	    'active' => $active,
	    'userid' => $userid,
	    'recdate' => $recdate,
	    'moduser' => $moduser,
	    'moddate' => $moddate
	);
	$this->db->insert($tblgroup, $data);
    }

    // Fungsi Tambah Data Privileges
    public function MDL_InsertPriv_Menu() {
	$tblgroup_det = $this->config->item('tmst_group_det');
	$tblmenu = $this->config->item('tmst_menu');

	$aryrows = $this->input->post();

	unset($aryrows['pid']);
	unset($aryrows['submit']);
	unset($aryrows['frmChk_all']);

	$AryData = array();
	while (list($k, $v) = @each($aryrows)) {
	    list($aa, $menu_id) = @explode("_", $k);
	    $AryData[$aa][$menu_id] = $v;
	}

	//$all = $this->input->post('menu_id_all');
	$pid = $this->input->post('pid');
	$userid = $this->session->userdata('userid');
	$recdate = date("Y-m-d H:i:s");
	$moduser = $this->session->userdata('userid');
	$moddate = date("Y-m-d H:i:s");

	// Delete Data yang lama
	$this->db->delete($tblgroup_det, array('pid' => $pid));

	//Insert Data yang baru
	while (list($k, $menu_id) = @each($AryData['frmChk'])) {

	    //Cek Menu Access
	    $Access = $AryData['frmRdo'][$k];
	    if ($Access == 'delete') {
		$isList = 1;
		$isAdd = 1;
		$isEdit = 1;
		$isDelete = 1;
	    } elseif ($Access == 'edit') {
		$isList = 1;
		$isAdd = 1;
		$isEdit = 1;
		$isDelete = 0;
	    } elseif ($Access == 'add') {
		$isList = 1;
		$isAdd = 1;
		$isEdit = 0;
		$isDelete = 0;
	    } else {
		$isList = 1;
		$isAdd = 0;
		$isEdit = 0;
		$isDelete = 0;
	    }


	    $data = array(
		'pid' => $pid,
		'menu_id' => $menu_id,
		'isList' => $isList,
		'isAdd' => $isAdd,
		'isEdit' => $isEdit,
		'isDelete' => $isDelete,
		'userid' => $userid,
		'recdate' => $recdate,
		'moduser' => $moduser,
		'moddate' => $moddate
	    );
	    $this->db->insert($tblgroup_det, $data);
	}
    }

    public function MDL_InsertPriv_User() {
	$tblusers_group = $this->config->item('tmst_users_group');

	$pid = $this->input->post('pid');
	$AryData = @explode(",", $this->input->post('selMember_value'));

	$userid = $this->session->userdata('userid');
	$recdate = date("Y-m-d H:i:s");
	$moduser = $this->session->userdata('userid');
	$moddate = date("Y-m-d H:i:s");


	//Insert & Update Data yang baru
	$AryDel = array();
	$AryMember = $this->MDL_Select_UserGroup($pid);

	$AryDel = $AryMember;
	while (list($k, $v) = @each($AryData)) {
	    if (isset($AryMember[$v])) {
		$id = $AryMember[$v];

		$data = array(
		    'user_id' => $v,
		    'group_id' => $pid,
		    'moduser' => $moduser,
		    'moddate' => $moddate
		);
		$this->db->where('id', $id);
		$this->db->update($tblusers_group, $data);

		unset($AryDel[$v]);
	    } elseif (strlen($v)) {
		$data = array(
		    'user_id' => $v,
		    'group_id' => $pid,
		    'recdate' => $recdate,
		    'moduser' => $moduser,
		    'moddate' => $moddate
		);
		$this->db->insert($tblusers_group, $data);
	    }
	}

	//Delete Data Not Member
	while (list($k, $v) = @each($AryDel)) {
	    $this->db->delete($tblusers_group, array('id' => $v));
	}
    }

    // Fungsi Ubah Data
    public function MDL_Update($id) {
	$tblgroup = $this->config->item('tmst_group');

	//$id = $this->input->post('id');
	$nama = $this->input->post('nama');
	$description = $this->input->post('description');
	$active = $this->input->post('active');
	$moduser = $this->session->userdata('userid');
	$moddate = date("Y-m-d H:i:s");
	$data = array(
	    'nama' => $nama,
	    'description' => $description,
	    'active' => $active,
	    'moduser' => $moduser,
	    'moddate' => $moddate
	);

	$this->db->where('id', $id);
	$this->db->update($tblgroup, $data);
    }

    // Fungsi Hapus Data
    public function MDL_Delete($id) {
	$tblgroup = $this->config->item('tmst_group');
	$tblgroup_det = $this->config->item('tmst_group_det');

	$this->db->delete($tblgroup, array('id' => $id));
	$this->db->delete($tblgroup_det, array('pid' => $id));
    }

    // Fungsi Uniq ID
    public function MDL_nextuniqueid() {
	srand((double) microtime() * 1000000);
	return sprintf("%s%06d", date("YmdHis"), rand(0, 999999));
    }

    public function MDL_isPermInsert($id) {
	$tblName = $this->config->item('tmst_group');

	$res = $this->db->get_where($tblName, array('id' => $id))->num_rows();

	if ($res) {
	    return 0;
	} else {
	    return 1;
	}
    }

    public function MDL_isPermDelete($id) {
	$tblName = $this->config->item('tmst_users_group');

	//$res = $this->db->get_where($tblName, array('empstatus_id' => $id))->num_rows();
	$sSQL = "
			SELECT group_id FROM $tblName WHERE group_id = '$id' LIMIT 0,1
		";

	$ambil = $this->db->query($sSQL);
	$res = $ambil->num_rows();

	if ($res) {
	    return 0;
	} else {
	    return 1;
	}
    }

}

?>