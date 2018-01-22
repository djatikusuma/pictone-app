<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function create($table,$data){
		$this->db->insert($table,$data);
	}

	public function viewer($table, $data, $where=NULL){
		if($where)
            $this->db->where($where);

        $this->db->set($data);

		$this->db->update($table,$data);		
	}

	public function read($table, $where=NULL, $order=NULL, $type=NULL, $limit=NULL, $offset=NULL){
		$this->db->from($table);

		if($where)
            $this->db->where($where);
        if($limit && $offset)
            $this->db->limit($limit,$offset);
        if($order && $type)
			$this->db->order_by($order, $type);

		$query = $this->db->get();

		return $query;
	}

	public function filter($table, $w=NULL, $where=NULL){
		$this->db->from($table);

		if($w!=NULL)
			$this->db->where($w);
			
		$this->db->where_in('id_kategori', $where);

		$query = $this->db->get();

		return $query;
	}

	public function tag($w=NULL, $where=NULL)
	{
		$this->db->from('detail_tags');
		$this->db->join('tags', 'tags.id = detail_tags.id_tags');
		$this->db->join('galeri', 'galeri.id = detail_tags.id_galeri');

		if($w!=NULL)
			$this->db->where($w);
			
		if($where!=NULL)	
			$this->db->where_in('id_kategori', $where);

		$query = $this->db->get();

		return $query;
	}

	public function get_komentar($w=NULL)
	{
		$this->db->select('concat_ws(" ", first_name, last_name) as nama_lengkap, komentar.id as id_kom, users.id as id_user, teks_komentar, tanggal');
		$this->db->from('komentar');
		$this->db->join('users', 'users.id = komentar.id_user');
		$this->db->join('galeri', 'galeri.id = komentar.id_galeri');
		$this->db->order_by('komentar.id', 'ASC');

		if($w!=NULL)
			$this->db->where($w);

		$query = $this->db->get();

		return $query;
	}

	public function edit($table, $where=NULL){
		if($where)
            $this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			$data = $query->row();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
	}

	public function update($table, $data, $where=NULL){
		if($where)
            $this->db->where($where);

        $this->db->set($data);

		$this->db->update($table,$data);		
	}
	

	public function delete($table, $where=NULL){
		if($where)
            $this->db->where($where);
		$this->db->delete($table);
	}
	
	public function trend_tags()
	{
		$sql = "SELECT nm_tags, COUNT(nm_tags) as jml_tags FROM tags
				INNER JOIN detail_tags ON tags.`id` = detail_tags.`id_tags`
				GROUP BY id
				ORDER BY COUNT(nm_tags) DESC
				LIMIT 10";
		return $this->db->query($sql);
	}

	public function get_user($id)
	{
		if($id)
            $this->db->where('id_user', $id);

		$this->db->select('first_name, last_name');
		$this->db->from('galeri');
		$this->db->join('users', 'users.id = galeri.id_user');
		$query = $this->db->get();
		return $query;
	}

	function cek_data($table=NULL, $where=NULL){
    	if($where)
    		$this->db->where($where);
    	return $this->db->get($table);
    }

}

/* End of file Post_model.php */
/* Location: ./application/models/Post_model.php */