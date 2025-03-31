<?php

use App\Controllers\IndexController;
use App\Controllers\EmailController;

$indexController = new IndexController();
$emailController = new EmailController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/form':
        $indexController->form();
        break;
    case '/email':
        $emailController->send();
        break;
    default:
        $indexController->index();
        break;
        
}
