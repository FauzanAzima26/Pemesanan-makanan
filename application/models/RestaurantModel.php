<?php
class RestaurantModel extends CI_Model
{
  public function insert($data)
  {
    return $this->db->insert('restaurants', $data);
  }

  public function get_all()
  {
    return $this->db->get('restaurants')->result();
  }

  public function get_by_id($id)
  {
    return $this->db->get_where('restaurants', ['id_owner' => $id])->row();
  }

  public function update($id, $data)
  {
    $this->db->where('id_restaurants', $id);
    return $this->db->update('restaurants', $data);
  }


}