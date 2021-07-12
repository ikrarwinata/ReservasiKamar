<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Akun_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'akun/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'akun/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'akun/index.html';
            $config['first_url'] = base_url() . 'akun/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Akun_model->total_rows($q);
        $akun = $this->Akun_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'akun_data' => $akun,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('akun/akun_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Akun_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'username' => $row->username,
		'password' => $row->password,
		'level' => $row->level,
	    );
            $this->load->view('akun/akun_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('akun'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('akun/create_action'),
	    'id' => set_value('id'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'level' => set_value('level'),
	);
        $this->load->view('akun/akun_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'level' => $this->input->post('level',TRUE),
	    );

            $this->Akun_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('akun'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Akun_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('akun/update_action'),
		'id' => set_value('id', $row->id),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'level' => set_value('level', $row->level),
	    );
            $this->load->view('akun/akun_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('akun'));
        }
    }
    
    public function update_action() 
    {
        if($this->input->post('username')!==NULL && $this->input->post('level')!==NULL){
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level'),
                );
        }else{
            $data = array(
            'password' => $this->input->post('password')
            );
        }
        
        $this->Akun_model->update($this->input->post('id'), $data);

        $row = $this->db->query("SELECT nama FROM pelanggan INNER JOIN akun ON pelanggan.idakun=akun.id WHERE pelanggan.idpelanggan='".$this->input->post('id')."'")->row()->nama;
        $data = array(
                'token' => $this->input->post('idakun').date("dmYHis"),
                'idakun' => $this->input->post('idakun'),
                'datavalue' => $this->input->post('id'),
                'displaytext' => $row->nama,
                'controller' => "akun",
                'action' => "update",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i"),
                );
        $this->Aktifitasakun_model->insert($data);
    }
    
    public function update_password_pelanggan() 
    {
        $this->load->model("Pelanggan_model");
        $row = $this->Pelanggan_model->get_by_id_join_akun($this->input->post('id'));

        $data = array(
            'password' => $this->input->post('password')
            );
        
        $this->Akun_model->update($row->idakun, $data);

        $data = array(
                'token' => $this->input->post('idakun').date("dmYHis"),
                'idakun' => $this->input->post('idakun'),
                'datavalue' => $this->input->post('id'),
                'displaytext' => $row->nama,
                'controller' => "akun",
                'action' => "update",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i"),
                );
        $this->load->model("Aktifitasakun_model");
        $this->Aktifitasakun_model->insert($data);
    }
    
    public function update_password_petugas() 
    {
        $this->load->model("Petugas_model");
        $row = $this->Petugas_model->get_by_id_join_akun($this->input->post('id'));
        
        if($this->session->userdata("idakun")==$row->idakun){
            $sess_data['password'] = $this->input->post('password');
            $this->session->set_userdata($sess_data);
        };

        $data = array(
            'password' => $this->input->post('password')
            );
        
        $this->Akun_model->update($row->idakun, $data);

        $data = array(
                'token' => $this->input->post('idakun').date("dmYHis"),
                'idakun' => $this->input->post('idakun'),
                'datavalue' => $this->input->post('id'),
                'displaytext' => $row->nama,
                'controller' => "akun",
                'action' => "update",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i"),
                );
        $this->load->model("Aktifitasakun_model");
        $this->Aktifitasakun_model->insert($data);
    }
    
    public function delete($id) 
    {
        $row = $this->Akun_model->get_by_id($id);

        if ($row) {
            $this->Akun_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('akun'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('akun'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "akun.xls";
        $judul = "akun";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Level");

	foreach ($this->Akun_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->level);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=akun.doc");

        $data = array(
            'akun_data' => $this->Akun_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('akun/akun_doc',$data);
    }

}

/* End of file Akun.php */
/* Location: ./application/controllers/Akun.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:13 */
/* http://harviacode.com */