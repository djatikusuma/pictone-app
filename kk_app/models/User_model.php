<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {
	protected $_table_name = 'users';
	protected $_primary_key = 'id';
	protected $_order_by = 'level';
	protected $_order_by_type = 'ASC';

	
	public function __construct(){
		parent::__construct();
	}

	public function user_register($input){
		$this->load->helper('site_helper');
		$encrypt_password = bCrypt($input['password'],12);
		$array_user = array(
				'username' => $input['username'],
				'password' => $encrypt_password,
				'level' => $input['level']
			);

		$this->db->insert('kel_user', $array_user);
	}

	public function exist_row_check($field,$data){
		$this->db->where($field,$data);
		$this->db->from('kel_user');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_user_detail($username){
		$this->db->where("username", $username);
		$query = $this->db->get($this->_table_name);

		if($query->num_rows() > 0){
			$data = $query->row();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */