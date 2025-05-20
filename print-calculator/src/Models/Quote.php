<?php

namespace App\Models;

use App\Utils\Database;

class Quote
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function createQuote($data)
    {
        $stmt = $this->db->prepare("INSERT INTO quotes (user_id, material_id, format_id, finishing_id, quantity, price, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$data['user_id'], $data['material_id'], $data['format_id'], $data['finishing_id'], $data['quantity'], $data['price']]);
        return $this->db->lastInsertId();
    }

    public function getQuote($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM quotes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateQuote($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE quotes SET material_id = ?, format_id = ?, finishing_id = ?, quantity = ?, price = ? WHERE id = ?");
        return $stmt->execute([$data['material_id'], $data['format_id'], $data['finishing_id'], $data['quantity'], $data['price'], $id]);
    }

    public function deleteQuote($id)
    {
        $stmt = $this->db->prepare("DELETE FROM quotes WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllQuotes()
    {
        $stmt = $this->db->query("SELECT * FROM quotes");
        return $stmt->fetchAll();
    }
}