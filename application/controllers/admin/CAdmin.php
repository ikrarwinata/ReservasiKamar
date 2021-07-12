<?php

require_once(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'Integer.php');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CAdmin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        set_timezone();
    }

    public function print_transaksi($id){
        if($this->session->userdata("level") < 1){
            redirect("CPublic");
        };
        $this->load->helper(array('form', 'url'));
        if($id == NULL){return NULL;};
        $this->load->model("Reservasi_model");
        $this->load->model("Bank_model");
        $this->load->model("Pelanggan_model");
        $this->load->model("Kamar_model");
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

    public function rekap(){
        $arr = array();
        for ($i=1; $i <= 12; $i++) { 
        $stampstart = date_timestamp_get(new DateTime($i."/01/".date("Y")));
        $stampakhir = date_timestamp_get(new DateTime($i.date("/t/Y")));
            $arr[$i]=$this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir'")->row()->c;
        }

        $data = array(
                'judul' => array("Laporan Transaksi"),
                'konten' => "admin/rekap/rekap",
                'script' => "admin/rekap/rekap_script",
                'datas' => $arr,
            );

        $this->load->view("admin/container", $data);

    }

    public function rekap_transaksi(){
        if($this->session->userdata("level") < 1){
            redirect("CPublic");
        };
        $this->load->model("Aktifitasakun_model");
        $this->load->model("Reservasi_model");

        $tanggalmulai = $this->input->post("tglstart");
        $tanggalmulai = $tanggalmulai==NULL?date("m/")."01/".date("Y"):format_date_from_string($tanggalmulai, "m/d/Y");
        $tanggalstart = $tanggalmulai;

        $tanggalakhir = $this->input->post("tglend");
        $tanggalakhir = $tanggalakhir==NULL?date("m/t/Y"):format_date_from_string($tanggalakhir, "m-d-Y");
        $tanggalend = $tanggalakhir;

        $tanggalmulai = $tanggalmulai==NULL?date("Y-m-d H:i:s"):get_year($tanggalmulai)."-".get_month($tanggalmulai)."-".get_day($tanggalmulai)." 00:00:00";
        $tanggalakhir = $tanggalakhir==NULL?date("Y-m-d H:i:s"):get_year($tanggalakhir)."-".get_month($tanggalakhir)."-".get_day($tanggalakhir)." 00:00:00";

        $stampstart = date_timestamp_get(new DateTime($tanggalmulai));
        $stampakhir = date_timestamp_get(new DateTime($tanggalakhir));

        $totaltransaksi = $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir'")->row()->c;
        $total = $this->Reservasi_model->get_total_range_join($stampstart, $stampakhir);
        $total = $total==NULL?0:$total;
        $int = new Integer($total);
        $terbilang = $int->ToCurrencyString();
        $data = array(
                'judul' => array("Laporan Transaksi"),
                'konten' => "admin/rekap/rekap",
                'script' => "admin/rekap/rekap_script",
                'totaltransaksi' => $totaltransaksi,
                'transaksiditolak' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir' AND status=0")->row()->c,
                'transaksidikonfirmasi' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir' AND status=2")->row()->c,
                'transaksipending' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir' AND status=4")->row()->c,
                'tanggalmulai'=>$tanggalstart,
                'tanggalakhir'=>$tanggalend,
                'stampstart'=>$stampstart,
                'stampend'=>$stampakhir,
                'total'=>$total,
                'terbilang'=>$terbilang,
            );

        $this->load->view("admin/container", $data);
    }

    public function rekap_print(){
        if($this->session->userdata("level") < 1){
            redirect("CPublic");
        };
        $this->load->model("Aktifitasakun_model");
        $this->load->model("Reservasi_model");

        $stampstart = $this->input->get("tglstart");
        $stampakhir = $this->input->get("tglend");

        $totaltransaksi = $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir'")->row()->c;
        $total = $this->Reservasi_model->get_total_range_join($stampstart, $stampakhir);
        $total = $total==NULL?0:$total;
        $int = new Integer($total);
        $terbilang = $int->ToCurrencyString();
        $data = array(
                'judul' => array("Laporan Transaksi"),
                'script' => "admin/rekap/rekap_script",
                'totaltransaksi' => $totaltransaksi,
                'transaksiditolak' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir' AND status=0")->row()->c,
                'transaksidikonfirmasi' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir' AND status=2")->row()->c,
                'transaksipending' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir' AND status=4")->row()->c,
                'tanggalmulai'=>date("Y-m-d", $stampstart),
                'tanggalakhir'=>date("Y-m-d", $stampakhir),
                'stampstart'=>$stampstart,
                'stampend'=>$stampakhir,
                'total'=>$total,
                'terbilang'=>$terbilang,
            );

        $this->load->view("admin/rekap/rekap_print", $data);
    }

    public function rekap_print2($m){
        if($this->session->userdata("level") < 1){
            redirect("CPublic");
        };
        $this->load->model("Aktifitasakun_model");
        $this->load->model("Reservasi_model");

        $stampstart = date_timestamp_get(new DateTime($m."/01/".date("Y")));
        $stampakhir = date_timestamp_get(new DateTime($m.date("/t/Y")));

        $totaltransaksi = $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir'")->row()->c;
        $total = $this->Reservasi_model->get_total_range_join($stampstart, $stampakhir);
        $total = $total==NULL?0:$total;
        $int = new Integer($total);
        $terbilang = $int->ToCurrencyString();
        $data = array(
                'judul' => array("Laporan Transaksi"),
                'script' => "admin/rekap/rekap_script",
                'totaltransaksi' => $totaltransaksi,
                'transaksiditolak' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir' AND status=0")->row()->c,
                'transaksidikonfirmasi' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir' AND status=2")->row()->c,
                'transaksipending' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE timestamps>='$stampstart' AND timestamps<='$stampakhir' AND status=4")->row()->c,
                'tanggalmulai'=>date("Y-m-d", $stampstart),
                'tanggalakhir'=>date("Y-m-d", $stampakhir),
                'stampstart'=>$stampstart,
                'stampend'=>$stampakhir,
                'total'=>$total,
                'terbilang'=>$terbilang,
            );

        $this->load->view("admin/rekap/rekap_print", $data);
    }

    public function index()
    {
        if($this->session->userdata("level") < 1){
            redirect("CPublic");
        };
        $this->load->model("Aktifitasakun_model");

        $data = array(
                'judul' => array("Dashboard"),
                'konten' => "admin/home",
                'script' => "admin/home_script",
                'kamardigunakan' => $this->db->query("SELECT COUNT(*) AS c FROM tamu")->row()->c,
                'pelanggan' => $this->db->query("SELECT COUNT(*) AS c FROM pelanggan")->row()->c,
                'reservasi' => $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE Status='1'")->row()->c,
                'transaksi' => $this->db->query("SELECT COUNT(*) AS c FROM riwayattamu")->row()->c,
                'pemasukan' => $this->db->query("SELECT SUM(pembayaran) AS c FROM riwayattamu WHERE tglkeluar LIKE '%___".date("m-Y")."%'")->row()->c,
                'activitys1' => $this->Aktifitasakun_model->get_limit_data_join_akunpetugas(6),
                'activitys2' => $this->Aktifitasakun_model->get_limit_data_join_akunpetugas(6,7),
                'activitysp1' => $this->Aktifitasakun_model->get_limit_data_join_akunpelanggan(6),
                'activitysp2' => $this->Aktifitasakun_model->get_limit_data_join_akunpelanggan(6,7),
            );

        $this->load->view("admin/container", $data);
    }

}