<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//date_default_timezone_set("Asia/Jakarta");
	}

	public function index()	{
		$this->load->view('template_login');
	}

	public function doLogin() {
		
		$username = $this->input->post('txtUserName');
		$password = $this->input->post('txtPWD');
		$success  = $this->auth->Auth_doLogin($username,$password);
		//var_dump($success); exit();
		if($success == 1) {
			// lemparkan ke halaman index user
			if($this->auth->Auth_isLogin()) {
				redirect('information');
			} else {
				redirect('login');
			}
		} elseif($success == 2) {
			print("
				<script language=\"javascript\">
					alert('User Not Active. Please try again or contact administrator !!');
					self.history.back();
				</script>
			");
		} else {
			//$data['isLogin'] = false;
			//$this->load->view('form_login', $data);
			//redirect('login/index');
			print("
				<script language=\"javascript\">
					alert('Invalid User ID or Password. Please try again !!');
					self.history.back();
				</script>
			");
		}
	}

	public function logout() {
		$tbluser = $this->config->item('tmst_users');
		$userid = $this->session->userdata('userid');
		
		//$this->db->query("UPDATE $tbluser SET active = 0 WHERE userid = '".$userid."'");
		$this->session->sess_destroy();
		redirect('login');
	}

	public function forgot_password(){
		$email = $this->input->post('forgot_email');
		$this->load->model('md_manage_user');
		//$this->load->model('md_template_email');
		$user = $this->md_manage_user->MDL_IsEmailExist($email);
		
		if(!$user){
			print("
				<script language=\"javascript\">
					alert('".$email." is not registered');
					self.history.back();
				</script>
			");
		}else{
			$user = reset($user);
			$password = $this->randomPassword();
			$this->md_manage_user->MDL_ResetPassword(md5($password), $user->username);
			$config = array(
			'protocol' => $this->config->item('protocol'),
			'smtp_host' => $this->config->item('smtp_host'),
			'smtp_port' => $this->config->item('smtp_port'),
			'smtp_user' => $this->config->item('smtp_user'), // change it to yours
			'smtp_pass' => $this->config->item('smtp_pass'), // change it to yours
			'mailtype' => $this->config->item('mailtype'),
			'charset' => $this->config->item('charset'),
			'wordwrap' => $this->config->item('wordwrap')
			);

			$message = "<strong>Your password has been reset. Use this username and password for sign in</strong> <br/>
						Username : '$user->username' <br/>
						Password : '$password'";

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from($this->config->item('smtp_user'),'Administrator');
			$this->email->to($email);
			$this->email->subject('Password Reset');
			$this->email->message($message);
			$this->email->send();

			print("
				<script language=\"javascript\">
					alert('Your new password has been sent to your email');
					self.history.back();
				</script>
			");
		}
	}

	function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array();
	    $alphaLength = strlen($alphabet) - 1;
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass);
	}
}
