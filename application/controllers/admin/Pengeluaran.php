<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengeluaran_model');
        $this->load->model("Aktifitasakun_model");
        $this->load->library('form_validation');
        set_timezone();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pengeluaran/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pengeluaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pengeluaran/index.html';
            $config['first_url'] = base_url() . 'admin/Pengeluaran/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengeluaran_model->total_rows_join_petugas($q);
        $pengeluaran = $this->Pengeluaran_model->get_limit_data_join_petugas($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengeluaran_data' => $pengeluaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => "admin/pengeluaran/pengeluaran_list",
            'script' => "admin/pengeluaran/pengeluaran_list_script",
            'per_page' => $config['per_page'],
            'judul' => array("Data Pengeluaran"),
        );
        $this->load->view('admin/container', $data);
    }

    public function read($id) 
    {
        $row = $this->Pengeluaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idpengeluaran' => $row->idpengeluaran,
		'deskripsi' => $row->deskripsi,
		'pengeluaran' => $row->pengeluaran,
		'tgl' => $row->tgl,
	    );
            $this->load->view('pengeluaran/pengeluaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect("admin/Pengeluaran");
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/Pengeluaran/create_action'),
    	    'idpengeluaran' => set_value('idpengeluaran'),
    	    'deskripsi' => set_value('deskripsi'),
    	    'pengeluaran' => set_value('pengeluaran'),
    	    'tgl' => set_value('tgl'),
            'judul' => array("Pengeluaran", "Tambah data pengeluaran"),
            'konten' => "admin/pengeluaran/pengeluaran_form",
	);
        $this->load->view('admin/container', $data);
    }
    
    public function create_action() 
    {
        $data = array(
            'deskripsi' => $this->input->post('deskripsi'),
            'pengeluaran' => $this->input->post('pengeluaran'),
            'tgl' => $this->input->post('tgl'),
            'idakun' => $this->input->post('idakun'),
        );

        $this->Pengeluaran_model->insert($data);

        $idpengeluaran = $this->db->query("SELECT idpengeluaran FROM pengeluaran WHERE pengeluaran='".$this->input->post('pengeluaran')."' AND deskripsi='".$this->input->post('deskripsi')."' AND idakun = '".$this->input->post('idakun')."' AND tgl = '".$this->input->post('tgl')."'")->row()->idpengeluaran;
        $token = $this->input->post('idakun').date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $this->input->post('idakun'),
            'datavalue' => $idpengeluaran,
            'displaytext' => $this->input->post('deskripsi',TRUE),
            'controller' => "pengeluaran",
            'action' => "create",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->Aktifitasakun_model->insert($action);

        $this->session->set_flashdata('message', 'Create Record Success');
    }
    
    public function update($id) 
    {
        $row = $this->Pengeluaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengeluaran/update_action'),
		'idpengeluaran' => set_value('idpengeluaran', $row->idpengeluaran),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'pengeluaran' => set_value('pengeluaran', $row->pengeluaran),
		'tgl' => set_value('tgl', $row->tgl),
	    );
            $this->load->view('pengeluaran/pengeluaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengeluaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idpengeluaran', TRUE));
        } else {
            $data = array(
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'pengeluaran' => $this->input->post('pengeluaran',TRUE),
		'tgl' => $this->input->post('tgl',TRUE),
	    );

            $this->Pengeluaran_model->update($this->input->post('idpengeluaran', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengeluaran'));
        }
    }
    
    public function delete() 
    {
        $id = $this->input->post("id");
        $row = $this->Pengeluaran_model->get_by_id_join_petugas($id);
        $idakun = $this->session->userdata("idakun");
        if ($row) {
            $data = array(
                'token' => $idakun.date("dmYHis"),
                'idakun' => $idakun,
                'datavalue' => $id,
                'displaytext' => $row->deskripsi,
                'controller' => "Pengeluaran",
                'action' => "delete",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i"),
                );
            $this->Aktifitasakun_model->insert($data);

            $this->Pengeluaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            echo "Success";
            return;
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            throw new Exception("Record Not Found", 1);
            echo "Failed";
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('pengeluaran', 'pengeluaran', 'trim|required');
	$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');

	$this->form_validation->set_rules('idpengeluaran', 'idpengeluaran', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
        
        if($limit<>""){
            $result =  $this->Pengeluaran_model->get_limit_data_join_petugas($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Pengeluaran_model->get_data_join_petugas($q);
        }else{
            $result = $this->Pengeluaran_model->get_all_join_petugas();
        }

        $namaFile = "pengeluaran.xls";
        $judul = "pengeluaran";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Akun");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Petugas");
        xlsWriteLabel($tablehead, $kolomhead++, "Pengeluaran");
    	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tgl");

    	foreach ($result as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->idakun);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteNumber($tablebody, $kolombody++, $data->pengeluaran);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
    
    public function print_page()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
        
        if($limit<>""){
            $result =  $this->Pengeluaran_model->get_limit_data_join_petugas($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Pengeluaran_model->get_data_join_petugas($q);
        }else{
            $result = $this->Pengeluaran_model->get_all_join_petugas();
        }
        
        $data = array(
            'pengeluaran_data' => $result,
            'title' => 'Data Pengeluaran',
            'text' => 'Data Pengeluaran',
            'start' => 0
        );
        
        $this->load->view('admin/pengeluaran/pengeluaran_doc',$data);
    }

}

/* End of file Pengeluaran.php */
/* Location: ./application/controllers/Pengeluaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:14 */
/* http://harviacode.com */