<?php
class Api_model extends CI_Model{

	/**
     * This function is used for get all package list.
     *
     * @return object
     */
	function get_all_package(){
		$result=$this->db->get('package')->result();
		return $result;
	}
	
	/**
     * This function is used for search package in package table.
     *
	 * @params string|number $search_data 
     * @return object
     */
	function search_package($search_data){
		$this->db->select('*');
        $this->db->from('package');
		if($search_data !=""){
			$this->db->like('package_name',$search_data);
			$this->db->or_like('package_price',$search_data);
		}
        $query = $this->db->get();
        return $query->result();
	}
	
	/**
     * This function is used for insert data into table.
     *
	 * @params string $table table name
	 * @params array $data 
     * @return int
     */
	function insert_data($table,$data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	
	/**
     * This function is used for get table row.
     *
	 * @params string $table table name
	 * @params array $where 
     * @return object
     */
	function get_table_row($table,$where){
		$query = $this->db->get_where($table,$where);
        return $query->row();  
	}
	
	/**
     * This function is used for incriment the table spacific column value by 1.
     *
	 * @params string $table table name
	 * @params array $where 
	 * @params string $column 
     * @return 1|0
     */
	function update_quantity($table,$where,$column){
		$this->db->set($column, "$column+1", FALSE); 
		$this->db->where($where);
        return $this->db->update($table);
    }
	
	/**
     * This function is used for get table all data with match condition.
     *
	 * @params string $table table name
	 * @params array $where 
     * @return object
     */
	function get_data($table,$where) {
		$query = $this->db->get_where($table,$where);
        return $query->result();  
	}
	
	/**
     * This function is used for get cart table data of login user.
     *
	 * @params array $where 
     * @return object
     */
	function get_cart_data($where) {
		$this->db->select('cart.id , cart.quantity as count , cart.package_id, package.package_name, package.package_price, package.package_image');
		$this->db->from('cart');
		$this->db->join('package', 'package.package_id = cart.package_id');
		$this->db->where($where);
		$query = $this->db->get();
        return $query->result();  
	}
	
	/**
     * This function is used for delete any table row with match condition.
     *
	 * @params string $table table name
	 * @params array $where 
     * @return object
     */
	function delete_data($table,$where) {
		$this->db->where($where);
        return $this->db->delete($table);
	}
	
}