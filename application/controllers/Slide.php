<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slide extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        date_default_timezone_set('Asia/Jakarta');
        // // $this->load->model('Auth_model', 'auth');
        // $this->load->model('Admin_model', 'admin');
        $this->load->model('Base_model', 'base');
    }

    public function index()
    {
        $data['title'] = "Slide Gambar";
        $data['slide'] = $this->base_model->get('slide')->result();
        $this->template->load('template', 'slide/data', $data);
    }

    public function add()
    {
        $data['title'] = "Slide Gambar";
        $this->template->load('template', 'slide/add', $data);
    }
    
    public function delete($id)
    {
        $where = array('id_slide' => $id);
        $this->base_model->del('slide', $where);
        redirect('admin/slide');
    }

    public function insertdata()
	{
		$config['upload_path']          = './assets/img/uploads/slide/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 5000;
		$config['max_width']            = 10000;
		$config['max_height']           = 10000;

		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('userfile')) {
			// $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Format gambar bukan PNG. </div>');

			// redirect('campaign/add');
			$gambar = $this->upload->data();
			$gambar = $gambar['file_name'];

			$data = array(
				// 'tittle_twibbon' => $tittle,
				'gambar' => $gambar
				// 'deskripsi' => $deskripsi,
				// 'date' => $date,
				// 'id_user' => $id_user
			);
			var_dump($data);
		} else {

			$gambar = $this->upload->data();
			$gambar = $gambar['file_name'];

			$data = array(
				
				'gambar_name' => $gambar
				
			);

			var_dump($data);
			$this->base_model->insert('slide', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data Berhasil Ditambahkan! </div>');

			redirect('admin/Slide');
		}
	}
  
}
