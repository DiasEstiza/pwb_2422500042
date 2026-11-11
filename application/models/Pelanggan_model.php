<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{

    private $_table = "pelanggan";

    public function get_all()
    {
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

}