<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Midtransnap $midtranssnap
 * @property CI_Input $input
 * @property CartModel $CartModel
 * @property CI_Session $session
 * @property CI_DB $db
 */

class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('MidtransSnap');
    }

    public function index()
    {
        // Data dummy
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 200000,
            ],
            'customer_details' => [
                'first_name' => 'Budi',
                'email' => 'budi@example.com',
            ]
        ];

        $data['snapToken'] = $this->midtranssnap->getSnapToken($params);
        $this->load->view('checkout_view', $data);
    }

    public function token()
    {
        $this->load->library('MidtransSnap');
        $this->load->model('CartModel');

        $user_id = $this->session->userdata('id');
        if (!$user_id) {
            redirect('auth/login');
        }

        $total = $this->CartModel->getTotal($user_id);
        if (!$total) {
            show_error('Total belanja kosong', 500);
        }

        // 1️⃣ Buat order_id tetap (tidak random)
        $order_id = time(); // contoh: 1721328340

        // 2️⃣ Simpan order ke database sebelum kirim ke Midtrans
        $this->db->insert('tb_orders', [
            'id' => $order_id, // pastikan 'id' adalah primary key
            'user_id' => $user_id,
            'status' => 'pending',
            'kode_verifikasi' => strtoupper(random_string('alnum', 6)),
            'total' => $total,
            'payment_method' => null
        ]);

        // 3️⃣ Kirim order_id ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $total
            ],
            'customer_details' => [
                'first_name' => $this->session->userdata('nama'),
                'email' => $this->session->userdata('email')
            ]
        ];

        $snapToken = $this->midtranssnap->getSnapToken($params);
        echo json_encode(['snapToken' => $snapToken]);
    }

    public function callback()
    {
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if (!$result) {
            show_error('Invalid JSON', 400);
            return;
        }

        $order_id = $result->order_id ?? null;
        $transaction_status = $result->transaction_status ?? null;
        $payment_type = $result->payment_type ?? null;

        // Mapping status
        if ($transaction_status === 'settlement') {
            $status_order = 'paid';
        } elseif ($transaction_status === 'pending') {
            $status_order = 'pending';
        } else {
            $status_order = 'cancelled';
        }

        // Update tb_orders
        $this->db->where('id', $order_id);
        $this->db->update('tb_orders', [
            'status' => $status_order,
            'payment_method' => $payment_type
        ]);

        // Lanjut jika pembayaran sukses
        if ($status_order === 'paid') {
            // Ambil data order
            $order = $this->db->get_where('tb_orders', ['id' => $order_id])->row();
            if ($order) {
                $user_id = $order->user_id;

                // Ambil item dari cart
                $cartItems = $this->db->get_where('tb_cart', ['user_id' => $user_id])->result();

                foreach ($cartItems as $item) {
                    // Ambil harga dari tb_menu
                    $menu = $this->db->get_where('tb_menu', ['id' => $item->menu_id])->row();
                    if (!$menu) continue; // skip jika menu tidak ditemukan

                    $this->db->insert('tb_order_items', [
                        'order_id' => $order_id,
                        'menu_id'  => $item->menu_id,
                        'qty'      => $item->qty,
                        'subtotal' => $item->qty * $menu->price
                    ]);
                }
            }
        }

        echo 'OK';
    }
}
