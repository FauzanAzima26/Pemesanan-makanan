<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property MenuModel $MenuModel
 * @property OrderModel $OrderModel
 * @property CartModel $CartModel
 * @property CI_DB $db
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
        $user_id = $this->session->userdata('id');
        $items = $this->CartModel->getCartItems($user_id);

        // Hitung total
        $total = 0;
        foreach ($items as $item) {
            $total += $item->price * $item->qty;
        }

        $data['items'] = $items;
        $data['total'] = $total;
        $data['title'] = 'Cart';
        $data['content'] = 'customer/cart';
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


    public function updateQty()
    {
        log_message('debug', '🔧 Memasuki updateQty() controller');

        $cart_id = $this->input->post('cart_id');
        $qty = (int) $this->input->post('qty');

        if ($cart_id && $qty > 0) {
            $this->CartModel->updateQty($cart_id, $qty);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        }
    }

    public function getCartTotal()
    {
        $user_id = $this->session->userdata('id');
        $items = $this->CartModel->getCartItems($user_id);

        $total = 0;
        foreach ($items as $item) {
            $total += $item->price * $item->qty;
        }

        echo json_encode(['total' => $total]);
    }

    public function remove()
    {
        $cart_id = $this->input->post('cart_id');
        $user_id = $this->session->userdata('id');

        $this->db->where('id', $cart_id);
        $this->db->where('user_id', $user_id);
        $deleted = $this->db->delete('tb_cart');

        echo json_encode([
            'status' => $deleted ? 'success' : 'error'
        ]);
    }
}
