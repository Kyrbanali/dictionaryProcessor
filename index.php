<?php

use src\DictionaryProcessor;

$processor = new DictionaryProcessor();

if (php_sapi_name() == "cli") {
    /* загрузка файла командной строкой
    php <file_name> <file_path> */
    $fileName = $argv[0];
    $filePath = $argv[1];

    $processor->processFile($filePath);
} else {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["dictionaryFile"])) {
        $fileName = $_FILES["dictionaryFile"]["name"];
        $filePath = $_FILES["dictionaryFile"]["tmp_name"];

        $processor->processFile($filePath);
    }

}