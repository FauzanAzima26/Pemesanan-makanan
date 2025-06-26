<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property MenuModel $MenuModel
 * @property OrderModel $OrderModel
 */

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->load->model('MenuModel');
        $this->load->library('session');
        $this->load->helper('string');
    }

    public function index($id)
    {
        $data['title'] = 'Order';
        $data['content'] = 'customer/order'; // halaman utama yang akan disisipkan
        $this->load->view('customer/layout/header', $data);
        $this->load->view('customer/layout/main', $data);
    }


    public function create()
    {
        $menu_id = $this->input->post('menu_id');
        $qty = (int) $this->input->post('qty');
        $payment = $this->input->post('payment_method');
        $user_id = $this->session->userdata('id');

        if (!$this->session->userdata('id')) {
            redirect('auth/login'); // atau halaman loginmu
        }

        $menu = $this->MenuModel->getMenuById($menu_id);
        if (!$menu || !$user_id) {
            $this->session->set_flashdata('error', 'Data tidak valid.');
            redirect('welcome');
            return;
        }

        $order_data = [
            'user_id' => $user_id,
            'total' => $menu->price * $qty,
            'status' => 'processing',
            'kode_verifikasi' => random_string('alnum', 8),
            'payment_method' => $payment,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $order_id = $this->OrderModel->insertOrder($order_data);

        $item_data = [
            'order_id' => $order_id,
            'menu_id' => $menu_id,
            'qty' => $qty,
            'price' => $menu->price,
            'subtotal' => $menu->price * $qty
        ];
        $this->OrderModel->insertOrderItem($item_data);

        $this->session->set_flashdata('success', 'Pesanan berhasil ditambahkan.');
        redirect('customer/cart');
    }
}
