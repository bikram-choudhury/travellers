<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('tcpdf/tcpdf.php');
//require_once('tcpdf/tcpdi.php');

class Pdfheaderfooter extends tcpdf {
 
  //Page header
  public function Header() {
    $html = ' <img src="'.base_url().'assets/images/pdfheader.jpg"   /> ';
 
    $this->SetFontSize(8);
    $this->WriteHTML($html, true, 0, true, 0);
  }
 
  // Page footer
  public function Footer() {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    $html = '<img width:"1000px;" src=""'.base_url().'assets/images/pdffooter.jpg"  " />';
 
    $this->SetFontSize(8);
    $this->WriteHTML($html, true, 0, true, 0);
  }
}

/* End of file Pdfheaderfooter.php */