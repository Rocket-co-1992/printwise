<?php

namespace App\Models;

use App\Utils\Database;

class Format
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO formats (name, width, height, price) VALUES (:name, :width, :height, :price)");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':width', $data['width']);
        $stmt->bindParam(':height', $data['height']);
        $stmt->bindParam(':price', $data['price']);
        return $stmt->execute();
    }

    public function read($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM formats WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE formats SET name = :name, width = :width, height = :height, price = :price WHERE id = :id");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':width', $data['width']);
        $stmt->bindParam(':height', $data['height']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM formats WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM formats");
        return $stmt->fetchAll();
    }
}