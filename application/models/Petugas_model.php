<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Petugas_model extends CI_Model
{

    public $table = 'petugas';
    public $id = 'idpetugas';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_by_akun($id)
    {
        $this->db->where("idakun", $id);
        return $this->db->get($this->table)->row();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get all
    function get_all_join_akun()
    {
        $this->db->select("*");
        $this->db->join('akun', $this->table.".idakun = akun.id");
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function get_by_id_join_akun($id)
    {
        $this->db->select("*");
        $this->db->join('akun', $this->table.".idakun = akun.id");
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('idpetugas', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('tgllahir', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('telepon', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('fotoprofil', $q);
        $this->db->or_like('idakun', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_join_akun($q = NULL) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('akun', $this->table.".idakun = akun.id");
        $this->db->like('idpetugas', $q);
    	$this->db->or_like('nama', $q);
    	$this->db->or_like('tgllahir', $q);
    	$this->db->or_like('alamat', $q);
    	$this->db->or_like('telepon', $q);
    	$this->db->or_like('email', $q);
    	$this->db->or_like('fotoprofil', $q);
    	$this->db->or_like('idakun', $q);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_data($q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idpetugas', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('tgllahir', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('telepon', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('fotoprofil', $q);
        $this->db->or_like('idakun', $q);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_data_join_akun($q = NULL) {
        $this->db->select("*");
        $this->db->join('akun', $this->table.".idakun = akun.id");
        $this->db->like('idpetugas', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('tgllahir', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('telepon', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('fotoprofil', $q);
        $this->db->or_like('idakun', $q);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idpetugas', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('tgllahir', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('telepon', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('fotoprofil', $q);
        $this->db->or_like('idakun', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_join_akun($limit, $start = 0, $q = NULL) {
        $this->db->select("*");
        $this->db->join('akun', $this->table.".idakun = akun.id");
        $this->db->like('idpetugas', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('tgllahir', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('telepon', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('fotoprofil', $q);
        $this->db->or_like('idakun', $q);
        $this->db->limit($limit, $start);
        $this->db->order_by($this->id, $this->order);
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

/* End of file Petugas_model.php */
/* Location: ./application/models/Petugas_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:14 */
/* http://harviacode.com */