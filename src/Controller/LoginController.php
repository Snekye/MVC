<?php
namespace App\Controller;

use App\DB;
use App\Model\User;

use App\Controller\AbstractController;
class LoginController extends AbstractController {
    public function index() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $db = new DB();
            $query = $db->pdo->prepare('
                SELECT *
                FROM user
                WHERE username = :username');
        
            $query->bindParam(':username', $_POST['username']);
            $query->execute();
            $userFound = $query->fetch();
        
            if (!$userFound) {
                $message = 'Identifiants inconnus.';
                $_POST['password'] = '';
            } else {
                $validPassword = password_verify($_POST['password'], $userFound['password']);
                if ($validPassword) {
        
                    $user = new User();
                    $user->setUsername($userFound['username']);
                    $user->setRole($userFound['role']);
                    $_SESSION["user"] = $user;
        
                    $message = 'Vous êtes maintenant connecté!';
        
                    if (isset($_POST['remember'])) {
                        setcookie("username",$_POST['username'],time()+(60*60*24*28)); //28j
                    }
                    else {
                        setcookie("username","",time()-10000); //Delete
                    }
                } else {
                    $message = 'Mot de passe incorrect.';
                    $_POST['password'] = '';
                }
            }
        }
        $this->render("login", [
            "message" => isset($message) ? $message : "",
        ]);
    }
}