<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * @Pembuat: Rangga Djatikusuma Lukman 
 * @Tanggal Dibuat: 2017-12-17 18:31:29 
 * @Diperbarui: 2017-12-17 18:31:29 
 */
use YoHang88\LetterAvatar\LetterAvatar;

class Pengaturan extends CI_Controller {

	protected $tb_kategori = 'kategori';
	protected $tb_galeri   = 'galeri';
	protected $tb_users    = 'users';
	protected $tb_picked   = 'picked';
	protected $tb_tags     = 'tags';
	protected $tb_DTtags   = 'detail_tags';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Post_model');
		$this->load->library(array('ion_auth'));
		$this->load->helper(array('site_helper','file'));

		if (!$this->ion_auth->logged_in())
		{
			$hasil = array(
					'msg'   => 'Proses ini hanya untuk pengguna yang telah signin', 
					'error' => 1, 
					'alert' => 'warning', 
					'icon'  => 'info'
		    	);
		        $this->session->set_flashdata($hasil);
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}	
	}

	public function index()
	{
		
		$data = [
			'title'      => 'Pictone',
			'user'       => $this->ion_auth_model->user($this->session->userdata('user_id'))->row_array(),
			'categories' => $this->Post_model->read($this->tb_kategori)->result(),
			'tags' 		 => $this->Post_model->read($this->tb_tags)->result(),
		];
		$data['content'] = $this->parser->parse('pengaturan', $data, TRUE);
		$this->parser->parse('template', $data);
	}

	public function update()
	{
		$post = $this->input->post(NULL);
		if(!empty($post['email']) && $this->uri->segment(3)){
			$data = array(
				'first_name' => $post['first_name'],
				'last_name'  => $post['last_name'],
				'phone'      => $post['phone'],
				'email'      => $post['email']
			);

			if($post['password'] != ''){
				$data['password'] = $post['password'];
			}

			$this->ion_auth_model->update($this->uri->segment(3), $data);
			$hasil = array(
				'msg'   => 'Data berhasil diperbarui', 
				'error' => 1, 
				'alert' => 'success', 
				'icon'  => 'checkmark'
			);
			$this->session->set_flashdata($hasil);
			redirect('pengaturan');
		}else{
			$hasil = array(
				'msg'   => 'Terdapat kesalahan ketika memperbarui data', 
				'error' => 1, 
				'alert' => 'danger', 
				'icon'  => 'info'
			);
			$this->session->set_flashdata($hasil);
			redirect('pengaturan');
		}
	}
}

/* End of file Pengaturan.php */
/* Location: .//C/xampp/htdocs/darkcatcoder/KukamiDev/web/kk_app/modules/Pengaturan/controllers/Pengaturan.php */