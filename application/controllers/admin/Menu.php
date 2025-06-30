<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property MenuModel $MenuModel
 * @property CI_Upload $upload
 * @property CI_DB $db
 */

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Tambahkan pengecekan session jika dibutuhkan
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('MenuModel');
    }

    public function index()
    {
        $data['title'] = 'Menu';
        $data['content'] = 'admin/menu'; // halaman utama yang akan disisipkan
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/main', $data);
    }

    public function get_data()
    {
        // Jika ada parameter ID (untuk edit)
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
            $menu = $this->MenuModel->get_by_id($id);

            if ($menu) {
                echo json_encode([
                    'id_menu' => $menu->id,
                    'name' => $menu->name,
                    'price' => $menu->price,
                    'description' => $menu->description,
                    'image' => $menu->image
                ]);
            } else {
                echo json_encode([
                    'error' => 'Data tidak ditemukan'
                ]);
            }
            return;
        }

        // Jika tidak ada ID (untuk DataTable)
        $data = $this->MenuModel->get_datatables();
        echo json_encode([
            "data" => $data
        ]);
    }

    public function store_or_update()
    {
        $id_menu = $this->input->post('id_menu');
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $description = $this->input->post('description');

        if (!$name || !$price || !$description || !is_numeric($price)) {
            echo json_encode(['success' => false, 'message' => 'Semua field wajib diisi dan harga harus berupa angka.']);
            return;
        }

        $config['upload_path']   = './uploads/menu/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        $image = $this->input->post('old_image'); // default ke gambar lama

        if (!empty($_FILES['image']['name'])) {
            if (!$this->upload->do_upload('image')) {
                echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
                return;
            }
            $upload_data = $this->upload->data();
            $image = 'uploads/menu/' . $upload_data['file_name'];
        }

        $data = [
            'name'        => $name,
            'price'       => $price,
            'description' => $description,
        ];
        if ($image) {
            $data['image'] = $image;
        }

        if ($id_menu) {
            $this->db->where('id', $id_menu)->update('tb_menu', $data);
            $message = 'Data menu berhasil diperbarui.';
        } else {
            $this->db->insert('tb_menu', $data);
            $message = 'Data menu berhasil disimpan.';
        }

        echo json_encode(['success' => true, 'message' => $message]);
    }
}
