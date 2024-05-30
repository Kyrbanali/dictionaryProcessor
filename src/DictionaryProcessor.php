<?php

namespace src;

class DictionaryProcessor
{
    public function processFile($filePath)
    {
        if (!file_exists($filePath)) {
        }

        $handle = fopen($filePath, "r");
        if ($handle === false) {

        }

        while ($line = fgets($handle) !== false) {
            $word = trim($line);
            $this->processWord($word);
        }

        fclose($handle);
    }

    private function processWord($word)
    {
        $firstLetter = substr($word, 0, 1);
        $letterPath = __DIR__ . "/../library/$firstLetter";

        if (!is_dir($letterPath)) {
            mkdir($letterPath, 0777, true);
        }

        $wordFilePath = "$letterPath/words.txt";
        file_put_contents($wordFilePath, $word . PHP_EOL, FILE_APPEND);

        $countFilePath = "$letterPath/count.txt";
        $letterCount = substr_count(strtolower($word), strtolower($firstLetter));
        $currentCount = 0;
        if (file_exists($countFilePath)) {
            $currentCount = (int)file_get_contents($countFilePath);
        }
        file_put_contents($countFilePath, $letterCount + $currentCount);
    }

}