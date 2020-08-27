<?php
class Login_model extends CI_Model{
	
	function __construct(){
		$this->table = 'users';
	}
	
	function get_login_detail($email, $password){
		return $this->db->where(
			['email' => $email,
			'password' => $password,
			'status' => 1])->get($this->table)->row();
	}
	
}