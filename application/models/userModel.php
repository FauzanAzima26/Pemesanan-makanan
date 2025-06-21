<?php
defined('BASEPATH') or exit('No direct script access allowed');

class userModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

}