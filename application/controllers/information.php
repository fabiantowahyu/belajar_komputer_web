<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Information extends CI_Controller {

    private $tblName;
    private $field;

    public function __construct() {
        parent::__construct();
        $this->load->model('md_information');
    }

    public function index() {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('list')) {
            $data['action'] = 'list';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            /* Bread crum */
            $this->load->model('md_ref_json');
            $params = $this->router->fetch_class();
            $hasil = $this->md_ref_json->MDL_SelectMenu($params);
            $parentt = $hasil->parentt;
            $nm_menu = $hasil->custom_title;
            $path_icon = $hasil->path_icon;
            $this->breadcrumbs->add($parentt, '#', $path_icon);
            $this->breadcrumbs->add($nm_menu, base_url());
            $breadcrum = $this->breadcrumbs->output();
            $data['breadcrum'] = $breadcrum;
            /* end */

            $data['results'] = $this->md_information->MDL_Select();
            
            //$this->auth->TVD($data['results']);die();
            //$this->auth->TVD($data['results']);die();
            $nm_title = $this->auth->Auth_getNameMenu();
            $data['title'] = sprintf("%s", $nm_title);
            $data['url_view'] = sprintf("%sinformation/CTRL_View/", site_url());
            $data['page'] = 'information/view';
            $data['plugin'] = 'information/plugin';
            $this->load->view('template_admin', $data);
        }
    }

    public function CTRL_New() {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('add')) {
            $data['action'] = 'add';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                redirect('information');
            } elseif ($this->input->post('submit')) {
                $isDuplicated = $this->md_information->MDL_isPermInsert($this->input->post('id'));
                if ($isDuplicated) {
                    $this->md_information->MDL_Insert();
                    redirect('information');
                } else {
                    $data['id'] = $this->input->post('id');
                    $data['page'] = 'error_duplicated';
                    $this->load->view('template_admin', $data);
                }
            } else {
                /* Bread crum */
                $this->load->model('md_ref_json');
                $params = $this->router->fetch_class();
                $hasil = $this->md_ref_json->MDL_SelectMenu($params);
                $parentt = $hasil->parentt;
                $nm_menu = $hasil->custom_title;
                $url_menu = $hasil->url_menu;
                $path_icon = $hasil->path_icon;
                $this->breadcrumbs->add($parentt, '#', $path_icon);
                $this->breadcrumbs->add($nm_menu, base_url() . $url_menu);
                $this->breadcrumbs->add('Add New', base_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $this->load->helper('plugin_helper');
                $data['content'] = '';
                $data['content_usa'] = '';

                $data['id'] = $this->md_information->MDL_getAutoID();

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add New", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);

                $data['url'] = 'information/CTRL_New';

                $data['url_browse_picture'] = sprintf("%sinformation/CTRL_Browse_picture/", site_url());
                $data['page'] = 'information/form';
                $data['plugin'] = 'information/plugin';
                $this->load->view('template_admin', $data);
            }
        }
    }

    public function CTRL_Edit($id = '') {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                redirect('information');
            } elseif ($this->input->post('submit')) {
                $id = $this->input->post('id');
                $this->md_information->MDL_Update($id);
                redirect('information');
            } else {
                /* Bread crum */
                $this->load->model('md_ref_json');
                $params = $this->router->fetch_class();
                $hasil = $this->md_ref_json->MDL_SelectMenu($params);
                $parentt = $hasil->parentt;
                $nm_menu = $hasil->custom_title;
                $url_menu = $hasil->url_menu;
                $path_icon = $hasil->path_icon;
                $this->breadcrumbs->add($parentt, '#', $path_icon);
                $this->breadcrumbs->add($nm_menu, base_url() . $url_menu);
                $this->breadcrumbs->add('Update', base_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $this->load->helper('plugin_helper');

                $hasil = $this->md_information->MDL_SelectID($id);
                //var_dump($hasil);die();
                $data['id'] = $hasil->id;
                $data['titleinfo'] = $hasil->title;
                $data['titleinfo_usa'] = $hasil->title_usa;
                $data['external_source'] = $hasil->external_source;
                $data['content'] = $hasil->content;
                $data['content_usa'] = $hasil->content_usa;
                $data['link'] = $hasil->link;
                $data['picture'] = $hasil->picture;
                $data['status'] = $hasil->status;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['url_browse_picture'] = sprintf("%sinformation/CTRL_Browse_picture/", site_url());
                $data['title_head'] = sprintf("%s - Update", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'information/CTRL_Edit/' . $id;
                $data['url_del'] = 'information/CTRL_Delete/' . $id;
                $data['page'] = 'information/form_edit';
                $data['plugin'] = 'information/plugin';
                $this->load->view('template_admin', $data);
            }
        }
    }

    public function CTRL_Delete($id = '') {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            $this->md_information->MDL_Delete($id);
            redirect('information');
        }
    }

    public function CTRL_View($id,$language="") {

            $sql2 = "select page_view from ttrs_information where id='$id'";
            $res2 = $this->db->query($sql2)->row();
            if($res2){
                    $data = array('page_view'=>$res2->page_view+1);
                    
                    $this->db->where('id', $id);
		$this->db->update('ttrs_information', $data);
            }
            
            
            
        $content="";
        $sql = "select * from ttrs_information where id ='$id'";
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

        $this->load->view('template_webview_information', $data);
    }

    public function CTRL_Browse_picture() {

        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } else {
            if ($this->input->post()) {


                $res = $this->md_information->MDL_UploadPicture();
                if ($res) {
                    $this->session->set_flashdata('upload_success', array('title' => '', 'message' => 'Success Upload Images', 'class' => 'alert alert-success'));


                    redirect('information/CTRL_Browse_picture');
                }
            }

            $data['results'] = $this->md_information->MDL_SelectPicture();


            $data['url'] = 'information/CTRL_Browse_picture/';
            $data['page'] = 'information/view_picture';
            $data['plugin'] = 'information/plugin';
            $this->load->view('template_popupwindow', $data);
        }
    }

    public function CTRL_DeletePicture($id = '') {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } else {
            $this->md_information->MDL_DeletePicture($id);
            $this->session->set_flashdata('upload_success', array('title' => '', 'message' => 'Success Delete Images', 'class' => 'alert alert-success'));

            redirect('information/CTRL_Browse_picture');
        }
    }

}
