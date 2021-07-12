<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function session_key(){
	return "RKMPS_SHS";
}

function to_number_kilo($number){
	return format_number($number/1000)." K";
}

function string_level($l){
	switch($l){
		case "2":
			$slevel = "Petugas";
			break;
		case "3":
			$slevel = "Bendahara";
			break;
		case "4":
			$slevel = "Koordinator";
			break;
		case "5":
			$slevel = "Kepala Bagian Umum";
			break;
		case "1":
			$slevel = "Tamu";
			break;
		default:
			$slevel = "Tamu";
			break;
	};
	return $slevel;
}

function string_statusresv($s){
	$result = NULL;
	switch($s){
		case "1":
			$result = "Menunggu Konfirmasi";
			break;
		case "2":
			$result = "Telah Dikonfirmasi";
			break;
		case "3":
			$result = "Telah Dikonfirmasi";
			break;
		case "4":
			$result = "Menunggu Bukti Pembayaran";
			break;
		default:
			$result = "Ditolak";
			break;
	}
	return $result;
}

function logcat($action, $dataval, $controller)
{
	$result = NULL;
	switch($action){
		case "create":
			$result = "Menambahkan %controller </br><a href='' role='button'>$dataval</a>";
			break;
		case "insert":
			$result = "Menambahkan %controller baru.</br><a href='' role='button'>$dataval</a>";
			break;
		case "update":
			$result = "Mengubah %controller <a href='#'>$dataval</a>";
			break;
		case "edit":
			$result = "Mengubah %controller <a href='#'>$dataval</a>";
			break;
		case "delete":
			$result = "Menghapus %controller <a href='#'>$dataval</a>";
			break;
		case "read":
			$result = "Melihat %controller <a href='#'>$dataval</a>";
			break;
		case "reservasi":
			$result = "Melakukan %controller kamar <a href='#'>$dataval</a>";
			break;
		case "konfirmasi":
			$result = "Mengkonfirmasi %controller Kamar <a href='#'>$dataval</a>";
			break;
		case "tolak":
			$result = "Menolak %controller Kamar <a href='#'>$dataval</a>";
			break;
		case "register":
			$result = "Telah melakukan $action akun";
			break;
		default:
			$result = "Online";
			break;
	};
	switch(strtolower($controller)){
		case "petugas":
			$result = str_replace("%controller","Akun",$result);
			break;
		case "pelanggan":
			$result = str_replace("%controller","data tamu",$result);
			break;
		case "kamar":
			$result = str_replace("%controller","kamar",$result);
			break;
		case "pengeluaran":
			$result = str_replace("%controller","Data Pengeluaran keterangan ",$result);
			break;
		case "tamu":
			$result = str_replace("%controller","Data Kamar ",$result);
			$result .=  " yang sedang digunakan tamu.";
		case "akun":
			$result = str_replace("%controller","Data akun ",$result);
			break;
		case "bank":
			$result = str_replace("%controller","Data ",$result);
			break;
		default:
			$result = str_replace("%controller",$controller,$result);
			break;
	}
	return $result;
};

function timelog($date, $jam, $detailed=FALSE)
{
	if(trim($date)==NULL||trim($jam)==NULL){return NULL;};
	$tanggal = format_date($date);
	$lastactivity=0;
	$d = substr($tanggal,0,2);
	$m = substr($tanggal,3,2);
	$Y = substr($tanggal,6,4);
	$H = substr($jam,0,2);
	$i = substr($jam,3,2);
	if($Y == date("Y")){
		if($m==date("m")){
			if($d==date("d")){
				if($H==date("H")){
					if($i==date("i")){
						$lastactivity = "Baru saja";
					}else{
						$lastactivity = (date("i") - $i) . " Menit yang lalu";
					}
				}else{
					if($detailed===TRUE){
						if($i==date("i")){
							$lastactivity = (date("H") - $H) . " Jam yang lalu";
						}else{
							$lastactivity = (date("H") - $H) . " Jam " . (date("i") - $i) . " Menit yang lalu";
						}
					}else{
						$lastactivity = (date("H") - $H) . " Jam yang lalu";
					}
				}
			}else{
				if($detailed===TRUE){
					if($H==date("H")){
						$lastactivity = (date("d") - $d) . " Hari yang lalu";
					}else{
						$lastactivity = (date("d") - $d) . " Hari " . (date("H") - $H) . " Jam yang lalu";
					}
				}else{
					$x = (date("d") - $d);
					$lastactivity = ($x<=0?0:$x) . " Hari yang lalu";
				}
			}
		}else{
			if($detailed===TRUE){
				if($d==date("d")){
					$lastactivity = (date("m") - $m) . " Bulan " . (date("d") - $d) . " Hari yang lalu";
				}else{
					$lastactivity = (date("m") - $m) . " Bulan yang lalu";
				}
			}else{
				$lastactivity = (date("m") - $m) . " Bulan yang lalu";
			}
		}
	}else{
		if($detailed===TRUE){
			$lastactivity = $tanggal . " " . $jam;
		}else{
			$lastactivity = $tanggal;
		}
	};

	return $lastactivity;
}

