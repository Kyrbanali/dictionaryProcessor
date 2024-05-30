<?php

namespace Src;


require_once ("src/Pushers/FilePusher.php");
require_once "src/Exceptions/DictionaryProcessorException.php";

use src\Pushers\FilePusher;
use Src\Exceptions\DictionaryProcessorException;

class DictionaryProcessor
{
    public function processFile($filePath)
    {
        $pusher = new FilePusher();
        $exception = new DictionaryProcessorException();

        if (!file_exists($filePath)) {
            $exception->exception();
        }

        $handle = fopen($filePath, "r");
        if ($handle === false) {
            $exception->exception();
        }

        while (($line = fgets($handle) )!== false) {
            $word = trim($line);
            print_r("\n$word\n");

            $pusher->pushData($word);

        }

        fclose($handle);
    }
}










