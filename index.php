<?php
require_once "src/autoloader.php";
require_once "src/database.php";
session_start();

$url = $_SERVER["REQUEST_URI"];
$prefix = substr($_SERVER["SCRIPT_NAME"],0,-10); //removing '/index.php' at the end
$route = substr($url,strlen($prefix));
$roles = isset($_SESSION["user"]) ? $_SESSION["user"]->getRoles() : ["PUBLIC_ACCESS"];

function matchroute($route, $controllerOptions = null) {
    global $roles;
    $allRoutes = json_decode(file_get_contents(__DIR__ . '/conf/routes.json'),true);

    foreach (array_keys($allRoutes) as $access) {
        if (isset($allRoutes[$access][$route])) {
            if (in_array($access, $roles)) {
                $controllerClass = "App\\Controller\\" . $allRoutes[$access][$route];
                $controller = new $controllerClass();
                $controller->index($controllerOptions);
                return;
            }
            else {
                matchroute("error", "403");
                return;
            }
        }
    }
    matchroute("error", "404");
}
matchroute($route);
?>
