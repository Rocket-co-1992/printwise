<?php

namespace App\Controllers;

use App\Models\Material;
use App\Models\Format;
use App\Models\Finishing;
use App\Models\Quote;
use App\Utils\Database;

class CalculatorController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function calculatePrice($data)
    {
        // Validate input data
        if (!$this->validateInput($data)) {
            return ['error' => 'Invalid input data'];
        }

        // Fetch materials, formats, and finishings from the database
        $material = new Material($this->db);
        $format = new Format($this->db);
        $finishing = new Finishing($this->db);

        $materialData = $material->getById($data['material_id']);
        $formatData = $format->getById($data['format_id']);
        $finishingData = $finishing->getById($data['finishing_id']);

        // Calculate price based on selected options
        $price = $this->calculate($materialData, $formatData, $finishingData, $data['quantity']);

        return ['price' => $price];
    }

    private function validateInput($data)
    {
        return isset($data['material_id'], $data['format_id'], $data['finishing_id'], $data['quantity']) &&
               is_numeric($data['quantity']) && $data['quantity'] > 0;
    }

    private function calculate($material, $format, $finishing, $quantity)
    {
        // Example calculation logic
        $basePrice = $material['price'] + $format['price'] + $finishing['price'];
        return $basePrice * $quantity;
    }

    public function getMaterials()
    {
        $material = new Material($this->db);
        return $material->getAll();
    }

    public function getFormats()
    {
        $format = new Format($this->db);
        return $format->getAll();
    }

    public function getFinishings()
    {
        $finishing = new Finishing($this->db);
        return $finishing->getAll();
    }
}