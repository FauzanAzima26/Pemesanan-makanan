<?php
class OrderModel extends CI_Model
{
  public function insertOrder($data)
  {
    $this->db->insert('tb_orders', $data);
    return $this->db->insert_id();
  }

  public function insertOrderItem($data)
  {
    return $this->db->insert('tb_order_items', $data);
  }
}
