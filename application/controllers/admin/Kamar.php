<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kamar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kamar_model');
        $this->load->model("Aktifitasakun_model");
        $this->load->library('form_validation');
        set_timezone();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Kamar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Kamar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Kamar/index.html';
            $config['first_url'] = base_url() . 'admin/Kamar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kamar_model->total_rows_empty_room($q) + $this->Kamar_model->total_rows_join_pelanggan($q);
        $kamar = $this->Kamar_model->get_limit_data_empty_room($config['per_page'], $start, $q);
        $kamar_joined = $this->Kamar_model->get_limit_data_join_pelanggan($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kamar_data' => $kamar_joined,
            'kamarnotamu_data' => $kamar,
            'q' => $q,
            'per_page' => $config['per_page'],
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => array("Semua Kamar"),
            'konten' => "admin/kamar/kamar_list",
            'script' => "admin/kamar/kamar_list_script",
            'bootstrap' => array("")
        );
        $this->load->view('admin/container', $data);
    }

    public function read($id) 
    {
        $row = $this->Kamar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idkamar' => $row->idkamar,
		'nomorkamar' => $row->nomorkamar,
		'tarif' => $row->tarif,
		'digunakan' => $row->digunakan,
		'fotokamar' => $row->fotokamar,
		'deskripsi' => $row->deskripsi,
	    );
            $this->load->view('kamar/kamar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kamar'));
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
            'action' => site_url('admin/Kamar/create_action'),
    	    'idkamar' => set_value('idkamar'),
    	    'nomorkamar' => set_value('nomorkamar'),
    	    'tarif' => set_value('tarif'),
    	    'digunakan' => set_value('digunakan'),
            'fotokamar' => set_value('fotokamar'),
            'foto2' => set_value('fotokamar'),
    	    'foto3' => set_value('fotokamar'),
    	    'deskripsi' => set_value('deskripsi'),
            'judul' => array("Kamar", "Tambah kamar baru"),
            'bootstrap' => $boot,
            'script' => 'admin/kamar/kamar_form_script',
            'konten' => 'admin/kamar/kamar_form',
    	);
        $this->load->view('admin/container', $data);
    }
    
    public function create_action() 
    {
        $this->load->helper(array('form', 'url'));
        
        $config['upload_path']          = './uploads/kamar';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 13660;
        $config['max_height']           = 7680;

        $this->load->library('upload', $config);
        $username = $this->input->post('nomorkamar',TRUE);

        $foto1 = NULL;
        if($this->input->post('removeimage')=="true"){
            $foto1 = "uploads/kamar/kamarnoimage.png";
        }else if(! $this->upload->do_upload('image')){
            $foto1 = "uploads/kamar/kamarnoimage.png";
        }else{
            $udata = $this->upload->data();
            $foto1 = "uploads/kamar/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto1);
        };

        $foto2 = NULL;
        if($this->input->post('removeimage2')=="true"){
            $foto2 = "uploads/kamar/kamarnoimage.png";
        }else if(! $this->upload->do_upload('image2')){
            $foto2 = "uploads/kamar/kamarnoimage.png";
        }else{
            $udata = $this->upload->data();
            $foto2 = "uploads/kamar/".$username."2".date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto2);
        };

        $foto3 = NULL;
        if($this->input->post('removeimage3')=="true"){
            $foto3 = "uploads/kamar/kamarnoimage.png";
        }else if(! $this->upload->do_upload('image3')){
            $foto3 = "uploads/kamar/kamarnoimage.png";
        }else{
            $udata = $this->upload->data();
            $foto3 = "uploads/kamar/".$username."3".date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto3);
        };

        $digunakan = $this->input->post('digunakan')?"1":"0";

        $data = array(
        'nomorkamar' => $this->input->post('nomorkamar',TRUE),
        'tarif' => $this->input->post('tarif',TRUE),
        'digunakan' => $digunakan,
        'fotokamar' => $foto1,
        'foto2' => $foto2,
        'foto3' => $foto3,
        'deskripsi' => $this->input->post('deskripsi',TRUE),
        );

        $this->Kamar_model->insert($data);

        $idkamar = $this->db->query("SELECT idkamar FROM kamar WHERE nomorkamar='".$this->input->post('nomorkamar')."' AND deskripsi='".$this->input->post('deskripsi')."'")->row()->idkamar;
        $user = $this->session->userdata("idakun");
        $token = $user.date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $this->session->userdata("idakun"),
            'datavalue' => $idkamar,
            'displaytext' => $this->input->post('nomorkamar'),
            'controller' => "kamar",
            'action' => "create",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->Aktifitasakun_model->insert($action);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect("admin/Kamar");
    }
    
    public function set_update()
    {
        $idakun = $this->input->post("idakun");
        $id = $this->input->post("id");
        $token = $idakun.date("YmdHis");
        $nama = $this->db->query("SELECT nomorkamar FROM kamar WHERE idkamar='".$id."'")->row()->nomorkamar;
        $data = array(
            'token' => $token,
            'idakun' => $idakun,
            'datavalue' => $id,
            'displaytext' => $nama,
            'controller' => "kamar",
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
            redirect("admin/Kamar");
            return;
        };

        $row = $this->Kamar_model->get_by_id($id);

        if ($row) {
            $digunakan = $row->digunakan?"1":"0";
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
                'action' => site_url('admin/Kamar/update_action'),
        		'idkamar' => set_value('idkamar', $row->idkamar),
        		'nomorkamar' => set_value('nomorkamar', $row->nomorkamar),
        		'tarif' => set_value('tarif', $row->tarif),
        		'digunakan' => set_value('digunakan', $digunakan),
                'fotokamar' => $row->fotokamar,
                'foto2' => isset($row->foto2)?$row->foto2:NULL,
        		'foto3' => isset($row->foto3)?$row->foto3:NULL,
        		'deskripsi' => $row->deskripsi,
                'judul' => array("Kamar", "Edit kamar"),
                'bootstrap' => $boot,
                'konten' => 'admin/kamar/kamar_form',
                'script' => 'admin/kamar/kamar_form_script'
        	    );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect("admin/Kamar");
        }
    }
    
    public function update_action() 
    {
        $this->load->helper(array('form', 'url'));
        
        $config['upload_path']          = './uploads/kamar';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 13660;
        $config['max_height']           = 7680;

        $this->load->library('upload', $config);
        $row = $this->Kamar_model->get_by_id($this->input->post('idkamar',TRUE));
        $username = $this->input->post('nomorkamar',TRUE);

        $foto = "uploads/kamar/kamarnoimage.jpg";
        if($this->input->post('removeimage')=="true"){
            if($row->fotokamar != $foto){unlink($row->fotokamar);};
        }else if(! $this->upload->do_upload('image')){
            $foto = $row->fotokamar==NULL?"uploads/kamar/kamarnoimage.png":$row->fotokamar;
        }else{
            $udata = $this->upload->data();
            $foto = "uploads/kamar/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto);
            if($row->fotokamar != "uploads/kamar/kamarnoimage.jpg"){unlink($row->fotokamar);};
        };

        $foto2 = "uploads/kamar/kamarnoimage.jpg";
        if($this->input->post('removeimage2')=="true"){
            if($row->foto2 != $foto2){unlink($row->foto2);};
        }else if(! $this->upload->do_upload('image2')){
            $foto2 = $row->foto2==NULL?"uploads/kamar/kamarnoimage.png":$row->foto2;
        }else{
            $udata = $this->upload->data();
            $foto2 = "uploads/kamar/".$username."2".date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto2);
            if($row->foto2 != "uploads/kamar/kamarnoimage.jpg"){unlink($row->foto2);};
        };

        $foto3 = "uploads/kamar/kamarnoimage.jpg";
        if($this->input->post('removeimage3')=="true"){
            if($row->foto3 != $foto3){unlink($row->foto3);};
        }else if(! $this->upload->do_upload('image3')){
            $foto3 = $row->foto3==NULL?"uploads/kamar/kamarnoimage.png":$row->foto3;
        }else{
            $udata = $this->upload->data();
            $foto3 = "uploads/kamar/".$username."3".date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto3);
            if($row->foto3 != "uploads/kamar/kamarnoimage.jpg"){unlink($row->foto3);};
        };

        $digunakan = $this->input->post('digunakan')?"1":"0";

        $data = array(
            'nomorkamar' => $this->input->post('nomorkamar',TRUE),
            'tarif' => $this->input->post('tarif',TRUE),
            'digunakan' => $digunakan,
            'fotokamar' => $foto,
            'foto2' => $foto2,
            'foto3' => $foto3,
            'deskripsi' => $this->input->post('deskripsi'),
            );

        $this->Kamar_model->update($this->input->post('idkamar', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect("admin/Kamar");
    }
    
    public function delete() 
    {
        $id = $this->input->post("id");
        $idakun = $this->input->post("idakun");
        $row = $this->Kamar_model->get_by_id($id);

        if ($row) {
            // catat aktifitas
            $data = array(
                'token' => $idakun.date("dmYHis"),
                'idakun' => $idakun,
                'datavalue' => $id,
                'displaytext' => $row->nomorkamar,
                'controller' => "Kamar",
                'action' => "delete",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i"),
                );
            $this->Aktifitasakun_model->insert($data);

            $this->Kamar_model->delete($id);
            return;
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo "Failed";
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomorkamar', 'nomorkamar', 'trim|required');
	$this->form_validation->set_rules('tarif', 'tarif', 'trim|required');
	$this->form_validation->set_rules('digunakan', 'digunakan', 'trim|required');
	$this->form_validation->set_rules('fotokamar', 'fotokamar', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

	$this->form_validation->set_rules('idkamar', 'idkamar', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
        
        if($limit<>""){
            $result =  $this->Kamar_model->get_limit_data($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Kamar_model->get_data($q);
        }else{
            $result = $this->Kamar_model->get_all();
        }

        $namaFile = "kamar.xls";
        $judul = "kamar";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Nomorkamar");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tarif");
    	xlsWriteLabel($tablehead, $kolomhead++, "Digunakan");
    	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");

    	foreach ($result as $data) {
                $kolombody = 0;

                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                xlsWriteNumber($tablebody, $kolombody++, $nourut);
        	    xlsWriteLabel($tablebody, $kolombody++, $data->nomorkamar);
        	    xlsWriteLabel($tablebody, $kolombody++, $data->tarif);
        	    xlsWriteLabel($tablebody, $kolombody++, ($data->digunakan==1?"Ya":"Tidak"));
        	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);

    	    $tablebody++;
                $nourut++;
        }
            xlsWriteLabel($tablebody+1, 4, "Mengetahui");
            xlsWriteLabel($tablebody+3, 4, "Drs. M. Tarmizi, MM");


        xlsEOF();
        exit();
    }
    
    public function print_page()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
        
        if($limit<>""){
            $result =  $this->Kamar_model->get_limit_data($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Kamar_model->get_data($q);
        }else{
            $result = $this->Kamar_model->get_all();
        }
        
        $data = array(
            'kamar_data' => $result,
            'title' => 'Data Kamar',
            'text' => 'Data Kamar',
            'start' => 0
        );
        
        $this->load->view('admin/kamar/kamar_doc',$data);
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kamar.doc");

        $data = array(
            'kamar_data' => $this->Kamar_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/kamar/kamar_doc',$data);
    }

}

/* End of file Kamar.php */
/* Location: ./application/controllers/Kamar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:13 */
/* http://harviacode.com */