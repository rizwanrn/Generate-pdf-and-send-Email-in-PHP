<?php
// Put this file into Library and call in your Controller
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

class Pdf
{
    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='landscape'){
        $dompdf = new Dompdf\Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->load_html($html);
        $dompdf->render();
        $file = $dompdf->output();
        file_put_contents($filename, $file);
        return $filename;
    }
}
