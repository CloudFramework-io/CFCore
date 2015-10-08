<?php

/**
 * Cloud Framework Autoloader 1.0
 */
spl_autoload_register(function($class) {
    if(false !== strpos($class, 'CloudFramework\\')) {
        $classPath = str_replace('CloudFramework\\', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR, $class) . '.php';
        $classPath = str_replace("\\", DIRECTORY_SEPARATOR, $classPath);
        if (file_exists($classPath)) {
            require_once $classPath;
        } else {
            throw new ErrorException("Class '{$class}' not found", 500, 10);
        }
    }
});

if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
}
