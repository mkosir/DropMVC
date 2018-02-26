<?php
// Class names must be the same as class filenames
spl_autoload_register(function ($class) {
    // ReflectionClass can't be used since there is no class instance yet
    // $className = (new \ReflectionClass($class))->getShortName();

    // Remove namespace from string to get just class name - e.g. $class = core\Router
    // $className = array_pop(explode('\\', $class)); // $className = Router
    $className = basename(str_replace('\\', '/', $class));

    $pathCore           = '../core/'            . $className . '.php';
    $pathControllers    = '../app/controllers/' . $className . '.php';
    $pathModels         = '../app/models/'      . $className . '.php';
    $pathUtils          = '../utils/'           . $className . '.php';

    // strpos() — find the position of the first occurrence of a substring in a string
    // check if the file exists based on file path if it does, check if this file belongs to the corresponding
    // namespace, because classes can have the same name in different namespaces
    if (file_exists($pathCore) and (strpos($class, NS_CORE) !== false)) {
        require_once $pathCore;
    } elseif (file_exists($pathControllers) and (strpos($class, NS_CONTROLLERS) !== false)) {
        require_once $pathControllers;
    } elseif (file_exists($pathModels) and (strpos($class, NS_MODELS) !== false)) {
        require_once $pathModels;
    } elseif (file_exists($pathUtils) and (strpos($class, NS_UTILS) !== false)) {
        require_once $pathUtils;
    }
});