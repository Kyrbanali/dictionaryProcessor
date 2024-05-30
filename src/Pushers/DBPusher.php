<?php

namespace src\Pushers;

use PDO;
use PDOException;

class DBPusher implements PusherInterface
{
    private PDO $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO('mysql:host=;dbname=', '', '');
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function pushData(string $word)
    {
        $firstLetter = mb_substr($word, 0, 1);
        $letterCount = mb_substr_count(strtolower($word), strtolower($firstLetter));

        $sql = 'INSERT INTO words (first_letter, word, letter_count) VALUES (:first_letter, :word, :letter_count)';

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':first_letter', $firstLetter);
            $stmt->bindParam(':word', $word);
            $stmt->bindParam(':letter_count', $letterCount);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }
    }

}