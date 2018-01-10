<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * @Pembuat: Rangga Djatikusuma Lukman 
 * @Tanggal Dibuat: 2017-12-17 18:31:14 
 * @Diperbarui: 2017-12-17 18:31:14 
 */
use YoHang88\LetterAvatar\LetterAvatar;


class Beranda extends CI_Controller {

	protected $tb_kategori = 'kategori';
	protected $tb_galeri   = 'galeri';
	protected $tb_filter   = 'filter';
	protected $tb_picked   = 'picked';
	protected $tb_tags     = 'tags';
	protected $tb_DTtags   = 'detail_tags';
	protected $tb_komentar = 'komentar';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Post_model');
		$this->load->library(array('ion_auth'));
		$this->load->helper(array('site_helper','file'));

		/*if (!$this->ion_auth->logged_in())
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
		}	*/	
	}

	public function avatar()
	{
		$avatar = new LetterAvatar('Steven Spielberg');
		echo "<img src=\"{$avatar}\" />";
	}

	public function testing()
	{
		// $tg = $this->db->query("SELECT group_concat(nm_tags) as nama_tags FROM $this->tb_DTtags
		// JOIN $this->tb_galeri ON galeri.id = detail_tags.id_galeri
		// JOIN $this->tb_tags ON tags.id = detail_tags.id_tags
		// WHERE id_galeri = 29");
		// $tgf = $tg->result();
		// echo "<pre>";
		// print_r($tgf[0]->nama_tags);

		$gets = $this->Post_model->get_komentar(array('id_galeri' => 31));
		echo "<pre>";
		print_r($gets->result());
	}

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		$fil = $this->Post_model->read($this->tb_filter, array('id_user' => $user_id));
		if(sizeof($fil->result()) > 0){
			$f = $this->db->query("SELECT group_concat(id_kategori) as kat_con FROM $this->tb_filter
			WHERE id_user = $user_id");
			$ff = $f->result();
			$split = explode(',', $ff[0]->kat_con);
			$gal = $this->Post_model->filter($this->tb_galeri, NULL, $split)->result();
		}else{
			$gal = $this->Post_model->read($this->tb_galeri)->result();
		}
		$data = [
			'title'      => 'Pictone',
			'user'       => $this->ion_auth_model->user($this->session->userdata('user_id'))->row_array(),
			'categories' => $this->Post_model->read($this->tb_kategori)->result(),
			'tags' 		 => $this->Post_model->read($this->tb_tags)->result(),
			'trend'      => $this->Post_model->trend_tags()->result(),
			'f'			 => $fil->result(),
			'galeris'    => $gal
		];
		$data['content'] = $this->parser->parse('beranda', $data, TRUE);
		$this->parser->parse('template', $data);
	}

	public function picked($id=NULL)
	{
		if($id==NULL){
			redirect(base_url());
		}else{
			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'id_galeri' => $id
			);

			$this->Post_model->create($this->tb_picked, $data);
			$hasil = array(
				'msg'   => 'Galeri berhasil di Picked', 
				'error' => 1, 
				'alert' => 'success', 
				'icon'  => 'checkmark'
			);
			$this->session->set_flashdata($hasil);
			redirect(base_url('profile/picked'));
		}
	}

	public function unpicked($id=NULL)
	{
		if($id==NULL){
			redirect(base_url());
		}else{
			$this->Post_model->delete($this->tb_picked, array('id_user' => $this->session->userdata('user_id'), 'id_galeri' => $id));
			$hasil = array(
				'msg'   => 'Galeri berhasil di Unpicked', 
				'error' => 1, 
				'alert' => 'success', 
				'icon'  => 'checkmark'
			);
			$this->session->set_flashdata($hasil);
			redirect(base_url('profile/picked'));
		}
	}

	public function search()
	{
		$q = $this->input->get('q');
		//$f = $this->Post_model->read($this->tb_filter, array('id_user' => $this->session->userdata('user_id')));
		
		$user_id = $this->session->userdata('user_id');
		$fil = $this->Post_model->read($this->tb_filter, array('id_user' => $user_id));
		if(sizeof($fil->result()) > 0){
			$f = $this->db->query("SELECT group_concat(id_kategori) as kat_con FROM $this->tb_filter
			WHERE id_user = $user_id");
			$ff = $f->result();
			$split = explode(',', $ff[0]->kat_con);
			$gal = $this->Post_model->filter($this->tb_galeri, array('deskripsi LIKE' => "%$q%"), $split)->result();
		}else{
			$gal = $this->Post_model->read($this->tb_galeri, array('deskripsi LIKE' => "%$q%"))->result();
		}
		$data = [
			'title'      => 'Pictone',
			'user'       => $this->ion_auth_model->user($this->session->userdata('user_id'))->row_array(),
			'categories' => $this->Post_model->read($this->tb_kategori)->result(),
			'trend'      => $this->Post_model->trend_tags()->result(),
			'f'			 => $fil->result(),
			'galeris'    => $gal
		];
		$data['content'] = $this->parser->parse('beranda', $data, TRUE);
		$this->parser->parse('template', $data);
	}

	public function tag()
	{
		$q = $this->input->get('q');
		
		$user_id = $this->session->userdata('user_id');
		$fil = $this->Post_model->read($this->tb_filter, array('id_user' => $user_id));
		if(sizeof($fil->result()) > 0){
			$f = $this->db->query("SELECT group_concat(id_kategori) as kat_con FROM $this->tb_filter
			WHERE id_user = $user_id");
			$ff = $f->result();
			$split = explode(',', $ff[0]->kat_con);
			$gal = $this->Post_model->tag(array('slug_tags LIKE' => "%$q%"), $split)->result();
		}else{
			$gal = $this->Post_model->tag(array('slug_tags LIKE' => "%$q%"))->result();
		}

		$data = [
			'title'      => 'Pictone',
			'user'       => $this->ion_auth_model->user($this->session->userdata('user_id'))->row_array(),
			'categories' => $this->Post_model->read($this->tb_kategori)->result(),
			'trend'      => $this->Post_model->trend_tags()->result(),
			'f'			 => $fil->result(),
			'galeris'    => $gal
		];
		$data['content'] = $this->parser->parse('beranda', $data, TRUE);
		$this->parser->parse('template', $data);
	}

	public function filter()
	{
		// reset filter
		$this->Post_model->delete($this->tb_filter, array('id_user' => $this->session->userdata('user_id')));
		$f = $this->input->post('filter');
		for ($i=0; $i < sizeof($f); $i++) { 
			$data = array('id_user' => $this->session->userdata('user_id'), 'id_kategori' => $f[$i]);
			$this->Post_model->create($this->tb_filter, $data);
		}
		$hasil = array(
			'msg'   => 'Filter telah diterapkan', 
			'error' => 1, 
			'alert' => 'warning', 
			'icon'  => 'info'
    	);
        $this->session->set_flashdata($hasil);
		// redirect them to the login page
		redirect(base_url());
		// print_r($this->Post_model->filter($this->tb_galeri, $this->input->post('filter'))->result());

	}


	public function update($id)
	{
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
		if(!empty($post['nama'])){
			$tanggal = str_replace('-', '', date('d-m-Y'));

			$getgal = $this->Post_model->read($this->tb_galeri, array('id' => $id))->row();
			if($getgal->nama === $post['nama']){
				$slug = $getgal->url_slug;
			}else{
				$slug = str_replace('-','', crc32(date('G:i:s')))."_".slug($post['nama']);
			}

			$data = array(
				'id_user'     => $this->session->userdata('user_id'),
				'id_kategori' => $post['id_kategori'],
				'nama'        => $post['nama'],
				'deskripsi'   => $post['deskripsi'],
				'url_slug'    => $slug
			);

			if(!empty($post['tags'])){
				// cek tags di database
				$tag = $post['tags'];
				foreach ($tag as $val) {
					$data_tg = array(
						"nm_tags" => $val,
						"slug_tags" => slug($val)
					);
					$cekurl = $this->Post_model->cek_data($this->tb_tags, array('slug_tags' => slug($val)));
					if($cekurl->row_array()>0){
					continue;
					}
					else{
					$this->db->set($data_tg)->insert($this->tb_tags);
					}
				}
				// reset filter
				$this->Post_model->delete($this->tb_DTtags, array('id_galeri' => $id));
				
				// insert data id tags dan id galeri ke database detail_tags
				foreach ($tag as $val) {
					// ambil data tags yg baru saja di unggah
					$getTg = $this->Post_model->cek_data($this->tb_tags, array('slug_tags' => slug($val)));
					$tg = $getTg->row();
	
					$data_tg = array(
						"id_galeri" => $id,
						"id_tags" => $tg->id
					);
					
					$this->db->set($data_tg)->insert($this->tb_DTtags);
				}
			}

			// update data galeri
			$this->Post_model->update($this->tb_galeri,$data, array('id' => $id));

			$hasil = array(
				'msg'   => $post['nama'].' berhasil diperbarui', 
				'error' => 1, 
				'alert' => 'success', 
				'icon'  => 'save'
	    	);
	        $this->session->set_flashdata($hasil);
			redirect(base_url());
		}else{
			$hasil = array(
				'msg'   => 'Terjadi kesalahan ketika memperbarui gambar', 
				'error' => 1, 
				'alert' => 'error', 
				'icon'  => 'info'
	    	);
	        $this->session->set_flashdata($hasil);
			redirect(base_url());
		}	
	}

	public function store()
	{
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
		if(!empty($post['nama'])){
			$tanggal = str_replace('-', '', date('d-m-Y'));

			$data = array(
				'id_user'     => $this->session->userdata('user_id'),
				'id_kategori' => $post['id_kategori'],
				'nama'        => $post['nama'],
				'deskripsi'   => $post['deskripsi'],
				'url_slug'    => str_replace('-','', crc32(date('G:i:s')))."_".slug($post['nama'])
			);
			$wh = array(
				'id_user' => $data['id_user'],
				'url_slug' => $data['url_slug'],
				'nama' => $data['nama'],
			);

			//upload
			$config['upload_path']   = './kk_uploads/galeri/';
			$config['allowed_types'] =  'jpg|png|jpeg';
			$config['max_size']      = '5120';
			$config['file_name']	 = md5(slug($data['nama']).time())."_{$tanggal}";
	 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
	 
			if ($this->upload->do_upload('featured_image')){
				$file                     = $this->upload->data();
				$data['file_img']    = $file['file_name'];
				$config['image_library']  = 'gd2';
				$config['source_image']   = $file['full_path'];
				$config['create_thumb']   = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']          = 300;
				$config['height']         = 300;
				$config['new_image']      = './kk_uploads/galeri/thumbnail/';

				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$data['thumbnail'] = $file['raw_name'].'_thumb'.$file['file_ext'];
				$this->image_lib->clear();
			}else {
				$type = get_mime_by_extension($_FILES['featured_image']['name']);
				if(($type != 'image/jpeg' || $type != 'image/png' || $type != 'image/gif') && $_FILES['featured_image']['size'] > $config['max_size']) {
					$error = $this->upload->display_errors();
					redirect('');
				}
			}

			// cek tags di database
			$tag = $post['tags'];
			foreach ($tag as $val) {
				$data_tg = array(
					"nm_tags" => $val,
					"slug_tags" => slug($val)
				);
				$cekurl = $this->Post_model->cek_data($this->tb_tags, array('slug_tags' => slug($val)));
				if($cekurl->row_array()>0){
				  continue;
				}
				else{
				  $this->db->set($data_tg)->insert($this->tb_tags);
				}
			}
			
			// Insert ke database galeri
			$this->Post_model->create($this->tb_galeri,$data);

			// ambil data galeri yg baru saja di unggah
			$getAll = $this->Post_model->read($this->tb_galeri,$wh);
			$rows = $getAll->row();

			// insert data id tags dan id galeri ke database detail_tags
			foreach ($tag as $val) {
				// ambil data tags yg baru saja di unggah
				$getTg = $this->Post_model->cek_data($this->tb_tags, array('slug_tags' => slug($val)));
				$tg = $getTg->row();

				$data_tg = array(
					"id_galeri" => $rows->id,
					"id_tags" => $tg->id
				);
				
				$this->db->set($data_tg)->insert($this->tb_DTtags);
			}

			$hasil = array(
				'msg'   => 'Selamat gambar berhasil dipublish', 
				'error' => 1, 
				'alert' => 'success', 
				'icon'  => 'save'
	    	);
	        $this->session->set_flashdata($hasil);
			redirect(base_url());
		}else{
			$hasil = array(
				'msg'   => 'Terjadi kesalahan ketika mempublish gambar, mohon ulangi kembali', 
				'error' => 1, 
				'alert' => 'error', 
				'icon'  => 'info'
	    	);
	        $this->session->set_flashdata($hasil);
			redirect(base_url());
		}	
	}

	public function delete($id=NULL)
	{
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
		if($id){
			$this->Post_model->delete($this->tb_galeri, array('id' => $id));
			$hasil = array(
				'msg'   => 'Gambar berhasil dihapus', 
				'error' => 1, 
				'alert' => 'success', 
				'icon'  => 'trash'
	    	);
	        $this->session->set_flashdata($hasil);
			redirect(base_url());
		}
	}

	public function galeri_detail()
	{
		$slug = $this->uri->segment(2);
		$data['user']    = $this->ion_auth_model->user($this->session->userdata('user_id'))->row_array();
		$data['galeri']	 = $this->Post_model->read($this->tb_galeri, array('url_slug' => $slug))->row_array();
		$data['title']   = $data['galeri']['nama'].' - Pictone';

		$id_gal = $data['galeri']['id'];
		$tg = $this->db->query("SELECT group_concat(nm_tags) as nama_tags FROM $this->tb_DTtags
								JOIN $this->tb_galeri ON galeri.id = detail_tags.id_galeri
								JOIN $this->tb_tags ON tags.id = detail_tags.id_tags
								WHERE id_galeri = $id_gal");
		$rw = $tg->result();

		$data['get_tags'] = $rw[0]->nama_tags;

		$gets = $this->Post_model->get_komentar(array('id_galeri' => $id_gal));
		$data['get_komentar'] = $gets->result();

		$data['content'] = $this->parser->parse('galeri_detail', $data, TRUE);
		$this->parser->parse('template', $data);
	}

	public function komentar_post()
	{
		$post = $this->input->post(NULL,TRUE);
		$url = $post['url_slug'];
		if($post==NULL){
			redirect(base_url());
		}else{
			$data = array(
				"id_user" => $this->session->userdata('user_id'),
				"id_galeri" => $post['id_galeri'],
				"teks_komentar" => $post['teks_komentar'],	
			);

			$this->Post_model->create($this->tb_komentar, $data);
			$hasil = array(
				'msg'   => 'Berhasil mengomentari', 
				'error' => 1, 
				'alert' => 'success', 
				'icon'  => 'checkmark'
			);
			$this->session->set_flashdata($hasil);
			redirect(base_url("galeri_detail/$url"));
		}
	}

	public function komentar_delete($id=NULL)
	{
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
		if($id){
			$this->Post_model->delete($this->tb_komentar, array('id' => $id));
			$hasil = array(
				'msg'   => 'Komentar berhasil dihapus', 
				'error' => 1, 
				'alert' => 'success', 
				'icon'  => 'trash'
	    	);
	        $this->session->set_flashdata($hasil);
			redirect(base_url());
		}
	}

}

/* End of file Beranda.php */
/* Location: .//C/xampp/htdocs/darkcatcoder/KukamiDev/web/kk_app/modules/Beranda/controllers/Beranda.php */