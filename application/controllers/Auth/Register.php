<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation
 * @property CI_Email $email
 * @property CI_Session $session
 * @property userModel $userModel
 * @property CI_Input $input
 * @property CI_Upload $upload
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
        // Validasi form input
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('regist');
        }

        // Siapkan konfigurasi upload gambar
        $config['upload_path']   = './uploads/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // maksimal 2MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        $image_name = null;
        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $image_name = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('regist');
            }
        }

        // Simpan user ke database
        $verification_code = mt_rand(100000, 999999);

        $data = [
            'name'              => $this->input->post('name'),
            'email'             => $this->input->post('email'),
            'password'          => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role'              => 'customer',
            'verification_code' => $verification_code,
            'is_verified'       => 0,
            'image'             => $image_name
        ];

        $this->userModel->insert_user($data);

        // Ambil data user setelah disimpan
        $user = $this->userModel->get_user_by_email($data['email']);
        $this->session->set_userdata('verif_user_id', $user->id);

        // Kirim kode verifikasi ke email
        $this->email->from('your_email@gmail.com', 'Go Rasa');
        $this->email->to($user->email);
        $this->email->subject('Kode Verifikasi Akun');
        $this->email->message("Kode verifikasi Anda adalah: <b>$verification_code</b>");

        if (!$this->email->send()) {
            $this->session->set_flashdata('error', 'Gagal mengirim kode verifikasi.');
            redirect('regist');
        }

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

        $this->load->view('auth/verify_form');
    }
}
