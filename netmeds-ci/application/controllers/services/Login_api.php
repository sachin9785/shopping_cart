<?php
class Login_api extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('api_model');
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type,      Accept");
		header("Content-Type: application/json");
		$json_file = file_get_contents('php://input');
        $this->jsonvalue = json_decode($json_file, true);
		$this->load->library(array('creatorjwt', 'form_validation'));
		
	}
	
	/**
     * This function is used for login user.
     *
     * @return json object
     */
    function login() {
        try {
            $json_data = new stdClass();
			
			$this->form_validation->set_rules('email', '', 'required|valid_email');
			$this->form_validation->set_rules('password', '', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => $this->lang->line('json_error_status'), 'error' => $this->form_validation->error_array()]);
            } else {
				$params = new stdClass();
				$getData = $this->api_model->get_table_row ('users',
					[
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password'))
					]
				);
				
				if (!empty($getData)) {
					unset($getData->password);
					$jwt_token = $this->creatorjwt->GenerateToken($getData);
					echo json_encode (
						array (
							'token' => $jwt_token,
							'status' => $this->lang->line('json_success_status')
						)
					);
				} else {
					$json_data->display_error= $this->lang->line('invalid_login_detail');
					
					echo json_encode (
						array( 
							"status" => $this->lang->line('json_error_status'),
							"error" =>$json_data
						)
					);
				}
            }
			exit;
        } catch(Exception $e) {
            echo json_encode(array( 
                "status" => $this->lang->line('json_error_status'), 
                "error" => $e->getMessage()));
            exit;
        }
    }
	

}