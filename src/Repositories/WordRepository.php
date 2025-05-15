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

    public function index(WordDTO $dto)
    {
        $ending = mb_substr($dto->word, $dto->accentPosition - 1);

        /*$stmt = $this->db->prepare("*/
        /*    SELECT * FROM words*/
        /*");*/
        /**/
        /*$stmt->execute([]);*/

        $stmt = $this->db->prepare("
            SELECT word FROM words
            WHERE
                (
                    accent_position < length AND
                    SUBSTRING(word, accent_position) = :ending
                )
                OR
                (
                    accent_position = length AND
                    RIGHT(word, 2) = :ending
                )
        ");

        $stmt->execute([
            'ending' => $ending,
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($result);

        return $result;
    }
}
