<?php

use App\Controllers\IndexController;

$indexController = new IndexController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    default:
        $indexController->index();
        break;
        
}
