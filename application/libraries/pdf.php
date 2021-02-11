<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class pdf 
{	

	protected $ci;

	function __construct()
	{
		$this->ci =& get_instance();
	}

	function Print_toPdf($view, $file_name, $paper, $orientation)
	{
		// instantiate and use the dompdf class
		$dompdf = new Dompdf\Dompdf();
		$dompdf->loadHtml($view);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper($paper, $orientation);

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream($file_name.".pdf", array('Attachment' => 0));
	}
} ?>