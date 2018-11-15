<?php

class Md_admin extends CI_Model {

    public function MDL_Select_Company() {
	$tbl_company = $this->config->item('tmst_company');

	$sSQL = "		
			SELECT CONCAT(a.type,' ',a.name) as company_name,a.vission,a.mission
			FROM $tbl_company a
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    // Fungsi Ambil Data
    public function MDL_Total_Approval() {
	$tbl_approvedby = $this->config->item('ttrs_approvedby');
	$tbl_user = $this->config->item('tmst_users');

	$userid = $this->session->userdata('userid');
	//$hasil = array();
	$sSQL = "	
			Select count(*) as jumlah_approval
			FROM $tbl_approvedby	
			WHERE approved_by = '$userid'
			AND status NOT IN ('3','4') 
		";
	//var_dump($sSQL); exit();
	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Total_Approval_Ideas() {
	$tbl_ideas = $this->config->item('ttrs_ideas');
	$tbl_ideas_approval = $this->config->item('ttrs_ideas_approval');

	//$userid = $this->session->userdata('userid');
	//$hasil = array();
	$sSQL = "	
			select count(a.id) as jumlah_approval 
                        from $tbl_ideas a 
                            left join $tbl_ideas_approval b
                        on a.id=b.ideas_id
                        where b.status='2'
		";

	//var_dump($sSQL); exit();
	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Total_Approval_Leave() {
	$tbl_approvedby = $this->config->item('ttrs_approvedby');
	$tbl_user = $this->config->item('tmst_users');

	$userid = $this->session->userdata('userid');
	//$hasil = array();
	$sSQL = "	
			Select count(*) as jumlah_approval
			FROM $tbl_approvedby	
			WHERE approved_by = '$userid'
			AND status NOT IN ('3','4') 
			AND requestapproval_id ='1'
		";

	//var_dump($sSQL); exit();
	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Total_Approval_Permit() {
	$tbl_approvedby = $this->config->item('ttrs_approvedby');
	$tbl_user = $this->config->item('tmst_users');

	$userid = $this->session->userdata('userid');
	//$hasil = array();
	$sSQL = "	
			Select count(*) as jumlah_approval
			FROM $tbl_approvedby	
			WHERE approved_by = '$userid'
			AND status NOT IN ('3','4') 
			AND requestapproval_id ='2'
		";

	//var_dump($sSQL); exit();
	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Total_Approval_Sickness() {
	$tbl_approvedby = $this->config->item('ttrs_approvedby');
	$tbl_user = $this->config->item('tmst_users');

	$userid = $this->session->userdata('userid');
	//$hasil = array();
	$sSQL = "	
			Select count(*) as jumlah_approval
			FROM $tbl_approvedby	
			WHERE approved_by = '$userid'
			AND status NOT IN ('3','4') 
			AND requestapproval_id ='3'
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    // Total Karyawan Baru Bulan ini..
    public function MDL_NewEmployee($start_date, $end_date) {
	$tblemployee = $this->config->item('tmst_employee');

	//$hasil = array();
	$sSQL = "	
			Select count(a.emp_id) as total_newEmployee
			FROM $tblemployee a
			WHERE a.join_date >= '$start_date'
				AND a.join_date <= '$end_date'
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Detail_NewEmployee($start_date, $end_date) {
	$tblemployee = $this->config->item('tmst_employee');
	$tblposition = $this->config->item('tmst_position');

	$hasil = array();

	$sSQL = "		
			Select a.emp_id,CONCAT(a.first_name,' ',a.middle_name,' ',a.last_name) as emp_name,a.join_date, b.position_name
			FROM $tblemployee a , $tblposition b
			WHERE a.join_date >= '$start_date'
				AND a.join_date <= '$end_date'
				AND a.position_id = b.position_id
			ORDER BY a.emp_id ASC
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[] = $data;
	    }
	}

	return $hasil;
    }

    public function MDL_ReceivedCheers() {
	$tblcheers = $this->config->item('ttrs_cheers_for_peers');
	$userid = $this->session->userdata('userid');
	$sSQL = "	
			Select count(a.id) as total_cheers_received
			FROM $tblcheers a
			WHERE 1=1
				AND to_peers='$userid'
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_CountIdea($type = '') {
	$tblideas = $this->config->item('ttrs_ideas');
	$tblideas_approval = $this->config->item('ttrs_ideas_approval');
	$userid = $this->session->userdata('userid');

	if ($type == 'approved') {
	    $AND = "and b.status='3'";
	} else {
	    $AND = "";
	}

	$sSQL = "	
			Select count(a.id) as total_ideas
			FROM $tblideas a
			left join $tblideas_approval b
	on a.id=b.ideas_id
			WHERE 1=1
				AND a.userid='$userid'
				$AND
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_CountUnfinishedSelf($type = '') {
	$tblpmperiod = $this->config->item('tmst_pmperiod');
	$tblpmperiod_detail = $this->config->item('tmst_pmperiod_detail');
	$tblpa = $this->config->item('ttrs_pa');


	$userid = $this->session->userdata('userid');



	$sSQL = "
                    select count(b.pid) as total 
                    from $tblpmperiod a
                    left join $tblpmperiod_detail b

                    on a.id= b.pid

                    left join $tblpa c
                    on  c.pmperiod_id=b.pid and b.emp_id=c.emp_id

                    where b.emp_id='$userid' 
                    and (c.status_self is null or c.status_self='1')
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_CountUnfinishedRequest($type = '') {
	$tblpa = $this->config->item('ttrs_pa');
	$tblpa_detail = $this->config->item('ttrs_pa_detail');
	$tblpa_setup_peers_detail = $this->config->item('tmst_pa_setup_peers_detail');
	$tblpa_setup_peers = $this->config->item('tmst_pa_setup_peers');

	$userid = $this->session->userdata('userid');



	$sSQL = "
                    select count(c.emp_id) as total 
                    from $tblpa_setup_peers_detail a  
                    left join $tblpa_setup_peers b
                    on a.id_peers=b.id
                    left join $tblpa d
                     on b.emp_id=d.emp_id 
                    left join $tblpa_detail c
                    on a.emp_id=c.emp_id  and   d.id=c.pa_id  
                              


                    where a.emp_id='$userid' 
                     and d.status_self='2' and (d.status_peers='0' or d.status_peers='1')
	and c.pa_type='peers' and (c.finish='0' or c.finish='1') 
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_CountUnfinishedRequestReviewer() {
	$tbldirect_selection_detail = $this->config->item('tmst_direct_selection_detail');
	$tbldirect_selection = $this->config->item('tmst_direct_selection');
	$tblpa_detail = $this->config->item('ttrs_pa_detail');

	$tblpa = $this->config->item('ttrs_pa');

	$userid = $this->session->userdata('userid');



	$sSQL = "
                   select count(c.id) as total 
                   from $tbldirect_selection_detail a

                    left join $tbldirect_selection b
                    on  b.id=a.dselection_id
                    left join $tblpa c 
                        on  c.emp_id=b.emp_id_subordinate
                        left join $tblpa_detail d 
                        on  a.emp_id_superior=d.emp_id

                    where a.emp_id_superior='$userid' and c.id=d.pa_id
                          
                    and c.status_self='2' and (c.status_reviewer='0' or c.status_reviewer='1')
                    and (d.finish='0' or d.finish='1') and pa_type='reviewer'

		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Detail_EmpBirthday($thismonth) {
	$tblemployee = $this->config->item('tmst_employee');
	$tblposition = $this->config->item('tmst_position');

	$hasil = array();

	$sSQL = "		
			Select a.emp_id,CONCAT(a.first_name,' ',a.middle_name,' ',a.last_name) as emp_name,a.birth_date, b.position_name
			FROM $tblemployee a , $tblposition b
			WHERE MONTH(a.birth_date) >= '$thismonth'
				AND a.position_id = b.position_id
			ORDER BY a.emp_id ASC
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[] = $data;
	    }
	}

	return $hasil;
    }

    // Total Employee Pension this Month
    public function MDL_TotalCheersSent() {
	$tblcheers = $this->config->item('ttrs_cheers_for_peers');

	$userid = $this->session->userdata('userid');
	$sSQL = "	
			Select count(a.id) as total_cheers_sent
			FROM $tblcheers a
			WHERE 1=1
				AND userid='$userid'
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Detail_EmpPension() {
	$tblemployee = $this->config->item('tmst_employee');
	$tblposition = $this->config->item('tmst_position');

	$hasil = array();

	$sSQL = "		
			Select a.emp_id,CONCAT(a.first_name,' ',a.middle_name,' ',a.last_name) as emp_name,b.position_name,
				   TIMESTAMPDIFF(YEAR, a.birth_date, CURDATE()) as age_year
			FROM $tblemployee a , $tblposition b
			WHERE 1=1
				AND TIMESTAMPDIFF(YEAR, a.birth_date, CURDATE()) > '54'
				AND a.position_id = b.position_id
			ORDER BY a.emp_id ASC
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[] = $data;
	    }
	}

	return $hasil;
    }

    public function MDL_SelectID_Employee($emp_id) {
	$tblemployee = $this->config->item('tmst_employee');
	$tblposition = $this->config->item('tmst_position');
	$tbltypevar = $this->config->item('tmst_typevar');
	$tblbranch = $this->config->item('tmst_branch');
	$tbladdress = $this->config->item('tmst_address');
	$tblcountry = $this->config->item('tmst_country');
	$tblprovince = $this->config->item('tmst_province');
	$tblcompany = $this->config->item('tmst_company');

	$hasil = "";
	$sSQL = "	
			SELECT e.emp_id, CONCAT(e.first_name,' ',e.middle_name,' ',e.last_name) as emp_name,f.position_name, e.hp, e.join_date, c.branch,
				   e.birth_place,e.birth_date,e.photo,e.signature,e.email,g.address1,g.phone1,g.mobile_phone1,
				   CONCAT(a.type,' ',a.name) as company_name
			FROM $tblcompany a,$tblposition f,$tblemployee e
				LEFT JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'GENDER') t ON t.id = e.gender
				LEFT JOIN $tblbranch c ON c.id = e.branch_id
                LEFT JOIN $tbladdress g ON g.emp_id = e.emp_id
			WHERE 1=1 
				AND e.emp_id ='$emp_id'
				AND f.position_id = e.position_id
				AND a.id = e.company_id
		";
	//$this->auth->TVD($sSQL); exit();

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Total_Cheers() {
	$tblcheers = $this->config->item('ttrs_cheers_for_peers');

	$userid = $this->session->userdata('userid');
	//$hasil = array();
	$sSQL = "	
			Select count(*) as jumlah_unread_cheers
			FROM $tblcheers	
			WHERE is_read='0'
			AND to_peers='$userid'
		";

	//var_dump($sSQL); exit();
	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function PrivIdeas() {
	$tblideas_selected = $this->config->item('ttrs_ideas_selected_user');

	$userid = $this->session->userdata('userid');
	//$hasil = array();
	$sSQL = "	
			select * from $tblideas_selected where emp_id='$userid'
		";

	//var_dump($sSQL); exit();
	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    return 1;
	} else {
	    return 0;
	}
    }

    public function MDL_GetGroupID($user_id) {
	$tbl_user_group = $this->config->item('tmst_users_group');

	$hasil = "";

	$sSQL = "		
			SELECT user_id,group_id
			FROM $tbl_user_group
			WHERE user_id = '$user_id'
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Get_Log_Notification() {
	$userid = $this->session->userdata('userid');

	$where = "a.emp_id = '$userid'";

	$hasil = array();

	$sSQL = "
			SELECT a.*,
			       b.first_name
			FROM ttrs_log_notification a
			    LEFT JOIN(SELECT emp_id , first_name FROM tmst_employee)b ON b.emp_id = a.userid
			WHERE $where 
			ORDER BY a.recdate DESC
			LIMIT 10
		";

	$ambil = $this->db->query($sSQL);
	if ($ambil->num_rows() > 0) {
	    foreach ($ambil->result() as $data) {
		$hasil[] = $data;
	    }
	}
	return $hasil;
    }

    public function MDL_Update_Log_Status($id) {
	$data = array(
	    'status' => '1'
	);

	$this->db->where('id', $id);
	$res = $this->db->update('ttrs_log_notification', $data);

	return $res;
    }
    
    public function MDL_TotalRequestIPP() {
		$tbl_approvedby	= $this->config->item('ttrs_approvedby');
		$tbl_user	= $this->config->item('tmst_users');
		
		$userid = $this->session->userdata('userid');
		//$hasil = array();
		$sSQL = "	
			Select count(*) as jumlah_approval
			FROM $tbl_approvedby	
			WHERE 1=1
			AND (approved_by LIKE '$userid,%' OR approved_by LIKE '%,$userid' OR approved_by LIKE '%,$userid,%')
			AND status NOT IN ('3','4','5')
			AND requestapproval_id ='1'
		";
		
		//var_dump($sSQL); exit();
		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil = $data;
			}
		}
		return $hasil;
	}
        public function MDL_CountTotalPoints() {
       
        $ttrs_cheers_for_peers_star = $this->config->item('ttrs_cheers_for_peers_star');

        $userid = $this->session->userdata('userid');
        $sSQL = "
                    select sum(total_star) as total 
                    from $ttrs_cheers_for_peers_star

                    where to_emp='$userid' 
		";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil = $data;
            }
        }
        if ($hasil->total == NULL) {
            return "0";
        } else {
            return $hasil->total;
        }
    }

}