<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property restaurantModel $restaurantModel
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
                'no' => $no++,
                'owner' => $restaurant->owner,
                'name' => $restaurant->name,
                'address' => $restaurant->address,
                'status' => $restaurant->status,
                'actions' => '
                    <button class="btn btn-sm btn-warning" data-id="' . $restaurant->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger" data-id="' . $restaurant->id . '">Delete</button>
                ',
            ];
            $data[] = $row;
        }

        $output = [
            "data" => $data // Tidak ada draw, recordsTotal, recordsFiltered karena bukan server-side
        ];

        echo json_encode($output);
    }
}
