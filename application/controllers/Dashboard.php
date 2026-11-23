<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Produk_kategori_model');
        $this->load->model('Produk_gambar_model');
    }

    public function index()
    {
        $data['gambar_model'] = $this->Produk_gambar_model;
        $data['list_produk'] = $this->Produk_model->get_all();
        $this->load->view('ecom/template/header', $data);
        $this->load->view('ecom/template/carausel');
        $this->load->view('ecom/home', $data);
        $this->load->view('ecom/template/footer');
    }
}