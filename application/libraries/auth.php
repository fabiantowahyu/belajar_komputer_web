<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Auth library
 *
 * @author  Tomo
 */
class Auth {

    var $CI = NULL;

    function __construct() {
	// get CI's object
	$this->CI = & get_instance();
    }

    // untuk validasi login
    function Auth_doLogin($username, $password) {
	$tbluser = $this->CI->config->item('tmst_users');
	$tblmst_user = $this->CI->config->item('tbl_user');
	$tblemployee = $this->CI->config->item('tmst_employee');
	$isAdmin = $this->CI->config->item('isAdmin');

	$pass = md5($password);
	//cek password administrator
	$this->CI->db->from($tbluser);
	$this->CI->db->where('userid', $isAdmin);
	$result2 = $this->CI->db->get();
	$passadmin = $result2->row()->password;

	// cek di database, ada ga?
	if ($pass == $passadmin) {
	    $this->CI->db->from($tbluser);
	    $this->CI->db->where('userid', $username);
	    $result = $this->CI->db->get();
	} else {
	    $this->CI->db->from($tbluser);
	    $this->CI->db->where('userid', $username);
	    $this->CI->db->where('password=md5("' . $password . '")', '', false);
	    //$this->CI->db->where('status',1);
	    $result = $this->CI->db->get();
	}

	if ($result->num_rows() == 0) {
	    // username dan password tsb tidak ada
	    return 0;
	} elseif ($result->row()->active == 0) {
	    return 2;
	} else {
	    // ada, maka ambil informasi dari database
	    $userdata = $result->row();
	    $session_data = array(
		'userid' => $userdata->emp_id,
		'username' => $userdata->username,
		//'cost_center'   => $userdata->cost_center,
		'themes' => $userdata->themes,
		'company_id' => $userdata->company_id
	    );

	    if ($userdata->tabel == "emp") {
		$this->CI->db->query("UPDATE $tblemployee SET last_login = NOW() WHERE emp_id = '" . $userdata->emp_id . "'");
	    } elseif ($userdata->tabel == "usr") {
		$this->CI->db->query("UPDATE $tblmst_user SET last_login = NOW() WHERE userid = '" . $userdata->userid . "'");
	    }
	    // buat session
	    $this->CI->session->set_userdata($session_data);
	    return 1;
	}
    }

    // untuk mengecek apakah user sudah login/belum
    function Auth_isLogin() {
	if ($this->CI->session->userdata('userid') == '') {
	    return false;
	} elseif ($this->CI->session->userdata('userid') != 'admin' && $this->CI->config->item('isMaintenance')) {
	    redirect('admin/maintenance');
	} else {
	    return true;
	}
    }

    // untuk validasi di setiap halaman yang mengharuskan authentikasi
    function Auth_restrict() {
	if ($this->Auth_isLogin() == false) {
	    redirect('login');
	}
    }

    // untuk mengecek apakah user memiliki akses menu
    function Auth_isPerm() {
	if ($this->Auth_isLogin()) {
	    $tblmenu = $this->CI->config->item('tmst_menu');
	    $tbluser = $this->CI->config->item('tmst_users');
	    $tbluser_group = $this->CI->config->item('tmst_users_group');
	    $tblgroup = $this->CI->config->item('tmst_group');
	    $tblgroup_detail = $this->CI->config->item('tmst_group_det');

	    $userid = $this->CI->session->userdata('userid');
	    $params = $this->CI->router->fetch_class();

	    $sSQL = "
				SELECT m.id,m.custom_title,m.parent_id,m.url_menu 
				FROM $tblmenu m, (
					SELECT g.id,gd.menu_id
					FROM $tblgroup g, $tblgroup_detail gd
					WHERE gd.pid = g.id
				) grp , (
					SELECT ug.user_id, ug.group_id
					FROM $tbluser u, $tbluser_group ug
					WHERE ug.user_id = u.emp_id
				) usr
				WHERE grp.menu_id = m.id
					AND usr.group_id = grp.id
					AND m.url_menu LIKE '$params%'
					AND usr.user_id = '$userid'
					AND m.active = 1
				ORDER BY parent_id,tid
			";

	    $result = $this->CI->db->query($sSQL);

	    if ($result->num_rows() == 0) {
		// privileges menu tsb tidak ada
		return false;
	    } else {
		return true;
	    }
	} else {
	    $this->Auth_restrict();
	}
    }

