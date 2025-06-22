<?php
// application/controllers/Menu.php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property menuModel $menuModel
 * @property RestaurantModel $RestaurantModel
 * @property CI_Input $input
 * @property CI_Upload $upload
 */
class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('menuModel');
        $this->load->model('RestaurantModel');
    }

    public function index()
    {
        $data['title'] = 'Data Menu';
        $data['content'] = 'admin/menu';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/main', $data);
    }

    public function get_data()
    {
        $menus = $this->menuModel->get_all();
        $data = [];
        $no = 1;

        foreach ($menus as $menu) {
            $data[] = [
                'no' => $no++,
                'id' => $menu->id,
                'restaurant_name' => $menu->restaurant_name,
                'name' => $menu->name,
                'price' => number_format($menu->price, 0, ',', '.'),
                'description' => $menu->description,
                'image' => base_url('uploads/menu/' . $menu->image),
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function store()
    {
        $id = $this->input->post('id_menu');
        $data = [
            'restaurant_id' => $this->input->post('restaurant_id'),
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
        ];

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads/menu/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                echo json_encode(['success' => false, 'message' => $this->upload->display_errors('', '')]);
                return;
            }

            $upload_data = $this->upload->data();
            $data['image'] = $upload_data['file_name'];
        }

        if ($id) {
            $update = $this->menuModel->update($id, $data);
            $message = $update ? 'Data berhasil diperbarui.' : 'Gagal memperbarui data.';
            echo json_encode(['success' => (bool)$update, 'message' => $message]);
        } else {
            $insert = $this->menuModel->insert($data);
            $message = $insert ? 'Data berhasil disimpan.' : 'Gagal menyimpan data.';
            echo json_encode(['success' => (bool)$insert, 'message' => $message]);
        }
    }

    public function edit()
    {
        $id = $this->input->get('id');
        $menu = $this->menuModel->get_by_id($id);
        if ($menu) {
            echo json_encode($menu);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $delete = $this->menuModel->delete($id);
        $message = $delete ? 'Data berhasil dihapus.' : 'Gagal menghapus data.';
        echo json_encode(['success' => (bool)$delete, 'message' => $message]);
    }

    public function restaurant_list()
    {
        $list = $this->RestaurantModel->get_all();
        echo json_encode($list);
    }
}
