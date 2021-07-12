<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Riwayattamu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Riwayattamu_model');
        $this->load->model("Aktifitasakun_model");
        $this->load->library('form_validation');
        set_timezone();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Riwayattamu/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Riwayattamu/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Riwayattamu/index';
            $config['first_url'] = base_url() . 'admin/Riwayattamu/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Riwayattamu_model->total_rows_join($q);
        $riwayattamu = $this->Riwayattamu_model->get_limit_data_join($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'riwayattamu_data' => $riwayattamu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'per_page' => $config['per_page'],
            'judul' => array("Riwayat Tamu"),
            'konten' => "admin/riwayattamu/riwayattamu_list",
            'script' => "admin/riwayattamu/riwayattamu_list_script",
            'bootstrap' => array("")
        );
        $this->load->view('admin/container', $data);
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

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('riwayattamu/create_action'),
	    'id' => set_value('id'),
	    'idpetugas' => set_value('idpetugas'),
	    'idpelanggan' => set_value('idpelanggan'),
	    'idkamar' => set_value('idkamar'),
	    'tglmasuk' => set_value('tglmasuk'),
	    'harimasuk' => set_value('harimasuk'),
	    'tglkeluar' => set_value('tglkeluar'),
	    'harikeluar' => set_value('harikeluar'),
	    'pembayaran' => set_value('pembayaran'),
	);
        $this->load->view('riwayattamu/riwayattamu_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idpetugas' => $this->input->post('idpetugas',TRUE),
		'idpelanggan' => $this->input->post('idpelanggan',TRUE),
		'idkamar' => $this->input->post('idkamar',TRUE),
		'tglmasuk' => $this->input->post('tglmasuk',TRUE),
		'harimasuk' => $this->input->post('harimasuk',TRUE),
		'tglkeluar' => $this->input->post('tglkeluar',TRUE),
		'harikeluar' => $this->input->post('harikeluar',TRUE),
		'pembayaran' => $this->input->post('pembayaran',TRUE),
	    );

            $this->Riwayattamu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('riwayattamu'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Riwayattamu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('riwayattamu/update_action'),
		'id' => set_value('id', $row->id),
		'idpetugas' => set_value('idpetugas', $row->idpetugas),
		'idpelanggan' => set_value('idpelanggan', $row->idpelanggan),
		'idkamar' => set_value('idkamar', $row->idkamar),
		'tglmasuk' => set_value('tglmasuk', $row->tglmasuk),
		'harimasuk' => set_value('harimasuk', $row->harimasuk),
		'tglkeluar' => set_value('tglkeluar', $row->tglkeluar),
		'harikeluar' => set_value('harikeluar', $row->harikeluar),
		'pembayaran' => set_value('pembayaran', $row->pembayaran),
	    );
            $this->load->view('riwayattamu/riwayattamu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('riwayattamu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'idpetugas' => $this->input->post('idpetugas',TRUE),
		'idpelanggan' => $this->input->post('idpelanggan',TRUE),
		'idkamar' => $this->input->post('idkamar',TRUE),
		'tglmasuk' => $this->input->post('tglmasuk',TRUE),
		'harimasuk' => $this->input->post('harimasuk',TRUE),
		'tglkeluar' => $this->input->post('tglkeluar',TRUE),
		'harikeluar' => $this->input->post('harikeluar',TRUE),
		'pembayaran' => $this->input->post('pembayaran',TRUE),
	    );

            $this->Riwayattamu_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('riwayattamu'));
        }
    }
    
    public function delete() 
    {
        $id = $this->input->post("id");
        $row = $this->Riwayattamu_model->get_by_id($id);

        if ($row) {
            $user = $this->input->post("idakun");
            $this->load->model("Kamar_model");
            $token = $user.date("YmdHis");
            $action = array(
                'token' => $token,
                'idakun' => $this->input->post("idakun"),
                'datavalue' => $id,
                'displaytext' => $this->Kamar_model->get_by_id($row->idkamar)->nomorkamar,
                'controller' => "riwayattamu",
                'action' => "delete",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i")
            );
            $this->Aktifitasakun_model->insert($action);

            $this->Riwayattamu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            echo "Succed";
            return;
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo $id;
            return;
        }
    }
    
    public function clear() 
    {
        if ($this->session->userdata(session_key())!==TRUE && $this->session->userdata('level')==2) {
            $user = $this->input->post("idakun");
            $token = $user.date("YmdHis");
            $action = array(
                'token' => $token,
                'idakun' => $this->session->userdata('idakun'),
                'datavalue' => "Semua Data",
                'displaytext' => "Semua Data",
                'controller' => "riwayattamu",
                'action' => "delete",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i")
            );
            $this->Aktifitasakun_model->insert($action);

            $this->db->query("TRUNCATE riwayattamu");
            $this->session->set_flashdata('message', 'Truncate Success');
            redirect(site_url('admin/Riwayattamu'));
            return;
        } else {
            $this->session->set_flashdata('message', 'Aktifitas dibutuhkan level super administrator');
            redirect(site_url('admin/Riwayattamu'));
            return;
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

    public function excel()
    {
        $this->load->helper('exportexcel');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
		
		if($limit<>""){
            $result =  $this->Riwayattamu_model->get_limit_data_join($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Riwayattamu_model->get_data_join($q);
        }else{
            $result = $this->Riwayattamu_model->get_all_join();
        }
		
        $namaFile = "riwayattamu.xls";
        $judul = "riwayattamu";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id petugas");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Petugas");
        xlsWriteLabel($tablehead, $kolomhead++, "Id pelanggan");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
		xlsWriteLabel($tablehead, $kolomhead++, "Nomor Kamar");
		xlsWriteLabel($tablehead, $kolomhead++, "Tglmasuk");
		xlsWriteLabel($tablehead, $kolomhead++, "Harimasuk");
		xlsWriteLabel($tablehead, $kolomhead++, "Tglkeluar");
		xlsWriteLabel($tablehead, $kolomhead++, "Harikeluar");
		xlsWriteLabel($tablehead, $kolomhead++, "Pembayaran");

		foreach ($result as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->idpetugas);
			xlsWriteLabel($tablebody, $kolombody++, $data->namapetugas);
            xlsWriteLabel($tablebody, $kolombody++, $data->idpelanggan);
			xlsWriteLabel($tablebody, $kolombody++, $data->namapelanggan);
			xlsWriteLabel($tablebody, $kolombody++, $data->nomorkamar);
			xlsWriteLabel($tablebody, $kolombody++, $data->tglmasuk);
			xlsWriteLabel($tablebody, $kolombody++, $data->harimasuk);
			xlsWriteLabel($tablebody, $kolombody++, $data->tglkeluar);
			xlsWriteLabel($tablebody, $kolombody++, $data->harikeluar);
			xlsWriteNumber($tablebody, $kolombody++, $data->pembayaran);

			$tablebody++;
            $nourut++;
        }
            xlsWriteLabel($tablebody+1, 10, "Mengetahui");
            xlsWriteLabel($tablebody+3, 10, "Drs. M. Tarmizi, MM");

        xlsEOF();
        exit();
    }
    
    public function print_page()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
		
		if($limit<>""){
            $result =  $this->Riwayattamu_model->get_limit_data_join($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Riwayattamu_model->get_data_join($q);
        }else{
            $result = $this->Riwayattamu_model->get_all_join();
        }
        
        $data = array(
            'riwayattamu_data' => $result,
            'title' => 'Riwayat Tamu',
            'text' => 'Riwayat Tamu',
            'start' => 0
        );
        
        $this->load->view('admin/riwayattamu/riwayattamu_doc',$data);
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=riwayattamu.doc");

        $data = array(
            'riwayattamu_data' => $this->Riwayattamu_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('riwayattamu/riwayattamu_doc',$data);
    }

}

/* End of file Riwayattamu.php */
/* Location: ./application/controllers/Riwayattamu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:15 */
/* http://harviacode.com */