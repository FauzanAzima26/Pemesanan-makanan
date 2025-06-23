<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property userModel $userModel
 * @property CI_Input $input
 */

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('userModel');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function process_login()
    {
        $this->form_validation->set_rules('email-username', 'Email/Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('login');
        } else {
            $email = $this->input->post('email-username');
            $password = $this->input->post('password');

            // Ambil user berdasarkan email saja (tanpa cek password dulu)
            $user = $this->userModel->get_user_by_email($email);

            if ($user && password_verify($password, $user->password)) {
                if ($user->is_verified == 0) {
                    $this->session->set_flashdata('error', 'Akun belum diverifikasi. Silakan cek email Anda.');
                    redirect('login');
                }

                $user_data = array(
                    'user_id'   => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'role'      => $user->role,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);

                // Redirect sesuai role
                if ($user->role == 'admin') {
                    redirect('admin/dashboard');
                } elseif ($user->role == 'courier') {
                    redirect('courier/dashboard');
                } else {
                    redirect('welcome');
                }
            } else {
                $this->session->set_flashdata('error', 'Email/username atau password salah');
                redirect('login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
