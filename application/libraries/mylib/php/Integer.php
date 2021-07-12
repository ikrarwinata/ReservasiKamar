<?php 
	namespace mylibs;
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Integer{
		public $coma_separator = ",";
		
		public $initial_for_two_digits_low = "Belas";
		public $initial_for_two_digits = "Puluh";
		public $initial_for_three_digits = "Ratus";
		public $initial_for_four_digits = "Ribu";
		public $initial_for_seven_digits = "Juta";
		public $initial_for_ten_digits = "Milyar";
		public $initial_for_thrteen_digits = "Triliyun";
		
		public $string_number_Zero = "Nol";
		public $string_number_One = "Satu";
		public $string_number_Two = "Dua";
		public $string_number_Three = "Tiga";
		public $string_number_Four = "Empat";
		public $string_number_Five = "Lima";
		public $string_number_Six = "Enam";
		public $string_number_Seven = "Tujuh";
		public $string_number_Eight = "Delapan";
		public $string_number_Nine = "Sembilan";
		public $FirstStringforOne = "Se";
		public $string_for_Coma = "Koma";
		
		private $_value = 0; // Default Number to Procces
		
		public function value(){			
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
				$this->_value = $Value;
			}else{
				return($this->_value);
			}
		}
		
		public function __construct($Value){
			if (is_numeric($Value) == true){
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
			
			$Value = $this->AuthenticateValue($Value);
			
			return(is_numeric($Value));
		}
		
		// Main Function : Return as Default property String //
		public function ToString(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$Value = $this->AuthenticateValue($Value);
			
			$result = "";
			$len = strlen($Value);
			
			$listInteger = str_split($Value, 1);
			$index = 0;
			$isSkip = false;
			
			foreach ($listInteger as $i){
				$now = $len - $index;
				
				if ($isSkip == true){
					$isSkip = false;
				}else{
					if ($i == 1){
						if ($now >= 2 and ($now == 14 || $now == 11 || $now == 8 || $now == 5 || $now == 2)){
							$nextIndex = $index + 1;
							$s = substr($Value, $index, 1);
							$nextS = substr($Value, $nextIndex, 1);
							if ($nextS >= 1){
								$result .= $this->to_number_string($nextS, true)." ";
								$result .= $this->initial_for_two_digits_low." ";
								$index ++;
								$isSkip = true;
								continue;
							}else{
								$ten = strtolower($this->to_number_string($s, true).$this->initial_for_two_digits." ");
								$result .= ucfirst($ten);
								$isSkip = true;
								$index ++;
								continue;
							}
						}else{
							$nextIndex = $index + 1;
							$nextS = substr($Value, $nextIndex, 1);
							if ($nextS >= 1){
								$result .= $this->to_number_string($i, true);
							}else{
								$result .= $this->to_number_string($i);
							}
						}
					}elseif ($i != 0){
						$result .= $this->to_number_string($i)." ";
					}
				}
				
				$index ++;
				
				if ($i == 0){continue;}
				switch ($now){
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
			}
			return $this->finishing_string($result);
		}
		
		// Extended Main Function : Return as Upper Case String //
		public function ToUpperString(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$result = strtoupper($this->ToString($Value));
			return($result);
		}
				
		// Extended Main Function : Return as Lower Case String //
		public function ToLowerString(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$result = strtolower($this->ToString($Value));
			return($result);
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
		
		// Extended Main Function : Return as Upper Case in the first String //
		public function ToUpperFirstString(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$result = strtolower($this->ToString($Value));
			return(ucfirst($result));
		}

		// convert single number to string //
		private function to_number_string($integer, $use_ext = false){
			$result = NULL;
			switch ($integer){
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
					if($use_ext == true){
						$result .= $this->FirstStringforOne;
					}else{
						$result .= $this->string_number_One;
					}
					break;
				case 0:
					
					break;
				default:
					
					break;
			}
			return $result;
		}
		
		// Fixing Unusual Word in the Result //
		private function finishing_string($String){
			if (strpos($String, $this->FirstStringforOne." ".$this->initial_for_two_digits_low) !== false){$String = str_replace($this->FirstStringforOne." ".$this->initial_for_two_digits_low, ucfirst(strtolower($this->FirstStringforOne.$this->initial_for_two_digits_low)), $String);}
			if (strpos($String, $this->FirstStringforOne.$this->initial_for_seven_digits) !== false){$String = str_replace($this->FirstStringforOne.$this->initial_for_seven_digits, $this->string_number_One." ".$this->initial_for_seven_digits, $String);}
			if (strpos($String, $this->FirstStringforOne.$this->initial_for_ten_digits) !== false){$String = str_replace($this->FirstStringforOne.$this->initial_for_ten_digits, $this->string_number_One." ".$this->initial_for_ten_digits, $String);}
			if (strpos($String, $this->FirstStringforOne.$this->initial_for_thrteen_digits) !== false){$String = str_replace($this->FirstStringforOne.$this->initial_for_thrteen_digits, $this->string_number_One." ".$this->initial_for_thrteen_digits, $String);}
			if (strpos($String, $this->FirstStringforOne.$this->initial_for_three_digits) !== false){$String = str_replace($this->FirstStringforOne.$this->initial_for_three_digits, $this->FirstStringforOne.strtolower($this->initial_for_three_digits), $String);}
			if (strpos($String, $this->FirstStringforOne.$this->initial_for_four_digits) !== false){$String = str_replace($this->FirstStringforOne.$this->initial_for_four_digits, $this->FirstStringforOne.strtolower($this->initial_for_four_digits), $String);}
			
			$se = $this->FirstStringforOne;
			$String = str_replace($se." ", $this->string_number_One." ", $String);
			if(substr($String, -2) == $se){
				$strLen = strlen($String) >= 3? strlen($String) - 2:0;
				$String = substr($String,0,$strLen).$this->string_number_One;
			}
			return $String;
		}
		
		private function AuthenticateValue($Value){
			if (empty($Value)){
				if (empty($this->value())){
					throw new Exception("Exception thrown : Empty value given", 1);
				}else{
					$Value = $this->value();
				}
			}
			return($Value);
		}
	}
?>