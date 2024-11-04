<?php
namespace App\Controller;

use App\Controller\AbstractController;

class LogoutController extends AbstractController {
    public function index() {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
        $this->redirect("/login");
    }
}