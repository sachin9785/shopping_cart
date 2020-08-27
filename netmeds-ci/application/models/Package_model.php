<?php
class Package_model extends CI_Model{

	function get_all_package(){
		$result=$this->db->get('package');
		return $result;
	}
	
}