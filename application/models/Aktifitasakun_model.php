<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aktifitasakun_model extends CI_Model
{

    public $table = 'aktifitasakun';
    public $id = 'token';
    public $order = 'DESC';
    public $sorter = 'id';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->sorter, $this->order);
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
        $this->db->like('token', $q);
    $this->db->or_like('idakun', $q);
    $this->db->or_like('datavalue', $q);
    $this->db->or_like('displaytext', $q);
    $this->db->or_like('controller', $q);
    $this->db->or_like('action', $q);
    $this->db->or_like('tanggal', $q);
    $this->db->or_like('jam', $q);
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_join_akunpetugas($q = NULL) {
        $this->db->select("*");
        $this->db->join('akun', $this->table.".idakun = akun.id");
        $this->db->join('petugas', "akun.id = petugas.idakun");
        $this->db->like('token', $q);
    $this->db->or_like($this->table.'.idakun', $q);
    $this->db->or_like('datavalue', $q);
    $this->db->or_like('displaytext', $q);
    $this->db->or_like('controller', $q);
    $this->db->or_like('action', $q);
    $this->db->or_like('tanggal', $q);
    $this->db->or_like('jam', $q);
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_join_akunpelanggan($q = NULL) {
        $this->db->select("*");
        $this->db->join('akun', $this->table.".idakun = akun.id");
        $this->db->join('pelanggan', "akun.id = pelanggan.idakun");
        $this->db->like('token', $q);
    $this->db->or_like($this->table.'.idakun', $q);
    $this->db->or_like('datavalue', $q);
    $this->db->or_like('displaytext', $q);
    $this->db->or_like('controller', $q);
    $this->db->or_like('action', $q);
    $this->db->or_like('tanggal', $q);
    $this->db->or_like('jam', $q);
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->sorter, $this->order);
        $this->db->like('token', $q);
	$this->db->or_like('idakun', $q);
	$this->db->or_like('datavalue', $q);
	$this->db->or_like('displaytext', $q);
	$this->db->or_like('controller', $q);
	$this->db->or_like('action', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('jam', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_join_akunpetugas($limit, $start = 0, $q = NULL) {
        $this->db->select("*");
        $this->db->join('akun', $this->table.".idakun = akun.id");
        $this->db->join('petugas', "akun.id = petugas.idakun");
        $this->db->like('token', $q);
        $this->db->or_like($this->table.'.idakun', $q);
        $this->db->or_like('datavalue', $q);
        $this->db->or_like('displaytext', $q);
        $this->db->or_like('controller', $q);
        $this->db->or_like('action', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('jam', $q);
        $this->db->order_by($this->table.".".$this->sorter, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_join_akunpelanggan($limit, $start = 0, $q = NULL) {
        $this->db->select("*");
        $this->db->join('akun', $this->table.".idakun = akun.id");
        $this->db->join('pelanggan', "akun.id = pelanggan.idakun");
        $this->db->like('token', $q);
        $this->db->or_like($this->table.'.idakun', $q);
        $this->db->or_like('datavalue', $q);
        $this->db->or_like('displaytext', $q);
        $this->db->or_like('controller', $q);
        $this->db->or_like('action', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('jam', $q);
        $this->db->order_by($this->table.".".$this->sorter, $this->order);
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

/* End of file Aktifitasakun_model.php */
/* Location: ./application/models/Aktifitasakun_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:12 */
/* http://harviacode.com */