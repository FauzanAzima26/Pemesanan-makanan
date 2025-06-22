<?php
defined('BASEPATH') or exit('No direct script access allowed');

class userModel extends CI_Model
{
    protected $table = 'users';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function insert_user($data)
    {
        $this->db->insert('users', $data);
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
}
