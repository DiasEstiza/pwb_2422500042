<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kategori_model');
    }

    public function index() {
        $data['list_kategori'] = $this->produk_kategori_model->get_all();
        $this->load->view('administrator/kategori/index', $data);
        $this->load->view('administrator/template/header');
        $this->load->view('administrator/template/sidebar');
        $this->load->view('administrator/kategori/index', $data);
        $this->load->view('administrator/template/footer');
    }
}

public function tambah_kategori()
{
    $data['title'] = 'Tambah Kategori';

    $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
    if ($this->form_validation->run() !== FALSE) {
        $this->__simpan_kategori();
    } else {
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/kategori/tambah_kategori');
        $this->load->view('administrator/templates/footer');
    }
}*