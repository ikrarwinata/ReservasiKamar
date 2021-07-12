<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kamar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kamar_model');
        $this->load->model("Aktifitasakun_model");
        $this->load->library('form_validation');
        set_timezone();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/Kamar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/Kamar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/Kamar/index.html';
            $config['first_url'] = base_url() . 'user/Kamar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kamar_model->total_rows_empty_room($q) + $this->Kamar_model->total_rows_join_pelanggan($q);
        $kamar = $this->Kamar_model->get_limit_data_empty_room($config['per_page'], $start, $q);
        $kamar_joined = $this->Kamar_model->get_limit_data_join_pelanggan($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kamar_data' => $kamar_joined,
            'kamarnotamu_data' => $kamar,
            'q' => $q,
            'per_page' => $config['per_page'],
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => array("Semua Kamar"),
            'konten' => "user/kamar/kamar_list",
            'script' => "user/kamar/kamar_list_script",
            'bootstrap' => array("assets/css/colorbox.min.css")
        );
        $this->load->view('user/container', $data);
    }

    public function kosong()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/Kamar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/Kamar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/Kamar/index.html';
            $config['first_url'] = base_url() . 'user/Kamar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kamar_model->total_rows_empty_room($q);
        $kamar = $this->Kamar_model->get_limit_data_empty_room($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kamarnotamu_data' => $kamar,
            'q' => $q,
            'per_page' => $config['per_page'],
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => array("Kamar Kosong"),
            'konten' => "user/kamar/kamarkosong_list",
            'script' => "user/kamar/kamar_list_script",
            'bootstrap' => array("assets/css/colorbox.min.css")
        );
        $this->load->view('user/container', $data);
    }

    public function tamu()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/Kamar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/Kamar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/Kamar/index.html';
            $config['first_url'] = base_url() . 'user/Kamar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kamar_model->total_rows_join_pelanggan($q);
        $kamar_joined = $this->Kamar_model->get_limit_data_join_pelanggan($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kamar_data' => $kamar_joined,
            'q' => $q,
            'per_page' => $config['per_page'],
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => array("Kamar Digunakan"),
            'konten' => "user/kamar/tamu_list",
            'script' => "user/kamar/kamar_list_script",
            'bootstrap' => array("assets/css/colorbox.min.css")
        );
        $this->load->view('user/container', $data);
    }

    public function read($id) 
    {
        $row = $this->Kamar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idkamar' => $row->idkamar,
		'nomorkamar' => $row->nomorkamar,
		'tarif' => $row->tarif,
		'digunakan' => $row->digunakan,
		'fotokamar' => $row->fotokamar,
		'deskripsi' => $row->deskripsi,
	    );
            $this->load->view('kamar/kamar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kamar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomorkamar', 'nomorkamar', 'trim|required');
	$this->form_validation->set_rules('tarif', 'tarif', 'trim|required');
	$this->form_validation->set_rules('digunakan', 'digunakan', 'trim|required');
	$this->form_validation->set_rules('fotokamar', 'fotokamar', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

	$this->form_validation->set_rules('idkamar', 'idkamar', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kamar.php */
/* Location: ./application/controllers/Kamar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:13 */
/* http://harviacode.com */