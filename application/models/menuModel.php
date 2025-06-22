<?php
defined('BASEPATH') or exit('No direct script access allowed');

class menuModel extends CI_Model
{
    private $table = 'menus';

    // Ambil semua data menu (join dengan restoran)
    public function get_all()
    {
        $this->db->select('menus.*, restaurants.name as restaurant_name');
        $this->db->from($this->table);
        $this->db->join('restaurants', 'restaurants.id = menus.restaurant_id', 'left');
        return $this->db->get()->result();
    }

    // Ambil menu berdasarkan ID (untuk edit)
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Ambil semua menu berdasarkan ID restoran (untuk detail)
    public function get_by_restaurant($restaurant_id)
    {
        return $this->db->get_where($this->table, ['restaurant_id' => $restaurant_id])->result();
    }

    // Simpan menu baru
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Update menu berdasarkan ID
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Hapus menu berdasarkan ID
    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
