<?php 
	namespace mylibs;
	class Image{
		private $img = NULL;
		
		public function __construct($Stream){
			try{
				$this->img = $this->BLOBData($Stream);
			}catch (UnexpectedValueException $e){
				try{
					$this->img = $this->BLOBData($Stream["tmp_name"]);
				}catch (UnexpectedValueException $e){
					throw new Exception("Stream given is invalid :: __construct()",1);
				}		
			}
		}
		
		private function ImageData(){
			if (func_num_args() == 1){
				try{
					if (file_exists(func_get_arg(0))){
						return(file_get_contents(func_get_arg(0)));
					}else{
						return(stripslashes(func_get_arg(0)));
					}
				}catch (UnexpectedValueException $e){
					return(stripslashes($this->img));		
				}
			}else{
				return(stripslashes($this->img));
			}
		}
		
		private function BLOBData(){
			if (func_num_args() == 1){
				try{
					if (file_exists(func_get_arg(0))){
						return(addslashes(file_get_contents(func_get_arg(0))));
					}else{
						return(addslashes(func_get_arg(0)));
					}
				}catch (UnexpectedValueException $e){
					return($this->img);		
				}
			}else{
				return($this->img);
			}
		}
		
		public function SetImage($StreamPath){
			try{
				$this->img = $this->BLOBData($Stream["tmp_name"]);
			}catch (UnexpectedValueException $e){
				try{
					$this->img = $this->BLOBData($Stream);
				}catch (UnexpectedValueException $e){
					throw new Exception("Stream given is invalid :: SetImage()",1);
				}		
			}
		}
		
		public function SetImageFromBLOB($BLOB){
			try{
				$this->img = $BLOB;
			}catch (Exception $e){
				throw new Exception("BLOB given is invalid :: SetImageFromBLOB()",1);
			}
		}
		
		public function ToHTMLImage($Width = 200, $Height = 200, $Style = NULL, $Class = NULL, $Name = NULL, $Id = NULL){
			if (! empty($Style)){$Style = "style='$Style' ";};
			if (! empty($Class)){$Class = "class='$Class' ";};
			if (! empty($Name)){$Name = "name='$Name' ";};
			if (! empty($Id)){$Id = "id='$Id' ";};
			if (is_numeric($Width) && $Width >= 1){$Width .= "px";};
			if (is_numeric($Height) && $Height >= 1){$Height .= "px";};
			return("<img src='data:image/jpeg;base64,".base64_encode($img)."' alt='Images' ".$Style.$Class.$Name.$Id."width='".$Width."' height='".$Height."'>");
		}
		
		public function HTMLImageFromFile($StreamPath, $Width = 200, $Height = 200, $Style = NULL, $Class = NULL, $Name = NULL, $Id = NULL){
			if (! empty($Style)){$Style = "style='$Style' ";};
			if (! empty($Class)){$Class = "class='$Class' ";};
			if (! empty($Name)){$Name = "name='$Name' ";};
			if (! empty($Id)){$Id = "id='$Id' ";};
			if (is_numeric($Width) && $Width >= 1){$Width .= "px";};
			if (is_numeric($Height) && $Height >= 1){$Height .= "px";};
			$blob = NULL;
			try{
				$blob = addslashes(file_get_contents($StreamPath));
			}catch (Exception $e){
				$blob = addslashes(stream_get_contents($StreamPath));
			}
			return("<img src='data:image/jpeg;base64,".base64_encode($blob)."' alt='Images' ".$Style.$Class.$Name.$Id."width='".$Width."' height='".$Height."'>");
		}
		
		public function HTMLImageFromBlob($Blob, $Width = 200, $Height = 200, $Style = NULL, $Class = NULL, $Name = NULL, $Id = NULL){
			if (! empty($Style)){$Style = "style='$Style' ";};
			if (! empty($Class)){$Class = "class='$Class' ";};
			if (! empty($Name)){$Name = "name='$Name' ";};
			if (! empty($Id)){$Id = "id='$Id' ";};
			if (is_numeric($Width) && $Width >= 1){$Width .= "px";};
			if (is_numeric($Height) && $Height >= 1){$Height .= "px";};
			return("<img src='data:image/jpeg;base64,".base64_encode($Blob)."' alt='Images' ".$Style.$Class.$Name.$Id."width='".$Width."' height='".$Height."'>");
		}
		
		public function ToBLOB(){
			if (func_num_args() == 1){
				return($this->BLOBData(func_get_arg(0)));
			}else{
				return($this->BLOBData());
			}
		}
		
		public function GetThumbnail($StreamPath = NULL, $ID = NULL, $Width = 134, $Height = 134){
			$temp = "new_content";
			
			if (empty($StreamPath)){
				$data_img = stripslashes($this->img);
				file_put_contents($temp, $data_img);
				$StreamPath=$temp;
			}
			
			$arr_image_details = getimagesize($StreamPath);
			$original_width = $arr_image_details[0];
			$original_height = $arr_image_details[1];

			if ($original_width > $original_height) {
				$new_width = $Width;
				$new_height = intval($original_height * $new_width / $original_width);
			} else {
				$new_height = $Height;
				$new_width = intval($original_width * $new_height / $original_height);
			}
			
			$dest_x = intval(($Width - $new_width) / 2);
			$dest_y = intval(($Height - $new_height) / 2);

			if ($arr_image_details[2] == IMAGETYPE_GIF) {
				$imgt = "ImageGIF";
				$imgcreatefrom = "ImageCreateFromGIF";
			}
			if ($arr_image_details[2] == IMAGETYPE_JPEG) {
				$imgt = "ImageJPEG";
				$imgcreatefrom = "ImageCreateFromJPEG";
			}
			if ($arr_image_details[2] == IMAGETYPE_PNG) {
				$imgt = "ImagePNG";
				$imgcreatefrom = "ImageCreateFromPNG";
			}
			
			if ($imgt) {
				$old_image = $imgcreatefrom($StreamPath);
//				$new_image = imagecreatetruecolor($Width, $Height);
				$new_image = imagecreate($Width, $Height);
				imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
				$filename_no_ext = explode('.', $StreamPath);
				$imgt($new_image, $filename_no_ext[0]."_thumbs".$ID.".jpg");
				$blob = $this->ToBLOB($filename_no_ext[0]."_thumbs".$ID.".jpg");
				unlink($temp);
				unlink($filename_no_ext[0]."_thumbs".$ID.".jpg");
				return($blob);
			}
		}
		
		public function CreateThumbnail($OutputPath=NULL, $StreamPath = NULL, $ID = NULL, $Width = 134, $Height = 134){
			if (empty($OutputPath)){
				$temp = "new_content";				
			}else{
				if (file_exists($OutputPath)){
					$temp = $OutputPath."new_content";
				}else{
					throw Exception ("Output Folder is not valid");
				}
			}
			
			if (empty($StreamPath)){
				$data_img = stripslashes($this->img);
				file_put_contents($temp,$data_img);
				$StreamPath=$temp;
			}
			
			$arr_image_details = getimagesize($StreamPath);
			$original_width = $arr_image_details[0];
			$original_height = $arr_image_details[1];

			if ($original_width > $original_height) {
				$new_width = $Width;
				$new_height = intval($original_height * $new_width / $original_width);
			} else {
				$new_height = $Height;
				$new_width = intval($original_width * $new_height / $original_height);
			}
			
			$dest_x = intval(($Width - $new_width) / 2);
			$dest_y = intval(($Height - $new_height) / 2);

			if ($arr_image_details[2] == IMAGETYPE_GIF) {
				$imgt = "ImageGIF";
				$imgcreatefrom = "ImageCreateFromGIF";
			}
			if ($arr_image_details[2] == IMAGETYPE_JPEG) {
				$imgt = "ImageJPEG";
				$imgcreatefrom = "ImageCreateFromJPEG";
			}
			if ($arr_image_details[2] == IMAGETYPE_PNG) {
				$imgt = "ImagePNG";
				$imgcreatefrom = "ImageCreateFromPNG";
			}

			if ($imgt) {
				$old_image = $imgcreatefrom($StreamPath);
				$new_image = imagecreatetruecolor($Width, $Height);
				imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
				$filename_no_ext = explode('.', $StreamPath);
				$imgt($new_image, $filename_no_ext[0]."_thumbs".$ID.".jpg");
				unlink($temp);
				return($filename_no_ext[0]."_thumbs".$ID.".jpg");
			}
		}
		
		public function ImageType(){
			$ImgType = NULL;
			if (func_num_args() == 1){
				$source = NULL;
				
				try{
					if (file_exists(func_get_arg(0))){
						$source = func_get_arg(0);
					}else{
						file_put_contents("temp/temp_content", $this->ImageData(func_get_arg(0)));
						$source = "temp/temp_content";
					}
				}catch (UnexpectedValueException $e){
					file_put_contents("temp/temp_content", stripslashes(func_get_arg(0)));
					$source = "temp/temp_content";		
				}
			}else{
				try{
					file_put_contents("temp/temp_content", $this->ImageData());
					$source = "temp/temp_content";
				}catch (UnexpectedValueException $e){
					throw new Exception("Unexpcted error while creating temp file", 1);
				}
				
			}
			
			if (file_exists($source)){
				$arr_image_details = getimagesize($source);
			}else{
				throw new Exception("Unexpcted error while checking image type", 1);
			}
			
			switch ($arr_image_details[2]){
				case IMAGETYPE_GIF:
					$ImgType = "gif";
					break;
				case IMAGETYPE_JPEG:
					$ImgType = "jpg";
					break;
				case IMAGETYPE_PNG:
					$ImgType = "png";
					break;
				default:
					$ImgType = $arr_image_details[2];
					break;
			}
			unlink($source);
			return($ImgType);
		}
		
		public function SaveImage($DestinationPath){
			try{
				if(is_dir($DestinationPath)){
					if(substr($DestinationPath, -1) == "/"){
						$name = $DestinationPath."_image";
					}else{
						$name = $DestinationPath."/_image";
					}
					file_put_contents($name, $this->ImageData());
					$new_name = $DestinationPath."image_".date("Yhis").".".$this->ImageType($name);
					rename($name,$new_name);
				}else{
					file_put_contents($DestinationPath, $this->ImageData());
				}
				return(true);
			}catch (UnexpectedValueException $e){
				return(false);
			}
		}
	}
?>