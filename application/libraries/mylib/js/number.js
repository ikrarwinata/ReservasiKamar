// JavaScript Document
class number extends Number{
	constructor(value){
		this.value = value;
		this.currency = currency;
		this.currency_simbol = "Rp.";
		this.initial_for_two_digits_low = "belas";
		this.initial_for_two_digits = "puluh";
		this.initial_for_three_digits = "ratus";
		this.initial_for_four_digits = "ribu";
		this.initial_for_seven_digits = "juta";
		this.initial_for_ten_digits = "milyar";
		this.initial_for_thrteen_digits = "triliyun";

		this.string_number_Zero = "Nol";
		this.string_number_One = "Satu";
		this.string_number_Two = "Dua";
		this.string_number_Three = "Tiga";
		this.string_number_Four = "Empat";
		this.string_number_Five = "Lima";
		this.string_number_Six = "Enam";
		this.string_number_Seven = "Tujuh";
		this.string_number_Eight = "Delapan";
		this.string_number_Nine = "Sembilan";
		this.FirstStringforOne = "Se";
	}
	
	FormatNumber() {
	  try {
		  var amount = this.value;
		var decimalCount = 2;
		  var decimal = ",";
		  var thousands = ".";
		decimalCount = Math.abs(decimalCount);
		decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

		var negativeSign = amount < 0 ? "-" : "";

		let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
		let j = (i.length > 3) ? i.length % 3 : 0;

		return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
	  } catch (e) {
		console.log(e);
	  }
	}
	
	IsNumberOrCurrency(){
		var x = this.value;
		x = x.replace(".", "");
		x = x.replace(",", "");
		x = x.replace(this.currency_simbol, "");

		if (Number.isInteger(this.value) === true){
			return true;							
		}else{
			return false;
		}
	}

	// Return as Formated Number //
	ToCurrency(){
		var x = this.value;
		x = x.replace(".", "");
		x = x.replace(",", "");
		x = x.replace(this.currency_simbol, "");

		var res = this.FormatNumber;

		return this.currency_simbol + res
	}

	// Main Function : Return as Default property String //
	ToString(){
		var result = "";
		var len = this.value.length;
		var listInteger = this.value.split("");
		var index = 0;
		var isSkip = false;

		numbers.forEach(listInteger as i){
			now = len - index;

			if (isSkip == true){
				isSkip = false;
			}else{
				if (i == 1){
					if (now >= 2 and (now == 14 || now == 11 || now == 8 || now == 5 || now == 2)){
						nextIndex = index + 1;
						s = substr(integer, index, 1);
						nextS = substr(integer, nextIndex, 1);
						if (nextS >= 1){
							result .= this->to_number_string(nextS, true)." ";
							result .= this->initial_for_two_digits_low." ";
							index ++;
							isSkip = true;
							continue;
						}else{
							ten = strtolower(this->to_number_string(s, true).this->initial_for_two_digits." ");
							result .= ucfirst(ten);
						}
					}elseif (now >= 2 and (now == 15 || now == 12 || now == 9 || now == 6 || now == 3)){
						result .= this->to_number_string(i, true);
					}else{
						result .= this->to_number_string(i, true);
					}
				}elseif (i !== 0){
					result .= this->to_number_string(i)." ";
				}
			}

			index ++;

			if (i == 0){continue;}
			switch (now){
					case 15:
						result .= this->initial_for_three_digits." ".this->initial_for_thrteen_digits." ";
						break;
					case 14:
						result .= this->initial_for_two_digits." ".this->initial_for_thrteen_digits." ";
						break;
					case 13:
						result .= this->initial_for_thrteen_digits." ";
						break;
					case 12:
						result .= this->initial_for_three_digits." ".this->initial_for_ten_digits." ";
						break;
					case 11:
						result .= this->initial_for_two_digits." ".this->initial_for_ten_digits." ";
						break;
					case 10:
						result .= this->initial_for_ten_digits." ";
						break;
					case 9:
						result .= this->initial_for_three_digits." ".this->initial_for_seven_digits." ";
						break;
					case 8:
						result .= this->initial_for_two_digits." ".this->initial_for_seven_digits." ";
						break;
					case 7:
						result .= this->initial_for_seven_digits." ";
						break;
					case 6:
						result .= this->initial_for_three_digits." ".this->initial_for_four_digits." ";
						break;
					case 5:
						result .= this->initial_for_two_digits." ".this->initial_for_four_digits." ";
						break;
					case 4:
						result .= this->initial_for_four_digits." ";
						break;
					case 3:
						result .= this->initial_for_three_digits." ";
						break;
					case 2:
						result .= this->initial_for_two_digits." ";
						break;
					case 1:

						break;
					default:

						break;
			}
		}
		if (addcurrency == true){result .= this->currency;}
		return this->finishing_string(result);
	}

