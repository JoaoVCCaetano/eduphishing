<?php

use App\Controllers\IndexController;

$indexController = new IndexController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/index':
        $indexController->index();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}
