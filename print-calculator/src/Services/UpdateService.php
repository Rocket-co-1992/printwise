<?php

namespace App\Services;

use GuzzleHttp\Client;

class UpdateService
{
    private $currentVersion;
    private $githubApiUrl = 'https://api.github.com/repos/yourusername/yourrepository/releases/latest';

    public function __construct($currentVersion)
    {
        $this->currentVersion = $currentVersion;
    }

    public function checkForUpdates()
    {
        $client = new Client();
        $response = $client->get($this->githubApiUrl);
        $data = json_decode($response->getBody(), true);

        if (isset($data['tag_name'])) {
            $latestVersion = $data['tag_name'];
            if (version_compare($this->currentVersion, $latestVersion, '<')) {
                return $latestVersion;
            }
        }

        return null;
    }

    public function update($latestVersion)
    {
        $zipUrl = "https://github.com/yourusername/yourrepository/archive/refs/tags/{$latestVersion}.zip";
        $zipFile = tempnam(sys_get_temp_dir(), 'update') . '.zip';

        file_put_contents($zipFile, fopen($zipUrl, 'r'));

        $this->extractZip($zipFile);
        unlink($zipFile);
    }

    private function extractZip($zipFile)
    {
        $zip = new \ZipArchive();
        if ($zip->open($zipFile) === true) {
            $zip->extractTo(__DIR__ . '/../../'); // Adjust the path as necessary
            $zip->close();
        }
    }
}