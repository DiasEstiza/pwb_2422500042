<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_kategori_model extends CI_Model
{
    private $_table = 'kategori';
    private $_primary_key = NULL;

    private function _primary_key()
    {
        if ($this->_primary_key !== NULL) {
            return $this->_primary_key;
        }

        $fields = $this->db->list_fields($this->_table);

        foreach (array('id_kategori', 'kategori_id', 'id') as $candidate) {
            if (in_array($candidate, $fields, TRUE)) {
                $this->_primary_key = $candidate;
                return $this->_primary_key;
            }
        }

        foreach ($fields as $field) {
            if (strpos(strtolower($field), 'id') === 0) {
                $this->_primary_key = $field;
                return $this->_primary_key;
            }
        }

        return FALSE;
    }

    public function get_all()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function get_by_id($id)
    {
        $key = $this->_primary_key();

        if (!$key) {
            return NULL;
        }

        return $this->db
            ->get_where($this->_table, array($key => $id))
            ->row_array();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function hapus($id)
    {
        $key = $this->_primary_key();

        if (!$key) {
            return FALSE;
        }

        return $this->db->delete(
            $this->_table,
            array($key => $id)
        );
    }

    public function ubah($id, $data)
    {
        $key = $this->_primary_key();

        if (!$key) {
            return FALSE;
        }

        return $this->db
            ->where($key, $id)
            ->update($this->_table, $data);
    }

    public function get_primary_key()
    {
        return $this->_primary_key();
    }
}
