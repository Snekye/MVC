<?php

final class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {

            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';

            if (substr($class, 0, 3) == "App") {
                $file = "src".substr($file, 3);
            }

            if (file_exists($file)) {
                require $file;
                return true;
            }

            return false;
        });
    }
}

Autoloader::register();