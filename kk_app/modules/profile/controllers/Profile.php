<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use YoHang88\LetterAvatar\LetterAvatar;

class Profile extends CI_Controller {

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
		$f = $this->Post_model->read($this->tb_galeri, array('id_user' => $this->session->userdata('user_id')));
		
		$data = [
			'title'      => 'Pictone',
			'user'       => $this->ion_auth_model->user($this->session->userdata('user_id'))->row_array(),
			'categories' => $this->Post_model->read($this->tb_kategori)->result(),
			'tags' 		 => $this->Post_model->read($this->tb_tags)->result(),
			'galeris'    => $f->result()
		];
		$data['content'] = $this->parser->parse('feed', $data, TRUE);
		$this->parser->parse('template', $data);
	}

	public function picked()
	{
		$this->db->select('*');
		$this->db->from("{$this->tb_picked} p"); 
		$this->db->join("{$this->tb_galeri} g", 'g.id=p.id_galeri');
		$this->db->join("{$this->tb_users} u", 'u.id=p.id_user');
		$this->db->where('p.id_user',$this->session->userdata('user_id'));
		$f = $this->db->get();
		
		$data = [
			'title'      => 'Pictone',
			'user'       => $this->ion_auth_model->user($this->session->userdata('user_id'))->row_array(),
			'galeris'    => $f->result()
		];
		$data['content'] = $this->parser->parse('picked', $data, TRUE);
		$this->parser->parse('template', $data);
	}
}

/* End of file Profile.php */
/* Location: .//C/xampp/htdocs/darkcatcoder/KukamiDev/web/kk_app/modules/Profile/controllers/Profile.php */