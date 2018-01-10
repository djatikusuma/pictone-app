<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainlib{

	/*
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}*/

	public function logged_in(){
		$_this =& get_instance();
		$_this->load->helper('url');
		if($_this->session->userdata('login_status') != TRUE){
			redirect(base_url('user/login'));
		}
	}

	public function admin_access(){
		$_this =& get_instance();
		$key = $_this->uri->segment(2);
		$_this->load->model(array('Post_model', 'User_model'));
		$cek = $_this->User_model->get_user_detail($_this->session->userdata('username'));
		$getPerm = $_this->Post_model->read('kel_menu', array('link' => '/'.$key))->row_array();
		$arPerm = json_decode($getPerm['access']);
		if( !in_array($cek->id_group, $arPerm)){
			redirect(base_url('for_admin'));
		}
	}

	public function has_logged(){
		$_this =& get_instance();
		$_this->load->helper('url');
		if($_this->session->userdata('login_status') != FALSE){
			redirect(base_url('for_admin'));
		}
	}

	public function file_upload_load(){
		$_this =& get_instance();

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 100;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;

		$_this->load->library('upload', $config);

	}

	

	public function pagination_load(){
		$_this =& get_instance();
		
		$config['base_url'] = base_url('front/daftar_artikel/hal/');
		$config['total_rows'] = $_this->Post_model->total_rows('tbl_post');
		$config['per_page'] = 5;

		/* config */
		$config['full_tag_open'] = '<div class="paging">';
		$config['full_tag_close'] = '</div>';
		$config['first_url'] = '';

		$_this->pagination->initialize($config);			
	}

}