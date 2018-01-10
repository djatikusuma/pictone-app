<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RDL_Model extends CI_Model {
	protected $_table_name;

	public function __construct()
	{
		parent::__construct();
		
	}
	
	Public function insert($data)
	{
		return $this->db->insert($this->_table_name,$data);
	}
	Public function edit($id)
	{
		return $this->db->get_where($this->_table_name,array('id'=>$id))->row();
	}
	Public function update($id, $data)
	{
		$where = array('id'=>$id);
		return $this->db->update($this->_table_name,$data,$where);
	}
	Public function delete($data)
	{
		for ($i=0; $i <count($data) ; $i++) { 
			$this->db->delete($this->_table_name,array('id' => $data[$i]->id));
		}
		return true;
		
	}
	public function count($where)
	{
		if($where){
			return $this->db->get_where($this->_table_name, $where)->num_rows();
		}else{
			return $this->db->count_all_results($this->_table_name);
		}

	}
	Public function get_data($size, $page)
	{
		return $this->db->get($this->_table_name, $size, $page)->result();
	}
	public function search($where, $size, $page){
		return $this->db->get_where($this->_table_name, $where, $size, $page)->result();
	}
	

}

/* End of file RDL_Model.php */
/* Location: .//C/xampp/htdocs/kukamidev/vue/kk_app/core/RDL_Model.php */