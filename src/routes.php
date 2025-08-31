<?php

use App\Controllers\IndexController;
use App\Controllers\EmailController;

$indexController = new IndexController();
$emailController = new EmailController();
require_once __DIR__ . '/Controllers/LoginController.php';
$loginController = new \App\Controllers\LoginController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/form':
        $indexController->form();
        break;
    case '/email':
        $emailController->send();
        break;
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginController->authenticate();
        } else {
            $loginController->showLoginForm();
        }
        break;
    default:
        $indexController->index();
        break;
}
