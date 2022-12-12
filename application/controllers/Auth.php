<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('m_login');
    }

    public function index()
    {
        $this->load->view('v_login');
    }
    public function login_aksi()
    {

        $user = $this->input->post('username', true);
        $pass = md5($this->input->post('password', true));

        // role validasi
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() != FALSE) {

            $where = array(
                'username' => $user,
                'password' => $pass
            );

            $cekLogin = $this->m_login->cek_login($where)->num_rows();

            if ($cekLogin > 0) {

                $sess_data = array(
                    'login' => 'OK',
                    'username' => $user
                );

                $this->session->set_userdata($sess_data);

                redirect(base_url());
            } else {
                redirect('auth');
            }
        } else {
            $this->load->view('v_login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    public function regist()
    {
        $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('v_header');
            $this->load->view('register');
            $this->load->view('v_footer');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'password' => password_hash(
                    $this->input->post('password1'),
                    PASSWORD_DEFAULT
                )
            ];

            $this->db->insert('users', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login</div>');
            redirect('auth');
        }
    }
}
