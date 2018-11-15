<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
	parent::__construct();
	$this->load->model('md_admin');
	$this->load->model('md_manage_group');
	$this->load->model('md_dashboard_view');
    }

    public function index() {
	if ($this->auth->Auth_isPerm()) {

	    /* Bread crum */
	    $id = $this->session->userdata('userid');
	    $this->load->model('md_ref_json');
	    $params = $this->router->fetch_class();
	    $hasil = $this->md_ref_json->MDL_SelectMenu($params);
	    $parentt = $hasil->parentt;
	    $nm_menu = $hasil->custom_title;
	    $path_icon = $hasil->path_icon;
	    $this->breadcrumbs->add($parentt, '#', $path_icon);
	    $this->breadcrumbs->add($nm_menu, base_url());
	    //$this->breadcrumbs->add('Spring Tutorial', base_url().'tutorials/spring-tutorials');
	    $breadcrum = $this->breadcrumbs->output();
	    /* end */

	    $this->load->model('md_manage_user');
	    $AryData = $this->md_manage_user->MDL_Select_Userdata($this->session->userdata('userid'));

	    $result_company = $this->md_admin->MDL_Select_Company();
	    $data['company_name'] = $result_company->company_name;
	    $data['vission'] = $result_company->vission;
	    $data['mission'] = $result_company->mission;
	    // This month
	    $req_startdate = date("Y-m-01");
	    $req_enddate = date("Y-m-t");
	    $req_month = date("m");

	    // This year
	    $req_startyear = date("Y-01-01");
	    $req_endyear = date("Y-12-t");

	    // Last month
	    $last_startdate = date("Y-m-01", strtotime("-1 month"));
	    $last_enddate = date("Y-m-t", strtotime("-1 month"));

	    // 3 Last month
	    $last_threemonth = date("m", strtotime("-2 month"));

	    $data['userid'] = $this->session->userdata('userid');
	    $data['username'] = $this->session->userdata('username');

	    //Portal Personal Information
	    $hasil = $this->md_admin->MDL_SelectID_Employee($id);
	    $data['emp_id'] = $hasil->emp_id;
	    $data['emp_name'] = $hasil->emp_name;
	    $data['position_name'] = $hasil->position_name;
	    $data['join_date'] = date("d M Y", strtotime($hasil->join_date));
	    $data['hp'] = $hasil->hp;
	    $data['photo'] = $hasil->photo;
	    $data['signature'] = $hasil->signature;
	    $data['branch'] = $hasil->branch;
	    $data['email'] = $hasil->email;
	    $data['birth_place'] = $hasil->birth_place;
	    $data['birth_date'] = date("d M Y", strtotime($hasil->birth_date));
	    $data['address1'] = $hasil->address1;
	    $data['phone1'] = $hasil->phone1;
	    $data['mobile_phone1'] = $hasil->mobile_phone1;
	    $data['company_name'] = $hasil->company_name;

	    $data['user_access'] = $this->md_admin->MDL_GetGroupID($data['userid']);

	    $data['group'] = $this->md_manage_group->MDL_Select();
	    $data['dashboard_view'] = $this->md_dashboard_view->MDL_Select_View();
	    $data['active_group'] = $this->session->userdata('active_group') ? $this->session->userdata('active_group') : '1';
	    $data['active_view_left'] = $this->md_dashboard_view->MDL_Select_View_ID($data['active_group'], "L");
	    $data['active_view_right'] = $this->md_dashboard_view->MDL_Select_View_ID($data['active_group'], "R");

	    $user_group = $this->md_manage_group->MDL_Select_UserID($data['userid']);
	    $data['user_group'] = $user_group->group_id;

	    $data['dashboard_left'] = $this->md_dashboard_view->MDL_Select_View_ID($data['user_group'], "L");
	    $data['dashboard_right'] = $this->md_dashboard_view->MDL_Select_View_ID($data['user_group'], "R");

	    $file_name = $hasil->photo;
	    if (strlen($file_name)) {
		$ary = @explode(".", $file_name);
		$type = $ary[count($ary) - 1];
		$data['file_name'] = sprintf("file_upload/avatar/%s.%s", $id, $type);
	    } else {
		$data['file_name'] = sprintf("file_upload/avatar/no_photo.jpg");
	    }
	    $file_signature = $hasil->signature;
	    if (strlen($file_signature)) {
		$ary = @explode(".", $file_signature);
		$type = $ary[count($ary) - 1];
		$data['file_signature'] = sprintf("file_upload/signature/%s.%s", $id, $type);
	    } else {
		$data['file_signature'] = sprintf("file_upload/signature/no_photo.jpg");
	    }
	    // End
	    // Reminder
	    $hasil = $this->md_admin->MDL_NewEmployee($req_startdate, $req_enddate); // New Employee
	    $data['total_newemployee'] = $hasil->total_newEmployee;

	    $hasil = $this->md_admin->MDL_ReceivedCheers();
	    $data['total_cheers_received'] = $hasil->total_cheers_received;

	    $hasil = $this->md_admin->MDL_CountIdea('approved');
	    $data['total_ideas_approved'] = $hasil->total_ideas;

	    $hasil = $this->md_admin->MDL_CountIdea();
	    $data['total_ideas'] = $hasil->total_ideas;

	    $hasil = $this->md_admin->MDL_TotalCheersSent();
	    $data['total_cheers_sent'] = $hasil->total_cheers_sent;


	    $data['url_view_ideas'] = sprintf("%sideas/", site_url());
	    $data['url_view_cheers'] = sprintf("%scheers_for_peers/", site_url());

	    $data['group'] = $AryData['group'];
	    $data['breadcrum'] = $breadcrum;
	    $data['page'] = 'Home/view';
	    $data['plugin'] = 'Home/plugin';
	    $this->load->view('template_admin', $data);
	} else {
	    $this->load->view('error_akses');
	}
    }

    public function CTRL_ViewPortal() {
	if (!$this->auth->Auth_isPerm()) {
	    $this->load->view('error_akses');
	} else {
	    $nm_title = $this->auth->Auth_getNameMenu();
	    $data['title_head'] = sprintf("%s - Personal Information", $nm_title);
	    $data['title'] = sprintf("%s", $nm_title);

	    $this->load->model('md_sales_order');
	    $data['results_so'] = $this->md_sales_order->MDL_Select($req_startdate, $req_enddate);

	    $data['url'] = 'admin/CTRL_ViewPortal';
	    $data['page'] = 'Home/view_portal';
	    $data['plugin'] = 'Home/plugin';
	    $this->load->view('template_popupwindow', $data);
	}
    }

    public function CTRL_ViewNewEmployee() {
	if (!$this->auth->Auth_isPerm()) {
	    $this->load->view('error_akses');
	} else {
	    $nm_title = $this->auth->Auth_getNameMenu();
	    $data['title_head'] = sprintf("%s - New Employee This Month", $nm_title);
	    $data['title'] = sprintf("%s", $nm_title);

	    $req_startdate = date("Y-m-01");
	    $req_enddate = date("Y-m-t");

	    $data['results_newemployee'] = $this->md_admin->MDL_Detail_NewEmployee($req_startdate, $req_enddate);

	    $data['url'] = 'admin/CTRL_ViewNewEmployee';
	    $data['page'] = 'Home/view_newemployee';
	    $data['plugin'] = 'Home/plugin';
	    $this->load->view('template_popupwindow', $data);
	}
    }

    public function CTRL_ViewBirthday() {
	if (!$this->auth->Auth_isPerm()) {
	    $this->load->view('error_akses');
	} else {
	    $nm_title = $this->auth->Auth_getNameMenu();
	    $data['title_head'] = sprintf("%s - Employee Birthday This Month", $nm_title);
	    $data['title'] = sprintf("%s", $nm_title);

	    $req_month = date("m");

	    $data['results_birthday'] = $this->md_admin->MDL_Detail_EmpBirthday($req_month);

	    $data['url'] = 'admin/CTRL_ViewBirthday';
	    $data['page'] = 'Home/view_birthday';
	    $data['plugin'] = 'Home/plugin';
	    $this->load->view('template_popupwindow', $data);
	}
    }

    public function CTRL_ViewPension() {
	if (!$this->auth->Auth_isPerm()) {
	    $this->load->view('error_akses');
	} else {
	    $nm_title = $this->auth->Auth_getNameMenu();
	    $data['title_head'] = sprintf("%s - Employee Pension Within 3 Month", $nm_title);
	    $data['title'] = sprintf("%s", $nm_title);

	    $data['results_pension'] = $this->md_admin->MDL_Detail_EmpPension();

	    $data['url'] = 'admin/CTRL_ViewPension';
	    $data['page'] = 'Home/view_pension';
	    $data['plugin'] = 'Home/plugin';
	    $this->load->view('template_popupwindow', $data);
	}
    }

    public function maintenance() {
	$this->load->view('maintenance');
    }

    public function Update_Isread($id) {
	$res = $this->md_admin->MDL_Update_Log_Status($id);

	echo json_encode($res);
    }

}
