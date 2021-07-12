<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Riwayattamu_model');
        $this->load->model("Reservasi_model");
        $this->load->library('form_validation');
        set_timezone();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/Riwayat/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/Riwayat/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/Riwayat/index';
            $config['first_url'] = base_url() . 'user/Riwayat/index';
        }
        $id = $this->session->userdata("id");
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Riwayattamu_model->total_rows_join_id($id, $q);
        $riwayattamu = $this->Riwayattamu_model->get_limit_data_join_id($id, $config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'riwayattamu_data' => $riwayattamu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'per_page' => $config['per_page'],
            'judul' => array("Riwayat Kamar"),
            'konten' => "user/riwayat/riwayatkamar_list",
            'script' => "user/riwayat/riwayatkamar_list_script",
            'bootstrap' => array("")
        );
        $this->load->view('user/container', $data);
    }

    public function reservasi()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/Riwayat/reservasi?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/Riwayat/reservasi?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/Riwayat/reservasi';
            $config['first_url'] = base_url() . 'user/Riwayat/reservasi';
        }
        $id = $this->session->userdata("id");
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Reservasi_model->total_rows_join_id($id, $q);
        $reservasiall = $this->Reservasi_model->get_limit_data_join_id($id, $config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'riwayattamu_data' => $reservasiall,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'per_page' => $config['per_page'],
            'judul' => array("Riwayat Reservasi"),
            'konten' => "user/riwayat/riwayatreservasi_list",
            'script' => "user/riwayat/riwayatkamar_list_script",
            'bootstrap' => array("")
        );
        $this->load->view('user/container', $data);
    }

    public function read($id) 
    {
        $row = $this->Riwayattamu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'idpetugas' => $row->idpetugas,
		'idpelanggan' => $row->idpelanggan,
		'idkamar' => $row->idkamar,
		'tglmasuk' => $row->tglmasuk,
		'harimasuk' => $row->harimasuk,
		'tglkeluar' => $row->tglkeluar,
		'harikeluar' => $row->harikeluar,
		'pembayaran' => $row->pembayaran,
	    );
            $this->load->view('riwayattamu/riwayattamu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('riwayattamu'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idpetugas', 'idpetugas', 'trim|required');
	$this->form_validation->set_rules('idpelanggan', 'idpelanggan', 'trim|required');
	$this->form_validation->set_rules('idkamar', 'idkamar', 'trim|required');
	$this->form_validation->set_rules('tglmasuk', 'tglmasuk', 'trim|required');
	$this->form_validation->set_rules('harimasuk', 'harimasuk', 'trim|required');
	$this->form_validation->set_rules('tglkeluar', 'tglkeluar', 'trim|required');
	$this->form_validation->set_rules('harikeluar', 'harikeluar', 'trim|required');
	$this->form_validation->set_rules('pembayaran', 'pembayaran', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Riwayattamu.php */
/* Location: ./application/controllers/Riwayattamu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:15 */
/* http://harviacode.com */