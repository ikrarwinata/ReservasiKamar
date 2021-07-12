<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anggota_inap extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_inap_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'anggota_inap/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'anggota_inap/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'anggota_inap/index.html';
            $config['first_url'] = base_url() . 'anggota_inap/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Anggota_inap_model->total_rows($q);
        $anggota_inap = $this->Anggota_inap_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'anggota_inap_data' => $anggota_inap,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('anggota_inap/anggota_inap_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Anggota_inap_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'idreservasi' => $row->idreservasi,
		'ktp' => $row->ktp,
	    );
            $this->load->view('anggota_inap/anggota_inap_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('anggota_inap'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('anggota_inap/create_action'),
	    'id' => set_value('id'),
	    'idreservasi' => set_value('idreservasi'),
	    'ktp' => set_value('ktp'),
	);
        $this->load->view('anggota_inap/anggota_inap_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idreservasi' => $this->input->post('idreservasi',TRUE),
		'ktp' => $this->input->post('ktp',TRUE),
	    );

            $this->Anggota_inap_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('anggota_inap'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Anggota_inap_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('anggota_inap/update_action'),
		'id' => set_value('id', $row->id),
		'idreservasi' => set_value('idreservasi', $row->idreservasi),
		'ktp' => set_value('ktp', $row->ktp),
	    );
            $this->load->view('anggota_inap/anggota_inap_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('anggota_inap'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'idreservasi' => $this->input->post('idreservasi',TRUE),
		'ktp' => $this->input->post('ktp',TRUE),
	    );

            $this->Anggota_inap_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('anggota_inap'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Anggota_inap_model->get_by_id($id);

        if ($row) {
            $this->Anggota_inap_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('anggota_inap'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('anggota_inap'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idreservasi', 'idreservasi', 'trim|required');
	$this->form_validation->set_rules('ktp', 'ktp', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Anggota_inap.php */
/* Location: ./application/controllers/Anggota_inap.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-17 19:09:38 */
/* http://harviacode.com */