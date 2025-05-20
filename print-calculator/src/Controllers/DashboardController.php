<?php

namespace App\Controllers;

use App\Models\Quote;
use App\Models\User;
use App\Utils\Database;

class DashboardController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        $statistics = $this->getStatistics();
        $history = $this->getQuoteHistory();

        // Render the dashboard view with statistics and history
        echo $this->render('dashboard/index.twig', [
            'statistics' => $statistics,
            'history' => $history
        ]);
    }

    private function getStatistics()
    {
        // Fetch statistics from the database
        $totalQuotes = $this->db->query("SELECT COUNT(*) FROM quotes")->fetchColumn();
        $totalUsers = $this->db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $totalMaterials = $this->db->query("SELECT COUNT(*) FROM materials")->fetchColumn();

        return [
            'totalQuotes' => $totalQuotes,
            'totalUsers' => $totalUsers,
            'totalMaterials' => $totalMaterials,
        ];
    }

    private function getQuoteHistory()
    {
        // Fetch quote history from the database
        return $this->db->query("SELECT * FROM quotes ORDER BY created_at DESC LIMIT 10")->fetchAll();
    }

    private function render($template, $data)
    {
        // Use Twig to render the template with the provided data
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader);

        return $twig->render($template, $data);
    }
}