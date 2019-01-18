<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------
  | DECLARE VARIABEL GLOBAL
  | -------------------------------------------------------------------
  |
  |
 */
$config['isMaintenance'] = 0;
$config['website_title'] = "Belajar Komputer";
$config['isAdmin'] = "admin";
$config['themes'] = "default";


$config['filepath_logo'] = realpath('./file_upload/logo');
$config['filepath_certificate'] = realpath('./file_upload/certificate');
$config['filepath_avatar'] = realpath('./file_upload/avatar');
$config['filepath_education'] = realpath('./file_upload/education');
$config['filepath_family'] = realpath('./file_upload/family');
$config['filepath_signature'] = realpath('./file_upload/signature');
$config['filepath_policy'] = realpath('./file_upload/policy');
$config['filepath_announcement'] = realpath('./file_upload/announcement');
$config['filepath_excel'] = realpath('./file_upload/excel');
$config['filepath_ideas_attachment'] = realpath('./file_upload/ideasattachment');
$config['filepath_cheers_attachment'] = realpath('./file_upload/cheersattachment');
$config['filepath_tasks_attachment'] = realpath('./file_upload/taskattachment');
$config['filepath_tasks_attachment_finish'] = realpath('./file_upload/finishtaskattachment');

$config['filepath_picture'] = realpath('./file_upload/picture');


$config['separator'] = sprintf("%s\%s", '', ''); //Windows
//$config['separator'] = sprintf("%s/%s",'',''); //Linux

date_default_timezone_set("Asia/Jakarta");



$dbPrefix = 'belajarkomputer.';

// Tabel Master
$config['tmst_emp_family'] = $dbPrefix . 'tmst_emp_family';
$config['tmst_company'] = $dbPrefix . 'tmst_company';
$config['tmst_branch'] = $dbPrefix . 'tmst_branch';
$config['tmst_users'] = $dbPrefix . 'tmst_users';
$config['tmst_users_group'] = $dbPrefix . 'tmst_users_group';
$config['tmst_menu'] = $dbPrefix . 'tmst_menu';
$config['tmst_group'] = $dbPrefix . 'tmst_group';
$config['tmst_group_det'] = $dbPrefix . 'tmst_group_detail';
$config['tmst_typevar'] = $dbPrefix . 'tmst_typevar';
$config['tmst_position'] = $dbPrefix . 'tmst_position';
$config['tmst_emp_education'] = $dbPrefix . 'tmst_emp_education';
$config['tmst_emp_training'] = $dbPrefix . 'tmst_emp_training';
$config['tmst_requestapproval'] = $dbPrefix . 'tmst_requestapproval';
$config['tmst_requestapproval_detail'] = $dbPrefix . 'tmst_requestapproval_detail';
$config['tmst_job_grade'] = $dbPrefix . 'tmst_job_grade';
$config['tmst_tax_number'] = $dbPrefix . 'tmst_tax_number';
$config['tmst_costcenter'] = $dbPrefix . 'tmst_costcenter';
$config['tmst_country'] = $dbPrefix . 'tmst_country';
$config['tmst_province'] = $dbPrefix . 'tmst_province';
$config['tmst_address'] = $dbPrefix . 'tmst_address';
$config['tmst_datachanges'] = $dbPrefix . 'tmst_datachange_type';
$config['tmst_attend_status'] = $dbPrefix . 'tmst_attend_status';
$config['tmst_attend_shfdaily'] = $dbPrefix . 'tmst_attend_shfdaily';
$config['tmst_attend_shfgroup'] = $dbPrefix . 'tmst_attend_shfgroup';
$config['tmst_attend_leave'] = $dbPrefix . 'tmst_attend_leave';
$config['tmst_attend_permit'] = $dbPrefix . 'tmst_attend_permit';
$config['tmst_attend_trip'] = $dbPrefix . 'tmst_attend_trip';
$config['tmst_empstatus'] = $dbPrefix . 'tmst_empstatus';
$config['tmst_bank'] = $dbPrefix . 'tmst_bank';
$config['tmst_holiday'] = $dbPrefix . 'tmst_holiday';
$config['tmst_achievement'] = $dbPrefix . 'tmst_achievement';
$config['tmst_disciplines'] = $dbPrefix . 'tmst_disciplines';
$config['tmst_careertransition'] = $dbPrefix . 'tmst_careertransition';
$config['tmst_careertransitiondtl'] = $dbPrefix . 'tmst_careertransitiondtl';
$config['tmst_careertransition_detail'] = $dbPrefix . 'tmst_careertransition_detail';
$config['tmst_lettertemplate'] = $dbPrefix . 'tmst_lettertemplate';
$config['tmst_globalsetting'] = $dbPrefix . 'tmst_globalsetting';
$config['pay_period'] = $dbPrefix . 'pay_period';
$config['tax_param'] = $dbPrefix . 'tax_param';
$config['tax_percentage'] = $dbPrefix . 'tax_percentage';
$config['tax_location'] = $dbPrefix . 'tax_location';
$config['empallowdeduct'] = $dbPrefix . 'empallowdeduct';
$config['payallowdeduct'] = $dbPrefix . 'payallowdeduct';
$config['tmst_symbol'] = $dbPrefix . 'tmst_symbol';
$config['tmst_score'] = $dbPrefix . 'tmst_score';
$config['ttrs_ideas'] = $dbPrefix . 'ttrs_ideas';
$config['ttrs_ideas_approval'] = $dbPrefix . 'ttrs_ideas_approval';
$config['ttrs_ideas_comment'] = $dbPrefix . 'ttrs_ideas_comment';
$config['ttrs_ideas_selected_user'] = $dbPrefix . 'ttrs_ideas_selected_user';

