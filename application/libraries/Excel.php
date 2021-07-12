<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	require_once(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'PHPExcel.php');
	require_once(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'Writer/Excel2007.php');
	require_once(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');

	class Excel{
		private $ExcelWorkSheet = array();
		public	$Default_Header_Style = array(
				  	'font' => array('bold' => true), // Set font nya jadi bold
				  	'alignment' => array(
				    	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				    	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				  	),
				  	'borders' => array(
				    	'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				    	'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				    	'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				   		'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
				  	)
				);
		public $Default_Style = array(
			  		'alignment' => array(
			    		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			  		),
			  		'borders' => array(
			    		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			    		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			    		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			    		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			  		)
				);
		
		public function __construct($Creator = "Shouts", $Title = "Ecxel File", $Subject = "none", $Description = "none"){
			// Panggil class PHPExcel nya
			$this->ExcelWorkSheet = new PHPExcel();
			// Settingan awal file excel
			$this->ExcelWorkSheet->getProperties()->setCreator($Creator)
			             ->setLastModifiedBy(date("d-m-Y"))
			             ->setTitle($Title)
			             ->setSubject($Subject)
			             ->setDescription($Description)
			             ->setKeywords($Title . " " . $Description);
			$this->ExcelWorkSheet->setActiveSheetIndex(0);
			$this->SetOrientation("landscape");
		}

		public function Reconstruct($Creator = "Shouts", $Title = "Ecxel File", $Subject = "none", $Description = "none"){
			// Panggil class PHPExcel nya
			$this->ExcelWorkSheet = new PHPExcel();
			// Settingan awal file excel
			$this->ExcelWorkSheet->getProperties()->setCreator($Creator)
			             ->setLastModifiedBy(date("d-m-Y"))
			             ->setTitle($Title)
			             ->setSubject($Subject)
			             ->setDescription($Description)
			             ->setKeywords($Title . " " . $Description);
			$this->ExcelWorkSheet->setActiveSheetIndex(0);
			$this->SetOrientation("landscape");
		}
		
		public function NewWorksheetFromFile($StreamPath){
			$this->ExcelWorkSheet = $this->OpenFile($StreamPath);
		}
		
		public function NewWorksheetFromArray($array, $rowStart=1){
			$kolomindex=65;
			$barisindex=$rowStart;
			foreach ($array as $row) {
				foreach ($row as $value) {
					$this->ExcelWorkSheet->setActiveSheetIndex(0)->setCellValue(chr($kolomindex).$barisindex, $value, PHPExcel_Cell_DataType::TYPE_STRING);
					$kolomindex++;
				};
				$barisindex++;
				$kolomindex=65;
			};
		}
		
		public function ToArray(){
			return($this->ExcelWorkSheet->getActiveSheet()->toArray(null, true, true ,true));
		}
		
		public function SetValue($Value, $Index="A1", $dataType = "String"){
			switch (strtolower($dataType)) {
				case 'string':
					$this->ExcelWorkSheet->setActiveSheetIndex(0)->setCellValueExplicit($Index, $Value, PHPExcel_Cell_DataType::TYPE_STRING);
					break;
				default:
					$this->ExcelWorkSheet->setActiveSheetIndex(0)->setCellValue($Index, $Value);
					break;
			}
		}
		
		public function SetCellValue($Value, $ColIndex = "A", $RowIndex = 1, $dataType = "String"){
			switch (strtolower($dataType)) {
				case 'string':
					$this->ExcelWorkSheet->setActiveSheetIndex(0)->setCellValueExplicit($ColIndex.$RowIndex, $Value, PHPExcel_Cell_DataType::TYPE_STRING);
					break;
				default:
					$this->ExcelWorkSheet->setActiveSheetIndex(0)->setCellValue($ColIndex.$RowIndex, $Value);
					break;
			}
		}
		
		public function GetCellValue($ColIndex = "A", $RowIndex = 1){
			$this->ExcelWorkSheet->setActiveSheetIndex(0)->getCellValue($ColIndex.$RowIndex);
		}
		
		public function SetStyle($Style, $Index="A1"){
			$this->ExcelWorkSheet->getActiveSheet()->getStyle($Index)->applyFromArray($Style);
		}
		
		public function SetCellStyle($Style, $ColIndex = "A", $RowIndex = 1){
			$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->applyFromArray($Style);
		}
		
		public function GetCellStyle($ColIndex = "A", $RowIndex = 1){
			return $this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex);
		}
		
		public function MergeCells($Start, $End){
			$this->ExcelWorkSheet->getActiveSheet()->mergeCells($Start.":".$End);
		}
		
		public function SetAutoSize($Value = true, $ColIndex = "A"){
			$this->ExcelWorkSheet->getActiveSheet()->getColumnDimension($ColIndex)->setAutoSize(true);
		}
		
		public function SetWidth($width, $ColIndex = "A"){
			$this->ExcelWorkSheet->getActiveSheet()->getColumnDimension($ColIndex)->setWidth($width);
		}
		
		public function SetHeight($height, $RowIndex = 1){
			$this->ExcelWorkSheet->getActiveSheet()->getRowDimension($RowIndex)->setRowHeight($height);
		}
		
		public function SetOrientation($Orientation = "LANDSCAPE"){
			switch (strtolower($Orientation)) {
				case 'landscape':
					$this->ExcelWorkSheet->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
					break;
				default:
					$this->ExcelWorkSheet->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_POTRAIT);
					break;
			}
		}

		public function SetFontBold($bool=true, $ColIndex = "A", $RowIndex = 1){
			$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getFont()->setBold($bool);
		}

		public function SetFontSize($size=15, $ColIndex = "A", $RowIndex = 1){
			$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getFont()->setSize($size);
		}

		public function SetHorizontalAligment($alignment="center", $ColIndex = "A", $RowIndex = 1){
			switch (strtolower($alignment)) {
				case 'center':
					$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					break;
				case 'left':
					$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					break;
				case 'right':
					$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					break;
				default:
					$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					break;
			}
		}

		public function SetVerticalAligment($alignment="center", $ColIndex = "A", $RowIndex = 1){
			switch (strtolower($alignment)) {
				case 'center':
					$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					break;
				case 'middle':
					$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_MIDDLE);
					break;
				case 'top':
					$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					break;
				case 'bottom':
					$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
					break;
				default:
					$this->ExcelWorkSheet->getActiveSheet()->getStyle($ColIndex.$RowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					break;
			}
		}
		
		public function Worksheet(){
			return($this->ExcelWorkSheet);
		}

		public function Download($filename="excelfile"){
			$this->ExcelWorkSheet->setActiveSheetIndex(0);

			// Proses file excel
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$filename.'".xlsx');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			// header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0excel nya

			$write = PHPExcel_IOFactory::createWriter($this->ExcelWorkSheet, 'Excel2007');
			$write->save('php://output');

		}
		
		private function OpenFile($StreamPath){
			// $_ExcelReader = new PHPExcel_Reader_Excel2007();
			// $LoadExcel = $_ExcelReader->load($StreamPath);
			$_ExcelReader = new PHPExcel_IOFactory();
			$LoadExcel = $_ExcelReader::load($StreamPath);
			
			$this->ExcelWorkSheet = $LoadExcel;
		}
	}
?>