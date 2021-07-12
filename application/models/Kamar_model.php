<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kamar_model extends CI_Model
{

    public $table = 'kamar';
    public $id = 'idkamar';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all_join_pelanggan()
    {
        $this->db->select("*");
        $this->db->join('tamu', $this->table.".idkamar = tamu.idkamar");
        $this->db->join('pelanggan', "tamu.idpelanggan = pelanggan.idpelanggan");
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get all
    function get_all_empty_room()
    {
        $this->db->select("*");
        $this->db->where("digunakan","0");
        $this->db->or_where("digunakan",NULL);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get all
    function total_rows_empty_room($q)
    {
        $this->db->group_start();
        $this->db->where("digunakan","0");
        $this->db->or_where("digunakan",NULL);
        $this->db->group_end();
        $this->db->group_start();
        $this->db->like('idkamar', $q);
        $this->db->or_like('nomorkamar', $q);
        $this->db->or_like('tarif', $q);
        $this->db->or_like('digunakan', $q);
        $this->db->or_like('fotokamar', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->group_end();
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data_empty_room($limit, $start = 0, $q = NULL) {
        $this->db->group_start();
        $this->db->where("digunakan","0");
        $this->db->or_where("digunakan",NULL);
        $this->db->group_end();
        $this->db->group_start();
        $this->db->or_like('idkamar', $q);
        $this->db->or_like('nomorkamar', $q);
        $this->db->or_like('tarif', $q);
        $this->db->or_like('digunakan', $q);
        $this->db->or_like('fotokamar', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('idkamar', $q);
        $this->db->or_like('nomorkamar', $q);
        $this->db->or_like('tarif', $q);
        $this->db->or_like('digunakan', $q);
        $this->db->or_like('fotokamar', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_join_pelanggan($q = NULL) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('tamu', $this->table.".idkamar = tamu.idkamar");
        $this->db->join('pelanggan', "tamu.idpelanggan = pelanggan.idpelanggan");
        $this->db->like($this->table.'.idkamar', $q);
        $this->db->or_like('nomorkamar', $q);
        $this->db->or_like('tarif', $q);
        $this->db->or_like('digunakan', $q);
        $this->db->or_like('fotokamar', $q);
        $this->db->or_like('deskripsi', $q);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_data_join_pelanggan($q = NULL) {
        $this->db->select("*");
        $this->db->join('tamu', $this->table.".idkamar = tamu.idkamar");
        $this->db->join('pelanggan', "tamu.idpelanggan = pelanggan.idpelanggan");
        $this->db->like('idkamar', $q);
        $this->db->or_like('nomorkamar', $q);
        $this->db->or_like('tarif', $q);
        $this->db->or_like('digunakan', $q);
        $this->db->or_like('fotokamar', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_data($q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idkamar', $q);
        $this->db->or_like('nomorkamar', $q);
        $this->db->or_like('tarif', $q);
        $this->db->or_like('digunakan', $q);
        $this->db->or_like('fotokamar', $q);
        $this->db->or_like('deskripsi', $q);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idkamar', $q);
        $this->db->or_like('nomorkamar', $q);
        $this->db->or_like('tarif', $q);
        $this->db->or_like('digunakan', $q);
        $this->db->or_like('fotokamar', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_join_pelanggan($limit, $start = 0, $q = NULL) {
        $this->db->select("*");
        $this->db->join('tamu', $this->table.".idkamar = tamu.idkamar");
        $this->db->join('pelanggan', "tamu.idpelanggan = pelanggan.idpelanggan");
        $this->db->like($this->table.'.idkamar', $q);
        $this->db->or_like('nomorkamar', $q);
        $this->db->or_like('tarif', $q);
        $this->db->or_like('digunakan', $q);
        $this->db->or_like('fotokamar', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->order_by($this->table.'.'.$this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Kamar_model.php */
/* Location: ./application/models/Kamar_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:14 */
/* http://harviacode.com */