$config['tmst_pa_setup_competency'] = $dbPrefix . 'tmst_pa_setup_competency';
$config['tmst_pa_setup_competency_detail'] = $dbPrefix . 'tmst_pa_setup_competency_detail';
$config['tmst_pa_setup_appraisal'] = $dbPrefix . 'tmst_pa_setup_appraisal';
$config['tmst_pa_setup_appraisal_detail'] = $dbPrefix . 'tmst_pa_setup_appraisal_detail';
$config['tmst_pa_setup_peers'] = $dbPrefix . 'tmst_pa_setup_peers';
$config['tmst_pa_setup_peers_detail'] = $dbPrefix . 'tmst_pa_setup_peers_detail';

$config['tmst_pa_setup_ipp'] = $dbPrefix . 'tmst_pa_setup_ipp';
$config['tmst_pa_setup_ipp_detail'] = $dbPrefix . 'tmst_pa_setup_ipp_detail';
$config['tmst_pa_setup_ipp_detail_kpi'] = $dbPrefix . 'tmst_pa_setup_ipp_detail_kpi';

$config['tmst_pmperiod'] = $dbPrefix . 'tmst_pmperiod';
$config['tmst_pmperiod_detail'] = $dbPrefix . 'tmst_pmperiod_detail';
$config['tmst_point'] = $dbPrefix . 'tmst_point';
$config['tmst_direct_selection'] = $dbPrefix . 'tmst_direct_selection';
$config['tmst_direct_selection_detail'] = $dbPrefix . 'tmst_direct_selection_detail';
$config['tmst_template_email'] = $dbPrefix . 'tmst_template_email';

