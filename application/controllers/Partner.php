<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partner extends CI_Controller
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
        $data['title'] = "Partner";
        $data['partner'] = $this->base_model->get('partner')->result();
        $this->template->load('template', 'partner/data', $data);
    }

    public function edit($id)
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Partner";
            $data['partner'] = $this->base->getUser('partner', ['id_partner' => $id]);
            $this->template->load('template', 'partner/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->base->update('Partner', 'id_partner', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('partner');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('partner/add');
            }
        }
    }

    public function add()
    {
        $data['title'] = "Partner";
        $this->template->load('template', 'partner/add', $data);
    }
  
    public function process()
    {
        // $login = userdata('id_user');

        $this->db->insert('partner', array(
            'name' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'instagram' => $this->input->post('instagram'),
            // 'user_id' => userdata('id_user')
            'maps' => $this->input->post('maps')
        ));

        if ($this->db->affected_rows()) {
            $this->data = array(
                'status' => true,
                'message' => "Data berhasil disimpan"
            );
        } else {
            $this->data = array(
                'status' => false,
                'message' => "Gagal saat menyimpan data!"
            );
        }

        redirect('admin/partner');
    }
}
