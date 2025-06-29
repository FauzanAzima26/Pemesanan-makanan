<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CartModel extends CI_Model
{
    public function getCartItems($user_id)
    {
        $this->db->select('tb_cart.id as cart_id, tb_cart.*, tb_menu.name, tb_menu.price, tb_menu.image');
        $this->db->from('tb_cart');
        $this->db->join('tb_menu', 'tb_cart.menu_id = tb_menu.id');
        $this->db->where('tb_cart.user_id', $user_id);
        return $this->db->get()->result();
    }

    public function addToCart($user_id, $menu_id, $qty)
    {
        $exist = $this->db->get_where('tb_cart', [
            'user_id' => $user_id,
            'menu_id' => $menu_id
        ])->row();

        if ($exist) {
            $this->db->set('qty', 'qty + ' . $qty, false);
            $this->db->where('id', $exist->id);
            $this->db->update('tb_cart');
        } else {
            $this->db->insert('tb_cart', [
                'user_id' => $user_id,
                'menu_id' => $menu_id,
                'qty' => $qty
            ]);
        }
    }

    public function clearCart($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('tb_cart');
    }

    public function updateQty($cart_id, $qty)
    {
        return $this->db->update('tb_cart', ['qty' => $qty], ['id' => $cart_id]);
    }

    public function getTotal($user_id)
    {
        $this->db->select('SUM(COALESCE(tb_menu.price, 0) * tb_cart.qty) AS total');
        $this->db->from('tb_cart');
        $this->db->join('tb_menu', 'tb_menu.id = tb_cart.menu_id');
        $this->db->where('tb_cart.user_id', $user_id);

        $query = $this->db->get();
        $row = $query->row();
        return $row ? $row->total : 0;
    }
}
