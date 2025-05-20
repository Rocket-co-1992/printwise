<?php

namespace App\Controllers;

use App\Models\Format;
use App\Utils\Database;

class FormatController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        $formats = Format::all($this->db);
        // Render the index view with formats
        echo $this->render('formats/index.twig', ['formats' => $formats]);
    }

    public function create()
    {
        // Render the create view
        echo $this->render('formats/create.twig');
    }

    public function store($data)
    {
        $format = new Format($data);
        $format->save($this->db);
        // Redirect to index after saving
        header('Location: /formats');
    }

    public function edit($id)
    {
        $format = Format::find($id, $this->db);
        // Render the edit view with the format data
        echo $this->render('formats/edit.twig', ['format' => $format]);
    }

    public function update($id, $data)
    {
        $format = Format::find($id, $this->db);
        $format->update($data, $this->db);
        // Redirect to index after updating
        header('Location: /formats');
    }

    public function delete($id)
    {
        $format = Format::find($id, $this->db);
        $format->delete($this->db);
        // Redirect to index after deleting
        header('Location: /formats');
    }

    private function render($template, $data = [])
    {
        // Assuming Twig is set up and available
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader);
        return $twig->render($template, $data);
    }
}