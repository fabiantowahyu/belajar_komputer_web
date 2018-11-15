<?php
class Md_company extends CI_Model {

	// Fungsi Ambil Data
	public function MDL_Select() {
		$tblcompany = $this->config->item('tmst_company');
		$tbltypevar = $this->config->item('tmst_typevar');

		$hasil = array();
		
		$sSQL = "
			SELECT c.id, CONCAT(t.nm_type,'. ',c.name) AS name 
				,c.address, c.phone, c.email, c.fax,c.*
			FROM $tblcompany c
				LEFT JOIN ( SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'COMPANY_TYPE' ) t ON t.id = c.type
			WHERE 1=1 
			ORDER BY c.id
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
		$tblcompany = $this->config->item('tmst_company');

		$offset = ($page-1)*$rows;  
  
		$hasil = array(); 
		$tmpData = array(); 
		
		$FILTER = strlen($item) ? "AND (id LIKE '%$item%' OR name LIKE '%$item%')" : "";  
		$rs = $this->db->query("SELECT count(*) as jum FROM $tblcompany WHERE 1=1 $FILTER");
		$row = $rs->row();  
		$total_rows = $row->jum;  

		$sSQL = "
			SELECT id, name FROM $tblcompany 
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
		$tblcompany = $this->config->item('tmst_company');

        return $this->db->get_where($tblcompany, array('id' => $id))->row();
    }
	
	// Fungsi Tambah Data
	public function MDL_Insert() {
		$filepath_logo = $this->config->item('filepath_logo');
		$tblcompany = $this->config->item('tmst_company');

		//Konfigurasi Upload file
		if(strlen($_FILES['userfile']['name'])) {

			$konfigurasi = array(
				'allowed_types' =>'jpg|jpeg|png|gif',
				'max_size' => 500,
				'upload_path' => $filepath_logo,
				'file_name' => $this->input->post('id')
			);

			$this->load->library('upload', $konfigurasi);
			$res = $this->upload->do_upload();
			if($res) {
				$file_name = $_FILES['userfile']['name'];
				$file_type = $_FILES['userfile']['type'];
			} else {
				return array(false,$this->upload->display_errors());
			}

		}
		
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$name = $this->input->post('name');
		$country = $this->input->post('country');
		$province = $this->input->post('province');
		$city = $this->input->post('city');
		$address = $this->input->post('address');
		$postal_code = $this->input->post('postal_code');
		$phone = $this->input->post('phone');
		$fax = $this->input->post('fax');
		$email = $this->input->post('email');
		$bank_account = $this->input->post('bank_account');
		$bank_name = $this->input->post('bank_name');
		$account_name = $this->input->post('account_name');
		$vission = $this->input->post('vission');
		$mission = $this->input->post('mission');
		$status = $this->input->post('status');
		$currency = $this->input->post('currency');
		$tax_country = $this->input->post('tax_country');
		$tax_file = $this->input->post('tax_file');
		$tax_signature = $this->input->post('tax_signature');
		$invoice_signature = $this->input->post('invoice_signature');
		
		$userid = $this->session->userdata('userid');
		$recdate = date("Y-m-d H:i:s");
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'id' => $id,
			'type' => $type,
			'name' => $name,
			'country' => $country,
			'province' => $province,
			'city' => $city,
			'address' => $address,
			'postal_code' => $postal_code,
			'phone' => $phone,
			'fax' => $fax,
			'email' => $email,
			'bank_account' => $bank_account,
			'bank_name' => $bank_name,
			'account_name' => $account_name,
			'vission' => $vission,
			'mission' => $mission,
			'status' => $status,
			'currency' => $currency,
			'tax_country' => $tax_country,
			'tax_file' => $tax_file,
			'tax_signature' => $tax_signature,
			'invoice_signature' => $invoice_signature,
			'userid' => $userid,
			'recdate' => $recdate,
			'moduser' => $moduser,
			'moddate' => $moddate
		);

	
		if(strlen($_FILES['userfile']['name'])) {
			$data['file_name'] = $file_name;
			$data['file_type'] = $file_type;
		} 

