<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property restaurantModel $restaurantModel
 * @property CI_Input $input
 * @property menuModel $menuModel
 */
class Restaurant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        // Load model
        $this->load->model('restaurantModel');
    }

    public function index()
    {
        $data['title'] = 'Data Restaurant';
        $data['content'] = 'admin/restaurant'; // View file: views/admin/restaurant.php

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/main', $data);
    }

    public function get_data()
    {
        $restaurants = $this->restaurantModel->get_all();
        $data = [];
        $no = 1;

        foreach ($restaurants as $restaurant) {
            $row = [
                'id' => $restaurant->id,
                'no' => $no++,
                'owner' => $restaurant->owner,
                'name' => $restaurant->name,
                'address' => $restaurant->address,
                'status' => $restaurant->status
            ];
            $data[] = $row;
        }

        echo json_encode(["data" => $data]);
    }

    public function store()
    {
        // Ambil input dari form
        $id_restaurant = $this->input->post('id_restaurant');
        $owner = $this->input->post('owner');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $status = $this->input->post('status');

        // Validasi sederhana
        if (empty($owner) || empty($name) || empty($address) || empty($status)) {
            echo json_encode([
                'success' => false,
                'message' => 'Semua field wajib diisi.'
            ]);
            return;
        }

        // Siapkan data
        $data = [
            'owner' => $owner,
            'name' => $name,
            'address' => $address,
            'status' => $status,
        ];

        // Proses update jika ID tersedia
        if (!empty($id_restaurant)) {
            $updated = $this->restaurantModel->update($id_restaurant, $data);
            if ($updated) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Data berhasil diperbarui.'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal memperbarui data.'
                ]);
            }
        } else {
            // Proses insert
            $saved = $this->restaurantModel->insert($data);
            if ($saved) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Data berhasil disimpan.'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan data.'
                ]);
            }
        }
    }

    public function edit()
    {
        $id = $this->input->get('id');
        if (!$id) {
            echo json_encode([
                'status' => false,
                'message' => 'ID tidak ditemukan'
            ]);
            return;
        }

        $restaurant = $this->restaurantModel->get_by_id($id);
        if ($restaurant) {
            echo json_encode($restaurant);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');

        if (!$id || !is_numeric($id)) {
            echo json_encode([
                'success' => false,
                'message' => 'ID tidak valid.'
            ]);
            return;
        }

        $deleted = $this->restaurantModel->delete($id);

        if ($deleted) {
            echo json_encode([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus data.'
            ]);
        }
    }

    public function detail()
    {
        $restaurant_id = $this->input->get('id');

        if (!$restaurant_id || !is_numeric($restaurant_id)) {
            echo json_encode([
                'success' => false,
                'message' => 'ID restoran tidak valid.'
            ]);
            return;
        }

        $this->load->model('menuModel');
        $menus = $this->menuModel->get_by_restaurant_id($restaurant_id);

        if ($menus) {
            echo json_encode([
                'success' => true,
                'data' => $menus
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Tidak ada menu untuk restoran ini.'
            ]);
        }
    }
}
