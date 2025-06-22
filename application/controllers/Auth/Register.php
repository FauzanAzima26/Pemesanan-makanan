<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation
 * @property CI_Email $email
 * @property CI_Session $session
 * @property userModel $userModel
 * @property CI_Input $input
 */
class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['form_validation', 'email']);
        $this->load->helper(['form', 'url']);
        $this->load->model('userModel');
    }

    public function index()
    {
        $this->load->view('auth/regist');
    }

    public function process()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[15]|is_unique[users.phone]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/register');
        }

        // Cek CAPTCHA
        $captcha = $this->input->post('g-recaptcha-response');
        $secret = '6LfuZmkrAAAAAJkSOBgtA17pDBRCGlGF938rHX09';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret' => $secret,
            'response' => $captcha
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $verify = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($verify);

        $response = json_decode($verify);

        if (!$response->success) {
            $this->session->set_flashdata('error', 'Captcha tidak valid');
            redirect('auth/register');
        }

        // Simpan user
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => 'user'
        ];

        $this->userModel->insert_user($data);

        // Kirim email
        $this->email->from('your_email@gmail.com', 'My App');
        $this->email->to($data['email']);
        $this->email->subject('Registrasi Berhasil');
        $this->email->message('Selamat, Anda berhasil registrasi!');
        $this->email->send();

        $this->session->set_flashdata('success', 'Registrasi berhasil, silakan login');
        redirect('auth/login');
    }
}
