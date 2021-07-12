<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aktifitasakun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Aktifitasakun_model');
        $this->load->library('form_validation');
        set_timezone();
    }

    public function index($akunlevel)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Aktifitasakun/index/'.$akunlevel.'?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Aktifitasakun/index/'.$akunlevel.'?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Aktifitasakun/index/'.$akunlevel.'';
            $config['first_url'] = base_url() . 'admin/Aktifitasakun/index/'.$akunlevel.'';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        switch (strtolower($akunlevel)) {
            case 'petugas':
                $config['total_rows'] = $this->Aktifitasakun_model->total_rows_join_akunpetugas($q);
                $aktifitasakun = $this->Aktifitasakun_model->get_limit_data_join_akunpetugas($config['per_page'], $start, $q);
                break;
            default:
                $config['total_rows'] = $this->Aktifitasakun_model->total_rows_join_akunpelanggan($q);
                $aktifitasakun = $this->Aktifitasakun_model->get_limit_data_join_akunpelanggan($config['per_page'], $start, $q);
                break;
        }

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'aktifitasakun_data' => $aktifitasakun,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'akunlevel'=>$akunlevel,
            'judul' => array("Aktifitas Akun", $akunlevel),
            'konten' => "admin/aktifitasakun/aktifitasakun_list",
            'per_page' => $config['per_page']
        );
        $this->load->view('admin/container', $data);
    }

    public function read($id) 
    {
        $row = $this->Aktifitasakun_model->get_by_id($id);
        if ($row) {
            $data = array(
		'token' => $row->token,
		'idakun' => $row->idakun,
		'datavalue' => $row->datavalue,
		'displaytext' => $row->displaytext,
		'controller' => $row->controller,
		'action' => $row->action,
		'tanggal' => $row->tanggal,
		'jam' => $row->jam,
	    );
            $this->load->view('aktifitasakun/aktifitasakun_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('aktifitasakun'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('aktifitasakun/create_action'),
	    'token' => set_value('token'),
	    'idakun' => set_value('idakun'),
	    'datavalue' => set_value('datavalue'),
	    'displaytext' => set_value('displaytext'),
	    'controller' => set_value('controller'),
	    'action' => set_value('action'),
	    'tanggal' => set_value('tanggal'),
	    'jam' => set_value('jam'),
	);
        $this->load->view('aktifitasakun/aktifitasakun_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idakun' => $this->input->post('idakun',TRUE),
		'datavalue' => $this->input->post('datavalue',TRUE),
		'displaytext' => $this->input->post('displaytext',TRUE),
		'controller' => $this->input->post('controller',TRUE),
		'action' => $this->input->post('action',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'jam' => $this->input->post('jam',TRUE),
	    );

            $this->Aktifitasakun_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('aktifitasakun'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Aktifitasakun_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('aktifitasakun/update_action'),
		'token' => set_value('token', $row->token),
		'idakun' => set_value('idakun', $row->idakun),
		'datavalue' => set_value('datavalue', $row->datavalue),
		'displaytext' => set_value('displaytext', $row->displaytext),
		'controller' => set_value('controller', $row->controller),
		'action' => set_value('action', $row->action),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'jam' => set_value('jam', $row->jam),
	    );
            $this->load->view('aktifitasakun/aktifitasakun_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('aktifitasakun'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('token', TRUE));
        } else {
            $data = array(
		'idakun' => $this->input->post('idakun',TRUE),
		'datavalue' => $this->input->post('datavalue',TRUE),
		'displaytext' => $this->input->post('displaytext',TRUE),
		'controller' => $this->input->post('controller',TRUE),
		'action' => $this->input->post('action',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'jam' => $this->input->post('jam',TRUE),
	    );

            $this->Aktifitasakun_model->update($this->input->post('token', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('aktifitasakun'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Aktifitasakun_model->get_by_id($id);

        if ($row) {
            $this->Aktifitasakun_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('aktifitasakun'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('aktifitasakun'));
        }
    }
    
    public function clear($akunlevel) 
    {
        if ($this->session->userdata(session_key())==1 && $this->session->userdata('level')>=4) {
            switch (strtolower($akunlevel)) {
                case 'petugas':
                    $this->db->query("DELETE FROM Aktifitasakun WHERE idakun IN (SELECT DISTINCT(idakun) FROM petugas)");
                    break;
                default:
                    $this->db->query("DELETE FROM Aktifitasakun WHERE idakun IN (SELECT DISTINCT(idakun) FROM pelanggan)");
                    break;
            }
            $this->session->set_flashdata('message', 'Truncate Success');
            redirect(site_url('admin/Aktifitasakun/index/'.$akunlevel));
            return;
        } else {
            $this->session->set_flashdata('message', 'Aktifitas ini hanya boleh dilakukan oleh Koordinator atau Kepala Divisi'.$this->session->userdata('level'));
            redirect(site_url('admin/Aktifitasakun/index/'.$akunlevel));
            return;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idakun', 'idakun', 'trim|required');
	$this->form_validation->set_rules('datavalue', 'datavalue', 'trim|required');
	$this->form_validation->set_rules('displaytext', 'displaytext', 'trim|required');
	$this->form_validation->set_rules('controller', 'controller', 'trim|required');
	$this->form_validation->set_rules('action', 'action', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('jam', 'jam', 'trim|required');

	$this->form_validation->set_rules('token', 'token', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->library("Excel");
        $excel = new Excel();
        $result_array = $this->Aktifitasakun_model->get_all();

        //Set Header
        $colIndex = 65;
        $rowIndex=1;
        $count = 0;
        foreach ($result_array as $row) {
            $rowname = key($row);
            foreach ($row as $value) {
                $excel->SetCellValue($rowname, chr($colIndex), $rowIndex);
                $excel->SetCellStyle($excel->Default_Header_Style, chr($colIndex), $rowIndex);
                $colIndex++;
                $count++;
                $rowname = key($row);
            }
            break;
        };

        //Set auto size
        $colIndex = 65;
        for($i = 1; $i <= $count; $i++){
            $excel->SetAutoSize(true, chr($colIndex));
            $colIndex++;
        };

        $excel->NewWorksheetFromArray($result_array,2);
        $excel->Download("Aktifitas Akun ".date("d m Y"));
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=aktifitasakun.doc");

        $data = array(
            'aktifitasakun_data' => $this->Aktifitasakun_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('aktifitasakun/aktifitasakun_doc',$data);
    }

}

/* End of file Aktifitasakun.php */
/* Location: ./application/controllers/Aktifitasakun.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:12 */
/* http://harviacode.com */