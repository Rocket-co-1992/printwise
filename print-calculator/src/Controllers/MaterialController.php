<?php

namespace App\Controllers;

use App\Models\Material;
use App\Utils\Database;

class MaterialController
{
    private $materialModel;

    public function __construct()
    {
        $this->materialModel = new Material();
    }

    public function index()
    {
        $materials = $this->materialModel->getAllMaterials();
        // Render the materials index view with the materials data
        echo $this->render('materials/index.twig', ['materials' => $materials]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $this->materialModel->createMaterial($data);
            header('Location: /materials');
            exit;
        }
        // Render the create material view
        echo $this->render('materials/create.twig');
    }

    public function edit($id)
    {
        $material = $this->materialModel->getMaterialById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $this->materialModel->updateMaterial($id, $data);
            header('Location: /materials');
            exit;
        }
        // Render the edit material view with the material data
        echo $this->render('materials/edit.twig', ['material' => $material]);
    }

    public function delete($id)
    {
        $this->materialModel->deleteMaterial($id);
        header('Location: /materials');
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