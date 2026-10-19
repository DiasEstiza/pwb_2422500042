<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();

        // Load model
        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model');

        // Load library
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['list_produk'] = $this->produk_model->get_all();

        $this->load->view('administrator/template/header', $data);
        $this->load->view('administrator/template/sidebar');
        $this->load->view('administrator/produk/index', $data);
        $this->load->view('administrator/template/footer');
    }

    public function tambah_produk()
    {
        $data['title'] = 'Tambah Produk';

        $this->form_validation->set_rules(
            'nama_produk',
            'Nama produk',
            'required'
        );

        $this->form_validation->set_rules(
            'kategori_produk',
            'Kategori',
            'required'
        );

        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_produk();
        } else {
            $data['list_kategori'] = $this->produk_kategori_model->get_all();

            $this->load->view('administrator/template/header', $data);
            $this->load->view('administrator/template/sidebar');
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/template/footer');
        }
    }

    public function ubah_produk($id = NULL)
    {
        if ($id == NULL) {
            redirect('administrator/produk');
        }

        $data['title'] = 'Ubah Produk';
        $data['produk'] = $this->produk_model->get_by_id($id);

        if (!$data['produk']) {
            show_404();
        }

        $this->form_validation->set_rules(
            'nama_produk',
            'Nama produk',
            'required'
        );

        $this->form_validation->set_rules(
            'kategori_produk',
            'Kategori',
            'required'
        );

        if ($this->form_validation->run() !== FALSE) {
            $this->__update_produk($id);
        } else {
            $data['list_kategori'] = $this->produk_kategori_model->get_all();
            
            // Kirim data gambar ke view
            $data['gambar_model']  = $this->produk_gambar_model;
            $data['gambar_produk'] = $this->produk_gambar_model->get_by_produk_id($id);

            $this->load->view('administrator/template/header', $data);
            $this->load->view('administrator/template/sidebar');
            $this->load->view('administrator/produk/ubah_produk', $data);
            $this->load->view('administrator/template/footer');
        }
    }

    private function __simpan_produk()
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'kategori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        // Simpan data produk
        $id_produk = $this->produk_model->tambah($data);

        if (!$id_produk) {
            show_error('Produk gagal disimpan ke database.');
            return;
        }

        // Upload gambar jika ada file yang dipilih
        if (
            isset($_FILES['gambar_produk']['name']) &&
            is_array($_FILES['gambar_produk']['name'])
        ) {
            $count = count($_FILES['gambar_produk']['name']);

            if ($count > 0) {
                $this->__produk_gambar_upload($count, $id_produk);
            }
        }

        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Berhasil menambahkan produk!!
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        ');

        redirect('administrator/produk');
    }

    private function __update_produk($id)
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'kategori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        // Update ke database ($data dulu baru $id)
        $this->produk_model->ubah($data, $id);

        // Upload gambar baru jika ada
        if (
            isset($_FILES['gambar_produk']['name']) &&
            is_array($_FILES['gambar_produk']['name'])
        ) {
            $count = count($_FILES['gambar_produk']['name']);

            if ($count > 0) {
                $this->__produk_gambar_upload($count, $id);
            }
        }

        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Berhasil mengubah data produk!!
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        ');

        redirect('administrator/produk');
    }

    private function __produk_gambar_upload($count, $id_produk)
    {
        $config['upload_path'] = FCPATH . 'uploads/produk/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 5000;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }

        for ($i = 0; $i < $count; $i++) {
            if (
                !isset($_FILES['gambar_produk']['name'][$i]) ||
                empty($_FILES['gambar_produk']['name'][$i])
            ) {
                continue;
            }

            $_FILES['file']['name']     = $_FILES['gambar_produk']['name'][$i];
            $_FILES['file']['type']     = $_FILES['gambar_produk']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['gambar_produk']['error'][$i];
            $_FILES['file']['size']     = $_FILES['gambar_produk']['size'][$i];

            $config['file_name'] = 'produk-' . $id_produk . '-' . time() . '-' . $i;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();

                $data = [
                    'nama_gambar' => $uploadData['file_name'],
                    'produk_id'  => $id_produk
                ];

                $this->produk_gambar_model->tambah($data);
            }
        }
    }
}