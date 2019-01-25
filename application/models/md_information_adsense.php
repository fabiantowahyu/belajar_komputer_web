<?php

class Md_information_adsense extends CI_Model {

    // Fungsi Ambil Data
    public function MDL_Select() {
        $tblletter_template = $this->config->item('ttrs_information_adsense_adsense');

        $hasil = array();

        $sSQL = "
			Select * from ttrs_information_adsense order by recdate desc
		";

        $hasil = $this->db->query($sSQL)->result();

        return $hasil;
    }

    public function MDL_SelectPicture() {
        $ttrs_information = $this->config->item('ttrs_information');

        $hasil = array();

        $sSQL = "
			Select * from $ttrs_information order by recdate desc
		";

        $hasil = $this->db->query($sSQL)->result();

        return $hasil;
    }

    public function MDL_SelectID($id) {
        $ttrs_information_adsense = $this->config->item('ttrs_information_adsense');

        return $this->db->get_where($ttrs_information_adsense, array('id' => $id))->row();
    }

    // Fungsi Tambah Data
    public function MDL_Insert() {
        $ttrs_information_adsense = $this->config->item('ttrs_information_adsense');

        $id = $this->MDL_getAutoID();
        $title = $this->input->post('title');
        $title_usa = $this->input->post('title_usa');
        $content = $this->input->post('content');
        $content_usa = $this->input->post('content_usa');
        $status = $this->input->post('status');

        $userid = $this->session->userdata('userid');
        $recdate = date("Y-m-d H:i:s");


        if ($this->input->post('external_source')) {
            $external = 1;
            $link = $this->input->post('link');
        } else {
            $link = base_url() . 'information_adsense/CTRL_View/' . $id;
            $external = 0;
        }


        $data = array(
            'id' => $id,
            'title' => $title,
            'title_usa' => $title_usa,
            'link' => $link,
            'external_source' => $external,
            'picture' => $this->input->post('picture'),
            'content' => $content,
            'content_usa' => $content_usa,
            'status' => $status,
            'userid' => $userid,
            'recdate' => $recdate,
        );
        $this->db->insert($ttrs_information_adsense, $data);
    }

    public function MDL_isPermInsert($id) {
        $tblName = $this->config->item('ttrs_information_adsense');

        $res = $this->db->get_where($tblName, array('id' => $id))->num_rows();

        if ($res) {
            return 0;
        } else {
            return 1;
        }
    }

    // Fungsi Ubah Data
    public function MDL_Update($id) {
        $ttrs_information_adsense = $this->config->item('ttrs_information_adsense');

        $id = $this->input->post('id');
        $content = $this->input->post('content');
        $content_usa = $this->input->post('content_usa');
        $title = $this->input->post('title');
        $title_usa = $this->input->post('title_usa');
        $status = $this->input->post('status');

        $moduser = $this->session->userdata('userid');
        $moddate = date("Y-m-d H:i:s");

        if ($this->input->post('external_source')) {
            $external = 1;
            $link = $this->input->post('link');
        } else {
            $link = base_url() . 'information_adsense/CTRL_View/' . $id;
            $external = 0;
        }

        $data = array(
            'content' => $content,
            'content_usa' => $content_usa,
            'title' => $title,
            'title_usa' => $title_usa,
            'external_source' => $external,
            'link' => $link,
            'picture' => $this->input->post('picture'),
            'status' => $status,
            'moduser' => $moduser,
            'moddate' => $moddate
        );

        $this->db->where('id', $id);
        $this->db->update($ttrs_information_adsense, $data);
    }

    // Fungsi Hapus Data
    public function MDL_Delete($id) {
        $ttrs_information_adsense = $this->config->item('ttrs_information_adsense');

        $this->db->delete($ttrs_information_adsense, array('id' => $id));
    }

    public function MDL_getAutoID() {
        $ttrs_information_adsense = $this->config->item('ttrs_information_adsense');

        $sSQL = "
			SELECT MAX(p.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(id,5,5) AS UNSIGNED INTEGER) AS num
				FROM $ttrs_information_adsense
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

        $hasil = sprintf("NWA%05d", $no_urut);

        return $hasil;
    }

    public function MDL_UploadPicture() {

        $file_picture = "";
        $filepath_picture = $this->config->item('filepath_picture');

        $ttrs_information = $this->config->item('ttrs_information');


        $konfigurasi = array(
            'upload_path' => $filepath_picture,
            'allowed_types' => 'jpg',
            'max_size' => 500,
            'remove_spaces' => TRUE,
            'encrypt_name' => FALSE,
        );
        $this->load->library('upload', $konfigurasi);

        if (strlen($_FILES['file_picture']['name'])) {
            if ($this->upload->do_upload('file_picture')) {
                $file_picture = $this->upload->data();
                $file_picture = $file_picture['file_name'];
            } else {
                array(false => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert('Attached File Denied, Please choose another type of attachment..');window.close();</script>";
                die();
                //return array(false, $this->upload->display_errors());die();
            }
        }



        $data['picture'] = $file_picture;
        $data['userid'] = $this->session->userdata('userid');
        $data['recdate'] = date("Y-m-d H:i:s");
        //$this->auth->TVD($data);die();





        $result = $this->db->insert($ttrs_information, $data);
        return $result;
    }

    public function MDL_DeletePicture($picture) {
        $ttrs_information = $this->config->item('ttrs_information');
        $filepath_picture = $this->config->item('filepath_picture');

        $this->db->delete($ttrs_information, array('picture' => $picture));
        $file = $filepath_picture . $picture;

        //echo $file;die();
        unlink("file_upload/picture/" . $picture);
    }

}

?>