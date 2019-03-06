<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Glossary extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('md_glossary');
    }

    public function index() {
        if (!$this->auth->Auth_isLogin()) {
            redirect('login');
        } else {
         

            $data['results'] = $this->md_glossary->MDL_Select();
            
            $data['title'] = "Glossary";
            $data['url_view'] = sprintf("%sglossary/CTRL_View/", site_url());
            $data['page'] = 'glossary/view';
            $data['plugin'] = 'glossary/plugin';
            $this->load->view('template_admin', $data);
        }
    }

    public function CTRL_New() {
        if (!$this->auth->Auth_isLogin()) {
            redirect('login');
        }  else {
            if ($this->input->post('close')) {
                redirect('glossary');
            } elseif ($this->input->post('submit')) {
               
                    $this->md_glossary->MDL_Insert();
                    redirect('glossary');
               
            } else {
               
                $data['title_head'] = "Add New Glossary";
                $data['title'] = "Add New Glossary";
                
                
                //$this->load->helper('plugin_helper');
                $data['arti'] = '';
                $data['arti_usa'] = '';


                $data['url'] = 'glossary/CTRL_New';

                $data['url_browse_picture'] = sprintf("%sglossary/CTRL_Browse_picture/", site_url());
                $data['page'] = 'glossary/form';
                $data['plugin'] = 'glossary/plugin';
                $this->load->view('template_admin', $data);
            }
        }
    }

    public function CTRL_Edit($id = '') {
        if (!$this->auth->Auth_isLogin()) {
           redirect('login');
        }  else {
            if ($this->input->post('close')) {
                redirect('glossary');
            } elseif ($this->input->post('submit')) {
                $id = $this->input->post('id');
                $this->md_glossary->MDL_Update($id);
                redirect('glossary');
            } else {
                

               
                $hasil = $this->md_glossary->MDL_SelectID($id);
                //var_dump($hasil);die();
                $data['id'] = $hasil->id;
                $data['judul_istilah'] = $hasil->judul_istilah;
                $data['arti'] = $hasil->arti;
                $data['arti_usa'] = $hasil->arti_usa;
                $data['picture'] = $hasil->picture;
                $data['word_of_the_day'] = $hasil->word_of_the_day;
                

               
                $data['url_browse_picture'] = sprintf("%sglossary/CTRL_Browse_picture/", site_url());
                $data['title_head'] = "Edit New Glossary";
                $data['title'] = "Edit New Glossary";
                $data['url'] = 'glossary/CTRL_Edit/' . $id;
                $data['url_del'] = 'glossary/CTRL_Delete/' . $id;
                $data['page'] = 'glossary/form_edit';
                $data['plugin'] = 'glossary/plugin';
                $this->load->view('template_admin', $data);
            }
        }
    }

    public function CTRL_Delete($id = '') {
        if (!$this->auth->Auth_isLogin()) {
           redirect('login');
        }  else {
            $this->md_glossary->MDL_Delete($id);
            redirect('glossary');
        }
    }

    public function CTRL_View($id,$language="") {

            $sql2 = "select page_view from ttrs_glossary where id='$id'";
            $res2 = $this->db->query($sql2)->row();
            if($res2){
                    $data = array('page_view'=>$res2->page_view+1);
                    
                    $this->db->where('id', $id);
		$this->db->update('ttrs_glossary', $data);
            }
            
            
            
        $content="";
        $sql = "select * from ttrs_glossary where id ='$id'";
        $res = $this->db->query($sql)->row();
        if ($res) {
            
            if($language=="indonesia"){
            $content = $res->content;
            }else if ($language=="usa"){
                $content = $res->content_usa;
            }else{
                $content = $res->content;
            }
            
           // $content.="<button class='btn btn-block btn-info btn-medium' onClick='showAndroidToast('Hello Android!')'>START QUIZ</button>";
            
            $test ='<SCRIPT type="text/javascript">if (typeof document.onselectstart!="undefined") {document.onselectstart=new Function ("return false");}else{document.onmousedown=new Function ("return false");document.onmouseup=new Function ("return true");}</SCRIPT>';
            $data['page'] = $test.$content;
        } else {

            $data['page'] = "No Content Available";
        }

        $this->load->view('template_webview_glossary', $data);
    }

    public function CTRL_Browse_picture() {

        if (!$this->auth->Auth_isLogin()) {
            redirect('login');
        } else {
            if ($this->input->post()) {


                $res = $this->md_glossary->MDL_UploadPicture();
                if ($res) {
                    $this->session->set_flashdata('upload_success', array('title' => '', 'message' => 'Success Upload Images', 'class' => 'alert alert-success'));


                    redirect('glossary/CTRL_Browse_picture');
                }
            }

            $data['results'] = $this->md_glossary->MDL_SelectPicture();


            $data['url'] = 'glossary/CTRL_Browse_picture/';
            $data['page'] = 'glossary/view_picture';
            $data['plugin'] = 'glossary/plugin';
            $this->load->view('template_popupwindow', $data);
        }
    }

    public function CTRL_DeletePicture($id = '') {
        if (!$this->auth->Auth_isLogin()) {
           redirect('login');
        } else {
            $this->md_glossary->MDL_DeletePicture($id);
            $this->session->set_flashdata('upload_success', array('title' => '', 'message' => 'Success Delete Images', 'class' => 'alert alert-success'));

            redirect('glossary/CTRL_Browse_picture');
        }
    }

}
