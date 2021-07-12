<?php 
	namespace mylibs;
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	require_once("Integer.php");

	class Currency extends Integer{
		public $currency_string = "Rupiah";
		public $currency_symbol = "Rp.";
		
		public $initial_for_two_digits_low = "belas";
		public $initial_for_two_digits = "puluh";
		public $initial_for_three_digits = "ratus";
		public $initial_for_four_digits = "ribu";
		public $initial_for_seven_digits = "juta";
		public $initial_for_ten_digits = "milyar";
		public $initial_for_thrteen_digits = "triliyun";
		
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
		
		private $_value = 0;
		
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
				parent::__construct($Value);
				$this->value($Value);
			}else{
				if ($this->IsIntegerOrCurrency($Value) == true){
					parent::__construct($this->ToInteger($Value));
					$this->value($Value);
				}else{
					throw new Exception("Exception thrown : invalid value at ::__construct(), given value : ".$Value, 1);
				}
			}
		}
		
		public function ToString(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$Value = $this->AuthenticateValue($Value);
			
			$string = parent::ToString();
			return($string);
		}
		
		public function ToCurrency($UseLeadingSymbol = true){
			$Value = $this->value();
			$Value = number_format($Value);
			$lead = $UseLeadingSymbol == true ? $this->currency_symbol : NULL;
			return($lead.$Value);
		}
		
		public function ToCurrencyString(){
			return(trim($this->ToString())." ".$this->currency_string);
		}
		
		public function IsCurrency(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$Value = $this->AuthenticateValue($Value);
			
			$result = false;
			try{
				$Value = $this->Currency_RemoveFormats($Value);
				if (is_numeric($Value) == true){$result = true;};
			}catch (UnexpectedValueException $e){
				return(false);
			}
			return($result);
		}
		
		public function IsIntegerOrCurrency(){
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$Value = $this->AuthenticateValue($Value);
			
			if (is_int($Value) == true){
				return(true);
			}else{
				$result = false;
				try{
					$Value = $this->Currency_RemoveFormats($Value);
					if (is_numeric($Value) == true){$result = true;};
				}catch (UnexpectedValueException $e){
					return(false);
				}
				return($result);
			}
		}
		
		public function ToInteger(){	
			if (func_num_args() == 1){
				$Value = func_get_arg(0);
			}else{
				$Value = $this->value();
			}
			
			$Value = $this->AuthenticateValue($Value);
			
			if ($this->IsIntegerOrCurrency($Value) == true){
				$result = NULL;
				try{
					$Value = $this->Currency_RemoveFormats($Value);
					if (is_int($Value) == true){
						$res = new Integer($Value);
						$result = $res->ToString();
					};
				}catch (UnexpectedValueException $e){
					return(NULL);
				}
				return($result);
			}
		}
		
		private function Currency_RemoveFormats($Value){
			$Value = str_replace(".", "", $Value);
			$Value = str_replace(",", "", $Value);
			
			$Value = strtolower($Value);
			$Value = str_replace($this->currency_string, NULL, $Value);
			$Value = str_replace($this->currency_symbol, NULL, $Value);

			$Value = str_replace($this->initial_for_two_digits_low, NULL, $Value);
			$Value = str_replace($this->initial_for_two_digits, NULL, $Value);
			$Value = str_replace($this->initial_for_three_digits, NULL, $Value);
			$Value = str_replace($this->initial_for_four_digits, NULL, $Value);
			$Value = str_replace($this->initial_for_seven_digits, NULL, $Value);
			$Value = str_replace($this->initial_for_ten_digits, NULL, $Value);
			$Value = str_replace($this->initial_for_thrteen_digits, NULL, $Value);

			$Value = str_replace($this->string_number_Zero, NULL, $Value);
			$Value = str_replace($this->string_number_One, NULL, $Value);
			$Value = str_replace($this->string_number_Two, NULL, $Value);
			$Value = str_replace($this->string_number_Three, NULL, $Value);
			$Value = str_replace($this->string_number_Four, NULL, $Value);
			$Value = str_replace($this->string_number_Five, NULL, $Value);
			$Value = str_replace($this->string_number_Six, NULL, $Value);
			$Value = str_replace($this->string_number_Seven, NULL, $Value);
			$Value = str_replace($this->string_number_Eight, NULL, $Value);
			$Value = str_replace($this->string_number_Nine, NULL, $Value);
			$Value = str_replace($this->FirstStringforOne, NULL, $Value);

			$Value = trim($Value);
			$Value = str_replace(" ", NULL, $Value);
			return($Value);
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