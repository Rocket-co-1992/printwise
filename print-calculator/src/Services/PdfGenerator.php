<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfGenerator
{
    private $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $this->dompdf = new Dompdf($options);
    }

    public function generatePdf($htmlContent, $fileName)
    {
        $this->dompdf->loadHtml($htmlContent);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        
        // Output the generated PDF to a file
        file_put_contents($fileName, $this->dompdf->output());
    }

    public function streamPdf($htmlContent, $fileName)
    {
        $this->dompdf->loadHtml($htmlContent);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        
        // Stream the generated PDF to the browser
        $this->dompdf->stream($fileName, ["Attachment" => true]);
    }
}