<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation
 * @property CI_Email $email
 * @property CI_Session $session
 * @property User_model $userModel
 * @property CI_Input $input
 */
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['form_validation', 'email', 'session']);
        $this->load->helper(['form', 'url', 'captcha']);
        $this->load->model('userModel');
    }

    public function index()
    {
        $vals = array(
            'word'       => '', // biarkan kosong, CI akan generate otomatis
            'img_path'   => './captcha/',
            'img_url'    => base_url('captcha/'),
            'img_width'  => 150,
            'img_height' => 40,
            'font_path'  => './application/fonts/OpenSans-Bold.ttf', // Ganti dengan font jelas
            'font_size'  => 40,
            'word_length' => 5,
            'img_id'     => 'captcha-img',
            'pool'       => 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789',
            'expiration' => 3600,
            'colors' => array(
                'background' => array(255, 255, 255),
                'border'     => array(100, 100, 100),
                'text'       => array(0, 0, 0),
                'grid'       => array(220, 220, 220)
            )
        );

        $captcha = create_captcha($vals);

        $this->session->set_userdata('captcha_code', $captcha['word']);
        $data['captcha_image'] = $captcha['image'];

        $this->load->view('auth/regist', $data);
    }

    public function process()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[15]|is_unique[users.phone]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/register');
        }

        $user_input = strtolower($this->input->post('captcha'));
        $session_captcha = strtolower($this->session->userdata('captcha_code'));

        if ($user_input !== $session_captcha) {
            $this->session->set_flashdata('error', 'Captcha yang dimasukkan salah.');
            redirect('auth/register');
        }

        $data = [
            'name'     => $this->input->post('name'),
            'email'    => $this->input->post('email'),
            'phone'    => $this->input->post('phone'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role'     => 'customer'
        ];

        $this->userModel->insert_user($data);

        // Kirim email notifikasi
        $this->email->from('your_email@gmail.com', 'My App');
        $this->email->to($data['email']);
        $this->email->subject('Registrasi Berhasil');
        $this->email->message('Selamat, Anda berhasil registrasi!');
        $this->email->send();

        $this->session->set_flashdata('success', 'Registrasi berhasil, silakan login.');
        redirect('auth/login');
    }
}
