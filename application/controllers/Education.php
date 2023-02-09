<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Education extends CI_Controller
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
        $edu = $this->base->get('education', null, 'yearIn')->result();
        $data = [
            'title'     => 'Education',
            'education' => $edu
        ];
        $this->template->load('template', 'education/data', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, true);
        
        $params = array(
            'sekolah'   => $post['school'],
            'yearIn'    => $post['yearIn'],
            'yearEnd'   => $post['yearEnd'],
            'user_id'   => userdata('id_user')
        );

        if ($post['program'] != null) {
            $params['program'] = $post['program'];
        } else {
            $params['program'] = '-';
        }

        $this->base->insert('education', $params);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Saved successfully');
            redirect('Education');
        } else {
            set_pesan('An error occurred while saving data', FALSE);
            redirect('Education');
        }
    }

    public function delete($id)
    {
        $this->base->delete('education', 'id_edu', $id);

        
        if ($this->db->affected_rows() > 0) {
            set_pesan('Delete successfully');
        } else {
            set_pesan('An error occurred while deleted data', FALSE);
        }

        redirect('Education');
    }
  
}
