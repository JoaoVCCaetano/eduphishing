<?php

use App\Controllers\IndexController;
use App\Controllers\EmailController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;

$indexController = new IndexController();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/form':
        $indexController->form();
        break;
    case '/email':
        $emailController = new EmailController();
        $emailController->send();
        break;
    case '/login':
        $loginController = new LoginController;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginController->authenticate();
        } else {
            $loginController->form();
        }
        break;
    case '/register':
        $registerController = new RegisterController;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $registerController->register();
        } else {
            $registerController->form();
        }
        break;
    case '/verify-email':
        $verifyController = new \App\Controllers\VerifyEmailController();
        $verifyController->verify();
        break;
    default:
        $indexController->index();
        break;
}
