<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reservasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Reservasi_model');
		$this->load->model("Aktifitasakun_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $tab = urldecode($this->input->get('tab', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'reservasi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'reservasi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'reservasi/index.html';
            $config['first_url'] = base_url() . 'reservasi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Reservasi_model->total_rows_join($q);
		
        $reservasiwaiting = $this->Reservasi_model->get_data_join1($q);
        $reservasiall = $this->Reservasi_model->get_limit_data_join($config['per_page'], $start, $q);
        $reservasirejected = $this->Reservasi_model->get_data_join0($q);
        $reservasiaccepted = $this->Reservasi_model->get_data_join2($q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'reservasi_datawaiting' => $reservasiwaiting,
            'reservasi_dataall' => $reservasiall,
            'reservasi_dataaccepted' => $reservasiaccepted,
            'reservasi_datarejected' => $reservasirejected,
            'judul' => array("Transaksi", "Reservasi"),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => "admin/reservasi/reservasi_list",
            'script' => "admin/reservasi/reservasi_list_script",
            'per_page' => $config['per_page'],
			'gototab' => $tab,
        );
        $this->load->view("admin/container", $data);
    }
    
    public function confirm(){
        
        $this->load->model('Kamar_model');
        $this->load->model('Tamu_model');   
        $status = "2";
        $datar = $this->Reservasi_model->get_by_id($this->input->post('id'));
        if(date_passed($datar->tglcheckin, 1)==TRUE){
            $out = increase_date($datar->tglcheckin, $datar->lamainap);
            $tarif = $this->db->select("tarif")->where("idkamar", $datar->idkamar)->get("kamar")->row()->tarif;
            $tarif = $tarif==NULL?0:$tarif;
            $data = array(
                'idpetugas' => $this->input->post('idpetugas'),
                'idpelanggan' => $datar->idpelanggan,
                'idkamar' => $datar->idkamar,
                'tglmasuk' => $datar->tglcheckin,
                'harimasuk' => get_str_day($datar->tglcheckin),
                'tglkeluar' => $out,
                'harikeluar' => get_str_day($out),
                'pembayaran' => $tarif * $datar->lamainap,
            );
            $this->Tamu_model->insert($data);
            // set kamar sedang digunakan
            $data = array(
                'digunakan'=>"1"
                );
            $this->Kamar_model->update($datar->idkamar,$data);
            $status = "3";
        }

        $data = array(
            'status' => $status
        );
        $this->Reservasi_model->update($this->input->post('id'), $data);
        
        $user = $this->input->post("idakun");
        $token = $user.date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $user,
            'datavalue' => $this->input->post('id'),
            'displaytext' => $this->input->post('nama'),
            'controller' => "Reservasi",
            'action' => "konfirmasi",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->Aktifitasakun_model->insert($action);
        
        echo "success";
        return "success";
    }
    
    public function set_room(){
        
        $this->load->model('Kamar_model');
        $this->load->model('Tamu_model');   
        $status = "2";
        $datar = $this->Reservasi_model->get_by_id($this->input->post('id'));
        $out = increase_date($datar->tglcheckin, $datar->lamainap);
        $data = array(
            'idpetugas' => $this->input->post('idpetugas'),
            'idpelanggan' => $datar->idpelanggan,
            'idkamar' => $datar->idkamar,
            'tglmasuk' => $datar->tglcheckin,
            'harimasuk' => get_str_day($datar->tglcheckin),
            'tglkeluar' => $out,
            'harikeluar' => get_str_day($out),
            'pembayaran' => "0",
        );
        $this->Tamu_model->insert($data);
        // set kamar sedang digunakan
        $data = array(
            'digunakan'=>"1"
            );
        $this->Kamar_model->update($datar->idkamar,$data);
        $status = "3";

        $data = array(
            'status' => $status
        );
        $this->Reservasi_model->update($this->input->post('id'), $data);
        
        echo "success";
        return "success";
    }
	
	public function reject($m){
		$ms = ($m==1?$this->input->post('messages'):NULL);
		
		$data = array(
			'status' => "0",
			'messages' => $ms,
	    );
		
        $this->Reservasi_model->update($this->input->post('id'), $data);
		
		$user = $this->input->post("idakun");
        $token = $user.date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $user,
            'datavalue' => $this->input->post('id'),
            'displaytext' => $this->input->post('nama'),
            'controller' => "Reservasi",
            'action' => "tolak",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->Aktifitasakun_model->insert($action); 
		
		echo "success";
		return "success";
	}

    public function read($id) 
    {
        $row = $this->Reservasi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idreservasi' => $row->idreservasi,
		'idpelanggan' => $row->idpelanggan,
		'idkamar' => $row->idkamar,
		'tglreservasi' => $row->tglreservasi,
		'tglcheckin' => $row->tglcheckin,
		'lamainap' => $row->lamainap,
		'status' => $row->status,
		'messages' => $row->messages,
	    );
            $this->load->view('reservasi/reservasi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('reservasi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('reservasi/create_action'),
	    'idreservasi' => set_value('idreservasi'),
	    'idpelanggan' => set_value('idpelanggan'),
	    'idkamar' => set_value('idkamar'),
	    'tglreservasi' => set_value('tglreservasi'),
	    'tglcheckin' => set_value('tglcheckin'),
	    'lamainap' => set_value('lamainap'),
	    'status' => set_value('status'),
	    'messages' => set_value('messages'),
	);
        $this->load->view('reservasi/reservasi_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idpelanggan' => $this->input->post('idpelanggan',TRUE),
		'idkamar' => $this->input->post('idkamar',TRUE),
		'tglreservasi' => $this->input->post('tglreservasi',TRUE),
		'tglcheckin' => $this->input->post('tglcheckin',TRUE),
		'lamainap' => $this->input->post('lamainap',TRUE),
		'status' => $this->input->post('status',TRUE),
		'messages' => $this->input->post('messages',TRUE),
	    );

            $this->Reservasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('reservasi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Reservasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('reservasi/update_action'),
		'idreservasi' => set_value('idreservasi', $row->idreservasi),
		'idpelanggan' => set_value('idpelanggan', $row->idpelanggan),
		'idkamar' => set_value('idkamar', $row->idkamar),
		'tglreservasi' => set_value('tglreservasi', $row->tglreservasi),
		'tglcheckin' => set_value('tglcheckin', $row->tglcheckin),
		'lamainap' => set_value('lamainap', $row->lamainap),
		'status' => set_value('status', $row->status),
		'messages' => set_value('messages', $row->messages),
	    );
            $this->load->view('reservasi/reservasi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('reservasi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idreservasi', TRUE));
        } else {
            $data = array(
		'idpelanggan' => $this->input->post('idpelanggan',TRUE),
		'idkamar' => $this->input->post('idkamar',TRUE),
		'tglreservasi' => $this->input->post('tglreservasi',TRUE),
		'tglcheckin' => $this->input->post('tglcheckin',TRUE),
		'lamainap' => $this->input->post('lamainap',TRUE),
		'status' => $this->input->post('status',TRUE),
		'messages' => $this->input->post('messages',TRUE),
	    );

            $this->Reservasi_model->update($this->input->post('idreservasi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('reservasi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Reservasi_model->get_by_id($id);

        if ($row) {
            $this->Reservasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('reservasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('reservasi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idpelanggan', 'idpelanggan', 'trim|required');
	$this->form_validation->set_rules('idkamar', 'idkamar', 'trim|required');
	$this->form_validation->set_rules('tglreservasi', 'tglreservasi', 'trim|required');
	$this->form_validation->set_rules('tglcheckin', 'tglcheckin', 'trim|required');
	$this->form_validation->set_rules('lamainap', 'lamainap', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('messages', 'messages', 'trim|required');

	$this->form_validation->set_rules('idreservasi', 'idreservasi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "reservasi.xls";
        $judul = "reservasi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Idpelanggan");
	xlsWriteLabel($tablehead, $kolomhead++, "Idkamar");
	xlsWriteLabel($tablehead, $kolomhead++, "Tglreservasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Tglcheckin");
	xlsWriteLabel($tablehead, $kolomhead++, "Lamainap");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Messages");

	foreach ($this->Reservasi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idpelanggan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idkamar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tglreservasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tglcheckin);
	    xlsWriteNumber($tablebody, $kolombody++, $data->lamainap);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->messages);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=reservasi.doc");

        $data = array(
            'reservasi_data' => $this->Reservasi_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('reservasi/reservasi_doc',$data);
    }

}

/* End of file Reservasi.php */
/* Location: ./application/controllers/Reservasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:15 */
/* http://harviacode.com */