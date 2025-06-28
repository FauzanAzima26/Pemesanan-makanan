<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderModel extends CI_Model
{
    protected $table = 'tb_orders';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_datatables()
    {
        $this->db->select('o.id, u.name as pemesan, o.status, o.total, o.payment_method as payment');
        $this->db->from('tb_orders o');
        $this->db->join('tb_users u', 'u.id = o.user_id');
        return $this->db->get()->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_by_user($user_id)
    {
        return $this->db->get_where('tb_orders', ['user_id' => $user_id])->result();
    }
}
