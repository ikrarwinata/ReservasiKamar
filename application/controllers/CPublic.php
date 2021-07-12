<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CPublic extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kamar_model');
        set_timezone();
    }

    public function index()
    {
        $this->load->model('Tamu_model');
        $kamar = $this->Kamar_model->get_limit_data(4, NULL, NULL);

        $data = array(
            'kamar_data' => $kamar,
            'konten' => "home",
        );
        $this->load->view('container', $data);
    }

    public function helps()
    {
        $data = array(
            'konten' => "helps",
        );
        $this->load->view('container', $data);
    }

    public function contact()
    {
        $this->load->model('Petugas_model');
        $petugas = $this->Petugas_model->get_limit_data(3, NULL, NULL);

        $data = array(
            'petugas_data' => $petugas,
            'konten' => "contact",
        );
        $this->load->view('container', $data);
    }

    public function tamu()
    {
        $this->load->model('Tamu_model');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.html';
            $config['first_url'] = base_url() . 'index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tamu_model->total_rows_join($q);
        $kamar = $this->Tamu_model->get_limit_data_join($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kamar_data' => $kamar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => "tamu",
        );
        $this->load->view('container', $data);
    }

    public function rooms()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kamar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kamar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kamar/index.html';
            $config['first_url'] = base_url() . 'kamar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kamar_model->total_rows($q);
        $kamar = $this->Kamar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kamar_data' => $kamar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'per_page' => $config['per_page'],
            'konten' => "rooms"
        );
        $this->load->view('container', $data);
    }

    public function rooms_view($id)
    {
        if($id == NULL){return NULL;};
        $row = $this->Kamar_model->get_by_id($id);
        $this->load->library("Parsedown");
        $Parsedown = new Parsedown();
        $d = $Parsedown->text($row->deskripsi);
        $this->load->model("Reservasi_model");
        $re = $this->Reservasi_model->get_by_kamar_for_resv($id);
        $data = array(
            'idkamar' => $row->idkamar,
            'nomorkamar' => $row->nomorkamar,
            'tarif' => $row->tarif,
            'strdigunakan' => $row->digunakan?"Digunakan":"Kosong",
            'digunakan' => $row->digunakan,
            'fotokamar' => $row->fotokamar,
            'foto2' => isset($row->foto2)?$row->foto2:NULL,
            'foto3' => isset($row->foto3)?$row->foto3:NULL,
            'deskripsi' => $d,
            'data_resv' => $re,
            'konten' => "rooms_view"
        );
        $this->load->view('container', $data);
    }

    public function reservasi()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kamar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kamar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kamar/index.html';
            $config['first_url'] = base_url() . 'kamar/index.html';
        }
        $this->load->model("Reservasi_model");
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Reservasi_model->total_rows_join2($q);
        $kamar = $this->Reservasi_model->get_limit_data_join2($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kamar_data' => $kamar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'per_page' => $config['per_page'],
            'konten' => "reservasi"
        );
        $this->load->view('container', $data);
    }

    public function reservasi_view($id)
    {
        if($id == NULL){return NULL;};
        $this->load->model("Reservasi_model");
        $row = $this->Reservasi_model->get_by_id_join2($id);
        $data = array(
            'idkamar' => $row->idkamar,
            'nomorkamar' => $row->nomorkamar,
            'tarif' => $row->tarif,
            'strdigunakan' => $row->digunakan?"Digunakan":"Kosong",
            'digunakan' => $row->digunakan,
            'fotokamar' => $row->fotokamar,
            'namapelanggan' => $row->namapelanggan,
            'tglcheckin' => $row->tglcheckin,
            'lamainap' => $row->lamainap,
            'konten' => "reservasi_view"
        );
        $this->load->view('container', $data);
    }

    public function reserv($id)
    {
        $this->load->helper(array('form', 'url'));
        if($id == NULL){return NULL;};
        $row = $this->Kamar_model->get_by_id($id);
        $this->load->model("Bank_model");
        $this->load->model("Reservasi_model");
        $re = $this->Reservasi_model->get_by_kamar_for_resv($id);
        $b = $this->Bank_model->get_all();
        $data = array(
            'idkamar' => $row->idkamar,
            'nomorkamar' => $row->nomorkamar,
            'tarif' => $row->tarif,
            'strdigunakan' => $row->digunakan?"Digunakan":"Kosong",
            'digunakan' => $row->digunakan,
            'fotokamar' => $row->fotokamar,
            'foto2' => $row->foto2,
            'foto3' => $row->foto3,
            'deskripsi' => $row->deskripsi,
            'data_resv' => $re,
            'konten' => "resv",
            'bank_data'=>$b
        );
        $this->load->view('container', $data);
    }

    public function reservation_action($id)
    {
        if($id == NULL){
			redirect("CPublic/reserv/".$id);
			return NULL;
		};
        $rowkamar = $this->Kamar_model->get_by_id($id);
        $this->load->model("Akun_model");
        $akun_data = $this->Akun_model->get_akun($this->input->post("username"), $this->input->post("password"));
        if(!$akun_data){
        	$this->session->set_flashdata('message', 'Username atau password anda salah');
			redirect("CPublic/reserv/".$id);
			return NULL;
		};
        $this->load->model("Pelanggan_model");
        $rowuser = $this->Pelanggan_model->get_by_akun($akun_data->id);
        $check = $this->db->query("SELECT COUNT(*) AS c FROM reservasi WHERE idpelanggan='".$rowuser->idpelanggan."' AND idkamar='".$rowkamar->idkamar."' AND tglcheckin='".$this->input->post("tglcheckin")."'")->row()->c;
        if($check >= 1){
            $this->session->set_flashdata('message', 'Anda sudah melakukan reservasi untuk kamar yang sama !');
            redirect("CPublic/reserv/".$id);
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
        redirect("CPublic/invoice/".$idr);
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
        $this->load->view('container', $data);
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

    public function register()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->view("register");
    }

    public function register_action()
    {
        $this->load->helper(array('form', 'url'));
        $username = $this->input->post('username',TRUE);
        $password = $this->input->post('password',TRUE);
        
        $config['upload_path']          = './uploads/pelanggan/ktp';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']             = 100000;
        $config['max_width']            = 8000;
        $config['max_height']           = 8000;
        $this->load->library('upload', $config);

        $foto = "uploads/pelanggan/profile/usernoimage.png";

        $akun = array(
            'username' => $username,
            'password' => $password,
            'level' => "1"
            );
        $this->load->model("Akun_model");
        $this->Akun_model->insert($akun);
        $idakun = $this->db->query("SELECT id FROM akun WHERE username='".$username."' AND password='".$password."'")->row()->id;

        $ktp = NULL;
        if($this->upload->do_upload('ktp')){
            $udata = $this->upload->data();
            $ktp = "uploads/pelanggan/ktp/".$username.date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $ktp);
        }else{
            echo "<script>alert('Foto ktp yang anda masukan terlalu besar. Silahkan coba lagi dengan foto yang diperkecil (Maks 10Mb, 8000x8000)');window.location='register'</script>";
            return;
        };
        
        $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'jeniskelamin' => $this->input->post('jeniskelamin',TRUE),
            'tgllahir' => format_date($this->input->post('tgllahir',TRUE)),
            'telepon' => $this->input->post('telepon',TRUE),
            'email' => $this->input->post('email',TRUE),
            'fotoktp' => $ktp,
            'fotoprofil' => $foto,
            'idakun' => $idakun,
            );

        $this->load->model("Pelanggan_model");
        $this->Pelanggan_model->insert($data);

        $user = $idakun;
        $token = $user.date("YmdHis");
        $action = array(
            'token' => $token,
            'idakun' => $idakun,
            'datavalue' => $idakun,
            'displaytext' => $this->input->post('nama',TRUE),
            'controller' => "pelanggan",
            'action' => "register",
            'tanggal' => date("d-m-Y"),
            'jam' => date("H:i")
        );
        $this->load->model("Aktifitasakun_model");
        $this->Aktifitasakun_model->insert($action);

        $this->session->set_flashdata('message', 'Create Record Success');


        $sess_data['id'] = $this->db->select("MAX(idpelanggan) AS res")->get("pelanggan")->row()->res;
        $sess_data['idakun'] = $idakun;
        $sess_data['username'] = $this->input->post('username',TRUE);
        $sess_data['password'] = $this->input->post('password',TRUE);
        $sess_data['nama'] = $this->input->post('nama',TRUE);
        $sess_data['tgllahir'] = $this->input->post('tgllahir',TRUE);
        $sess_data['fotoprofil'] = "uploads/pelanggan/profile/usernoimage.png";
        $sess_data['level'] = "1";
        $sess_data[session_key()] = 1;
        $this->session->set_userdata($sess_data);
        redirect("User");
    }

    public function login()
    {
        $this->load->view("login");
    }

    public function lupa_password(){
        $u = $this->input->post("username");
        $p = $this->input->post("email");

        $this->load->model("Akun_model");            
        $akun_data = $this->Akun_model->lupa_password($u, $p);

        if($akun_data){
            switch ($akun_data->level) {
                case '2':
                    // petugas
                    $this->load->model("Petugas_model");
                    $petugas = $this->Petugas_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $petugas->idpetugas;
                    $sess_data['idakun'] = $petugas->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $petugas->nama;
                    $sess_data['tgllahir'] = $petugas->tgllahir;
                    $sess_data['alamat'] = $petugas->alamat;
                    $sess_data['fotoprofil'] = ($petugas->fotoprofil==NULL?"uploads/petugas/usernoimage.png":$petugas->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "Admin";
                    break;
                case '3':
                    // bendahara
                    $this->load->model("Petugas_model");
                    $petugas = $this->Petugas_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $petugas->idpetugas;
                    $sess_data['idakun'] = $petugas->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $petugas->nama;
                    $sess_data['tgllahir'] = $petugas->tgllahir;
                    $sess_data['alamat'] = $petugas->alamat;
                    $sess_data['fotoprofil'] = ($petugas->fotoprofil==NULL?"uploads/petugas/usernoimage.png":$petugas->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "Admin";
                    break;
                case '4':
                    // kepala/koordinator
                    $this->load->model("Petugas_model");
                    $petugas = $this->Petugas_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $petugas->idpetugas;
                    $sess_data['idakun'] = $petugas->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $petugas->nama;
                    $sess_data['tgllahir'] = $petugas->tgllahir;
                    $sess_data['alamat'] = $petugas->alamat;
                    $sess_data['fotoprofil'] = ($petugas->fotoprofil==NULL?"uploads/petugas/usernoimage.png":$petugas->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "Admin";
                    break;
                case '5':
                    // kepala/koordinator
                    $this->load->model("Petugas_model");
                    $petugas = $this->Petugas_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $petugas->idpetugas;
                    $sess_data['idakun'] = $petugas->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $petugas->nama;
                    $sess_data['tgllahir'] = $petugas->tgllahir;
                    $sess_data['alamat'] = $petugas->alamat;
                    $sess_data['fotoprofil'] = ($petugas->fotoprofil==NULL?"uploads/petugas/usernoimage.png":$petugas->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "Admin";
                    break;
                case '1':
                    // user
                    $this->load->model("Pelanggan_model");
                    $pelanggan = $this->Pelanggan_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $pelanggan->idpelanggan;
                    $sess_data['idakun'] = $pelanggan->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $pelanggan->nama;
                    $sess_data['tgllahir'] = $pelanggan->tgllahir;
                    $sess_data['fotoprofil'] = ($pelanggan->fotoprofil==NULL?"uploads/pelanggan/profile/usernoimage.png":$pelanggan->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "User";
                    break;
                default:
                    // user
                    $this->load->model("Pelanggan_model");
                    $pelanggan = $this->Pelanggan_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $pelanggan->idpelanggan;
                    $sess_data['idakun'] = $pelanggan->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $pelanggan->nama;
                    $sess_data['tgllahir'] = $pelanggan->tgllahir;
                    $sess_data['fotoprofil'] = ($pelanggan->fotoprofil==NULL?"uploads/pelanggan/profile/usernoimage.png":$pelanggan->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "User";
                    break;
            }
            $sess_data[session_key()] = 1;
            $this->session->set_userdata($sess_data);
            redirect($ref);
        }else{
            $this->session->set_flashdata('message', 'Maaf, Username atau email anda tidak ditemukan !');
            redirect("Login");
        }
    }

    public function login_action(){
        $u = $this->input->post("username");
        $p = $this->input->post("password");

        $this->load->model("Akun_model");            
        $akun_data = $this->Akun_model->get_akun($u, $p);

        $ref = "Admin";
        if($akun_data){
            switch ($akun_data->level) {
                case '2':
                    // petugas
                    $this->load->model("Petugas_model");
                    $petugas = $this->Petugas_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $petugas->idpetugas;
                    $sess_data['idakun'] = $petugas->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $petugas->nama;
                    $sess_data['tgllahir'] = $petugas->tgllahir;
                    $sess_data['alamat'] = $petugas->alamat;
                    $sess_data['fotoprofil'] = ($petugas->fotoprofil==NULL?"uploads/petugas/usernoimage.png":$petugas->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "Admin";
                    break;
                case '3':
                    // bendahara
                    $this->load->model("Petugas_model");
                    $petugas = $this->Petugas_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $petugas->idpetugas;
                    $sess_data['idakun'] = $petugas->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $petugas->nama;
                    $sess_data['tgllahir'] = $petugas->tgllahir;
                    $sess_data['alamat'] = $petugas->alamat;
                    $sess_data['fotoprofil'] = ($petugas->fotoprofil==NULL?"uploads/petugas/usernoimage.png":$petugas->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "Admin";
                    break;
				case '4':
					// kepala/koordinator
                    $this->load->model("Petugas_model");
                    $petugas = $this->Petugas_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $petugas->idpetugas;
                    $sess_data['idakun'] = $petugas->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $petugas->nama;
                    $sess_data['tgllahir'] = $petugas->tgllahir;
                    $sess_data['alamat'] = $petugas->alamat;
                    $sess_data['fotoprofil'] = ($petugas->fotoprofil==NULL?"uploads/petugas/usernoimage.png":$petugas->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "Admin";
                    break;
				case '5':
					// kepala/koordinator
                    $this->load->model("Petugas_model");
                    $petugas = $this->Petugas_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $petugas->idpetugas;
                    $sess_data['idakun'] = $petugas->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $petugas->nama;
                    $sess_data['tgllahir'] = $petugas->tgllahir;
                    $sess_data['alamat'] = $petugas->alamat;
                    $sess_data['fotoprofil'] = ($petugas->fotoprofil==NULL?"uploads/petugas/usernoimage.png":$petugas->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "Admin";
                    break;
				case '1':
                    // user
                    $this->load->model("Pelanggan_model");
                    $pelanggan = $this->Pelanggan_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $pelanggan->idpelanggan;
                    $sess_data['idakun'] = $pelanggan->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $pelanggan->nama;
                    $sess_data['tgllahir'] = $pelanggan->tgllahir;
                    $sess_data['fotoprofil'] = ($pelanggan->fotoprofil==NULL?"uploads/pelanggan/profile/usernoimage.png":$pelanggan->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "User";
                    break;
                default:
                    // user
                    $this->load->model("Pelanggan_model");
                    $pelanggan = $this->Pelanggan_model->get_by_akun($akun_data->id);

                    $sess_data['id'] = $pelanggan->idpelanggan;
                    $sess_data['idakun'] = $pelanggan->idakun;
                    $sess_data['username'] = $akun_data->username;
                    $sess_data['password'] = $akun_data->password;
                    $sess_data['nama'] = $pelanggan->nama;
                    $sess_data['tgllahir'] = $pelanggan->tgllahir;
                    $sess_data['fotoprofil'] = ($pelanggan->fotoprofil==NULL?"uploads/pelanggan/profile/usernoimage.png":$pelanggan->fotoprofil);
                    $sess_data['level'] = $akun_data->level;
                    $ref = "User";
                    break;
            }
			$sess_data[session_key()] = 1;
			$this->session->set_userdata($sess_data);
			redirect($ref);
        }else{
            $this->session->set_flashdata('message', 'Upss... Username atau password yang anda masukan salah !');
			redirect("Login");
		}
    }

    public function logout(){
        $this->session->unset_userdata("id");
        $this->session->unset_userdata("idakun");
        $this->session->unset_userdata("username");
        $this->session->unset_userdata("password");
        $this->session->unset_userdata("nama");        
        $this->session->unset_userdata("tgllahir");        
        $this->session->unset_userdata("alamat");        
        $this->session->unset_userdata("fotoprofil");        
        $this->session->unset_userdata("level");
        $this->session->unset_userdata("slevel");
        $this->session->unset_userdata(session_key());
        session_destroy();
        redirect("CPublic");
    }

}