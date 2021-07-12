<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Riwayattamu_model extends CI_Model
{

    public $table = 'riwayattamu';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get all
    function get_all_join()
    {
        $this->db->select("riwayattamu.id, riwayattamu.idpetugas, riwayattamu.idpelanggan, riwayattamu.idkamar, riwayattamu.tglmasuk, riwayattamu.harimasuk, riwayattamu.tglkeluar, riwayattamu.harikeluar, riwayattamu.pembayaran, petugas.nama AS namapetugas, petugas.idakun AS idakunpetugas, pelanggan.nama AS namapelanggan, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('petugas', $this->table.".idpetugas = petugas.idpetugas");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
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
        $this->db->like('id', $q);
    $this->db->or_like('idpetugas', $q);
    $this->db->or_like('idpelanggan', $q);
    $this->db->or_like('idkamar', $q);
    $this->db->or_like('tglmasuk', $q);
    $this->db->or_like('harimasuk', $q);
    $this->db->or_like('tglkeluar', $q);
    $this->db->or_like('harikeluar', $q);
    $this->db->or_like('pembayaran', $q);
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_join($q = NULL) {
        $this->db->select("riwayattamu.id, riwayattamu.idpetugas, riwayattamu.idpelanggan, riwayattamu.idkamar, riwayattamu.tglmasuk, riwayattamu.harimasuk, riwayattamu.tglkeluar, riwayattamu.harikeluar, riwayattamu.pembayaran, petugas.nama AS namapetugas, petugas.idakun AS idakunpetugas, pelanggan.nama AS namapelanggan, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('petugas', $this->table.".idpetugas = petugas.idpetugas");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->like('id', $q);
        $this->db->or_like($this->table.'.idpetugas', $q);
        $this->db->or_like($this->table.'.idpelanggan', $q);
        $this->db->or_like($this->table.'.idkamar', $q);
        $this->db->or_like('tglmasuk', $q);
        $this->db->or_like('harimasuk', $q);
        $this->db->or_like('tglkeluar', $q);
        $this->db->or_like('harikeluar', $q);
        $this->db->or_like('pembayaran', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_join_id($id, $q = NULL) {
        $this->db->select("riwayattamu.id, riwayattamu.idpetugas, riwayattamu.idpelanggan, riwayattamu.idkamar, riwayattamu.tglmasuk, riwayattamu.harimasuk, riwayattamu.tglkeluar, riwayattamu.harikeluar, riwayattamu.pembayaran, petugas.nama AS namapetugas, petugas.idakun AS idakunpetugas, pelanggan.nama AS namapelanggan, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('petugas', $this->table.".idpetugas = petugas.idpetugas");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where($this->table.".idpelanggan", $id);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('idpetugas', $q);
        $this->db->or_like('idpelanggan', $q);
        $this->db->or_like('idkamar', $q);
        $this->db->or_like('tglmasuk', $q);
        $this->db->or_like('harimasuk', $q);
        $this->db->or_like('tglkeluar', $q);
        $this->db->or_like('harikeluar', $q);
        $this->db->or_like('pembayaran', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_join($limit, $start = 0, $q = NULL) {
        $this->db->select("riwayattamu.id, riwayattamu.idpetugas, riwayattamu.idpelanggan, riwayattamu.idkamar, riwayattamu.tglmasuk, riwayattamu.harimasuk, riwayattamu.tglkeluar, riwayattamu.harikeluar, riwayattamu.pembayaran, petugas.nama AS namapetugas, petugas.idakun AS idakunpetugas, pelanggan.nama AS namapelanggan, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('petugas', $this->table.".idpetugas = petugas.idpetugas");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->like('id', $q);
        $this->db->or_like($this->table.'.idpetugas', $q);
        $this->db->or_like($this->table.'.idpelanggan', $q);
        $this->db->or_like($this->table.'.idkamar', $q);
        $this->db->or_like('tglmasuk', $q);
        $this->db->or_like('harimasuk', $q);
        $this->db->or_like('tglkeluar', $q);
        $this->db->or_like('harikeluar', $q);
        $this->db->or_like('pembayaran', $q);
        $this->db->limit($limit, $start);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_join_id($id, $limit, $start = 0, $q = NULL) {
        $this->db->select("riwayattamu.id, riwayattamu.idpetugas, riwayattamu.idpelanggan, riwayattamu.idkamar, riwayattamu.tglmasuk, riwayattamu.harimasuk, riwayattamu.tglkeluar, riwayattamu.harikeluar, riwayattamu.pembayaran, petugas.nama AS namapetugas, petugas.idakun AS idakunpetugas, pelanggan.nama AS namapelanggan, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('petugas', $this->table.".idpetugas = petugas.idpetugas");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where($this->table.".idpelanggan", $id);
        $this->db->limit($limit, $start);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_data($q = NULL) {
        $this->db->select("riwayattamu.id, riwayattamu.idpetugas, riwayattamu.idpelanggan, riwayattamu.idkamar, riwayattamu.tglmasuk, riwayattamu.harimasuk, riwayattamu.tglkeluar, riwayattamu.harikeluar, riwayattamu.pembayaran, petugas.nama AS namapetugas, petugas.idakun AS idakunpetugas, pelanggan.nama AS namapelanggan, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('petugas', $this->table.".idpetugas = petugas.idpetugas");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->like('id', $q);
        $this->db->or_like($this->table.'.idpetugas', $q);
        $this->db->or_like($this->table.'.idpelanggan', $q);
        $this->db->or_like($this->table.'.idkamar', $q);
        $this->db->or_like('tglmasuk', $q);
        $this->db->or_like('harimasuk', $q);
        $this->db->or_like('tglkeluar', $q);
        $this->db->or_like('harikeluar', $q);
        $this->db->or_like('pembayaran', $q);
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

/* End of file Riwayattamu_model.php */
/* Location: ./application/models/Riwayattamu_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:15 */
/* http://harviacode.com */