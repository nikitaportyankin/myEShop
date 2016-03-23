<?php

spl_autoload_register('loadClass');
function loadClass($class_name)
{
    # List all the class directories in the array.
    $array_paths = array(
        '/models/',
        '/components/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}