<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Petugas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Petugas_model');
        $this->load->model("Aktifitasakun_model");
        $this->load->library('form_validation');
        set_timezone();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Petugas/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Petugas/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Petugas/index.html';
            $config['first_url'] = base_url() . 'admin/Petugas/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Petugas_model->total_rows_join_akun($q);
        $petugas = $this->Petugas_model->get_limit_data_join_akun($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'petugas_data' => $petugas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => array("Data Petugas"),
            'konten' => "admin/petugas/petugas_list",
            'script' => "admin/petugas/petugas_list_script",
            'per_page' => $config['per_page']
        );
        $this->load->view('admin/container', $data);
    }

    public function read($id) 
    {
        $row = $this->Petugas_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'idpetugas' => $row->idpetugas,
    		'nama' => $row->nama,
    		'tgllahir' => $row->tgllahir,
    		'alamat' => $row->alamat,
    		'telepon' => $row->telepon,
    		'email' => $row->email,
    		'fotoprofil' => $row->fotoprofil,
    		'idakun' => $row->idakun,
            'konten' => 'admin/petugas/petugas_read'
        );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('petugas'));
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
            'action' => site_url('admin/Petugas/create_action'),
    	    'idpetugas' => set_value('idpetugas'),
    	    'nama' => set_value('nama'),
    	    'tgllahir' => set_value('tgllahir'),
    	    'alamat' => set_value('alamat'),
    	    'telepon' => set_value('telepon'),
    	    'email' => set_value('email'),
    	    'fotoprofil' => set_value('fotoprofil'),
    	    'idakun' => set_value('idakun'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'level' => set_value('level', '1'),
            'slevel' => set_value('slevel', 'Petugas'),
            'judul' => array("Petugas", "Tambah petugas"),
            'bootstrap' => $boot,
            'konten' => 'admin/petugas/petugas_form',
            'script' => 'admin/petugas/petugas_form_script'
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

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');

        $foto = NULL;
        if($this->input->post('removeimage')=="true"){
            $foto = "uploads/petugas/usernoimage.png";
        }else if(! $this->upload->do_upload('image')){
            $foto = "uploads/petugas/usernoimage.png";
        }else{
            $udata = $this->upload->data();
            $foto = "uploads/petugas/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto);
        };

        $this->load->model("Akun_model");
        $akun = array(
            'username' => $username,
            'password' => $password,
            'level' => $level
            );
        $this->Akun_model->insert($akun);
        $idakun = $this->db->query("SELECT id FROM akun WHERE username='".$username."' AND password='".$password."'")->row()->id;

        $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'tgllahir' => $this->input->post('tgllahir',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'telepon' => $this->input->post('telepon',TRUE),
            'email' => $this->input->post('email',TRUE),
            'fotoprofil' => $foto,
            'idakun' => $idakun,
            );

        $this->Petugas_model->insert($data);
		
        $user = $this->session->userdata("idakun");
        $token = $user.date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $this->session->userdata("idakun"),
            'datavalue' => $idakun,
            'displaytext' => $this->input->post('nama',TRUE),
            'controller' => "pelanggan",
            'action' => "create",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->Aktifitasakun_model->insert($action);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect("admin/Petugas");
    }
    
    public function set_update()
    {
        $idakun = $this->input->post("idakun");
        $id = $this->input->post("id");
        $token = $idakun.date("YmdHis");
        $nama = $this->db->query("SELECT petugas.nama FROM akun INNER JOIN petugas ON akun.id=petugas.idakun WHERE petugas.idpetugas='".$id."'")->row()->nama;
        $data = array(
            'token' => $token,
            'idakun' => $idakun,
            'datavalue' => $id,
            'displaytext' => $nama,
            'controller' => "petugas",
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
            redirect("admin/Petugas");
            return;
        };

        $row = $this->Petugas_model->get_by_id_join_akun($id);

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
                'action' => site_url('admin/Petugas/update_action'),
        		'idpetugas' => set_value('idpetugas', $row->idpetugas),
        		'nama' => set_value('nama', $row->nama),
        		'tgllahir' => set_value('tgllahir', $row->tgllahir),
        		'alamat' => set_value('alamat', $row->alamat),
        		'telepon' => $row->telepon,
        		'email' => set_value('email', $row->email),
        		'fotoprofil' => set_value('fotoprofil', $row->fotoprofil),
        		'idakun' => set_value('idakun', $row->idakun),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'level' => $row->level,
                'slevel' => string_level($row->level),
                'judul' => array("Petugas", "Edit data petugas"),
                'bootstrap' => $boot,
                'konten' => 'admin/petugas/petugas_form',
                'script' => 'admin/petugas/petugas_form_script'
        	    );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('petugas'));
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

        $row = $this->Petugas_model->get_by_id_join_akun($this->input->post('idpetugas',TRUE));
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');

        $foto = NULL;
        if($this->input->post('removeimage')=="true"){
            $foto = "uploads/petugas/usernoimage.png";
            if($row->fotoprofil != $foto){unlink($row->fotoprofil);};
        }else if(! $this->upload->do_upload('image')){
            $foto = $row->fotoprofil==NULL?"uploads/petugas/usernoimage.png":$row->fotoprofil;
        }else{
            $udata = $this->upload->data();
            $foto = "uploads/petugas/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto);
            if($row->fotoprofil != "uploads/petugas/usernoimage.png"){unlink($row->fotoprofil);};
        };
		
		if($this->input->post('telepon',TRUE)==NULL){
			if($row->telepon==NULL){
				$tel = NULL;
			}else{
				$tel = $row->telepon;
			}
		}else{
			$tel = $this->input->post('telepon',TRUE);
		}

       $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'tgllahir' => $this->input->post('tgllahir',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'telepon' => $tel,
            'email' => $this->input->post('email',TRUE),
            'fotoprofil' => $foto,
        );

        $this->Petugas_model->update($this->input->post('idpetugas'), $data);

        $this->load->model("Akun_model");
        $akun = array(
            'username' => $username,
            'password' => $password,
            'level' => $level
            );
        $this->Akun_model->update($row->idakun, $akun);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect("admin/Petugas");
    }
    
    public function delete() 
    {
        $id = $this->input->post("id");
        $idakun = $this->input->post("idakun");
        $row = $this->Petugas_model->get_by_id($id);

        if ($row) {
            // catat aktifitas
            $data = array(
                'token' => $idakun.date("dmYHis"),
                'idakun' => $idakun,
                'datavalue' => $id,
                'displaytext' => $row->nama,
                'controller' => "Petugas",
                'action' => "delete",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i"),
                );
            $this->Aktifitasakun_model->insert($data);

            //delete Akun
            $this->load->model("Akun_model");
            $this->Akun_model->delete($row->idakun);
            unlink($row->fotoprofil);
            $this->Petugas_model->delete($id);
            return;
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo "Failed";
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
    	$this->form_validation->set_rules('tgllahir', 'tgllahir', 'trim|required');
    	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
    	$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
    	$this->form_validation->set_rules('email', 'email', 'trim|required');
    	$this->form_validation->set_rules('fotoprofil', 'fotoprofil', 'trim|required');
    	$this->form_validation->set_rules('idakun', 'idakun', 'trim|required');

    	$this->form_validation->set_rules('idpetugas', 'idpetugas', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
        
        if($limit<>""){
            $result =  $this->Petugas_model->get_limit_data_join_akun($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Petugas_model->get_data_join_akun($q);
        }else{
            $result = $this->Petugas_model->get_all_join_akun();
        }

        $namaFile = "petugas.xls";
        $judul = "petugas";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Username");
    	xlsWriteLabel($tablehead, $kolomhead++, "Password");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tgllahir");
    	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
    	xlsWriteLabel($tablehead, $kolomhead++, "Telepon");
    	xlsWriteLabel($tablehead, $kolomhead++, "Email");

       foreach ($result as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->username);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgllahir);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->telepon);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->email);

    	    $tablebody++;
            $nourut++;
        }
            xlsWriteLabel($tablebody+1, 7, "Mengetahui");
            xlsWriteLabel($tablebody+3, 7, "Drs. M. Tarmizi, MM");

        xlsEOF();
        exit();
    }
    
    public function print_page()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
        
        if($limit<>""){
            $result =  $this->Petugas_model->get_limit_data_join_akun($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Petugas_model->get_data_join_akun($q);
        }else{
            $result = $this->Petugas_model->get_all_join_akun();
        }
        
        $data = array(
            'petugas_data' => $result,
            'title' => 'Data Petugas',
            'text' => 'Data Petugas',
            'start' => 0
        );
        
        $this->load->view('admin/petugas/petugas_doc',$data);
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=petugas.doc");

        $data = array(
            'petugas_data' => $this->Petugas_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('petugas/petugas_doc',$data);
    }

}

/* End of file Petugas.php */
/* Location: ./application/controllers/Petugas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:14 */
/* http://harviacode.com */