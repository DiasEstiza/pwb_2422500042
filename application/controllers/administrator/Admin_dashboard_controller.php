<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard_controller extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        is_admin_logged_in();
    }

    public function index() {
        $data['title'] = 'Shoppi Amik';
        $this->load->view('administrator/template/header', $data);
        $this->load->view('administrator/template/sidebar');
        $this->load->view('administrator/dashboard');
        $this->load->view('administrator/template/footer');
    }
}