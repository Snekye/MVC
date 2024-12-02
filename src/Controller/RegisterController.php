<?php
namespace App\Controller;

use App\DB;
use App\Model\User;
use App\Controller\AbstractController;

class RegisterController extends AbstractController {
    //8 char, upper, lower, number, special
    public const REGEX = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    public function index() {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])) {
            $db = new DB();
            if ($_POST['password'] !== $_POST['password2']) {
                $message = "Les mots de passe ne correspondent pas.";
            }
            else if (!preg_match($this::REGEX, $_POST['password'])) {
                $message = "Le mot de passe doit contenir au moins 8 charactères, et au moins une miniscule, une majuscule, un chiffre et un caractère spécial.";
            }
            else if (str_contains(strtolower($_POST['password']), strtolower($_POST['username']))) {
                $message = "Le mot  de passe ne doit pas contenir votre nom d'utilisateur";
            }
            else {
                $user = new User();
                $user->setPassword($_POST['password']);
                $user->setUsername($_POST['username']);
                $user->setRole("ROLE_USER");
                $db->saveOne($user);

                $message = "ok";
            }
        }

        $this->render("register", [
            "message" => isset($message) ? $message : "",
        ]);
    }
}