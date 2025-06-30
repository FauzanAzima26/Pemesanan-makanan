<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB $db
 */

class Seeder extends CI_Controller
{
    public function menu()
    {
        $this->load->database();

        $data = [
            [
                'name' => 'Nasi Goreng',
                'price' => 15000,
                'description' => 'Nasi goreng dengan telur dan ayam',
                'image' => 'uploads/menu/nasi_goreng.jpg',
                'status' => 'aktif'
            ],
            [
                'name' => 'Mie Ayam',
                'price' => 12000,
                'description' => 'Mie ayam dengan pangsit',
                'image' => 'uploads/menu/mie_ayam.jpg',
                'status' => 'aktif'
            ]
        ];

        $this->db->insert_batch('tb_menu', $data);
        echo "Seeder berhasil dijalankan.";
    }

    public function user()
    {
        $this->load->database();

        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'is_verified' => 1
            ],
            [
                'name' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => password_hash('customer123', PASSWORD_DEFAULT),
                'role' => 'customer',
                'is_verified' => '1'
            ],
            
        ];

        $this->db->insert_batch('tb_users', $data);
        echo "Seeder berhasil dijalankan.";
    }
}
