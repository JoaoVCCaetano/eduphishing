<?php

namespace App\Controllers;


class IndexController {

    public function index() {
        include __DIR__ . '/../Views/index.php';
    }

    public function form(){
        include __DIR__ . '/../Views/form.php';
    }

    public function email(){
        include __DIR__ . '/../Views/index.php';
    }

}