		$this->db->insert($tblcompany, $data);
		return array(true,"");
	}

	// Fungsi Ubah Data
	public function MDL_Update($id){
		$tblcompany = $this->config->item('tmst_company');

		//$id = $this->input->post('id');
		$type = $this->input->post('type');
		$name = $this->input->post('name');
		$country = $this->input->post('country');
		$province = $this->input->post('province');
		$city = $this->input->post('city');
		$address = $this->input->post('address');
		$postal_code = $this->input->post('postal_code');
		$phone = $this->input->post('phone');
		$fax = $this->input->post('fax');
		$email = $this->input->post('email');
		$bank_account = $this->input->post('bank_account');
		$bank_name = $this->input->post('bank_name');
		$account_name = $this->input->post('account_name');
		$vission = $this->input->post('vission');
		$mission = $this->input->post('mission');
		$status = $this->input->post('status');
		$currency = $this->input->post('currency');
		$tax_country = $this->input->post('tax_country');
		$tax_file = $this->input->post('tax_file');
		$tax_signature = $this->input->post('tax_signature');
		$invoice_signature = $this->input->post('invoice_signature');
		$moduser = $this->session->userdata('userid');
		$moddate = date("Y-m-d H:i:s");
		
		$data = array(
			'type' => $type,
			'name' => $name,
			'country' => $country,
			'province' => $province,
			'city' => $city,
			'address' => $address,
			'postal_code' => $postal_code,
			'phone' => $phone,
			'fax' => $fax,
			'email' => $email,
			'bank_account' => $bank_account,
			'bank_name' => $bank_name,
			'account_name' => $account_name,
			'vission' => $vission,
			'mission' => $mission,
			'status' => $status,
			'currency' => $currency,
			'tax_country' => $tax_country,
			'tax_file' => $tax_file,
			'tax_signature' => $tax_signature,
			'invoice_signature' => $invoice_signature,
			'moduser' => $moduser,
			'moddate' => $moddate
		);

        $this->db->where('id', $id);
        $this->db->update($tblcompany, $data);
    }
	
	public function MDL_UpdateFoto($id) {
		$filepath_logo = $this->config->item('filepath_logo');
		$separator = $this->config->item('separator');
		$tblcompany = $this->config->item('tmst_company');

		//Konfigurasi Upload file
		if(strlen($_FILES['userfile']['name'])) {

			//===== START Delete File yang lama
			$hasil = $this->MDL_SelectID($id);
			$file_name = $hasil->file_name;
			$ary = @explode(".",$file_name);
			$type = $ary[count($ary)-1];
			$file = sprintf("%s%s%s.%s",$filepath_logo,$separator,$id,$type);
			if(file_exists($file)) {
				unlink($file);
			}
			//===== END
			
			$konfigurasi = array(
				'allowed_types' =>'jpg|jpeg|png|gif',
				'max_size' => 500,
				'upload_path' => $filepath_logo,
				'file_name' => $id
			);

			$this->load->library('upload', $konfigurasi);
			$res = $this->upload->do_upload();
			if($res) {
				$file_name = $_FILES['userfile']['name'];
				$file_type = $_FILES['userfile']['type'];
				
				$data = array(
					'file_name' => $file_name,
					'file_type' => $file_type
				);

				$this->db->where('id', $id);
				$this->db->update($tblcompany, $data);
			} 
		}
	}

	// Fungsi Hapus Data
	public function MDL_Delete($id) {
		$filepath_logo = $this->config->item('filepath_logo');
		$separator = $this->config->item('separator');
		$tblcompany = $this->config->item('tmst_company');

		//===== START Delete File yang lama
		$hasil = $this->MDL_SelectID($id);
		$file_name = $hasil->file_name;
		$ary = @explode(".",$file_name);
		$type = $ary[count($ary)-1];
		$file = sprintf("%s%s%s.%s",$filepath_logo,$separator,$id,$type);
		if(file_exists($file)) {
			unlink($file);
		}
		//===== END
		
		$this->db->delete($tblcompany, array('id' => $id));
	}

	public function MDL_isPermInsert($id){
		$tblName = $this->config->item('tmst_company');

		$res = $this->db->get_where($tblName, array('id' => $id))->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }

	public function MDL_isPermDelete($id){
		$tblName = $this->config->item('tmst_branch');

		//$res = $this->db->get_where($tblName, array('empstatus_id' => $id))->num_rows();
		$sSQL = "
			SELECT company_id FROM $tblName WHERE company_id = '$id' LIMIT 0,1
		";

		$ambil = $this->db->query($sSQL);
		$res = $ambil->num_rows();

		if($res) {
			return 0;
		} else {
			return 1;
		}
    }

	public function MDL_Option_Company() {
		$data = $this->MDL_Select();
		foreach($data as $row) {
			$option[$row->id] = $row->name;
		}

		return $option;
	}
	
	public function MDL_getAutoID() {
		$tblcompany = $this->config->item('tmst_company');

		$sSQL = "
			SELECT MAX(p.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(id,5,5) AS UNSIGNED INTEGER) AS num
				FROM $tblcompany
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
	
}
?>