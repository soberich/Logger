<?php

// indicate namespace TOGETHER WITH separators IF there're ones
const NAMESPACE_NAME_WITH_SEPARTORS = "PSRLogger";

// base directory for the namespace
const BASE_PARENT_DIRECTORY = __DIR__;

spl_autoload_register
(
    function ($className)
        {
        $prefix = NAMESPACE_NAME_WITH_SEPARTORS;
        $base_dir = BASE_PARENT_DIRECTORY;

        // is there any namespace prefix at all?
        $len = strlen($prefix);
        if (strncmp($prefix, $className, $len) !== 0)
        {
            return;
        }
        // get the relative class name
        $relative_class = substr($className, $len);
        $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . '.php';
        // if the file exists, require it
        if (file_exists($file))
        {
            require $file;
        }
    }, true, true
);
