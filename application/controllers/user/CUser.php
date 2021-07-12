<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CUser extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Kamar_model");
        $this->load->model("Akun_model");
        set_timezone();
    }

    public function invoice($id){
        $this->load->helper(array('form', 'url'));
        if($id == NULL){return NULL;};
        $this->load->model("Reservasi_model");
        $this->load->model("Bank_model");
        $this->load->model("Pelanggan_model");
        $resv = $this->Reservasi_model->get_by_id($id);
        $b = $this->Bank_model->get_by_id($resv->kodebank);
        $a = $this->Pelanggan_model->get_by_id($resv->idpelanggan);
        $row = $this->Kamar_model->get_by_id($resv->idkamar);
        $this->load->library("Parsedown");
        $Parsedown = new Parsedown();
        $d = $Parsedown->text($row->deskripsi);

        $data = array(
                'judul' => array("Dashboard"),
            'id' => $id,
            'idkamar' => $row->idkamar,
            'nomorkamar' => $row->nomorkamar,
            'tarif' => $row->tarif,
            'nama' => $a->nama,
            'telepon' => $a->telepon,
            'fotokamar' => $row->fotokamar,
            'checkin' => $resv->tglcheckin,
            'status' => $resv->status,
            'lamainap' => $resv->lamainap,
            'buktipembayaran' => isset($resv->buktipembayaran)?$resv->buktipembayaran:NULL,
            'foto2' => isset($row->foto2)?$row->foto2:NULL,
            'foto3' => isset($row->foto3)?$row->foto3:NULL,
            'timestamps' => $resv->timestamps,
            'konten' => 'resv_script',
            'namanasabah'=>$b->namanasabah,
            'namabank'=>$b->namabank,
            'gambarbank'=>$b->gambar,
            'rekening'=>$b->rekening,
        );
        $this->load->view('user/container', $data);
    }

    public function print_invoice($id){
        $this->load->helper(array('form', 'url'));
        if($id == NULL){return NULL;};
        $this->load->model("Reservasi_model");
        $this->load->model("Bank_model");
        $this->load->model("Pelanggan_model");
        $resv = $this->Reservasi_model->get_by_id($id);
        $b = $this->Bank_model->get_by_id($resv->kodebank);
        $a = $this->Pelanggan_model->get_by_id($resv->idpelanggan);
        $row = $this->Kamar_model->get_by_id($resv->idkamar);
        $this->load->library("Parsedown");
        $Parsedown = new Parsedown();
        $d = $Parsedown->text($row->deskripsi);

        $data = array(
                'judul' => array("Dashboard"),
            'id' => $id,
            'idkamar' => $row->idkamar,
            'nomorkamar' => $row->nomorkamar,
            'tarif' => $row->tarif,
            'nama' => $a->nama,
            'telepon' => $a->telepon,
            'fotokamar' => $row->fotokamar,
            'checkin' => $resv->tglcheckin,
            'status' => $resv->status,
            'lamainap' => $resv->lamainap,
            'buktipembayaran' => isset($resv->buktipembayaran)?$resv->buktipembayaran:NULL,
            'foto2' => isset($row->foto2)?$row->foto2:NULL,
            'foto3' => isset($row->foto3)?$row->foto3:NULL,
            'timestamps' => $resv->timestamps,
            'konten' => 'resv_script',
            'namanasabah'=>$b->namanasabah,
            'namabank'=>$b->namabank,
            'gambarbank'=>$b->gambar,
            'rekening'=>$b->rekening,
        );
        $this->load->view('resv_script_print', $data);
    }

    public function reserv($id)
    {
        $this->load->helper(array('form', 'url'));
        if($id == NULL){return NULL;};
        $row = $this->Kamar_model->get_by_id($id);
        $this->load->model("Bank_model");
        $this->load->model("Reservasi_model");
        $b = $this->Bank_model->get_all();
        $re = $this->Reservasi_model->get_by_kamar_for_resv($id);
        $data = array(
            'idkamar' => $row->idkamar,
            'nomorkamar' => $row->nomorkamar,
            'tarif' => $row->tarif,
            'strdigunakan' => $row->digunakan?"Digunakan":"Kosong",
            'digunakan' => $row->digunakan,
            'fotokamar' => $row->fotokamar,
            'deskripsi' => $row->deskripsi,
            'data_resv' => $re,
            'bank_data'=>$b,
            'konten' => "user/reservasi/resv",
            'judul' => array("Reservasi Kamar", $row->nomorkamar),
        );
        $this->load->view('user/container', $data);
    }

    public function reservation_action($id)
    {
        if($id == NULL){
            redirect("user/CUser/resv/".$id);
            return NULL;
        };
        $rowkamar = $this->Kamar_model->get_by_id($id);
        $this->load->model("Akun_model");
        $akun_data = $this->Akun_model->get_akun($this->session->userdata("username"), $this->session->userdata("password"));
        if(!$akun_data){
            $this->session->set_flashdata('message', 'Username atau password anda salah');
            redirect("user/CUser/resv/".$id);
            return NULL;
        };
        $this->load->model("Pelanggan_model");
        $rowuser = $this->Pelanggan_model->get_by_akun($akun_data->id);
        $check = $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE idpelanggan='".$rowuser->idpelanggan."' AND idkamar='".$rowkamar->idkamar."' AND tglcheckin='".$this->input->post("tglcheckin")."'")->row()->c;
        if($check >= 1){
            $this->session->set_flashdata('message', 'Anda sudah melakukan reservasi untuk kamar yang sama !');
            redirect("user/CUser/resv/".$id);
            return NULL;
        }
        $date = date_create();
        $idr = $rowuser->idpelanggan.$rowuser->idakun.date("dmYHis");
        $data = array(
            'idreservasi' => $idr,
            'idpelanggan' => $rowuser->idpelanggan,
            'idkamar' => $rowkamar->idkamar,
            'tglreservasi' => date("d-m-Y"),
            'tglcheckin' => $this->input->post("tglcheckin"),
            'kodebank' => $this->input->post("rek"),
            'lamainap' => $this->input->post("lamainap"),
            'status' => "4",
            'timestamps'=>date_timestamp_get($date),
        );

        $this->load->model("Reservasi_model");
        $this->Reservasi_model->insert($data);

        $this->load->model("Anggota_inap_model");
        
        $countfiles = count($_FILES['member']['name']);
        for ($i=0; $i < $countfiles; $i++) { 
            $Tempext = explode(".", $_FILES['member']["name"][$i]);
            $ext = (count($Tempext)>=2)?$Tempext[count($Tempext)-1]:NULL;
            $fktp = "uploads/pelanggan/ktp/".$rowkamar->idkamar.$rowuser->idakun.date("dmYHis").$i.".".$ext;
            rename($_FILES['member']["tmp_name"][$i], $fktp);
            $datam = array(
                'idreservasi'=>$idr,
                'ktp'=>$fktp,
            );

            $this->Anggota_inap_model->insert($datam);
        }

        $this->load->model("Aktifitasakun_model");
        $user = $akun_data->id;
        $token = $user.date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $user,
            'datavalue' => $id,
            'displaytext' => $rowkamar->nomorkamar,
            'controller' => "Reservasi",
            'action' => "reservasi",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->Aktifitasakun_model->insert($action);
        redirect("user/CUser/invoice/".$idr);
    }

    public function bukti_pembayaran($id){
        $this->load->helper(array('form', 'url'));
        $this->load->model("Reservasi_model");
        if($id == NULL){return NULL;};

        $config['upload_path']          = './uploads/buktipembayaran';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 100000;
        $config['max_width']            = 8000;
        $config['max_height']           = 8000;
        $this->load->library('upload', $config);

        $bukti = NULL;
        if($this->upload->do_upload('bukti')){
            $udata = $this->upload->data();
            $bukti = "uploads/buktipembayaran/".$id.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $bukti);
        }

        $resv = $this->Reservasi_model->get_by_id($id);
        if ($resv) {
            $data=array(
                'status'=>"1",
                'buktipembayaran'=>$bukti,
            );
            $this->Reservasi_model->update($id, $data);
            echo "<script>alert('Bukti pembayaran berhasil diunggah, silahkan tunggu konfirmasi dari petugas selanjutnya.');window.history.go(-1);</script>";
        }

    }

    public function index()
    {
        if($this->session->userdata("level") < 1){
            redirect("CPublic");
        };
        $this->load->model("Aktifitasakun_model");

        $data = array(
                'judul' => array("Dashboard"),
                'konten' => "user/home",
                'script' => "user/home_script",
                'activitys1' => $this->Aktifitasakun_model->get_limit_data_join_akunpetugas(6),
                'activitys2' => $this->Aktifitasakun_model->get_limit_data_join_akunpetugas(6,7),
                'activitysp1' => $this->Aktifitasakun_model->get_limit_data_join_akunpelanggan(6),
                'activitysp2' => $this->Aktifitasakun_model->get_limit_data_join_akunpelanggan(6,7),
            );

        $this->load->view("user/container", $data);
    }

}