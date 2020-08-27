<?php
class Api extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('api_model');
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type,      Accept");
		header("Content-Type: application/json");
		$json_file = file_get_contents('php://input');
        $this->jsonvalue = json_decode($json_file, true);
		$this->load->library(array('creatorjwt', 'form_validation'));
		$token_data = $this->input->get_request_header('Authorization');
		if(!$token_data){
			echo json_encode (
						array( 
							"status" => $this->lang->line('json_error_status'),
							"error" => $this->lang->line('invalid_login_detail')
						)
					);
			exit;
		}
		$token = $this->creatorjwt->getBearerToken($token_data);
		$this->user_data = $this->creatorjwt->DecodeToken($token);
		
		
		
	}
	
	/**
     * This function is used for get all packages from database table for display packages on frontend.
     * 
     * @return json object
     */
	function products() {
		try {
			$data = $this->api_model->get_all_package();
			echo json_encode($data);
		} catch(Exception $e) {
            echo json_encode(array( 
                "status" => $this->lang->line('json_error_status'), 
                "error" => $e->getMessage()));
            exit;
        } 
	}
	
	/**
     * This function is used for save order information into database and return the order detail.
     *
     * @return json object
     */
	function orders() {
		try {
			$this->jsonvalue['createdAt'] = date("Y-m-d H:i:s");
			if($this->jsonvalue['name']) {
			  $this->jsonvalue['id'] = $this->api_model->insert_data('orders',
				  [
					  'name'=>$this->jsonvalue['name'],
					  'email'=>$this->jsonvalue['email'],
					  'address'=>$this->jsonvalue['address'],
					  'total'=>$this->jsonvalue['total'],
					  'cart_items' => json_encode($this->jsonvalue['cartItems']),
					  'created' => $this->jsonvalue['createdAt'],
					  'user_id' => $this->user_data['id']
				  ]
			  );
			}
			echo json_encode($this->jsonvalue);
		} catch(Exception $e) {
            echo json_encode(array( 
                "status" => $this->lang->line('json_error_status'), 
                "error" => $e->getMessage()));
            exit;
        }
	}
	
	/**
     * This function is used for seach package.
     *
     * @return json object
     */
	function search_package() {
		try {
			$data = $this->api_model->search_package($_GET['search']);
			echo json_encode($data);
		} catch(Exception $e) {
            echo json_encode(array( 
                "status" => $this->lang->line('json_error_status'), 
                "error" => $e->getMessage()));
            exit;
        }
	}
	
	/**
     * This function is used for get login user cart package and add new package into card.
     *
     * @return json object
     */
	function add_to_cart() {
		try {
			if($this->jsonvalue['package_id']) {
				
				$check_exist = $this->api_model->get_table_row('cart',['package_id' => $this->jsonvalue['package_id'], 'user_id' => $this->user_data['id']]);
				
				if(empty($check_exist)) {
					$data = array(
						'package_id' => $this->jsonvalue['package_id'],
						'quantity' => 1, 
						'user_id' => $this->user_data['id']
					);
					$this->api_model->insert_data('cart',$data);
				} else {
					$this->api_model->update_quantity('cart', ['package_id' => $this->jsonvalue['package_id'], 'user_id' => $this->user_data['id']], 'quantity');
				}
			}
			
			$cart_data = $this->api_model->get_cart_data(['user_id' => $this->user_data['id']]);
			echo json_encode($cart_data);
		} catch(Exception $e) {
            echo json_encode(array( 
                "status" => $this->lang->line('json_error_status'), 
                "error" => $e->getMessage()));
            exit;
        }
	}
	
	/**
     * This function is used for remove cart package.
     *
     * @return TRUE|FALSE
     */
	function remove_from_cart() {
		try {
			echo $this->api_model->delete_data("cart" , ['package_id' => $this->jsonvalue['package_id'], 'user_id' => $this->user_data['id']]);
		} catch(Exception $e) {
            echo json_encode(array( 
                "status" => $this->lang->line('json_error_status'), 
                "error" => $e->getMessage()));
            exit;
        }
	}	

}