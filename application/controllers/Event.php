<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
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
        $data['title'] = 'Data Event Koopen';
        $data['event'] = $this->base->get('event')->result();
        $this->template->load('template', 'event/data', $data);
    }

    public function add()
    {

        $event = new stdClass();
        $event->description = null;
        $event->tanggal = null;
        $event->lokasi = null;
        $event->foto_perumahan = null;
        $data = array(
            'title' => 'Tambah Data event',
            'page' => 'add',
            'row' => $event
        );
        $this->template->load('template', 'event/form', $data);
    }

    public function edit($id_tentangKami)
    {
        if (userdata('role') == 1) {
            $tentang = $this->tentang->get($id_tentangKami)->row();
            $data = array(
                'title' => 'Edit Data tentang',
                'page' => 'edit',
                'row' => $tentang
            );
            $this->template->load('template', 'tentang/form', $data);
        } else {
            redirect('home');
        }
    }

    public function del($id_tentangKami)
    {
        if (userdata('role') == 1) {
            $where = array('id_tentangKami' => $id_tentangKami);
            $this->base_model->del('tbl_tentang_kami', $where);
            if ($this->db->affected_rows() > 0) {
                set_pesan('Data Berhasil Dihapus');
            }
            redirect('admin/tentang');
        } else {
            redirect('home');
        }
    }

    public function proses()
    {
       
        $tanggal = date("Y-m-d");
        $login = userdata('id_user');
        $post = $this->input->post(null, TRUE);
        $config['upload_path']          = './assets/img/uploads/event';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 5000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;
        $config['file_name']            = 'event-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

        $this->load->library('upload', $config);
        
        $post = $this->input->post(null, TRUE);
        $post['image'] = $this->upload->data('file_name');
        var_dump($post);
        if (isset($_POST['add'])) {
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {
                    $post['image'] = $this->upload->data('file_name');
                    $this->tentang->addEvent($post);
                    if ($this->db->affected_rows() > 0) {
                        set_pesan('Data Berhasil Dismpan');
                    }
                    var_dump($post);
                    redirect('admin/tentang');
                } else {
                    $error = $this->upload->display_error();
                    echo $error;
                }
            }
        }
        if (isset($_POST['edit'])) {
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {
                    $item = $this->tentang->get($post['id_tentangKami'])->row();
                    if ($item->foto != null) {
                        $target_file = './assets/uploads/tentang/' . $item->foto;
                        unlink($target_file);
                    }
                    $post['image'] = $this->upload->data('file_name');
                    $this->tentang->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        set_pesan('Data Berhasil Dismpan');
                    }
                    // var_dump($post);
                    redirect('admin/tentang');
                } else {
                    $error = $this->upload->display_error();
                    echo $error;
                }
            } else {
                $post['image'] = null;
                $this->tentang->edit($post);
                if ($this->db->affected_rows() > 0) {
                    set_pesan('Data Berhasil Dismpan');
                }
                redirect('admin/tentang');
            }
        }
    }
}
