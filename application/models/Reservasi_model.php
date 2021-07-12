<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reservasi_model extends CI_Model
{

    public $table = 'reservasi';
    public $id = 'idreservasi';
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
    function get_total_range_join($stampstart, $stampend)
    {
        $this->db->select("SUM(kamar.tarif) AS res");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where("reservasi.timestamps >=", $stampstart, FALSE);
        $this->db->where("reservasi.timestamps <=", $stampend, FALSE);
        return $this->db->get($this->table)->row()->res;
    }

    // get all
    function get_all_join()
    {
        $this->db->select("reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
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

    // get data by id
    function get_by_kamar_for_resv($id)
    {
        $q = "SELECT * FROM ".$this->table." WHERE idkamar=$id AND tglcheckin LIKE '".date("Y")."-_%' AND status = '1' UNION SELECT * FROM ".$this->table." WHERE idkamar=$id AND tglcheckin LIKE '".date("Y")."-_%' AND status = '4'";
        return $this->db->query($q)->result();
    }

    // get data by id
    function get_by_kamar($id)
    {
        $this->db->where("idkamar", $id);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id_join2($id)
    {
        $this->db->select("reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.idkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where("Status", "2");
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('idreservasi', $q);
		$this->db->or_like($this->table.'.idpelanggan', $q);
		$this->db->or_like($this->table.'.idkamar', $q);
		$this->db->or_like('tglreservasi', $q);
		$this->db->or_like('tglcheckin', $q);
		$this->db->or_like('lamainap', $q);
		$this->db->or_like('status', $q);
		$this->db->or_like('messages', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_join($q = NULL) {
        $this->db->select("reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->or_like('idreservasi', $q);
        $this->db->or_like($this->table.'.idpelanggan', $q);
        $this->db->or_like($this->table.'.idkamar', $q);
        $this->db->or_like('tglreservasi', $q);
        $this->db->or_like('tglcheckin', $q);
        $this->db->or_like('lamainap', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('messages', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_join_id($id, $q = NULL) {
        $this->db->select("reservasi.buktipembayaran, reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where($this->table.'.idpelanggan', $id);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_join2($q = NULL) {
        $this->db->select("reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where("Status", "2");
        if($q!=NULL){
            $this->db->or_like('idreservasi', $q);
            $this->db->or_like($this->table.'.idpelanggan', $q);
            $this->db->or_like($this->table.'.idkamar', $q);
            $this->db->or_like('tglreservasi', $q);
            $this->db->or_like('tglcheckin', $q);
            $this->db->or_like('lamainap', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('messages', $q);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idreservasi', $q);
		$this->db->or_like('idpelanggan', $q);
		$this->db->or_like('idkamar', $q);
		$this->db->or_like('tglreservasi', $q);
		$this->db->or_like('tglcheckin', $q);
		$this->db->or_like('lamainap', $q);
		$this->db->or_like('status', $q);
		$this->db->or_like('messages', $q);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_join($limit, $start = 0, $q = NULL) {
        $this->db->select("reservasi.buktipembayaran, reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->or_like('idreservasi', $q);
        $this->db->or_like($this->table.'.idpelanggan', $q);
        $this->db->or_like($this->table.'.idkamar', $q);
        $this->db->or_like('tglreservasi', $q);
        $this->db->or_like('tglcheckin', $q);
        $this->db->or_like('lamainap', $q);
        $this->db->or_like('status', $q);
//      $this->db->or_like('messages', $q);
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_join_id($id, $limit, $start = 0, $q = NULL) {
        $this->db->select("reservasi.buktipembayaran, reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, reservasi.messages, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where($this->table.'.idpelanggan', $id);
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_join2($limit, $start = 0, $q = NULL) {
        $this->db->select("reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where("Status", "2");
        if($q!=NULL){
            $this->db->or_like('idreservasi', $q);
            $this->db->or_like($this->table.'.idpelanggan', $q);
            $this->db->or_like($this->table.'.idkamar', $q);
            $this->db->or_like('tglreservasi', $q);
            $this->db->or_like('tglcheckin', $q);
            $this->db->or_like('lamainap', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('messages', $q);
        }
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_data_join0( $q = NULL) {
        $this->db->select("reservasi.buktipembayaran, reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where("Status", "0");
        if($q!=NULL){
			$this->db->or_like('idreservasi', $q);
			$this->db->or_like($this->table.'.idpelanggan', $q);
			$this->db->or_like($this->table.'.idkamar', $q);
			$this->db->or_like('tglreservasi', $q);
			$this->db->or_like('tglcheckin', $q);
			$this->db->or_like('lamainap', $q);
			$this->db->or_like('status', $q);
			$this->db->or_like('messages', $q);
		}
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_data_join1($q = NULL) {
        $this->db->select("reservasi.buktipembayaran, reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where("Status", "1");
		if($q!=NULL){
			$this->db->or_like('idreservasi', $q);
			$this->db->or_like($this->table.'.idpelanggan', $q);
			$this->db->or_like($this->table.'.idkamar', $q);
			$this->db->or_like('tglreservasi', $q);
			$this->db->or_like('tglcheckin', $q);
			$this->db->or_like('lamainap', $q);
			$this->db->or_like('status', $q);
			$this->db->or_like('messages', $q);
		}
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_data_join2( $q = NULL) {
        $this->db->select("reservasi.buktipembayaran, reservasi.idreservasi, reservasi.idpelanggan, reservasi.idkamar, reservasi.tglreservasi, reservasi.tglcheckin, reservasi.lamainap, reservasi.status, pelanggan.nama AS namapelanggan, pelanggan.idpelanggan, pelanggan.jeniskelamin, pelanggan.tgllahir, pelanggan.telepon, pelanggan.email, pelanggan.fotoktp, pelanggan.fotoprofil, kamar.nomorkamar, kamar.tarif, kamar.digunakan, kamar.fotokamar");
        $this->db->join('pelanggan', $this->table.".idpelanggan = pelanggan.idpelanggan");
        $this->db->join('kamar', $this->table.".idkamar = kamar.idkamar");
        $this->db->where("Status >=", "2");
		if($q!=NULL){
			$this->db->or_like('idreservasi', $q);
			$this->db->or_like($this->table.'.idpelanggan', $q);
			$this->db->or_like($this->table.'.idkamar', $q);
			$this->db->or_like('tglreservasi', $q);
			$this->db->or_like('tglcheckin', $q);
			$this->db->or_like('lamainap', $q);
			$this->db->or_like('status', $q);
			$this->db->or_like('messages', $q);
		}
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

    // update data
    function update_string($id, $data)
    {
        $where =$this->id." = '".$id."'";
        $this->db->update_string($this->table, $data, $where);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Reservasi_model.php */
/* Location: ./application/models/Reservasi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:15 */
/* http://harviacode.com */