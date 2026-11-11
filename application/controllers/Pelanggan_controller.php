<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
    }

    public function login()
    {
        if ($this->session->has_userdata('pelanggan_login')) {
            redirect(base_url());
            die;
        }
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->_login();
        } else {
            $this->load->view('ecom/template/header');
            $this->load->view('ecom/pelanggan_login');
            $this->load->view('ecom/template/footer');
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $check = $this->pelanggan_model->check_login($email, $password);
        if ($check) {
            $session_data = array(
                'id' => $check['id_pelanggan'],
                'email' => $check['email'],
                'nama' => $check['nama_pelanggan'],
                'pelanggan_login' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect(base_url());
        } else {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        Email atau password salah!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ');
        }
        redirect('login');
    }
}