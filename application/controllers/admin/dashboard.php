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

        // Menu aktif
        $this->db->where('status', 'aktif');
        $data['jumlah_menu_aktif'] = $this->db->count_all_results('tb_menu');

        // Menu tidak aktif
        $this->db->where('status', 'nonaktif');
        $data['jumlah_menu_nonaktif'] = $this->db->count_all_results('tb_menu');

        // Total pesanan
        $data['jumlah_pesanan'] = $this->db->count_all('tb_orders');

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/main', $data);
    }
}
