<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Experience extends CI_Controller
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
        $exp = $this->base->get('experience', null, 'dateIn')->result();
        $data = [
            'title'     => 'Experience',
            'education' => $exp
        ];
        $this->template->load('template', 'experience/data', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, true);
        
        $params = array(
            'company'   => $post['company'],
            'desc'    => $post['desc'],
            'dateIn'   => $post['dateIn'],
            'user_id'   => userdata('id_user')
        );

        if ($post['dateEnd'] != "") {
            $params['dateEnd'] = $post['dateEnd'];
        } else {
            $params['dateEnd'] = 'Now';
        }

        $this->base->insert('experience', $params);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Saved successfully');
        } else {
            set_pesan('An error occurred while saving data', FALSE);
        }

        redirect('Experience');
    }

    public function delete($id)
    {
        $this->base->delete('experience', 'id_ex', $id);

        
        if ($this->db->affected_rows() > 0) {
            set_pesan('Delete successfully');
        } else {
            set_pesan('An error occurred while deleted data', FALSE);
        }

        redirect('Experience');
    }
  
}
