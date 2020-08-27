<?php
class Login extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		if($this->session->userdata('logged_in')){ redirect('package');}   
	}

	function index(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_login_detail');
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('login');
		} else {
		 redirect('package', 'refresh');
		}
	}
	
	function check_login_detail($password) {
		$this->load->model('login_model');
		$email = $this->input->post('email');
		$result = $this->login_model->get_login_detail($email, md5($password));
	
		if(!empty($result)) {
			$sess_array = array(
			'id' => $result->id,
			'email' => $result->email,
			'role' => $result->role,         
			'first_name' => $result->first_name,         
			'last_name' => $result->last_name,         
			);
			$this->session->set_userdata('logged_in', $sess_array);
			return TRUE;
		} else {
			$this->form_validation->set_message('check_login_detail', 'Username or Password Invalid');
			return false;
		}
	}

	
}