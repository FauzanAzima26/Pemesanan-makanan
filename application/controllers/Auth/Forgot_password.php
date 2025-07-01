<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property userModel $userModel
 * @property CI_Input $input
 */

class Forgot_password extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['form_validation', 'email']);
        $this->load->model('userModel');
    }

    public function index()
    {
        $this->load->view('auth/forgot_password');
    }

    public function send_link()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('forgot_password');
        }

        $email = $this->input->post('email');
        $user = $this->userModel->get_user_by_email($email);

        if (!$user) {
            $this->session->set_flashdata('error', 'Email tidak ditemukan.');
            redirect('forgot_password');
        }

        // Generate token & simpan ke DB
        $token = bin2hex(random_bytes(16));
        $this->userModel->save_reset_token($user->id, $token);

        // Kirim email
        $reset_link = base_url("reset_password/$token");

        $this->email->from('your_email@gmail.com', 'Go Rasa');
        $this->email->to($email);
        $this->email->subject('Reset Password');
        $this->email->message("Klik link berikut untuk reset password: <a href='$reset_link'>$reset_link</a>");

        if ($this->email->send()) {
            $this->session->set_flashdata('success', 'Link reset password telah dikirim.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim email.');
        }

        redirect('forgot_password');
    }

    public function reset($token)
    {
        $user = $this->userModel->get_user_by_token($token);

        if (!$user) {
            show_error('Token tidak valid atau sudah kedaluwarsa.', 401);
        }

        // tampilkan form reset password
        $this->load->view('auth/reset', ['token' => $token]);
    }

    public function update_password()
    {
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('token', 'Token', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('reset_password/' . $this->input->post('token'));
        }

        $token = $this->input->post('token');
        $user = $this->userModel->get_user_by_token($token);

        if (!$user) {
            show_error('Token tidak valid.', 401);
        }

        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $this->userModel->update_password($user->id, $password);

        $this->session->set_flashdata('success', 'Password berhasil direset. Silakan login.');
        redirect('login');
    }
}
