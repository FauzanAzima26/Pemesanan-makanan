<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 */

class Restaurant extends CI_Controller
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
        $data['title'] = 'Restaurant';
        $data['content'] = 'admin/restaurant'; // halaman utama yang akan disisipkan
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/main', $data);
    }
}
