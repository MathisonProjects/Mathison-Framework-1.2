<?php namespace App;

	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;
	use TCPDF;
	
	class mfwpdfs extends Eloquent {
	    protected $table = 'mfwpdfs';
		protected $fillable = ['name', 'description', 'pdfheader', 'pdffooter', 'rid'];

		public function createPdf($data,$report) {
			$pdf = new TCPDF;
	        $pdf->AddPage();
	        $pdf->writeHTML(nl2br($data->pdfheader).'<hr>
'.$report[0].'
<br /><br />'.$report[1].'<br />
<hr>'.nl2br($data->pdffooter));
	        $pdf->Output($data->name.'.pdf','D');
		}
	}
?>