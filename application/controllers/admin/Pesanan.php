<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property OrderModel $OrderModel
 * @property CI_Upload $upload
 */

class Pesanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Tambahkan pengecekan session jika dibutuhkan
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('OrderModel');
    }

    public function index()
    {
        $data['title'] = 'Pesanan';
        $data['content'] = 'admin/pesanan'; // halaman utama yang akan disisipkan
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/main', $data);
    }

    public function get_data()
    {
        // Jika ada parameter ID (untuk edit)
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
            $order = $this->OrderModel->get_by_id($id);

            if ($order) {
                echo json_encode([
                    'id_order' => $order->id,
                    'pemesan' => $order->user_id,
                    'status' => $order->status,
                    'total' => $order->total,
                    'payment' => $order->payment_method
                ]);
            } else {
                echo json_encode([
                    'error' => 'Data tidak ditemukan'
                ]);
            }
            return;
        }

        // Jika tidak ada ID (untuk DataTable)
        $data = $this->OrderModel->get_datatables();
        echo json_encode([
            "data" => $data
        ]);
    }
}
