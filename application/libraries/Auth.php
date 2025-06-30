<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth
{
    protected $CI;
    
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function check()
    {
        if (!$this->CI->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function admin_only()
    {
        $this->check();
        if ($this->CI->session->userdata('role') !== 'admin') {
            show_404();
        }
    }

    public function customer_only()
    {
        $this->check();
        if ($this->CI->session->userdata('role') !== 'customer') {
            show_404();
        }
    }
}
