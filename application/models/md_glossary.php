<?php

class Md_glossary extends CI_Model {

    public function MDL_Select() {

        $hasil = array();

        $sSQL = "
			Select * from tmst_istilah_komputer order by recdate desc
		";

        $hasil = $this->db->query($sSQL)->result();

        return $hasil;
    }

    public function MDL_SelectPicture() {

        $hasil = array();

        $sSQL = "
			Select * from ttrs_information_picture order by recdate desc
		";

        $hasil = $this->db->query($sSQL)->result();

        return $hasil;
    }

    public function MDL_SelectID($id) {

        return $this->db->get_where('tmst_istilah_komputer', array('id' => $id))->row();
    }

    public function MDL_Insert() {



        $word_of_the_day = $this->input->post('word_of_the_day');

        $userid = $this->session->userdata('userid');
        $recdate = date("Y-m-d H:i:s");

        $data = array(
            'judul_istilah' => $this->input->post('judul_istilah'),
            'arti' => $this->input->post('arti'),
            'arti_usa' => $this->input->post('arti_usa'),
            'picture' => $this->input->post('picture'),
           // 'userid' => $userid,
            'recdate' => $recdate,
        );
        $this->db->insert('tmst_istilah_komputer', $data);
        $id = $this->db->insert_id();

        if ($word_of_the_day == 1) {


            $data2 = array(
                'word_of_the_day' => 0,
            );
            $this->db->update('tmst_istilah_komputer', $data2);
            
            
            $data2 = array(
                'word_of_the_day' => 1,
            );
            
            $this->db->where('id', $id);
            $this->db->update('tmst_istilah_komputer', $data2);
            
        }
    }

    // Fungsi Ubah Data
    public function MDL_Update($id) {

      
        $word_of_the_day = $this->input->post('word_of_the_day');


        $data = array(
            'judul_istilah' => $this->input->post('judul_istilah'),
            'arti' => $this->input->post('arti'),
            'arti_usa' => $this->input->post('arti_usa'),
            'picture' => $this->input->post('picture'),
        );
        $this->db->where('id', $id);
        $this->db->update('tmst_istilah_komputer', $data);
        
         if ($word_of_the_day == 1) {


            $data2 = array(
                'word_of_the_day' => 0,
            );
            $this->db->update('tmst_istilah_komputer', $data2);
            
            
            $data2 = array(
                'word_of_the_day' => 1,
            );
            
            $this->db->where('id', $id);
            $this->db->update('tmst_istilah_komputer', $data2);
            
        }
        
    }

    // Fungsi Hapus Data
    public function MDL_Delete($id) {

        $this->db->delete('tmst_istilah_komputer', array('id' => $id));
    }

}

?>