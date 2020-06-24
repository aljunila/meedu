<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/dompdf/lib/html5lib/Parser.php';
require APPPATH.'/libraries/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require APPPATH.'/libraries/dompdf/lib/php-svg-lib/src/autoload.php';
require APPPATH.'/libraries/dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;

class Pdfgenerator {
  public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->set_paper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
  }


}
