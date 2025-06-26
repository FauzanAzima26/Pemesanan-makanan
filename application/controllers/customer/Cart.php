<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property MenuModel $MenuModel
 * @property OrderModel $OrderModel
 * @property CartModel $CartModel
 */

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel');
        $this->load->model('MenuModel');
        $this->load->library('session');
        $this->load->helper('string');
    }

    public function index()
    {
        $data['title'] = 'Cart';
        $data['content'] = 'customer/cart'; // halaman utama yang akan disisipkan
        $this->load->view('customer/layout/header', $data);
        $this->load->view('customer/layout/main', $data);
    }

    public function store($menu_id = null)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $user_id = $this->session->userdata('id');
        $qty = 1; // default qty

        $menu = $this->MenuModel->getMenuById($menu_id);
        if (!$menu) {
            $this->session->set_flashdata('error', 'Menu tidak ditemukan');
            redirect('welcome');
        }

        $this->CartModel->addToCart($user_id, $menu_id, $qty);
        $this->session->set_flashdata('success', 'Item berhasil ditambahkan ke keranjang.');
        redirect('welcome');
    }


    public function checkout()
    {
        $cart = $this->session->userdata('cart');
        $user_id = $this->session->userdata('id');
        $payment = $this->input->post('payment_method');

        if (!$cart || !$user_id) {
            redirect('auth/login');
        }

        $total = array_sum(array_column($cart, 'subtotal'));

        $order_data = [
            'user_id' => $user_id,
            'total' => $total,
            'status' => 'processing',
            'kode_verifikasi' => random_string('alnum', 8),
            'payment_method' => $payment,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $order_id = $this->OrderModel->insertOrder($order_data);

        foreach ($cart as $item) {
            $this->OrderModel->insertOrderItem([
                'order_id' => $order_id,
                'menu_id' => $item['menu_id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal']
            ]);
        }

        $this->session->unset_userdata('cart');
        $this->session->set_flashdata('success', 'Pesanan berhasil dibuat.');
        redirect('customer/cart');
    }
}
