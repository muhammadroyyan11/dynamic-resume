<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Base_model', 'base');
    }

    public function index()
    {
        // var_dump(userdata('nama'));
        $data['title'] = "Barang";
        $data['barang'] = $this->base_model->get('barang')->result();
        $this->template->load('template', 'barang/data', $data);
    }

    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->base_model->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }
        $data['title'] = "Tambah Barang";
        $data['input'] = $input;
        $data['kategori'] = $this->base_model->getOrderProduk('kproduk')->result();

        $this->template->load('template', 'barang/add', $data);
    }

    public function process()
    {
        // $login = userdata('id_user');

        $this->db->insert('barang', array(
            'name' => $this->input->post('nama_barang'),
            'description' => $this->input->post('description'),
            'status' => $this->input->post('status'),
            'id_kproduk' => $this->input->post('kategori')
            // 'user_id' => userdata('id_user')
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

        redirect('admin/barang');
    }

    public function insertdata()
    {
        // $tanggal = date("Y-m-d");
        // $login = userdata('id_user');

        $config['upload_path']          = './assets/img/uploads/produk/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 5000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            // $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Format gambar bukan PNG. </div>');

            // redirect('campaign/add');
            $gambar = $this->upload->data();
            $gambar =  $gambar['file_name'];
            $seo = slugify($this->input->post('nama_barang'));
            $name = $this->input->post('nama_barang');
            $desc = $this->input->post('description');
            $status = $this->input->post('status');
            $link = $this->input->post('link_tokped');
            $harga = $this->input->post('harga');
            $id_kproduk = $this->input->post('kategori');

            $data = array(
                'name' => $name,
                'description' => $desc,
                'status' => $status,
                'harga' => $harga,
                'seo_name' => $seo,
                'gambar_name' => $gambar,
                'link_tokped' => $link,
                'id_kproduk' => $id_kproduk,
            );
            // var_dump($data);
            $this->base_model->insert('barang', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data Berhasil Ditambahkan! </div>');
            redirect('admin/barang');
        } else {

            $gambar = $this->upload->data();
            $gambar =  $gambar['file_name'];
            $harga = $this->input->post('harga');
            $name = $this->input->post('nama_barang');
            $seo = slugify($this->input->post('nama_barang'));
            $desc = $this->input->post('description');
            $status = $this->input->post('status');
            $link = $this->input->post('link_tokped');
            $id_kproduk = $this->input->post('kategori');

            $data = array(

                'name' => $name,
                'description' => $desc,
                'status' => $status,
                'harga' => $harga,
                'seo_name' => $seo,
                'gambar_name' => $gambar,
                'link_tokped' => $link,
                'id_kproduk' => $id_kproduk,
            );

            // var_dump($data);
            $this->base_model->insert('barang', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data Berhasil Ditambahkan! </div>');

            redirect('admin/barang');
        }
    }

    public function delete($getId)
    {
        // $id = encode_php_tags($getId);
        if ($this->base_model->delete('barang', 'id_barang', $getId)) {
            echo "<script>alert('Data Berhasil Di Hapus');</script>";
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('admin/barang');
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama_barang', 'Name', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        if ($this->input->post('userfile')) {
            $this->form_validation->set_rules('userfile', 'Userfile');
        }
        $this->form_validation->set_rules('link_tokped', 'Link_tokped', 'required');
        if ($this->input->post('description')) {
            $this->form_validation->set_rules('description', 'Description');
        }
        // $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_message('required', '% masih kosong, Silahkan di isi');


        if ($this->form_validation->run() == FALSE) {
            $query = $this->base->getBarang($id);
            if ($query->num_rows() > 0) {
                $data['title'] = 'Edit data barang';
                $data['row'] = $query->row();
                $data['kategori'] = $this->base_model->getOrderProduk('kproduk')->result();
                $this->template->load('template', 'barang/edit', $data);
            } else {
                echo "<script>alert('Data Tidak Di Temukan');";
                echo "window.location='" . site_url('admin/barang') . "';</script>";
            }
        } else {
            $config['upload_path']          = './assets/img/uploads/produk/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 5000;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);

            

            if (!$this->upload->do_upload('userfile')) {
                // $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Format gambar bukan PNG. </div>');

                // redirect('campaign/add');
                $gambar = $this->upload->data();
                $gambar =  $gambar['file_name'];
                $seo = slugify($this->input->post('nama_barang'));
                $name = $this->input->post('nama_barang');
                $desc = $this->input->post('description');
                $status = $this->input->post('status');
                $link = $this->input->post('link_tokped');
                $harga = $this->input->post('harga');
                $id_kproduk = $this->input->post('kategori');

                $data = array(
                    'name' => $name,
                    'description' => $desc,
                    'status' => $status,
                    'harga' => $harga,
                    'seo_name' => $seo,
                    'gambar_name' => $gambar,
                    'link_tokped' => $link,
                    'id_kproduk' => $id_kproduk,
                );
                var_dump($data);
                // $this->base_model->insert('barang', $data);
                // $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data Berhasil Ditambahkan! </div>');
                // redirect('admin/barang');
            } else {

                $gambar = $this->upload->data();
                $gambar =  $gambar['file_name'];
                $harga = $this->input->post('harga');
                $name = $this->input->post('nama_barang');
                $seo = slugify($this->input->post('nama_barang'));
                $desc = $this->input->post('description');
                $status = $this->input->post('status');
                $link = $this->input->post('link_tokped');
                $id_kproduk = $this->input->post('kategori');

                
                $data = array(
                    'name' => $name,
                    'description' => $desc,
                    'status' => $status,
                    'harga' => $harga,
                    'seo_name' => $seo,
                    'gambar_name' => $gambar,
                    'link_tokped' => $link,
                    'id_kproduk' => $id_kproduk,
                );
                // var_dump($data);
                $where=array('id_barang' => $this->input->post('id_barang'));
                $this->base_model->edit('barang', $data, $where);
                if ($this->db->affected_rows() > 0) {
                    echo "<script>alert('Data Berhasil Di Simpan');</script>";
                } else {
                    echo "<script>alert('Gagal Di Simpan');</script>";
                }
                echo "<script>window.location='" . site_url('admin/barang') . "';</script>";
            }
        }
    }

    
}
