<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
        $this->load->model("Aktifitasakun_model");
        $this->load->library('form_validation');
        set_timezone();
    }

    public function index()
    {
    }
    
    public function set_update()
    {
        $idakun = $this->input->post("idakun");
        $id = $this->input->post("id");
        $token = $idakun.date("YmdHis");
        $nama = $this->db->query("SELECT pelanggan.nama FROM akun INNER JOIN pelanggan ON akun.id=pelanggan.idakun WHERE pelanggan.idpelanggan='".$id."'")->row()->nama;
        $data = array(
            'token' => $token,
            'idakun' => $idakun,
            'datavalue' => $id,
            'displaytext' => $nama,
            'controller' => "pelanggan",
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
            redirect("user/Pelanggan");
            return;
        };

        $row = $this->Pelanggan_model->get_by_id($id);

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
                'button' => 'Simpan',
                'action' => site_url('user/Pelanggan/update_action'),
        		'idpelanggan' => set_value('idpelanggan', $row->idpelanggan),
        		'nama' => set_value('nama', $row->nama),
        		'jeniskelamin' => set_value('jeniskelamin', $row->jeniskelamin),
        		'tgllahir' => set_value('tgllahir', $row->tgllahir),
        		'telepon' => $row->telepon,
        		'email' => set_value('email', $row->email),
        		'fotoktp' => set_value('fotoktp', $row->fotoktp),
        		'fotoprofil' => set_value('fotoprofil', $row->fotoprofil),
        		'idakun' => set_value('idakun', $row->idakun),
                'judul' => array($this->session->userdata("nama"), "Profil"),
                'bootstrap' => $boot,
                'konten' => 'user/Pelanggan/pelanggan_form',
                'script' => 'user/Pelanggan/pelanggan_form_script'
        	    );
            $this->load->view('user/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record '.$id.' Not Found');
            redirect("user/CUser");
        }
    }
    
    public function update_action() 
    {
        $this->load->helper(array('form', 'url'));
        
        $config['upload_path']          = './uploads/pelanggan/profile';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 1366;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $row = $this->Pelanggan_model->get_by_id_join_akun($this->input->post('idpelanggan',TRUE));
        $username = $row->username;
        $password = $row->password;

        $foto = NULL;
        if($this->input->post('removeimage')=="true"){
            $foto = "uploads/pelanggan/profile/usernoimage.png";
            if($row->fotoprofil != $foto){unlink($row->fotoprofil);};
        }else if(! $this->upload->do_upload('image')){
            $foto = $row->fotoprofil;
        }else{
            $udata = $this->upload->data();
            $foto = "uploads/pelanggan/profile/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto);
            if($row->fotoprofil != "uploads/pelanggan/profile/usernoimage.png"){unlink($row->fotoprofil);};
        };

        $ktp = NULL;
        $config['upload_path']          = './uploads/pelanggan/ktp';
        $this->upload->initialize($config);
        if($this->input->post('removektp')=="true"){
            $ktp = NULL;
            unlink($row->fotoktp);
        }else if(! $this->upload->do_upload('ktp')){
            $ktp = $row->fotoktp?NULL:$row->fotoktp;
        }else{
            $udata = $this->upload->data();
            $ktp = "uploads/pelanggan/ktp/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $ktp);
            unlink($row->fotoktp);
        };

        $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'jeniskelamin' => $this->input->post('jeniskelamin',TRUE),
            'tgllahir' => $this->input->post('tgllahir',TRUE),
            'telepon' => $this->input->post('telepon',TRUE),
            'email' => $this->input->post('email',TRUE),
            'fotoktp' => $ktp,
            'fotoprofil' => $foto,
            );

        $this->Pelanggan_model->update($this->input->post('idpelanggan', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect("user/CUser");
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
    	$this->form_validation->set_rules('jeniskelamin', 'jeniskelamin', 'trim|required');
    	$this->form_validation->set_rules('tgllahir', 'tgllahir', 'trim|required');
    	$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
    	$this->form_validation->set_rules('email', 'email', 'trim|required');
    	$this->form_validation->set_rules('fotoktp', 'fotoktp', 'trim|required');
    	$this->form_validation->set_rules('fotoprofil', 'fotoprofil', 'trim|required');
    	$this->form_validation->set_rules('idakun', 'idakun', 'trim|required');

    	$this->form_validation->set_rules('idpelanggan', 'idpelanggan', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:14 */
/* http://harviacode.com */