<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

ob_start();

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_admin');
        $this->load->library('form_validation');
    }

    function index() {
        $sekolah = $this->m_admin->get_sekolah();
        $this->load->view('v_login', ['sekolah' => $sekolah]);
    }

    function admin() {
        $this->load->view('v_login_admin');
    }

    function index2() {
        $this->load->view('v_tes');
    }

    public function ceklogin_admin() {
        $data = [
            'username' => $this->input->post('username'),
        ];
        $this->data['list'] = $this->m_login->cekakun('tb_admin', 'username_admin', $data['username']);
        $pass               = $this->input->post('password');

        if (!empty($this->data['list'])) {
            foreach ($this->data['list'] as $row) {
                if (password_verify($pass, $row['password'])) {
                    $sess_data['id_admin']       = $row['id_admin'];
                    $sess_data['username_admin'] = $row['username_admin'];
                    $sess_data['password']       = $row['password'];
                    $sess_data['nama_admin']     = $row['nama_admin'];
                    $this->session->set_userdata('logged_in', $sess_data);
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('login',
                        "<div class='uk-alert uk-alert-warning'>
                            <a href='#' class='uk-alert-close uk-close'></a>
                                <i class='fa fa-info'>&nbsp;</i>
                        Password yang anda masukkan tidak sesuai
                      </div>");
                    redirect(base_url("login/admin"));
                }
            }
        } else {
            $this->session->set_flashdata('login',
                "<div class='uk-alert uk-alert-danger'>
                        <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fa fa-info'>&nbsp;</i>
                    Akun Tidak terdaftar
                  </div>");
            redirect(base_url("login/admin"));
        }
    }

    public function ceklogin() {
        $data = [
            'username' => $this->input->post('username'),
        ];

        $this->data['list'] = $this->m_login->cekakun('tb_akun', 'username', $data['username']);
        $pass               = $this->input->post('password');

        if (!empty($this->data['list'])) {
            foreach ($this->data['list'] as $row) {
                if (password_verify($pass, $row['password'])) {
                    $sess_data['id_akun']  = $row['id_akun'];
                    $sess_data['username'] = $row['username'];
                    $sess_data['password'] = $row['password'];
                    $sess_data['level']    = $row['level'];
                    $this->session->set_userdata('logged_in', $sess_data);
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('login',
                        "<div class='uk-alert uk-alert-warning'>
                            <a href='#' class='uk-alert-close uk-close'></a>
                                <i class='fa fa-info'>&nbsp;</i>
                        Password yang anda masukkan tidak sesuai
                      </div>");
                    redirect(base_url("login"));
                }
            }
        } else {
            $this->session->set_flashdata('login',
                "<div class='uk-alert uk-alert-danger'>
                        <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fa fa-info'>&nbsp;</i>
                    Akun Tidak terdaftar
                  </div>");
            redirect(base_url("login"));
        }
    }

    function logout_admin() {
        $this->session->sess_destroy();
        redirect('login/admin');
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
};
