<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
 
class Latihan extends REST_Controller {

	protected $table = 'testing';
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data mahasiswa
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $mahasiswa = $this->db->get($this->table)->result();
        } else {
            $this->db->where('id', $id);
            $mahasiswa = $this->db->get($this->table)->result();
        }
        $this->response($mahasiswa, 200);
    }
 
    // insert new data to mahasiswa
    function index_post() {
        $data = array(
					'code' => $this->post('code'),
					'name' => $this->post('name')
                );
        $insert = $this->db->insert($this->table, $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data mahasiswa
    function index_put() {
        $id = $this->put('id');
        $data = array(
					'code' => $this->post('code'),
					'name' => $this->post('name')
                );
        $this->db->where('id', $id);
        $update = $this->db->update($this->table, $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete mahasiswa
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete($this->table);
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}

/* End of file Latihan.php */
/* Location: .//C/xampp/htdocs/kukamidev/vue/kk_app/controllers/api/Latihan.php */