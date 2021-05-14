<?php

/*
 * Autoload all classes based on their namespace
 */
spl_autoload_register(function ($class) {

    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $path = '/' . $class . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});