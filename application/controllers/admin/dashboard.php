<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('auth'); 
        $this->auth->admin_only();    

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['content'] = 'admin/dashboard';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/main', $data);
    }
}
