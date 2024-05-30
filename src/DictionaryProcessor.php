<?php

namespace Src;

require_once ("src/Pushers/PusherInterface.php");

use src\Pushers\PusherInterface;

class DictionaryProcessor
{
    private PusherInterface $pusher;

    public function __construct(PusherInterface $pusher)
    {
        $this->pusher = $pusher;
    }

    public function processFile(string $filePath)
    {

        if (!file_exists($filePath)) {
            throw new \Exception("Файл не существует: $filePath");
        }

        $handle = fopen($filePath, "r");
        if ($handle === false) {
            throw new \Exception("Не удалось открыть файл: $filePath");
        }

        while (($line = fgets($handle) )!== false) {
            $word = trim($line);
            $this->pusher->pushData($word);
        }

        fclose($handle);
    }
}










