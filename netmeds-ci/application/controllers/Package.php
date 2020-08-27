<?php
class Package extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){ redirect('login'); }
		$this->load->model('package_model');
	}

	function index(){
		$data['data']=$this->package_model->get_all_package();
		$this->load->view('package_list',$data);
	}

	function add_to_cart(){ 
		$data = array(
			'id' => $this->input->post('package_id'), 
			'name' => $this->input->post('package_name'), 
			'price' => $this->input->post('package_price'), 
			'qty' => $this->input->post('quantity'), 
			'user_id' => $this->session->userdata('logged_in')['id']
		);
		$this->cart->insert($data);
		echo $this->show_cart(); 
	}

	function show_cart(){ 
		$this->load->view('cart');
	}

	function load_cart(){ 
		echo $this->show_cart();
	}

	function delete_cart(){ 
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
}