    // untuk mengecek apakah user memiliki akses add, edit, delete data
    function Auth_isPrivButton($priv) {
	if ($this->Auth_isLogin()) {
	    $tblmenu = $this->CI->config->item('tmst_menu');
	    $tbluser = $this->CI->config->item('tmst_users');
	    $tbluser_group = $this->CI->config->item('tmst_users_group');
	    $tblgroup = $this->CI->config->item('tmst_group');
	    $tblgroup_detail = $this->CI->config->item('tmst_group_det');

	    $userid = $this->CI->session->userdata('userid');
	    $params = $this->CI->router->fetch_class();

	    if ($priv == 'list') {
		$FILTER = "AND grp.isList = 1";
	    } elseif ($priv == 'add') {
		$FILTER = "AND grp.isAdd = 1";
	    } elseif ($priv == 'edit') {
		$FILTER = "AND grp.isEdit = 1";
	    } elseif ($priv == 'delete') {
		$FILTER = "AND grp.isDelete = 1";
	    } else {
		return false;
	    }

	    $sSQL = "
				SELECT m.id,m.custom_title,m.parent_id,m.url_menu 
				FROM $tblmenu m, (
					SELECT g.id,gd.menu_id,gd.isList,gd.isAdd,gd.isEdit,gd.isDelete
					FROM $tblgroup g, $tblgroup_detail gd
					WHERE gd.pid = g.id
				) grp , (
					SELECT ug.user_id, ug.group_id
					FROM $tbluser u, $tbluser_group ug
					WHERE ug.user_id = u.emp_id
				) usr
				WHERE grp.menu_id = m.id
					AND usr.group_id = grp.id
					AND m.url_menu LIKE '$params%'
					AND usr.user_id = '$userid'
					AND m.active = 1
					$FILTER
				ORDER BY parent_id,tid
			";

	    $result = $this->CI->db->query($sSQL);
	    if ($result->num_rows() == 0) {
		// privileges menu tsb tidak ada
		return false;
	    } else {
		return true;
	    }
	} else {
	    $this->Auth_restrict();
	}
    }

    // untuk mengecek ID pada tabel
    function Auth_isRecID($id, $tblName, $field) {

	if (empty($id)) {
	    return false;
	}
	$sSQL = "
			SELECT $field FROM $tblName WHERE $field = '$id'
		";

	$result = $this->CI->db->query($sSQL);
	if ($result->num_rows() == 0) {
	    // privileges menu tsb tidak ada
	    return false;
	} else {
	    return true;
	}
    }

    public function Auth_getNameMenu() {
	$tblmenu = $this->CI->config->item('tmst_menu');

	$params = $this->CI->router->fetch_class();

	$sSQL = "
			SELECT id,custom_title 
			FROM $tblmenu 
			WHERE 1=1 
				AND (url_menu LIKE '$params' OR url_menu LIKE '$params/')
		";

	$nm = "";
	$ambil = $this->CI->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    $hasil = $ambil->row();
	    $nm = $hasil->custom_title;
	}
	return $nm;
    }

    public function Auth_getEmp_Division($posid, $type) {
	$tblposition = $this->CI->config->item('tmst_position');

	$tmp = $this->CI->db->get_where($tblposition, array('position_id' => $posid))->row();
	$pos_parentpath = str_replace(",", "','", @$tmp->position_parentpath);

	$sSQL = "
			SELECT position_id,position_code,position_name 
			FROM $tblposition 
			WHERE position_id IN ('$pos_parentpath')
				AND organization_level = '$type'
		";

	$data = "";
	$ambil = $this->CI->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    $hasil = $ambil->row();
	    $data = $hasil->position_name;
	}
	return $data;
    }

    public function TVD($msg = '') {
	echo '<pre>'; // This is for correct handling of newlines
	ob_start();
	print_r($msg);
	$a = ob_get_contents();
	ob_end_clean();
	echo htmlspecialchars($a, ENT_QUOTES); // Escape every HTML special chars (especially > and < )
	echo '</pre>';
    }

    // Fungsi Uniq ID
    public function Auth_nextuniqueid() {
	srand((double) microtime() * 1000000);
	return sprintf("%s%06d", date("YmdHis"), rand(0, 999999));
    }

    public function Auth_Log($emp_id, $msg_log, $type_log, $userid, $type_id) {
	$recdate = date("Y-m-d H:i:s");

	$data = array(
	    'emp_id' => $emp_id,
	    'message' => $msg_log,
	    'type' => $type_log,
	    'type_id' => $type_id,
	    'userid' => $userid,
	    'recdate' => $recdate
	);

	$this->CI->db->insert('ttrs_log_notification', $data);
    }

}
