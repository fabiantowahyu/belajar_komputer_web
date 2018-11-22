<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Information_ccna1 extends CI_Controller {

    private $tblName;
    private $field;

    public function __construct() {
        parent::__construct();
        $this->load->model('md_information_ccna1_ccna1');
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

            $data['results'] = $this->md_information_ccna1_ccna1->MDL_Select();
            
            //$this->auth->TVD($data['results']);die();
            //$this->auth->TVD($data['results']);die();
            $nm_title = $this->auth->Auth_getNameMenu();
            $data['title'] = sprintf("%s", $nm_title);
            $data['url_view'] = sprintf("%sinformation_ccna1/CTRL_View/", site_url());
            $data['page'] = 'information_ccna1/view';
            $data['plugin'] = 'information_ccna1/plugin';
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
                redirect('information_ccna1');
            } elseif ($this->input->post('submit')) {
                $isDuplicated = $this->md_information_ccna1_ccna1->MDL_isPermInsert($this->input->post('id'));
                if ($isDuplicated) {
                    $this->md_information_ccna1_ccna1->MDL_Insert();
                    redirect('information_ccna1');
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

                $data['id'] = $this->md_information_ccna1_ccna1->MDL_getAutoID();

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add New", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);

                $data['url'] = 'information_ccna1/CTRL_New';

                $data['url_browse_picture'] = sprintf("%sinformation_ccna1/CTRL_Browse_picture/", site_url());
                $data['page'] = 'information_ccna1/form';
                $data['plugin'] = 'information_ccna1/plugin';
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
                redirect('information_ccna1');
            } elseif ($this->input->post('submit')) {
                $id = $this->input->post('id');
                $this->md_information_ccna1_ccna1->MDL_Update($id);
                redirect('information_ccna1');
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

                $hasil = $this->md_information_ccna1_ccna1->MDL_SelectID($id);
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
                $data['url_browse_picture'] = sprintf("%sinformation_ccna1/CTRL_Browse_picture/", site_url());
                $data['title_head'] = sprintf("%s - Update", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'information_ccna1/CTRL_Edit/' . $id;
                $data['url_del'] = 'information_ccna1/CTRL_Delete/' . $id;
                $data['page'] = 'information_ccna1/form_edit';
                $data['plugin'] = 'information_ccna1/plugin';
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
            $this->md_information_ccna1_ccna1->MDL_Delete($id);
            redirect('information_ccna1');
        }
    }

    public function CTRL_View($id,$language="") {

        $content="";
        $sql = "select * from ttrs_information_ccna1 where id ='$id'";
        $res = $this->db->query($sql)->row();
        if ($res) {
            
            if($language=="indonesia"){
            $content = $res->content;
            }else if ($language=="usa"){
                $content = $res->content_usa;
            }else{
                $content = $res->content;
            }
            
            
            
            $data['page'] = $content;
        } else {

            $data['page'] = "No Content Available";
        }

        $this->load->view('template_webview_information_ccna1', $data);
    }

    public function CTRL_Browse_picture() {

        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } else {
            if ($this->input->post()) {


                $res = $this->md_information_ccna1_ccna1->MDL_UploadPicture();
                if ($res) {
                    $this->session->set_flashdata('upload_success', array('title' => '', 'message' => 'Success Upload Images', 'class' => 'alert alert-success'));


                    redirect('information_ccna1/CTRL_Browse_picture');
                }
            }

            $data['results'] = $this->md_information_ccna1_ccna1->MDL_SelectPicture();


            $data['url'] = 'information_ccna1/CTRL_Browse_picture/';
            $data['page'] = 'information_ccna1/view_picture';
            $data['plugin'] = 'information_ccna1/plugin';
            $this->load->view('template_popupwindow', $data);
        }
    }

    public function CTRL_DeletePicture($id = '') {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } else {
            $this->md_information_ccna1_ccna1->MDL_DeletePicture($id);
            $this->session->set_flashdata('upload_success', array('title' => '', 'message' => 'Success Delete Images', 'class' => 'alert alert-success'));

            redirect('information_ccna1/CTRL_Browse_picture');
        }
    }

}
