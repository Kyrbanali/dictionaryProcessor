<?php

namespace src\Pushers;

use PDOException;

class DBPusher implements PusherInterface
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO('mysql:host=;dbname=', '', '');
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function pushData($word)
    {
        $firstLetter = $word[0];
        $letterCount = substr_count($word, $firstLetter);

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