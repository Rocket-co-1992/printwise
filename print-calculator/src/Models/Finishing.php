<?php

namespace App\Models;

use App\Utils\Database;

class Finishing
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO finishings (name, description, price) VALUES (:name, :description, :price)");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        return $stmt->execute();
    }

    public function read($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM finishings WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE finishings SET name = :name, description = :description, price = :price WHERE id = :id");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM finishings WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM finishings");
        return $stmt->fetchAll();
    }
}