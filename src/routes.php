<?php

use App\Controllers\IndexController;

$indexController = new IndexController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/form':
        $indexController->form();
        break;
    case '/email':
        $indexController->email();
        break;
    default:
        $indexController->index();
        break;
        
}
