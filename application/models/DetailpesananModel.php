<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailpesananModel extends CI_Model
{
    protected $table = 'tb_order_items';

    public function getByOrderId($order_id)
    {
        return $this->db->get_where($this->table, ['order_id' => $order_id])->result();
    }
}
