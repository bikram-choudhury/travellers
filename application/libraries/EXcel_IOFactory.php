<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH."/third_party/PHPExcel/IOFactory.php";
class EXcel_IOFactory extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
 