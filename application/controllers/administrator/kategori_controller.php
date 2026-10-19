<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();

        $this->load->model('produk_kategori_model');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
    }

    private function _render($view, $data = array())
    {
        $data['title'] = isset($data['title'])
            ? $data['title']
            : 'Kategori - Shopi Amik';

        $this->load->view('administrator/template/header', $data);
        $this->load->view('administrator/template/sidebar');
        $this->load->view($view, $data);
        $this->load->view('administrator/template/footer');
    }

    public function index()
    {
        $data['list_kategori'] = $this->produk_kategori_model->get_all();

        $this->_render('administrator/kategori/index', $data);
    }

    public function tambah_kategori()
    {
        $this->form_validation->set_rules(
            'nama_kategori',
            'Nama Kategori',
            'trim|required|max_length[100]'
        );

        $this->form_validation->set_rules(
            'deskripsi_kategori',
            'Deskripsi',
            'trim|required'
        );

        if ($this->input->method(TRUE) === 'POST' && $this->form_validation->run()) {
            $data = array(
                'nama' => ucwords(trim($this->input->post('nama_kategori', TRUE))),
                'deskripsi' => ucfirst(trim($this->input->post('deskripsi_kategori', TRUE)))
            );

            if ($this->produk_kategori_model->tambah($data)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show">Berhasil menambahkan kategori!<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
                );
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show">Gagal menambahkan kategori.</div>'
                );
            }

            redirect('administrator/kategori');
            return;
        }

        $data['title'] = 'Tambah Kategori';
        $this->_render('administrator/kategori/tambah_kategori', $data);
    }

    public function hapus_kategori($id = NULL)
    {
        if ($id === NULL || !$this->produk_kategori_model->get_by_id($id)) {
            show_404();
            return;
        }

        if ($this->produk_kategori_model->hapus($id)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show">Berhasil menghapus kategori!<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show">Gagal menghapus kategori.</div>'
            );
        }

        redirect('administrator/kategori');
    }

    public function ubah_kategori($id = NULL)
    {
        $kategori = $id === NULL
            ? NULL
            : $this->produk_kategori_model->get_by_id($id);

        if (!$kategori) {
            show_404();
            return;
        }

        $this->form_validation->set_rules(
            'nama_kategori',
            'Nama Kategori',
            'trim|required|max_length[100]'
        );

        $this->form_validation->set_rules(
            'deskripsi_kategori',
            'Deskripsi',
            'trim|required'
        );

        if ($this->input->method(TRUE) === 'POST' && $this->form_validation->run()) {
            $data = array(
                'nama' => ucwords(trim($this->input->post('nama_kategori', TRUE))),
                'deskripsi' => ucfirst(trim($this->input->post('deskripsi_kategori', TRUE)))
            );

            if ($this->produk_kategori_model->ubah($id, $data)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show">Berhasil mengubah kategori!<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
                );
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show">Gagal mengubah kategori.</div>'
                );
            }

            redirect('administrator/kategori');
            return;
        }

        $data['title'] = 'Ubah Kategori';
        $data['kategori'] = $kategori;

        $this->_render('administrator/kategori/ubah_kategori', $data);
    }
}