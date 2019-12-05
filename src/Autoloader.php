<?php

spl_autoload_register(function ($className) {
    $filename = trim(str_replace('AdventOfCode', '', str_replace('\\', DIRECTORY_SEPARATOR, $className)), ' /\\');
    $filename .= '.php';
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
