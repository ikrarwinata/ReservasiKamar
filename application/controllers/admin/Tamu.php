<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tamu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Aktifitasakun_model");
        $this->load->model('Kamar_model');
        $this->load->model('Tamu_model');
        $this->load->model("Riwayattamu_model");
        $this->load->library('form_validation');
        set_timezone();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Tamu/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Tamu/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Tamu/index.html';
            $config['first_url'] = base_url() . 'admin/Tamu/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tamu_model->total_rows($q);
        $tamu =  $this->Kamar_model->get_limit_data_join_pelanggan($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $boot = array(
            'assets/css/bootstrap-timepicker.min.css',
            'assets/css/daterangepicker.min.css',
            'assets/css/bootstrap-datetimepicker.min.css',
        );
        $data = array(
            'tamu_data' => $tamu,
            'q' => $q,
            'per_page' => $config['per_page'],
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => array("Kamar yang digunakan"),
            'konten' => "admin/tamu/tamu_list",
            'script' => "admin/tamu/tamu_list_script",
            'bootstrap' => $boot
        );
        $this->load->view('admin/container', $data);
    }

    public function read($id) 
    {
        $row = $this->Tamu_model->get_by_id($id);
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
            $this->load->view('tamu/tamu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tamu'));
        }
    }

    public function image_of(){
        $this->load->model("Pelanggan_model");
        $id=$this->input->post("id");
        // echo $id;
        echo $this->Pelanggan_model->get_by_id($id)->fotoprofil;
        return;
    }

    public function tarif_of(){
        $id=$this->input->post("id");
        // echo $id;
        echo format_number($this->Kamar_model->get_by_id($id)->tarif);
        return;
    }

    public function checkout_of(){
        $id=$this->input->post("id");
        // echo $id;
        echo $this->Tamu_model->get_by_id($id)->tglkeluar;
        return;
    }

    public function bayar_of(){
        $id=$this->input->post("id");
        // echo $id;
        echo $this->Tamu_model->get_by_id($id)->pembayaran>0?1:0;
        return;
    }

    public function set_checkout(){
        $id = $this->input->post("id");
        $tglkeluar = $this->input->post("tglkeluar",TRUE);
        $bayar = $this->input->post("bayar",TRUE);

        $row = $this->Tamu_model->get_by_id($id);

        if($tglkeluar==NULL){
            if($row->tglkeluar==NULL){
                $d = date("d-m-Y");
                $tglkeluar = $d;
                $harikeluar=get_str_day($d);
            }
        }else{
            $harikeluar=get_str_day($tglkeluar);
        };


        if($bayar==1){
            $tarif=$this->Kamar_model->get_by_id($row->idkamar)->tarif;
        }else{
            $tarif=$row->pembayaran;
        };

        $data = array(
                'id' => $id.date("dmYHis"),
                'idpetugas' => $row->idpetugas,
                'idpelanggan' => $row->idpelanggan,
                'idkamar' => $row->idkamar,
                'tglmasuk' => $row->tglmasuk,
                'harimasuk' => $row->harimasuk,
                'tglkeluar' => $tglkeluar,
                'harikeluar' => $harikeluar,
                'pembayaran' => $tarif,
            );

        $this->Riwayattamu_model->Insert($data);

        $this->Tamu_model->delete($id);
        // // set kamar sedang digunakan
        $d = array(
            'digunakan'=>"0"
            );
        $this->Kamar_model->update($row->idkamar,$d);
        return true;
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
        $this->load->model("Pelanggan_model");
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('admin/Tamu/create_action'),
    	    'id' => set_value('id'),
    	    'idpetugas' => set_value('idpetugas'),
            'idpelanggan' => set_value('idpelanggan'),
    	    'namapelanggan' => set_value('namapelanggan'),
            'idkamar' => set_value('idkamar'),
    	    'nomorkamar' => set_value('nomorkamar'),
    	    'tglmasuk' => date("d-m-Y"),
    	    'harimasuk' => set_value('harimasuk'),
    	    'tglkeluar' => set_value('tglkeluar'),
    	    'harikeluar' => set_value('harikeluar'),
    	    'pembayaran' => set_value('pembayaran'),
            'kamar_data'=> $this->Kamar_model->get_all_empty_room(),
            'pelanggan_data'=> $this->Pelanggan_model->get_all(),
            'judul' => array("Tambah kamar yang digunakan"),
            'script' => "admin/tamu/tamu_form_script",
            'bootstrap' => $boot,
            'konten'=>"admin/tamu/tamu_form"
        );
        $this->load->view('admin/container', $data);
    }
    
    public function create_action() 
    {
        $in = $this->input->post('tglmasuk');
        $out = $this->input->post('tglkeluar');

        $data = array(
            'idpetugas' => $this->input->post('idpetugas',TRUE),
            'idpelanggan' => $this->input->post('idpelanggan',TRUE),
            'idkamar' => $this->input->post('idkamar',TRUE),
            'tglmasuk' => $in,
            'harimasuk' => get_str_day($in),
            'tglkeluar' => $out,
            'harikeluar' => get_str_day($out),
            'pembayaran' => $this->input->post('pembayaran'),
        );

        $this->Tamu_model->insert($data);
        // set kamar sedang digunakan
        $data = array(
            'digunakan'=>"1"
            );
        $this->Kamar_model->update($this->input->post('idkamar',TRUE),$data);

        $id = $this->db->select("id")->where('idpelanggan',$this->input->post('idpelanggan'))->where('idkamar',$this->input->post('idkamar'))->where('tglmasuk',$in)->get("tamu")->row()->id;
        $user = $this->session->userdata("idakun");
        $token = $user.date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $this->session->userdata("idakun"),
            'datavalue' => $id,
            'displaytext' => $this->Kamar_model->get_by_id($id)->nomorkamar,
            'controller' => "tamu",
            'action' => "create",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->Aktifitasakun_model->insert($action);

        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('admin/Tamu'));
    }
    
    public function set_update()
    {
        $idakun = $this->input->post("idakun");
        $id = $this->input->post("id");
        $token = $idakun.date("YmdHis");
        $nama = $this->Kamar_model->get_by_id($this->Tamu_model->get_by_id($id)->idkamar)->nomorkamar;
        $data = array(
            'token' => $token,
            'idakun' => $idakun,
            'datavalue' => $id,
            'displaytext' => $nama,
            'controller' => "tamu",
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
            redirect("admin/Tamu");
            return;
        };

        $row = $this->Tamu_model->get_by_id($id);

        if ($row) {
            $this->load->model("Pelanggan_model");
            $boot = array(
                'assets/css/jquery-ui.custom.min.css',
                'assets/css/chosen.min.css',
                'assets/css/bootstrap-timepicker.min.css',
                'assets/css/daterangepicker.min.css',
                'assets/css/bootstrap-datetimepicker.min.css',
                'assets/css/bootstrap-colorpicker.min.css'
            );
            $namap = $this->Pelanggan_model->get_by_id($row->idpelanggan)->nama;
            $nomorkamar = $this->Kamar_model->get_by_id($row->idkamar)->nomorkamar;
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/Tamu/update_action'),
        		'id' => set_value('id', $row->id),
        		'idpetugas' => set_value('idpetugas', $row->idpetugas),
                'idpelanggan' => set_value('idpelanggan', $row->idpelanggan),
        		'namapelanggan' => set_value('namapelanggan', $namap),
                'idkamar' => set_value('idkamar', $row->idkamar),
        		'nomorkamar' => set_value('nomorkamar', $nomorkamar),
        		'tglmasuk' => set_value('tglmasuk', $row->tglmasuk),
        		'harimasuk' => set_value('harimasuk', $row->harimasuk),
        		'tglkeluar' => set_value('tglkeluar', $row->tglkeluar),
        		'harikeluar' => set_value('harikeluar', $row->harikeluar),
        		'pembayaran' => set_value('pembayaran', $row->pembayaran),
                'kamar_data'=> $this->Kamar_model->get_all_empty_room(),
                'pelanggan_data'=> $this->Pelanggan_model->get_all(),
                'judul' => array("Edit kamar yang digunakan " . $namap),
                'script' => "admin/tamu/tamu_form_script",
                'bootstrap' => $boot,
                'konten'=>"admin/tamu/tamu_form"
    	    );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/Tamu'));
        }
    }
    
    public function update_action() 
    {
        $in = $this->input->post('tglmasuk');
        $out = $this->input->post('tglkeluar');

        $data = array(
            'idpetugas' => $this->input->post('idpetugas',TRUE),
            'idpelanggan' => $this->input->post('idpelanggan',TRUE),
            'idkamar' => $this->input->post('idkamar',TRUE),
            'tglmasuk' => $in,
            'harimasuk' => get_str_day($in),
            'tglkeluar' => $out,
            'harikeluar' => get_str_day($out),
            'pembayaran' => $this->input->post('pembayaran'),
        );

        $this->Tamu_model->update($this->input->post('id', TRUE), $data);
        // set kamar sedang digunakan
        $data = array(
            'digunakan'=>"1"
            );
        $this->Kamar_model->update($this->input->post('idkamar',TRUE),$data);

        $id = $this->input->post('id', TRUE);
        $user = $this->session->userdata("idakun");
        $token = $user.date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $this->session->userdata("idakun"),
            'datavalue' => $id,
            'displaytext' => $this->Kamar_model->get_by_id($id)->nomorkamar,
            'controller' => "tamu",
            'action' => "update",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->Aktifitasakun_model->insert($action);

        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('admin/Tamu'));
    }
    
    public function delete() 
    {
        $id = $this->input->post("id");
        $row = $this->Tamu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'digunakan'=>"0"
                );
            $this->Kamar_model->update($row->idkamar,$data);

            $user = $this->input->post("idakun");
            $token = $user.date("YmdHis");
            $action = array(
                'token' => $token,
                'idakun' => $this->input->post("idakun"),
                'datavalue' => $id,
                'displaytext' => $row->nomorkamar,
                'controller' => "tamu",
                'action' => "delete",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i")
            );
            $this->Aktifitasakun_model->insert($action);

            $this->Tamu_model->delete($id);

            $this->session->set_flashdata('message', 'Delete Record Success');
            echo "Succed";
            return;
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo "Failed";
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
        
        $namaFile = "tamu.xls";
        $judul = "tamu";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Idpetugas");
    	xlsWriteLabel($tablehead, $kolomhead++, "Idpelanggan");
    	xlsWriteLabel($tablehead, $kolomhead++, "Idkamar");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tglmasuk");
    	xlsWriteLabel($tablehead, $kolomhead++, "Harimasuk");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tglkeluar");
    	xlsWriteLabel($tablehead, $kolomhead++, "Harikeluar");
    	xlsWriteLabel($tablehead, $kolomhead++, "Pembayaran");

        foreach ($this->Tamu_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->idpetugas);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->idpelanggan);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->idkamar);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tglmasuk);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->harimasuk);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tglkeluar);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->harikeluar);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->pembayaran);

    	    $tablebody++;
            $nourut++;
        }
            xlsWriteLabel($tablebody+1, 8, "Mengetahui");
            xlsWriteLabel($tablebody+3, 8, "Drs. M. Tarmizi, MM");

        xlsEOF();
        exit();
    }
    
    public function print_page()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
        
        if($limit<>""){
            $result =  $this->Kamar_model->get_limit_data_join_pelanggan($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Kamar_model->get_data_join_pelanggan($q);
        }else{
            $result = $this->Kamar_model->get_all_join_pelanggan();
        }
        
        $data = array(
            'tamu_data' => $result,
            'title' => 'Data Tamu',
            'text' => 'Data Kamar Yang Digunakan Tamu',
            'start' => 0
        );
        
        $this->load->view('admin/kamar/kamar_doc',$data);
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tamu.doc");

        $data = array(
            'tamu_data' => $this->Tamu_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tamu/tamu_doc',$data);
    }

}

/* End of file Tamu.php */
/* Location: ./application/controllers/Tamu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:15 */
/* http://harviacode.com */