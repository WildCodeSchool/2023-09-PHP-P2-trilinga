<?php

namespace App\Model;

use PDO;

class ModificationManager extends AbstractManager
{
    public const TABLE = 'question';

    // public function selectAllModif(array $question, array $answer): int
    // {

    //     $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`entitled`, `language_id`, `level_id` )
    //     VALUES (:entitled, :language_id, :level_id)");
    //     $statement->bindValue('entitled', $question['entitled'], PDO::PARAM_STR);
    //     $statement->bindValue('language_id', $question['language'], PDO::PARAM_INT);
    //     $statement->bindValue('level_id', $question['level'], PDO::PARAM_INT);

    //     $statement->execute();
    //     return $statement->fetchAll();
    // }
}
