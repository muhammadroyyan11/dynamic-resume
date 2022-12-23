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
        $edu = $this->base->get('education')->result();
        $data = [
            'title'     => 'Education',
            'education' => $edu
        ];
        $this->template->load('template', 'education/data', $data);
    }

  
}
