<?php

namespace App\Model;

use PDO;

class AnswerManager extends AbstractManager
{
    public const TABLE = 'answer';

    public function insertAnswer(string $content, bool $isTrue, int $questionId, string $url = null): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`url`, `content`, `is_true`, `question_id`) 
        VALUES (:url, :content, :is_true, :question_id)");
        $statement->bindValue('url', $url, PDO::PARAM_STR);
        $statement->bindValue('content', $content, PDO::PARAM_STR);
        $statement->bindValue('is_true', $isTrue, PDO::PARAM_INT);
        $statement->bindValue('question_id', $questionId, PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function selectThreeAnswerByIdWithQuestion(int $id): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE question_id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}
