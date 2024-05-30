<?php

namespace src\Pushers;

require_once "src/Pushers/PusherInterface.php";

class FilePusher implements PusherInterface
{
    public function pushData(string $word)
    {
        $firstLetter = mb_substr($word, 0, 1);
        $letterPath = __DIR__ . "/../../library/$firstLetter";

        if (!is_dir($letterPath)) {
            mkdir($letterPath, 0777, true);
        }

        $wordFilePath = "$letterPath/words.txt";
        file_put_contents($wordFilePath, $word . PHP_EOL, FILE_APPEND);

        $countFilePath = "$letterPath/count.txt";
        $letterCount = mb_substr_count(strtolower($word), strtolower($firstLetter));
        $currentCount = 0;
        if (file_exists($countFilePath)) {
            $currentCount = (int)file_get_contents($countFilePath);
        }

        file_put_contents($countFilePath, $letterCount + $currentCount);
    }

}