<?php

require_once "src/Pushers/DBPusher.php";

use src\Pushers\DBPusher;

$pusher = new DBPusher();

try {
    $pusher->pushData();
} catch(Exception $e) {
    file_put_contents("mysql.log", $e->getMessage() . PHP_EOL, FILE_APPEND);
}
