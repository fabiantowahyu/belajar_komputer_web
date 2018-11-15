<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_json extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//date_default_timezone_set("Asia/Jakarta");
		$this->load->model('md_ref_json');
	}

	public function getDataBranch()	{
		$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
		$data = $this->md_ref_json->MDL_SelectKabupaten($q);

		echo json_encode($data);
	}

	public function getDataCompany()	{
		$q = isset($_POST['q']) ? strval($_POST['q']) : '';
		$data = $this->md_ref_json->MDL_SelectCompany($q);
		//$result['total'] = count($data);
		//$result['rows'] = $data;

		echo json_encode($data);
	}

	public function getDataLocation()	{
		$q = isset($_POST['q']) ? strval($_POST['q']) : '';
		$data = $this->md_ref_json->MDL_SelectLocation($q);
		//$result['total'] = count($data);
		//$result['rows'] = $data;

		echo json_encode($data);
	}

	function getData_SubIndustry() {
		$q = isset($_POST['fvalue']) ? strval($_POST['fvalue']) : '';

		$AryKota = $this->md_ref_json->MDL_SelectSubIndustry($q);
		echo '<option value="">Please Select</option>';
		foreach($AryKota as $row) {
			echo '<option value="'.$row->id.'">'.$row->subindustry.'</option>';
		}

		//return $option;
	}

	function getData_ProductID() {
		$q = isset($_POST['fvalue']) ? strval($_POST['fvalue']) : '';

		$AryKota = $this->md_ref_json->MDL_SelectProduct($q);
		echo '<option value="">Please Select</option>';
		foreach($AryKota as $row) {
			echo '<option value="'.$row->id.'">'.$row->product.'</option>';
		}

		//return $option;
	}
}
