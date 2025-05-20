<?php

namespace App\Controllers;

use App\Models\Finishing;
use App\Utils\Database;

class FinishingController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        $finishings = $this->db->query("SELECT * FROM finishings");
        // Render the index view with finishings data
        echo $this->render('finishing/index.twig', ['finishings' => $finishings]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];

            $this->db->query("INSERT INTO finishings (name, price) VALUES (:name, :price)", [
                ':name' => $name,
                ':price' => $price
            ]);

            header('Location: /finishings');
            exit;
        }

        // Render the create view
        echo $this->render('finishing/create.twig');
    }

    public function edit($id)
    {
        $finishing = $this->db->query("SELECT * FROM finishings WHERE id = :id", [':id' => $id]);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];

            $this->db->query("UPDATE finishings SET name = :name, price = :price WHERE id = :id", [
                ':name' => $name,
                ':price' => $price,
                ':id' => $id
            ]);

            header('Location: /finishings');
            exit;
        }

        // Render the edit view with finishing data
        echo $this->render('finishing/edit.twig', ['finishing' => $finishing]);
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM finishings WHERE id = :id", [':id' => $id]);
        header('Location: /finishings');
        exit;
    }

    private function render($template, $data = [])
    {
        // Assuming Twig is set up and available
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader);
        return $twig->render($template, $data);
    }
}