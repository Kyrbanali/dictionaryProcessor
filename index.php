<?php

set_error_handler('errorHandler');
set_exception_handler('exceptionHandler');

function errorHandler($errno, $errstr, $errfile, $errline) {
    logError("Error: [$errno] $errstr - $errfile:$errline");
}

function exceptionHandler($exception) {
    logError("Uncaught exception: " . $exception->getMessage());
}

function logError($error) {
    $logFile = __DIR__ . '/mysql.log';
    error_log(date('Y-m-d H:i:s') . " - $error\n", 3, $logFile);
}

require_once "src/Pushers/FilePusher.php";
require_once "src/DictionaryProcessor.php";

use Src\DictionaryProcessor;
use src\Pushers\FilePusher;

$pusher = new FilePusher();
$processor = new DictionaryProcessor($pusher);

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