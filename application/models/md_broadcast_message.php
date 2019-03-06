<?php

class Md_broadcast_message extends CI_Model {

    // Fungsi Ambil Data
    public function MDL_Select() {
        
        $hasil = array();

        $sSQL = "
			Select * from ttrs_broadcast_message order by recdate desc
		";

        $hasil = $this->db->query($sSQL)->result();

        return $hasil;
    }


    // Fungsi Tambah Data
    public function MDL_Insert() {
        
        $id = $this->MDL_getAutoID();
        $title = $this->input->post('title');
        $target = $this->input->post('target');
        $message= $this->input->post('message');
        $userid = $this->session->userdata('userid');
        $recdate = date("Y-m-d H:i:s");

        $this->load->library('firebase');

        $data = array(
            'id' => $id,
            'title' => $title,
            'target' => $target,
            'message' => $message,
            'userid' => $userid,
            'recdate' => $recdate,
        );
        
        
        if($target=='all'){
            
        $Arytoken = $this->md_broadcast_message->MDL_Select_Receiver();
	foreach ($Arytoken as $row) {
	 $res =   $this->firebase->SendNotification($title,$message,$row->token);
        }
        
        }else{
           
          $res =     $this->firebase->SendNotification($title,$message,$target);
            
        }
        
        if($res==TRUE){
            
            $data['status'] = 1;
            
        }else{
            
            $data['status'] = 0;
        }
        
        
        
        
        $this->db->insert('ttrs_broadcast_message', $data);
        
        return $res;
    }


    public function MDL_getAutoID() {
        
        $sSQL = "
			SELECT MAX(p.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(id,5,5) AS UNSIGNED INTEGER) AS num
				FROM ttrs_broadcast_message
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

        $hasil = sprintf("BRC%05d", $no_urut);

        return $hasil;
    }

 
  

}

?>