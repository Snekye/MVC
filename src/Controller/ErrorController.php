<?php
namespace App\Controller;

use App\Controller\AbstractController;
class ErrorController extends AbstractController {
    const ERROR_MSGS = [
        "403" => "You do not have access to this resource",
        "404" => "The requested page does not exist",
        "500" => "Internal Server Error",
    ];
    public function index($error) {
        global $prefix;
        $errorMessage = $this::ERROR_MSGS[$error];

        $this->render("error", [
            "error" => $error,
            "errorMessage" => $errorMessage,
            "prefix" => $prefix,
        ]);
    }
}