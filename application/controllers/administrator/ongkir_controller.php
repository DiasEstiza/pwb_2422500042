<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ongkir_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();

        $this->load->model('produk_ongkir_model');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
    }

    private function _render($view, $data = array())
    {
        $data['title'] = isset($data['title'])
            ? $data['title']
            : 'Ongkir - Shopi Amik';

        $this->load->view('administrator/template/header', $data);
        $this->load->view('administrator/template/sidebar');
        $this->load->view($view, $data);
        $this->load->view('administrator/template/footer');
    }

    public function index()
    {
        $data['list_ongkir'] = $this->produk_ongkir_model->get_all();

        $this->_render('administrator/ongkir/index', $data);
    }

    public function tambah_ongkir()
    {
        $this->form_validation->set_rules(
        'nama_ekspedisi042',
        'Nama Ekspedisi',
        'trim|required'
        );

        $this->form_validation->set_rules(
        'jenis_layanan042',
        'Jenis Layanan',
        'trim|required'
        );

        $this->form_validation->set_rules(
        'tarif_per_kg042',
        'Tarif Per Kg',
        'trim|required'
        );

        $this->form_validation->set_rules(
        'status042',
        'Status',
        'trim|required'
        );

        if ($this->input->method(TRUE) === 'POST' && $this->form_validation->run()) {
            $data = array(
                'id_ongkir042' => trim($this->input->post('id_ongkir042', TRUE)),
                'nama_ekspedisi042' => ucfirst(trim($this->input->post('nama_ekspedisi042', TRUE))),
                'jenis_layanan042' => ucfirst(trim($this->input->post('jenis_layanan042', TRUE))),
                'tarif_per_kg042' => trim($this->input->post('tarif_per_kg042', TRUE)),
                'status042' => ucfirst(trim($this->input->post('status042', TRUE)))
            );
            if ($this->produk_ongkir_model->tambah($data)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show">Berhasil menambahkan ongkir!<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
                );
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show">Gagal menambahkan ongkir.</div>'
                );
            }

            redirect('administrator/ongkir');
            return;
        }

        $data['title'] = 'Tambah Ongkir';
        $this->_render('administrator/ongkir/tambah_ongkir', $data);
    }

    public function hapus_ongkir($id = NULL)
    {
        if ($id === NULL || !$this->produk_ongkir_model->get_by_id($id)) {
            show_404();
            return;
        }

        if ($this->produk_ongkir_model->hapus($id)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show">Berhasil menghapus ongkir!<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show">Gagal menghapus ongkir.</div>'
            );
        }

        redirect('administrator/ongkir');
    }

    public function ubah_ongkir($id = NULL)
    {
        $ongkir = $id === NULL
            ? NULL
            : $this->produk_ongkir_model->get_by_id($id);

        if (!$ongkir) {
            show_404();
            return;
        }

        $this->form_validation->set_rules(
            'id_ongkir042',
            'ID Ongkir',
            'trim|required|max_length[100]'
        );

        $this->form_validation->set_rules(
            'nama_ekspedisi042',
            'Nama Ekspedisi',
            'trim|required'
        );

        $this->form_validation->set_rules(
            'jenis_layanan042',
            'Jenis Layanan',
            'trim|required'
        );

        $this->form_validation->set_rules(
            'tarif_per_kg042',
            'Tarif Per Kg',
            'trim|required'
        );

        $this->form_validation->set_rules(
            'status042',
            'Status',
            'trim|required'
        );

        if ($this->input->method(TRUE) === 'POST' && $this->form_validation->run()) {
            $data = array(
    'id_ongkir042' => trim($this->input->post('id_ongkir042', TRUE)),
    'nama_ekspedisi042' => ucfirst(trim($this->input->post('nama_ekspedisi042', TRUE))),
    'jenis_layanan042' => ucfirst(trim($this->input->post('jenis_layanan042', TRUE))),
    'tarif_per_kg042' => trim($this->input->post('tarif_per_kg042', TRUE)),
    'status042' => ucfirst(trim($this->input->post('status042', TRUE)))
);
            if ($this->produk_ongkir_model->ubah($id, $data)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show">Berhasil mengubah ongkir!<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
                );
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show">Gagal mengubah ongkir.</div>'
                );
            }

            redirect('administrator/ongkir');
            return;
        }

        $data['title'] = 'Ubah Ongkir';
        $data['ongkir'] = $ongkir;

        $this->_render('administrator/ongkir/ubah_ongkir', $data);
    }
}