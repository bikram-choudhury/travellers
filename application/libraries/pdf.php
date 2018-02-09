 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
    
   				public function Header() {
        		$CI =& get_instance();
				$hub_id= $CI->session->userdata ('user_id');
				$hub_data= $CI->main_model->run_manual_query_with_return_row("select *  from users where id= 1 and user_type='007'" );
				//echo $hub_data;
				$html = '<table ><tr>
						<td  style=" "><img src="'.base_url().'assets/images/pdfheader.jpg" height="100px;" /> </td></tr></table>';
				$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
				
					}

   					 // Page footer
					public function Footer() {

					// Position at 15 mm from bottom
					$this->SetY(-15);
					// Set font
					$this->SetFont('helvetica', 'I', 8);
					// Page number

					 $image_file = ''.base_url().'assets/images/pdffooter.jpg';
					$this->Image($image_file, 0, 268, 220, "", "JPG", "", "T", false, 300, "", false, false, 0, false, false, false);
					//$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
					}

    
    
}
/*Author:Tutsway.com */  
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */