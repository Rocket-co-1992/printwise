<?php
require_once '../config/app.php';
require_once '../config/database.php';
require_once '../src/Utils/Database.php';
require_once '../src/Auth/Authentication.php';
require_once '../src/Auth/Authorization.php';
require_once '../src/Controllers/AuthController.php';
require_once '../src/Controllers/DashboardController.php';
require_once '../src/Controllers/MaterialController.php';
require_once '../src/Controllers/FormatController.php';
require_once '../src/Controllers/FinishingController.php';
require_once '../src/Controllers/CalculatorController.php';
require_once '../src/Controllers/ReportController.php';
require_once '../src/Services/PdfGenerator.php';
require_once '../src/Services/CsvExporter.php';
require_once '../src/Services/UpdateService.php';
require_once '../src/Api/CalculatorApi.php';

session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ($uri) {
    case '/login':
        $controller = new AuthController();
        $controller->login();
        break;
    case '/register':
        $controller = new AuthController();
        $controller->register();
        break;
    case '/dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;
    case '/materials':
        $controller = new MaterialController();
        $controller->index();
        break;
    case '/formats':
        $controller = new FormatController();
        $controller->index();
        break;
    case '/finishings':
        $controller = new FinishingController();
        $controller->index();
        break;
    case '/calculator':
        $controller = new CalculatorController();
        $controller->index();
        break;
    case '/reports':
        $controller = new ReportController();
        $controller->index();
        break;
    default:
        http_response_code(404);
        echo '404 Not Found';
        break;
}