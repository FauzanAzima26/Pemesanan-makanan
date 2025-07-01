<?php
defined('BASEPATH') or exit('No direct script access allowed');

class userModel extends CI_Model
{
    protected $table = 'tb_users';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('tb_users', ['email' => $email])->row();
    }

    public function insert_user($data)
    {
        $this->db->insert('tb_users', $data);
        return $this->db->insert_id(); // ID terakhir dikembalikan ke controller
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function save_reset_token($user_id, $token)
    {
        $this->db->where('id', $user_id);
        $this->db->update('tb_users', ['reset_token' => $token]);
    }

    public function get_user_by_token($token)
    {
        return $this->db->get_where('tb_users', ['reset_token' => $token])->row();
    }

    public function update_password($user_id, $password)
    {
        $this->db->where('id', $user_id);
        $this->db->update('tb_users', [
            'password' => $password,
            'reset_token' => null // Hapus token setelah reset
        ]);
    }
}
