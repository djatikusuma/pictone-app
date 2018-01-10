<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * @Pembuat: Rangga Djatikusuma Lukman 
 * @Tanggal Dibuat: 2017-12-17 18:30:56 
 * @Diperbarui: 2017-12-17 18:30:56 
 */
class For_admin extends CI_Controller {

	protected $tb_kategori = 'kategori';
	protected $tb_users    = 'users';

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Post_model', 'Ion_auth_model'));
		$this->load->library(array('ion_auth'));
		$this->load->helper('site_helper');

		if (!$this->ion_auth->is_admin())
		{
			redirect(base_url());
		}
	}

	public function index()
	{
		redirect('for_admin/kategori');
	}

	public function kategori($page=null)
	{
		switch ($page) {
			case 'store':
				if (!$this->ion_auth->logged_in())
				{
					$hasil = array(
						'msg'   => 'Proses ini hanya untuk pengguna yang telah signin', 
						'error' => 1, 
						'alert' => 'warning', 
						'icon'  => 'info'
			    	);
			        $this->session->set_flashdata($hasil);
					redirect(base_url());
				}
				$post = $this->input->post(NULL);
				if(!empty($post['nama'])){
					$data = array(
						'nama'        => $post['nama'],
						'deskripsi'   => $post['deskripsi']
					);
					$this->Post_model->create($this->tb_kategori,$data);
					$hasil = array(
						'msg'   => "Kategori {$post['nama']} berhasil ditambahkan", 
						'error' => 1, 
						'alert' => 'success', 
						'icon'  => 'save'
			    	);
			        $this->session->set_flashdata($hasil);
					redirect('for_admin/kategori');
				}else{
					$hasil = array(
						'msg'   => "Kategori {$post['nama']} gagal ditambahkan", 
						'error' => 1, 
						'alert' => 'error', 
						'icon'  => 'info'
			    	);
			        $this->session->set_flashdata($hasil);
					redirect('for_admin/kategori');
				}
				break;
			case 'update':
				$post = $this->input->post(NULL);
				if(!empty($post['nama']) && $this->uri->segment(4)){
					$data = array('nama' => $post['nama'], 'deskripsi' => $post['deskripsi']);
					$this->Post_model->update($this->tb_kategori, $data, array('id' => $this->uri->segment(4)));
					$hasil = array(
						'msg'   => "Kategori {$post['nama']} berhasil diperbarui", 
						'error' => 1, 
						'alert' => 'success', 
						'icon'  => 'save'
			    	);
			        $this->session->set_flashdata($hasil);
					redirect('for_admin/kategori');
				}else{
					$hasil = array(
						'msg'   => "Kategori {$post['nama']} gagal diperbarui", 
						'error' => 1, 
						'alert' => 'error', 
						'icon'  => 'info'
			    	);
			        $this->session->set_flashdata($hasil);
					redirect('for_admin/kategori');
				}
				break;
			case 'delete':
				$id = $this->uri->segment(4);
				if($id){
					$this->Post_model->delete($this->tb_kategori, array('id' => $id));
					$hasil = array(
						'msg'   => "Kategori berhasil dihapus", 
						'error' => 1, 
						'alert' => 'warning', 
						'icon'  => 'trash'
			    	);
			        $this->session->set_flashdata($hasil);
					redirect('for_admin/kategori');
				}
				break;
			default:
				$data = [
					'title'      => 'Pictone[ADMIN] - Kategori',
					'user'       => $this->ion_auth_model->user($this->session->userdata('user_id'))->row_array(),
					'categories' => $this->Post_model->read($this->tb_kategori)->result()
				];
				$data['content'] = $this->parser->parse('kategori/view', $data, TRUE);
				$this->parser->parse('template', $data);
				break;
		}
	}

	public function pengguna($page=null)
	{
		switch ($page) {
			case 'store':
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
					redirect(base_url());
				}
				$post = $this->input->post(NULL);
				if(!empty($post['first_name'])){
					$email    = strtolower($post['email']);
					$identity = $email;
					$password = $post['password'];

					$data = array(
						'first_name' => $post['first_name'],
						'last_name'  => $post['last_name'],
						'phone'      => $post['phone']
					);
					$this->ion_auth_model->register($identity, $password, $email, $data);
					redirect('for_admin/pengguna');
				}else{
					redirect('for_admin/pengguna');
				}
				break;
			case 'update':
				$post = $this->input->post(NULL);
				if(!empty($post['email']) && $this->uri->segment(4)){
					$data = array(
						'first_name' => $post['first_name'],
						'last_name'  => $post['last_name'],
						'phone'      => $post['phone'],
						'email'      => $post['email']
					);

					if($post['password'] != ''){
						$data['password'] = $post['password'];
					}

					$this->ion_auth_model->update($this->uri->segment(4), $data);

					redirect('for_admin/pengguna');
				}else{
					redirect('for_admin/pengguna');
				}
				break;
			case 'delete':
				$id = $this->uri->segment(4);
				if($id){
					$this->Post_model->delete($this->tb_users, array('id' => $id));
					redirect('for_admin/pengguna');
				}
				break;
			default:
				$data = [
					'title' => 'Pictone[ADMIN] - Users',
					'user'  => $this->ion_auth_model->user($this->session->userdata('user_id'))->row_array(),
					'users' => $this->Post_model->read($this->tb_users)->result()
				];
				$data['content'] = $this->parser->parse('users/view', $data, TRUE);
				$this->parser->parse('template', $data);
				break;
		}
	}

}

/* End of file For_admin.php */
/* Location: .//C/xampp/htdocs/kukamidev/vue/kk_app/modules/for_admin/controllers/For_admin.php */