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

    private function __simpan_produk()
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'kategori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        # simpan dan return id_produk yang disimpan
        $id_produk = $this->produk_model->tambah($data);

        # simpan data, trus lakukan upload gambar kebalikan id produk
        $count = count($_FILES['gambar_produk']['name']);

        if ($count > 0) {
            // jika ada gambar upload
            $this->__produk_gambar_upload($count, $id_produk);
        }

        $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil menambahkan produk!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        ');

        redirect('admin/produk');
    }

    private function __produk_gambar_upload($count, $id_produk)
    {
        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['gambar_produk']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['gambar_produk']['name'][$i];
                $_FILES['file']['type'] = $_FILES['gambar_produk']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['gambar_produk']['error'][$i];
                $_FILES['file']['size'] = $_FILES['gambar_produk']['size'][$i];

                $config['upload_path'] = 'uploads/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                // $config['file_name'] = $_FILES['gambar_produk']['name'][$i];
                $config['file_name'] = "produk-" . $id_produk . '-' . $i;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    $data = [
                        'nama_gambar' => $filename,
                        'produk_id' => $id_produk
                    ];

                    $this->produk_gambar_model->tambah($data);
                }
            }
        }
    }
}