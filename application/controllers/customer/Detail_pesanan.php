<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property MenuModel $MenuModel
 * @property OrderModel $OrderModel
 * @property DetailpesananModel $DetailpesananModel
 * @property CI_DB $db
 */

class Detail_pesanan extends CI_Controller
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
        $data['title'] = 'Pesanan saya';
        $data['content'] = 'customer/detail_pesanan';
        $this->load->view('customer/layout/header', $data);
        $this->load->view('customer/layout/main', $data);
    }

    public function get_data()
    {
        $this->load->model('OrderModel');
        $this->load->model('DetailpesananModel');
        $this->load->model('MenuModel');

        $user_id = $this->session->userdata('id');
        $orders = $this->OrderModel->get_by_user($user_id); // ambil semua pesanan milik user

        $result = [];

        foreach ($orders as $order) {
            $items = $this->DetailpesananModel->getByOrderId($order->id); // ambil semua item dalam 1 order

            foreach ($items as $item) {
                $menu = $this->MenuModel->get_by_id($item->menu_id);

                $result[] = [
                    'id' => $order->id,
                    'menu' => $menu ? $menu->name : 'Tidak diketahui',
                    'status' => $order->status,
                    'total' => number_format($order->total, 0, ',', '.'),
                    'payment' => ucfirst($order->payment_method),
                ];
            }
        }

        echo json_encode(['data' => $result]);
    }
}
