<?php 
	// Configuration File for My Library
class MyLib{	
	public $php_library = array("Integer","Currency","Image");

	public $js_library = array();
	
	 public function __construct(){
        spl_autoload_register(array($this, 'loader'));
    }
	
	public function loader($className){
        if (substr($className, 0, 6) == 'mylibs'){
        		require  APPPATH."libraries".DIRECTORY_SEPARATOR."mylib".DIRECTORY_SEPARATOR."php".str_replace('mylibs\\', DIRECTORY_SEPARATOR, $className).'.php';
        }
    }

}
?>