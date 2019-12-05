<?php

spl_autoload_register(function ($className) {
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    $basename = basename($filename);

    if (is_readable($filename)) {
        require($filename);

        return;
    }

    if (is_readable($basename)) {
        require($basename);

        return;
    }
});