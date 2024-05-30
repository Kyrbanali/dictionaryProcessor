<?php

require_once "src/DictionaryProcessor.php";
use Src\DictionaryProcessor;

$processor = new DictionaryProcessor();

if (php_sapi_name() == "cli") {
    /* загрузка файла командной строкой
    php <file_name> <file_path> */
    $filePath = $argv[1];

    $processor->processFile($filePath);
} else {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["dictionaryFile"])) {
        $filePath = $_FILES["dictionaryFile"]["tmp_name"];

        $processor->processFile($filePath);
    }

}