<?php

namespace App\Services;

use League\Csv\Writer;
use League\Csv\CannotInsertRecord;

class CsvExporter
{
    private $filename;

    public function __construct($filename = 'report.csv')
    {
        $this->filename = $filename;
    }

    public function export(array $data)
    {
        $csv = Writer::createFromPath($this->filename, 'w+');
        $csv->setHeader(['ID', 'Material', 'Format', 'Finishing', 'Price', 'Date']);

        foreach ($data as $record) {
            try {
                $csv->insertOne($record);
            } catch (CannotInsertRecord $e) {
                // Handle the error appropriately
                error_log('Could not insert record: ' . $e->getMessage());
            }
        }

        return $this->filename;
    }
}