<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Integer{
		const version = "3.1.12";

		public $currency_symbol = "Rp.";
		public $currency_string = "rupiah";
		public $coma_separator = ",";
		
		public $initial_for_two_digits_low = "belas";
		public $initial_for_two_digits = "puluh";
		public $initial_for_three_digits = "ratus";
		public $initial_for_four_digits = "ribu";
		public $initial_for_seven_digits = "juta";
		public $initial_for_ten_digits = "milyar";
		public $initial_for_thrteen_digits = "triliyun";
		
		public $string_number_Zero = "nol";
		public $string_number_One = "satu";
		public $string_number_Two = "dua";
		public $string_number_Three = "tiga";
		public $string_number_Four = "empat";
		public $string_number_Five = "lima";
		public $string_number_Six = "enam";
		public $string_number_Seven = "tujuh";
		public $string_number_Eight = "delapan";
		public $string_number_Nine = "sembilan";
		public $FirstStringforOne = "se";
		public $string_for_Coma = "koma";
		
		private $_value = ""; // Default Number to Procces
		
		public function Parse(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			if(is_numeric($Value)){
				return $Value;
			}
		}
		
		public function TryParse(){
			$result = FALSE;
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}

			if(!is_numeric($Value)) return $result;

			if (func_num_args() == 2){
				if(func_get_arg(1) == $Value) $result = TRUE;
			}else{
				 $result = TRUE;
			}

			return $result;
		}

		public function value(){			
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
				$this->_value = $Value;
			}else{
				return($this->_value);
			}
		}
		
		public function __construct($Value){
			if (is_numeric(str_replace(".", NULL, $Value)) == TRUE || is_numeric(str_replace(",", NULL, $Value)) == TRUE || is_numeric(str_replace(" ", NULL, $Value)) == TRUE){
				$this->value($Value);
			}else{
        		throw new Exception("Exception thrown invalid : value at ::__construct()", 1);
			}
		}
		
		public function IsInteger(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			return(is_numeric($Value));
		}
		
		public function ToCurrency($UseLeadingSymbol = TRUE){
			$Value = $this->value();
			$Value = number_format($Value);
			$lead = $UseLeadingSymbol == true ? $this->currency_symbol : NULL;
			return($lead.$Value);
		}

		public function ToCurrencyString(){
			$r = trim($this->ToString());
			return $r != NULL ? $r . " " . $this->currency_string : NULL;
		}

		// Main Function : Return as Default property String //
		public function ToString(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$afterComa = NULL;
			if(strpos($Value, $this->coma_separator) !== FALSE){
				$afterComa = explode($this->coma_separator, $Value)[1];
				$value = explode($this->coma_separator, $Value)[0];
			}
			
			$res = NULL;
			$len = strlen($Value);
			
			if(($len % 3) != 0){
				$Value = str_repeat("0", 15 - $len).$Value;
			}

			$res = $this->do_querys($Value);
			if($afterComa != NULL) $res.= $this->do_querys($afterComa);

			return $this->finishing_string($res);
		}
		
		// Extended Main Function : Return as Capital each Words //
		public function ToSentenceString(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$res = strtolower($this->ToString($Value));
			$result = "";
			$list = explode(" ", $res);
			foreach	($list as $l){
				$result .= ucfirst($l)." ";
			}
			return($result);
		}

		private function do_querys($Value){
			$result = NULL;
			$len = strlen($Value);
			$listSatuan = str_split($Value, 3);
			$indexsatuan = 0;
			$indexchar = 0;
			$started = FALSE;
			$skipnext = FALSE;
			$zerocounter = 0;
			foreach ($listSatuan as $satuan) {
				$listInteger = str_split($satuan, 1);
				$indexnilai = 0;
				foreach ($listInteger as $nilai) {
					if($skipnext){$skipnext = FALSE; $indexnilai++; $indexchar++; continue;};

					if($nilai == 0){
						if($started){
							$zerocounter ++;
							if($indexnilai == 1){
								
							}else if($indexnilai == 2) {
								if($zerocounter<=2) $result .= $this->satuan($len - $indexchar);
							}else if($indexnilai == 3){
								
							}
						}
					}else{
						$started = TRUE;
						$zerocounter = 0;
						if($indexnilai == 1){
							
						}else if($indexnilai == 2) {
							
						}else if($indexnilai == 3){
							
						}
						if($nilai == 1){
							if($indexnilai == 0){
								$result .= $this->FirstStringforOne.$this->initial_for_three_digits." ";
							}else if($indexnilai == 1){
								$skipnext = TRUE;
								$result .= $this->belasan(substr($Value, $indexchar, 2))." ";
								$result .= $this->satuan($len - ($indexchar + 1));
							}else{
								$result .= $this->to_number_string($nilai)." ";
								$result .= $this->satuan($len - $indexchar);
							}
						}else{
							$result .= $this->to_number_string($nilai)." ";
							$result .= $this->satuan($len - $indexchar);
						}
					}
					$indexnilai++;
					$indexchar++;
				}
				$indexsatuan++;
			}
			return $result;
		}

		private function belasan($i){
			$result = NULL;
			switch ($i) {
				case 10:
					$result = $this->FirstStringforOne.$this->initial_for_two_digits;
					break;
				case 11:
					$result = $this->FirstStringforOne.$this->initial_for_two_digits_low;
					break;
				case 12:
					$result = $this->string_number_Two." ".$this->initial_for_two_digits_low;
					break;
				case 13:
					$result = $this->string_number_Three." ".$this->initial_for_two_digits_low;
					break;
				case 14:
					$result = $this->string_number_Four." ".$this->initial_for_two_digits_low;
					break;
				case 15:
					$result = $this->string_number_Five." ".$this->initial_for_two_digits_low;
					break;
				case 16:
					$result = $this->string_number_Six." ".$this->initial_for_two_digits_low;
					break;
				case 17:
					$result = $this->string_number_Seven." ".$this->initial_for_two_digits_low;
					break;
				case 18:
					$result = $this->string_number_Eight." ".$this->initial_for_two_digits_low;
					break;
				case 19:
					$result = $this->string_number_Nine." ".$this->initial_for_two_digits_low;
					break;
				default:
					$result = NULL;
					break;
			};
			return $result;
		}

		private function satuan($index){
			$result = NULL;
			switch ($index){
				case 15:
					$result .= $this->initial_for_three_digits." ";
					break;
				case 14:
					$result .= $this->initial_for_two_digits." ";
					break;
				case 13:
					$result .= $this->initial_for_thrteen_digits." ";
					break;
				case 12:
					$result .= $this->initial_for_three_digits." ";
					break;
				case 11:
					$result .= $this->initial_for_two_digits." ";
					break;
				case 10:
					$result .= $this->initial_for_ten_digits." ";
					break;
				case 9:
					$result .= $this->initial_for_three_digits." ";
					break;
				case 8:
					$result .= $this->initial_for_two_digits." ";
					break;
				case 7:
					$result .= $this->initial_for_seven_digits." ";
					break;
				case 6:
					$result .= $this->initial_for_three_digits." ";
					break;
				case 5:
					$result .= $this->initial_for_two_digits." ";
					break;
				case 4:
					$result .= $this->initial_for_four_digits." ";
					break;
				case 3:
					$result .= $this->initial_for_three_digits." ";
					break;
				case 2:
					$result .= $this->initial_for_two_digits." ";
					break;
				case 1:
					
					break;
				default:
					
					break;
			}
			return $result;
		}

		// convert single number to string //
		private function to_number_string($i){
			$result = NULL;
			switch ($i){
				case 9:
					$result .= $this->string_number_Nine;
					break;
				case 8:
					$result .= $this->string_number_Eight;
					break;
				case 7:
					$result .= $this->string_number_Seven;
					break;
				case 6:
					$result .= $this->string_number_Six;
					break;
				case 5:
					$result .= $this->string_number_Five;
					break;
				case 4:
					$result .= $this->string_number_Four;
					break;
				case 3:
					$result .= $this->string_number_Three;
					break;
				case 2:
					$result .= $this->string_number_Two;
					break;
				case 1:
					$result .= $this->string_number_One;
					break;
				case 0:
					
					break;
				case $this->coma_separator:
					$result .= $this->string_for_Coma;
					break;
				default:
					
					break;
			}
			return $result;
		}
		
		private function finishing_string($String){
			// perbaiki angka belasan
			// $String = str_replace($this->FirstStringforOne." ".$this->initial_for_two_digits_low, $this->FirstStringforOne.$this->initial_for_two_digits_low, $String);
			if (trim($String)==$this->currency_string) {
				return NULL;
			}else{
				return $String;
			}
		}
	}
?>