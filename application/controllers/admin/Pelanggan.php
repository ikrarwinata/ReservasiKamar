<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 // Load library phpspreadsheet
require_once(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'phpspreadsheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

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
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pelanggan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pelanggan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pelanggan/index.html';
            $config['first_url'] = base_url() . 'admin/Pelanggan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelanggan_model->total_rows_join_akun($q);
        $pelanggan = $this->Pelanggan_model->get_limit_data_join_akun($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pelanggan_data' => $pelanggan,
            'judul' => array("Data Tamu"),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => "admin/pelanggan/pelanggan_list",
            'script' => "admin/pelanggan/pelanggan_list_script",
            'per_page' => $config['per_page']
        );
        $this->load->view("admin/container", $data);
    }

    public function read($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);
        $boot = array(
            'assets/css/colorbox.min.css'
        );
        if ($row) {
            $data = array(
            'judul' => array("Data Tamu", "Detail ".$row->nama),
    		'idpelanggan' => $row->idpelanggan,
    		'nama' => $row->nama,
    		'jeniskelamin' => $row->jeniskelamin,
    		'tgllahir' => $row->tgllahir,
    		'telepon' => $row->telepon,
    		'email' => $row->email,
    		'fotoktp' => $row->fotoktp,
    		'fotoprofil' => $row->fotoprofil,
    		'idakun' => $row->idakun,
            'bootstrap' => $boot,
            'konten' => 'admin/pelanggan/pelanggan_read',
            'script' => "admin/pelanggan/pelanggan_read_script"
	    );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/Pelanggan'));
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
            'action' => site_url('admin/Pelanggan/create_action'),
    	    'idpelanggan' => set_value('idpelanggan'),
    	    'nama' => set_value('nama'),
    	    'jeniskelamin' => set_value('jeniskelamin'),
    	    'tgllahir' => set_value('tgllahir'),
    	    'telepon' => set_value('telepon'),
    	    'email' => set_value('email'),
    	    'fotoktp' => set_value('fotoktp'),
    	    'fotoprofil' => set_value('fotoprofil'),
    	    'idakun' => set_value('idakun'),
            'judul' => array("Tamu", "Tambah tamu baru"),
            'bootstrap' => $boot,
            'konten' => 'admin/pelanggan/pelanggan_form',
            'script' => 'admin/pelanggan/pelanggan_form_script'
    	);
        $this->load->view('admin/container', $data);
    }
    
    public function create_action() 
    {
        $this->load->helper(array('form', 'url'));
        
        $config['upload_path']          = './uploads/pelanggan/profile';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 1366;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $username = $this->input->post('nama',TRUE).substr($this->input->post('telepon',TRUE), 15);
        $password = $this->input->post('telepon',TRUE);

        $foto = NULL;
        if(! $this->upload->do_upload('image')){
            $foto = "uploads/pelanggan/profile/usernoimage.png";
        }else{
            $udata = $this->upload->data();
            $foto = "uploads/pelanggan/profile/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $foto);
        };

        $ktp = NULL;
        $config['upload_path']          = './uploads/pelanggan/ktp';
        $this->upload->initialize($config);
        if($this->upload->do_upload('ktp')){
            $udata = $this->upload->data();
            $ktp = "uploads/pelanggan/ktp/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $ktp);
        };

        $akun = array(
            'username' => $username,
            'password' => $password,
            'level' => "0"
            );
        $this->load->model("Akun_model");
        $this->Akun_model->insert($akun);
        $idakun = $this->db->query("SELECT id FROM akun WHERE username='".$username."' AND password='".$password."'")->row()->id;

        $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'jeniskelamin' => $this->input->post('jeniskelamin',TRUE),
            'tgllahir' => $this->input->post('tgllahir',TRUE),
            'telepon' => $this->input->post('telepon',TRUE),
            'email' => $this->input->post('email',TRUE),
            'fotoktp' => $ktp,
            'fotoprofil' => $foto,
            'idakun' => $idakun,
            );

        $this->Pelanggan_model->insert($data);

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
        redirect("admin/Pelanggan");
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
            redirect("admin/Pelanggan");
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
                'action' => site_url('admin/Pelanggan/update_action'),
        		'idpelanggan' => set_value('idpelanggan', $row->idpelanggan),
        		'nama' => set_value('nama', $row->nama),
        		'jeniskelamin' => set_value('jeniskelamin', $row->jeniskelamin),
        		'tgllahir' => set_value('tgllahir', $row->tgllahir),
        		'telepon' => $row->telepon,
        		'email' => set_value('email', $row->email),
        		'fotoktp' => set_value('fotoktp', $row->fotoktp),
        		'fotoprofil' => set_value('fotoprofil', $row->fotoprofil),
        		'idakun' => set_value('idakun', $row->idakun),
                'judul' => array("Tamu", "Edit data tamu"),
                'bootstrap' => $boot,
                'konten' => 'admin/pelanggan/pelanggan_form',
                'script' => 'admin/pelanggan/pelanggan_form_script'
        	    );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record '.$id.' Not Found');
            redirect("admin/Pelanggan");
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
        redirect("admin/Pelanggan");
    }
    
    public function delete() 
    {
        $id = $this->input->post("id");
        $idakun = $this->input->post("idakun");
        $row = $this->Pelanggan_model->get_by_id($id);
        
        if ($row) {
            // catat aktifitas
            $data = array(
                'token' => $idakun.date("dmYHis"),
                'idakun' => $idakun,
                'datavalue' => $id,
                'displaytext' => $row->nama,
                'controller' => "Pelanggan",
                'action' => "delete",
                'tanggal' => date("d-m-Y"),
                'jam' => date("H:i"),
                );
            $this->Aktifitasakun_model->insert($data);

            //delete Akun
            $this->load->model("Akun_model");
            $this->Akun_model->delete($row->idakun);

            unlink($row->fotoktp);
            if($row->fotoprofil != "uploads/pelanggan/profile/usernoimage.png"){unlink($row->fotoprofil);};

            $this->Pelanggan_model->delete($id);
            return;
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo "Failed";
        }
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

    public function excel()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
        
        if($limit>0){
            $result =  $this->Pelanggan_model->get_limit_data_join_akun($limit, $start, $q);
        }elseif($q!=NULL){
            $result =  $this->Pelanggan_model->get_data_join_akun($q);
        }else{
            $result = $this->Pelanggan_model->get_all_join_akun();
        }

        $namaFile = "pelanggan";
        $judul = "pelanggan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;


        $HeaderStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            )
        );
        $TitleStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
        );

        $namaFile = "Data Akun Tamu - " . date("d-m-Y H-i");
        $judul = "Data Akun Tamu";

        $spreadsheet = new Spreadsheet();
        //penulisan header
        $spreadsheet->getProperties()->setCreator('Ikrar Winata')
            ->setLastModifiedBy('SHS')
            ->setTitle($judul)
            ->setSubject($judul)
            ->setDescription($judul . date("d-m-Y"))
            ->setKeywords($judul)
            ->setCategory("Reservasi, Kamar");
        //penulisan header

        // Set Header, style, and merging cells
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $judul);
        $spreadsheet->getActiveSheet()->mergeCells("A1:H1");
        $spreadsheet->getActiveSheet()->getStyle("A1:H1")->applyFromArray($HeaderStyle);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', 'No.');
        $spreadsheet->getActiveSheet()->getStyle("A4")->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B4', 'Nama');
        $spreadsheet->getActiveSheet()->getStyle("B4")->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C4', 'Username');
        $spreadsheet->getActiveSheet()->getStyle("C4")->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D4', 'Password');
        $spreadsheet->getActiveSheet()->getStyle("D4")->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("D")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E4', 'Email');
        $spreadsheet->getActiveSheet()->getStyle("E4")->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("E")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F4', 'Telepon');
        $spreadsheet->getActiveSheet()->getStyle("F4")->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("F")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G4', 'Jenis Kelamin');
        $spreadsheet->getActiveSheet()->getStyle("G4")->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("G")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('H4', 'Tanggal Lahir');
        $spreadsheet->getActiveSheet()->getStyle("H4")->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("H")->setAutoSize(TRUE);

        $rowstart = 5;
        $index = 1;
        foreach ($result as $data) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("A".$rowstart, $index++);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("B".$rowstart, isset($data->nama)?$data->nama:NULL);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("C".$rowstart, isset($data->username)?$data->username:NULL);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("D".$rowstart, isset($data->password)?$data->password:NULL);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("E".$rowstart, isset($data->email)?$data->email:NULL);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("F".$rowstart, isset($data->telepon)?$data->telepon:NULL);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("G".$rowstart, isset($data->jeniskelamin)?$data->jeniskelamin:NULL);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("H".$rowstart, isset($data->tgllahir)?$data->tgllahir:NULL);
            $rowstart++;
        }


        $spreadsheet->setActiveSheetIndex(0)->setCellValue("H".($rowstart+1), "Mengetahui");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue("H".($rowstart+3), "Drs. M. Tarmizi, MM");

        $spreadsheet->getActiveSheet()->setTitle($judul.date('d-m-Y H-i'));
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $namaFile .'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
    
    public function print_page()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $limit = intval($this->input->get('limit'));
        
        if($limit<>""){
            $result =  $this->Pelanggan_model->get_limit_data_join_akun($limit, $start, $q);
        }elseif($q<>""){
            $result =  $this->Pelanggan_model->get_data_join_akun($q);
        }else{
            $result = $this->Pelanggan_model->get_all_join_akun();
        }
        
        $data = array(
            'pelanggan_data' => $result,
            'title' => 'Data Pelanggan',
            'text' => 'Data Pelanggan',
            'start' => 0
        );
        
        $this->load->view('admin/pelanggan/pelanggan_doc',$data);
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pelanggan.doc");

        $data = array(
            'pelanggan_data' => $this->Pelanggan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pelanggan/pelanggan_doc',$data);
    }

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-22 10:55:14 */
/* http://harviacode.com */