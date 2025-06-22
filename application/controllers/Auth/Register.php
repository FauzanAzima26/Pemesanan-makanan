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
            redirect('regist');
        }

        // Validasi CAPTCHA
        $captcha = $this->input->post('g-recaptcha-response');
        $secret = '6LfuZmkrAAAAAJkSOBgtA17pDBRCGlGF938rHX09';
        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$captcha}");
        $response = json_decode($verify);

        if (!$response->success) {
            $this->session->set_flashdata('error', 'Captcha tidak valid');
            redirect('regist');
        }

        // Simpan user ke database
        $verification_code = mt_rand(100000, 999999);

        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => 'customer',
            'verification_code' => $verification_code,
            'is_verified' => 0
        ];

        $this->userModel->insert_user($data);

        // Ambil data user setelah disimpan
        $user = $this->userModel->get_user_by_email($data['email']);
        $this->session->set_userdata('verif_user_id', $user->id);

        // Kirim kode verifikasi ke email
        $this->email->from('your_email@gmail.com', 'My App');
        $this->email->to($user->email);
        $this->email->subject('Kode Verifikasi Akun');
        $this->email->message("Kode verifikasi Anda adalah: <b>$verification_code</b>");

        if (!$this->email->send()) {
            $this->session->set_flashdata('error', 'Gagal mengirim kode verifikasi.');
            redirect('regist');
        }

        // Arahkan ke form verifikasi
        redirect('regist/verify');
    }

    public function verify()
    {
        if ($this->input->post()) {
            $code = $this->input->post('otp');
            $user_id = $this->session->userdata('verif_user_id');

            $user = $this->userModel->get_by_id($user_id);

            if ($user && $user->verification_code == $code) {
                $this->userModel->update($user_id, [
                    'is_verified' => 1,
                    'verification_code' => null
                ]);

                $this->session->set_flashdata('success', 'Akun berhasil diverifikasi, silakan login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Kode verifikasi salah.');
                redirect('regist/verify');
            }
        }

        $this->load->view('auth/verify_form'); // form input kode
    }
}
