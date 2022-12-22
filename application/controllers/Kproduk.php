<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kproduk extends CI_Controller
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
        $data['title'] = "Kategori Barang";
        $data['kproduk'] = $this->base_model->get('kproduk')->result();
        $this->template->load('template', 'kproduk/data', $data);
    }

    public function add()
    {
        $this->db->insert('kproduk', array(
            'nama' => $this->input->post('namaKategori'),
            'seo_nama' => slugify($this->input->post('namaKategori')),
            'isActive' => '1'
        ));

        if ($this->db->affected_rows()) {
            $this->data = array(
                'status' => true,
                'message' => "Data berhasil disimpan"
            );
            set_pesan('Data berhasil di simpan');
        } else {
            $this->data = array(
                'status' => false,
                'message' => "Gagal saat menyimpan data!"
            );
            set_pesan('Gagal saat menyimpan data', false);
        }

        redirect('admin/kproduk');
    }

    public function delete($id)
    {
        $where = array('id_kproduk' => $id);
        $this->base_model->del('kproduk', $where);
        redirect('admin/kproduk');
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('namaKategori', 'nama', 'required');
        // $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');


        if ($this->form_validation->run() == FALSE) {
            // $where=array('id_kartikel' => $id);
            $query = $this->base->getKproduk($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $data['title'] = 'Edit Kategori Produk / Barang';
                $this->template->load('template', 'kproduk/edit', $data);
            } else {
                echo "<script>alert('Data Tidak Di Temukan');";
                echo "window.location='" . site_url('admin/kproduk') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $data = array(
                'nama' => $this->input->post('namaKategori'),
                'seo_nama' => slugify($this->input->post('namaKategori')),
            );
            $where = array('id_kproduk' => $id);
            $this->base_model->edit('kproduk', $data, $where);
            if ($this->db->affected_rows() > 0) {
                echo "<script>alert('Data Berhasil Di Simpan');</script>";
            }
            echo "<script>window.location='" . site_url('admin/kproduk') . "';</script>";
        }
    }
}
