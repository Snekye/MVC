<?php
namespace App\Controller;
abstract class AbstractController {
    public function render($view, $data = []) {
        $controller = $this;
        extract($data);
        require "view/$view.php";
    }
    public function redirect($route) {
        $prefix = substr($_SERVER["SCRIPT_NAME"],0,-10); //removing '/index.php' at the end
        header("Location: $prefix$route");
    }
}