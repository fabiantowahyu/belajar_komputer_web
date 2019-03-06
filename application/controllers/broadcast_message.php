<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Broadcast_message extends CI_Controller {

   
    public function __construct() {
        parent::__construct();
        $this->load->model('md_broadcast_message');
    }

    public function index() {
        if (!$this->auth->Auth_isLogin()) {
            $this->load->view('error_akses');
        } else {
            
           if ($this->input->post('submit')) {
                
                    $res = $this->md_broadcast_message->MDL_Insert();
                    if($res==TRUE){
                    $this->session->set_flashdata('send_success', 'Message Sent !');
                    }else{
                       $this->session->set_flashdata('send_failed', 'Broadcast Failed'); 
                        
                    }
                    redirect('broadcast_message');
            } else {
           

            $data['results'] = $this->md_broadcast_message->MDL_Select();
            $data['id'] = $this->md_broadcast_message->MDL_getAutoID();
            
            $Aryreceiver = $this->CTRL_Option_Receiver();
		$data['receiver'] = '';
		$data['option_receiver'] = $Aryreceiver;
            
            $data['title'] = "Broadcast Message";
            $data['url'] = 'broadcast_message/';
            $data['url_view'] = sprintf("%sbroadcast_message/CTRL_View/", site_url());
            $data['page'] = 'broadcast_message/view';
            $data['plugin'] = 'broadcast_message/plugin';
            $this->load->view('template_admin', $data);
        }
        }
    }

 
    public function CTRL_Option_Receiver() {

	
	$option['all'] = 'All user';
        
	return $option;
    }
}
