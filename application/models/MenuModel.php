<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuModel extends CI_Model
{
    protected $table = 'tb_menu';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_datatables()
    {
        $this->db->select('*');
        $this->db->from('tb_menu');
        return $this->db->get()->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('tb_menu', $data);
    }

    public function get_all()
    {
        return $this->db->get($this->table)->result(); // ambil semua data
    }
}
