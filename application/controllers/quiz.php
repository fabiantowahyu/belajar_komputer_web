<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quiz extends CI_Controller {

    private $tblName;
    private $field;

    public function __construct() {
        parent::__construct();
        $this->load->model('md_quiz');
        $this->tblName = $this->config->item('tmst_quiz');
        $this->field = 'quiz_type';
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

            $data['results'] = $this->md_quiz->MDL_Select();

            $nm_title = $this->auth->Auth_getNameMenu();
            $data['title'] = sprintf("%s", $nm_title);
            $data['url_view'] = sprintf("%squiz/CTRL_View/", site_url());
            $data['page'] = 'quiz/view';
            $data['plugin'] = 'quiz/plugin';
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
                redirect('quiz');
            } elseif ($this->input->post('submit')) {
                $isDuplicated = $this->md_quiz->MDL_isPermInsert($this->input->post('id_information'));
                if ($isDuplicated) {
                    $this->md_quiz->MDL_Insert();



                    redirect('quiz');
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


                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add New", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);



                // $data['url_cek_field'] = sprintf("%s%s/costcenter_code", site_url(), "country/CTRL_CekField");
                $data['url'] = 'quiz/CTRL_New';
                $data['page'] = 'quiz/form';
                $data['plugin'] = 'quiz/plugin';
                $this->load->view('template_admin', $data);
            }
        }
    }

    public function CTRL_Edit($id_information = '') {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id_information, $this->tblName, $this->field)) {
            $data['id'] = $id;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                redirect('quiz');
            } elseif ($this->input->post('submit')) {
                $id_information = $this->input->post('id_information');
                $this->md_quiz->MDL_Update($id_information);


                redirect('quiz');
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
                //$this->breadcrumbs->add('Spring Tutorial', base_url().'tutorials/spring-tutorials');
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $data['quiz'] = $this->md_quiz->get_all_quiz($id_information,'id_information');
                $data['id_information'] = $this->uri->segment(3);
              

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Update", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);

                $data['url'] = 'quiz/CTRL_Edit/' . $id_information;
                $data['url_del'] = 'quiz/CTRL_Delete/' . $id_information;
                $data['page'] = 'quiz/form_edit';
                $data['plugin'] = 'quiz/plugin';
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
        } elseif (!$this->auth->Auth_isRecID($id, $this->tblName, $this->field)) {
            $data['id'] = $id;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            $quiz_type = $this->input->post('quiz_type');
            
            $hasil = $this->md_quiz->MDL_SelectID($quiz_type);
            
            $isDeleted = $this->md_quiz->MDL_isPermDelete($hasil->quiz_type);

            if ($isDeleted) {
                $data['page'] = 'error_delete';
                $this->load->view('template_admin', $data);
            } else {
                $this->md_quiz->MDL_Delete($id);
                redirect('quiz');
            }
        }
    }

    
     public function CTRL_Delete_item($id_item="") {
        
        
        if(!$this->auth->Auth_isPerm()) {

            $this->load->view('error_akses');

        } elseif(!$this->auth->Auth_isPrivButton('delete')) {

            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        }  else {
            
            $this->md_quiz->MDL_Delete_item($id_item);
            
            redirect('quiz/CTRL_Edit/'.$this->uri->segment(4));
        }
    }
}