//Table Transaction....
$config['ttrs_approvedby'] = $dbPrefix . 'ttrs_approvedby';
$config['tmst_employee'] = $dbPrefix . 'tmst_employee';
$config['ttrs_empdatachange'] = $dbPrefix . 'ttrs_empdatachange';
$config['ttrs_datachangedetail'] = $dbPrefix . 'ttrs_datachangedetail';
$config['ttrs_leave_hist'] = $dbPrefix . 'ttrs_leave_history';
$config['ttrs_permit_hist'] = $dbPrefix . 'ttrs_permit_history';
$config['ttrs_sick_hist'] = $dbPrefix . 'ttrs_sick_history';
$config['ttrs_trip_hist'] = $dbPrefix . 'ttrs_trip_history';
$config['ttrs_overtime_hist'] = $dbPrefix . 'ttrs_overtime_history';
$config['ttrs_attendance'] = $dbPrefix . 'ttrs_attendance';
$config['ttrs_attend_group'] = $dbPrefix . 'ttrs_attend_group';
$config['ttrs_empbank'] = $dbPrefix . 'ttrs_empbank';
$config['ttrs_empgetleave'] = $dbPrefix . 'ttrs_empgetleave';
$config['ttrs_policy'] = $dbPrefix . 'ttrs_policy_request';
$config['ttrs_announcement'] = $dbPrefix . 'ttrs_announcement_request';
$config['ttrs_awardhistory'] = $dbPrefix . 'ttrs_awardhistory';
$config['ttrs_disciplineshistory'] = $dbPrefix . 'ttrs_disciplineshistory';
$config['ttrs_employmenthistory'] = $dbPrefix . 'ttrs_employmenthistory';
$config['ttrs_empsalaryparam'] = $dbPrefix . 'ttrs_empsalaryparam';
$config['ttrs_empsalaryparamhistory'] = $dbPrefix . 'ttrs_empsalaryparamhistory';
$config['ttrs_empbankperiod'] = $dbPrefix . 'ttrs_empbankperiod';
$config['ttrs_procytdh'] = $dbPrefix . 'ttrs_procytdh';
$config['ttrs_procytdd'] = $dbPrefix . 'ttrs_procytdd';
$config['ttrs_procmtdh'] = $dbPrefix . 'ttrs_procmtdh';
$config['ttrs_procmtdd'] = $dbPrefix . 'ttrs_procmtdd';
$config['ttrs_empbanktransfer'] = $dbPrefix . 'ttrs_empbanktransfer';
$config['ttrs_log_notification'] = $dbPrefix . 'ttrs_log_notification';

$config['ttrs_pa'] = $dbPrefix . 'ttrs_pa';
$config['ttrs_pa_detail'] = $dbPrefix . 'ttrs_pa_detail';
$config['ttrs_pa_segmentation'] = $dbPrefix . 'ttrs_pa_segmentation';
$config['ttrs_pa_value_appraisal'] = $dbPrefix . 'ttrs_pa_value_appraisal';
$config['ttrs_pa_value_competency'] = $dbPrefix . 'ttrs_pa_value_competency';
$config['ttrs_cheers_for_peers'] = $dbPrefix . 'ttrs_cheers_for_peers';
$config['ttrs_cheers_for_peers_star'] = $dbPrefix . 'ttrs_cheers_for_peers_star';

$config['tmst_team_member'] = $dbPrefix . 'tmst_team_member';
$config['tmst_team_member_detail'] = $dbPrefix . 'tmst_team_member_detail';
$config['ttrs_task'] = $dbPrefix . 'ttrs_task';
$config['ttrs_task_detail'] = $dbPrefix . 'ttrs_task_detail';
$config['ttrs_task_comment'] = $dbPrefix . 'ttrs_task_comment';


$config['tmst_team_member'] = $dbPrefix . 'tmst_team_member';
$config['tmst_team_member_detail'] = $dbPrefix . 'tmst_team_member_detail';
$config['ttrs_task'] = $dbPrefix . 'ttrs_task';
$config['ttrs_task_detail'] = $dbPrefix . 'ttrs_task_detail';
$config['ttrs_task_comment'] = $dbPrefix . 'ttrs_task_comment';


$config['ttrs_information'] = $dbPrefix . 'ttrs_information';
$config['ttrs_information_alkes'] = $dbPrefix . 'ttrs_information_alkes';
$config['ttrs_information_picture'] = $dbPrefix . 'ttrs_information_picture';
$config['ttrs_information_kesehatan'] = $dbPrefix . 'ttrs_information_kesehatan';


// Tabel View...
$config['tbl_user'] = $config['tmst_users'];
$config['tmst_users'] = $dbPrefix . 'v_users';

/* End of file tabel.php */
/* Location: ./application/config/tabel.php */
