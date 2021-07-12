<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bank_model');
        $this->load->library('form_validation');
        $this->load->model("Aktifitasakun_model");
        set_timezone();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'bank/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'bank/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'bank/index.html';
            $config['first_url'] = base_url() . 'bank/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Bank_model->total_rows($q);
        $bank = $this->Bank_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
		
		$boot = array(
            'assets/css/bootstrap-timepicker.min.css',
            'assets/css/daterangepicker.min.css',
            'assets/css/bootstrap-datetimepicker.min.css',
        );
        $data = array(
            'bank_data' => $bank,
            'q' => $q,
            'per_page' => $config['per_page'],
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => array("Rekening BANK"),
            'konten' => "admin/bank/bank_list",
            'script' => "admin/bank/bank_list_script",
            'bootstrap' => $boot
        );
        $this->load->view('admin/container', $data);
    }

    public function read($id) 
    {
        $row = $this->Bank_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idbank' => $row->idbank,
		'namabank' => $row->namabank,
		'rekening' => $row->rekening,
		'gambar' => $row->gambar,
	    );
            $this->load->view('bank/bank_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bank'));
        }
    }

    public function create() 
    {
        $boot = array(
            'assets/css/jquery-ui.custom.min.css',
            'assets/css/chosen.min.css',
            'assets/css/bootstrap-timepicker.min.css',
            'assets/css/daterangepicker.min.css',
            'assets/css/bootstrap-datetimepicker.min.css',
            'assets/css/bootstrap-colorpicker.min.css'
        );
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/Bank/create_action'),
			'idbank' => set_value('idbank'),
			'namabank' => set_value('namabank'),
            'rekening' => set_value('rekening'),
			'namanasabah' => set_value('namanasabah'),
			'gambar' => set_value('gambar'),
            'judul' => array("Tambah rekening BANK"),
            'script' => "admin/bank/bank_form_script",
            'bootstrap' => $boot,
            'konten'=>"admin/bank/bank_form",
            'script' => 'admin/bank/bank_form_script'
		);
        $this->load->view('admin/container', $data);
    }
    
    public function create_action() 
    {
        $this->load->helper(array('form', 'url'));
        
        $config['upload_path']          = './uploads/petugas';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 1366;
        $config['max_height']           = 768;

		$this->load->library('upload', $config);
		
		$bankname = $this->input->post('namabank');
        $rekening = $this->input->post('rekening',TRUE);
		$namanasabah = $this->input->post('namanasabah',TRUE);
		
        $foto = NULL;
        if($this->input->post('removeimage')=="true"){
            $foto = "uploads/bank/bank_logo.png";
        }else if(! $this->upload->do_upload('image')){
            $foto = "uploads/bank/bank_logo.png";
        }else{
            $udata = $this->upload->data();
            $foto = "uploads/bank/".$bankname.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto);
        };
		
        $data = array(
			'namabank' => $bankname,
            'rekening' => $rekening,
			'namanasabah' => $namanasabah,
			'gambar' => $foto,
		);

		$this->Bank_model->insert($data);
		
		$idbank = $this->db->query("SELECT idbank FROM bank WHERE namabank='$bankname' AND rekening = '$rekening'")->row()->idbank;
		$user = $this->session->userdata("idakun");
        $token = $user.date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $this->session->userdata("idakun"),
            'datavalue' => $idbank,
            'displaytext' => "Rekening ".$rekening,
            'controller' => "bank",
            'action' => "create",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->Aktifitasakun_model->insert($action);
		
		$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('admin/Bank'));
    }
    
    public function set_update()
    {
        $idakun = $this->input->post("idakun");
        $id = $this->input->post("id");
        $token = $idakun.date("YmdHis");
        $nama = $this->db->query("SELECT namabank FROM bank WHERE idbank='$id'")->row()->namabank;
        $data = array(
            'token' => $token,
            'idakun' => $idakun,
            'datavalue' => $id,
            'displaytext' => "Rekening ".$nama,
            'controller' => "bank",
            'action' => "update",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        
        $this->Aktifitasakun_model->insert($data);
        echo $token;
        return true;
    }
    
    public function update($token) 
    {
		$act = $this->db->query("SELECT * FROM aktifitasakun WHERE token='".$token."' AND action='update' AND jam LIKE '%".date("H")."___%'")->row();

        if ($act){
            $id = $act->datavalue;
        }else{
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect("admin/Bank");
            return;
        };
		
        $row = $this->Bank_model->get_by_id($id);

        if ($row) {
            $boot = array(
                'assets/css/jquery-ui.custom.min.css',
                'assets/css/chosen.min.css',
                'assets/css/bootstrap-timepicker.min.css',
                'assets/css/daterangepicker.min.css',
                'assets/css/bootstrap-datetimepicker.min.css',
                'assets/css/bootstrap-colorpicker.min.css'
            );
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/Bank/update_action'),
				'idbank' => set_value('idbank', $row->idbank),
				'namabank' => set_value('namabank', $row->namabank),
                'rekening' => set_value('rekening', $row->rekening),
				'namanasabah' => set_value('namanasabah', $row->namanasabah),
				'gambar' => set_value('gambar', $row->gambar),
                'judul' => array("BANK", "Edit rekening BANK"),
                'bootstrap' => $boot,
                'konten' => 'admin/bank/bank_form',
                'script' => 'admin/bank/bank_form_script'
	    	);
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/Bank'));
        }
    }
    
    public function update_action() 
    {
        $this->load->helper(array('form', 'url'));
        
        $config['upload_path']          = './uploads/petugas';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 1366;
        $config['max_height']           = 768;
		
        $this->load->library('upload', $config);
		
        $row = $this->Bank_model->get_by_id($this->input->post('idbank',TRUE));
		
        $foto = NULL;
        if($this->input->post('removeimage')=="true"){
            $foto = "uploads/bank/bank_logo.png";
            if($row->gambar != $foto){unlink($row->gambar);};
        }else if(! $this->upload->do_upload('image')){
            $foto = $row->gambar==NULL?"uploads/bank/bank_logo.png":$row->gambar;
        }else{
            $udata = $this->upload->data();
            $foto = "uploads/petugas/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto);
            if($row->gambar != "uploads/bank/bank_logo.png"){unlink($row->gambar);};
        };
		
		$data = array(
			'namabank' => $this->input->post('namabank'),
            'rekening' => $this->input->post('rekening',TRUE),
			'namanasabah' => $this->input->post('namanasabah',TRUE),
			'gambar' => $foto,
	    );

		$this->Bank_model->update($this->input->post('idbank', TRUE), $data);
		$this->session->set_flashdata('message', 'Update Record Success');
		redirect(site_url('admin/Bank'));
    }
    
    public function delete($id) 
    {
        $id = $this->input->post("id");
        $idakun = $this->input->post("idakun");
		
        $row = $this->Bank_model->get_by_id($id);

        if ($row) {
            unlink($row->gambar);
            $this->Bank_model->delete($id);
            return;
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo "Failed";
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('namabank', 'namabank', 'trim|required');
	$this->form_validation->set_rules('rekening', 'rekening', 'trim|required');
	$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');

	$this->form_validation->set_rules('idbank', 'idbank', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bank.xls";
        $judul = "bank";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Namabank");
	xlsWriteLabel($tablehead, $kolomhead++, "Rekening");
	xlsWriteLabel($tablehead, $kolomhead++, "Gambar");

	foreach ($this->Bank_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->namabank);
	    xlsWriteLabel($tablebody, $kolombody++, $data->rekening);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gambar);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bank.doc");

        $data = array(
            'bank_data' => $this->Bank_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('bank/bank_doc',$data);
    }

}

/* End of file Bank.php */
/* Location: ./application/controllers/Bank.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-17 01:22:27 */
/* http://harviacode.com */