function format_number($number){
	$result = $number;
	if(strpos($number, ",")!==FALSE){
		$listNumber = explode(",", $number);

		$result = number_format($listNumber[0]);
		$result = str_replace(",", ".", $result);
		foreach ($listNumber as $value) {
			$result .= ",". $value;
		}
	}else{
		$result = number_format($number);
		$result = str_replace(",", ".", $result);
	};

	return $result;
}

function set_timezone($zone = 'Asia/Jakarta'){
	date_default_timezone_set($zone);
}

function format_date($date){
    set_timezone();

	if(trim($date)==NULL){return NULL;};
	$c = array();
	$d=NULL;
	$m=NULL;
	$Y=NULL;

	if(strpos($date, "-")!==FALSE){
		$c = explode("-", $date);
	}else{
		$c = explode("/", $date);
	};

	if(strlen($c[0]) >= 4){
		$d = $c[2];
		$m = $c[1];
		$Y = $c[0];
	}else if($c[1] >= 13){
		$d = $c[1];
		$m = $c[0];
		$Y = $c[2];
	}else{
		return $date;
	}

	return $d."-".$m."-".$Y;
}

function format_date_from_string($date, $oldformat){
    set_timezone();

	if(trim($date)==NULL){return NULL;};
	$c = array();
	$f = array();

	$sp = strpos($oldformat, "-")!==FALSE?"-":"/";
	$sp2 = strpos($date, "-")!==FALSE?"-":"/";
	$c = explode($sp2, $date);
	$f = explode($sp, $oldformat);

	$d=NULL;
	$m=NULL;
	$Y=NULL;
	$result = NULL;

	for ($i=0; $i < 3; $i++) { 
		if (isset($f[$i])) {
			switch (strtolower($f[$i])) {
				case 'd':
					$d = $c[$i];
					break;
				case 'm':
					$m = $c[$i];
					break;
				case 'y':
					$Y = $c[$i];
					break;
				default:
					$d = $c[$i];
					break;
			}
		}else{
			$result = $date;
			break;
		}
	}
	$result = $d."-".$m."-".$Y;

	return $result;
}

function get_year($date){
	if($date==NULL){return NULL;};
	$date = format_date($date);
	$sp = strpos($date, '-')!==FALSE?'-':'/';
	$res = explode($sp, $date)[2];
	return $res;
}

function get_month($date){
	if($date==NULL){return NULL;};
	$date = format_date($date);
	$sp = strpos($date, '-')!==FALSE?'-':'/';
	$res = explode($sp, $date)[1];
	return $res;
}

function get_day($date){
	if($date==NULL){return NULL;};
	$date = format_date($date);
	$sp = strpos($date, '-')!==FALSE?'-':'/';
	$res = explode($sp, $date)[0];
	return $res;
}

function get_str_day($date){
	if($date==NULL){return NULL;};
	$date = format_date($date);
	$result = NULL;
	switch (date("w", mktime(0, 0, 0, get_month($date), get_day($date), get_year($date)))) {
		case '0':
			$result="Minggu";
			break;
		case '1':
			$result="Senin";
			break;
		case '2':
			$result="Selasa";
			break;
		case '3':
			$result="Rabu";
			break;
		case '4':
			$result="Kamis";
			break;
		case '5':
			$result="Jumat";
			break;
		case '6':
			$result="Sabtu";
			break;
		default:
			$result=NULL;
			break;
	};
	return $result;
};

function date_passed($date, $onequal = 1){
	if($date == NULL){return FALSE;};
	$date = format_date($date);

	$dY = date("Y");
	$dM = date("m");
	$dd = date("d");
	$nY = get_year($date);
	$nM = get_month($date);
	$nd = get_day($date);

	if($dY > $nY){return "1";};
	if($dM > $nM && $dY == $nY){return "1";};
	if($dd > $nd && $dM == $nM && $dY == $nY){return "1";};
	if($onequal == TRUE && $dd == $nd && $dM == $nM && $dY == $nY){return "1";};
	return "0";
}

function str_sentence($str){
	$c = explode(" ", $str);
	$res = NULL;
	foreach ($c as $value) {
		$res .= strtoupper(substr($value, 0,1)).strtolower(substr($value, 1))." ";
	};
	$res = trim($res);
	return $res;
};

function str_shortened($str, $lenght, $ext = "..."){
	$res = NULL;
	if(strlen($str)>$lenght){
		$res = substr($str, 0, $lenght).$ext;
	}else{
		$res = $str;
	}
	return $res;
}

function increase_date($date, $increament){
	$d = strtotime("+$increament day", strtotime(get_year($date)."-".get_month($date)."-".get_day($date)));
	return date("d-m-Y", $d);
}

function increase_date_defaultformat($date, $increament){
	$d = strtotime("+$increament day", strtotime(get_year($date)."-".get_month($date)."-".get_day($date)));
	return date("Y-m-d", $d);
}

function get_str_month($index){
	$sbulan = array('', 'January', "February", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	if($index<=count($sbulan)){
		$index = $index*1;
		return $sbulan[$index];
	}else{
		return NULL;
	}
}