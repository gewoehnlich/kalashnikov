<?php

namespace Gewoehnlich\Kalashnikov\Repositories;

use Gewoehnlich\Kalashnikov\Core\Database;
use Gewoehnlich\Kalashnikov\DTO\WordDTO;
use PDO;

class WordRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function index(WordDTO $dto): string
    {
        $ending = mb_substr($dto->word, $dto->accentPosition - 1);

        $stmt = $this->db->prepare("
            SELECT * FROM words
        ");

        $stmt->execute([]);

        $result = $stmt->fetchAll();

        foreach ($result as $row) {
            $word = mb_convert_encoding($row['word'], 'Windows-1252', 'UTF-8');
            if (str_ends_with($word, $ending) && $word != $dto->word) {
                return $word;
            }
        }

        return '';
    }
}
