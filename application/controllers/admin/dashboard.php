<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 */

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Tambahkan pengecekan session jika dibutuhkan
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['content'] = 'admin/dashboard'; // halaman utama yang akan disisipkan
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/main', $data);
    }
}
