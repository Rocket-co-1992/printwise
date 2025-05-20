<?php

namespace App\Controllers;

use App\Services\PdfGenerator;
use App\Services\CsvExporter;
use App\Models\Quote;

class ReportController
{
    protected $pdfGenerator;
    protected $csvExporter;

    public function __construct()
    {
        $this->pdfGenerator = new PdfGenerator();
        $this->csvExporter = new CsvExporter();
    }

    public function generatePdfReport($quoteId)
    {
        $quote = new Quote();
        $quoteData = $quote->getQuoteById($quoteId);

        if ($quoteData) {
            $this->pdfGenerator->generate($quoteData);
        } else {
            // Handle error: Quote not found
            http_response_code(404);
            echo "Quote not found.";
        }
    }

    public function generateCsvReport($quoteId)
    {
        $quote = new Quote();
        $quoteData = $quote->getQuoteById($quoteId);

        if ($quoteData) {
            $this->csvExporter->export($quoteData);
        } else {
            // Handle error: Quote not found
            http_response_code(404);
            echo "Quote not found.";
        }
    }

    public function index()
    {
        // Logic to display reports or list of quotes
        // This could involve fetching all quotes and rendering a view
    }
}