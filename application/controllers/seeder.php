<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB $db
 */

class Seeder extends CI_Controller
{

    public function user()
    {
        $this->load->database();

        $data = [
            [
                'name'         => 'Admin',
                'email'        => 'admin@gmail.com',
                'password'     => password_hash('admin123', PASSWORD_DEFAULT),
                'role'         => 'admin',
                'image'        => 'IMG_1248.JPG', // hanya nama file
                'is_verified'  => 1
            ],
        ];

        $this->db->insert_batch('tb_users', $data);
        echo "Seeder berhasil dijalankan.";
    }
}