	// Extended Main Function : Return as Upper Case String //
	function to_upper_string(integer = NULL, addcurrency = true){
		result = strtolower(this->to_string(integer, addcurrency));
		return(strtoupper(result));
	}


	// Extended Main Function : Return as Lower Case String //
	function to_lower_string(integer = NULL, addcurrency = true){
		result = strtolower(this->to_string(integer, addcurrency));
		return(result);
	}

	// Extended Main Function : Return as Capital each Words //
	function to_sentence_string(integer = NULL, addcurrency = true){
		res = strtolower(this->to_string(integer, addcurrency));
		result = "";
		list = explode(" ", res);
		foreach	(list as l){
			result .= ucfirst(l)." ";
		}
		return(result);
	}

	// Extended Main Function : Return as Upper Case in the first String //
	function to_upper_first_string(integer = NULL, addcurrency = true){
		result = strtolower(this->to_string(integer, addcurrency));
		return(ucfirst(result));
	}

	// convert single number to string //
	function to_number_string(integer, use_ext = false){
		result = NULL;
		switch (integer){
			case 9:
				result .= this->string_number_Nine;
				break;
			case 8:
				result .= this->string_number_Eight;
				break;
			case 7:
				result .= this->string_number_Seven;
				break;
			case 6:
				result .= this->string_number_Six;
				break;
			case 5:
				result .= this->string_number_Five;
				break;
			case 4:
				result .= this->string_number_Four;
				break;
			case 3:
				result .= this->string_number_Three;
				break;
			case 2:
				result .= this->string_number_Two;
				break;
			case 1:
				if(use_ext == true){
					result .= this->FirstStringforOne;
				}else{
					result .= this->string_number_One;
				}
				break;
			case 0:

				break;
			default:

				break;
		}
		return result;
	}

	// Fixing Unusual Word in the Result //
	function finishing_string(String){
		if (strpos(String, this->FirstStringforOne." ".this->initial_for_two_digits_low) !== false){String = str_replace(this->FirstStringforOne." ".this->initial_for_two_digits_low, ucfirst(strtolower(this->FirstStringforOne.this->initial_for_two_digits_low)), String);}
		if (strpos(String, this->FirstStringforOne.this->initial_for_seven_digits) !== false){String = str_replace(this->FirstStringforOne.this->initial_for_seven_digits, this->string_number_One." ".this->initial_for_seven_digits, String);}
		if (strpos(String, this->FirstStringforOne.this->initial_for_ten_digits) !== false){String = str_replace(this->FirstStringforOne.this->initial_for_ten_digits, this->string_number_One." ".this->initial_for_ten_digits, String);}
		if (strpos(String, this->FirstStringforOne.this->initial_for_thrteen_digits) !== false){String = str_replace(this->FirstStringforOne.this->initial_for_thrteen_digits, this->string_number_One." ".this->initial_for_thrteen_digits, String);}
		if (strpos(String, this->FirstStringforOne.this->currency) !== false){String = str_replace(this->FirstStringforOne.this->currency, this->string_number_One." ".this->currency, String);}
		return String;
	}
}