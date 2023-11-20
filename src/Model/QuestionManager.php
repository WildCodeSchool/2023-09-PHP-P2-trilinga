<?php

namespace App\Model;

//require_once 'db.php';

use PDO;

class QuestionManager extends AbstractManager
{
    public const TABLE = 'question';

    public function selectQuizByLevelAndLanguage(int $levelId, int $languageId): array
    {

        $statement = $this->pdo->prepare("SELECT q.id, q.entitled, a.content, a.is_true, a.url
        FROM (
            SELECT * FROM question
            WHERE level_id = :level_id AND language_id = :language_id
            ORDER BY RAND()
            LIMIT 10
        ) AS q
        JOIN answer AS a ON q.id = a.question_id");

        $statement->bindValue(':level_id', $levelId, PDO::PARAM_INT);
        $statement->bindValue(':language_id', $languageId, PDO::PARAM_INT);

         $statement->execute();
         return $statement->fetchAll();
    }

    public function insertQuestion(array $question): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`entitled`, `language_id`, `level_id` ) 
        VALUES (:entitled, :language_id, :level_id)");
        $statement->bindValue('entitled', $question['entitled'], PDO::PARAM_STR);
        $statement->bindValue('language_id', $question['language'], PDO::PARAM_INT);
        $statement->bindValue('level_id', $question['level'], PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function selectAllQuestionsWithAnswers(): array
    {
        $query = 'SELECT q.id, q.entitled, a.id as answerId, 
        a.content, lg.name as lg_name, 
        lv.name as lv_name FROM ' . static::TABLE .
        ' as q JOIN answer AS a ON q.id = a.question_id 
        JOIN language AS lg ON lg.id = q.language_id
        JOIN level AS lv ON lv.id = q.level_id';

        return $this->pdo->query($query)->fetchAll();
    }
    public function selectOneQuestionById(int $id): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->bindValue('entitled', $id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function update(array $question)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " JOIN answer AS a ON question.id = a.question_id
         SET `entitled` = :entitled, `id` = :id, `content` = :content, `url` = :url    WHERE id=:id");
        $statement->bindValue('id', $question['id'], PDO::PARAM_INT);
        $statement->bindValue('entitled', $question['entitled'], PDO::PARAM_STR);
        $statement->bindValue('content', $question['content'], PDO::PARAM_STR);
        $statement->bindValue('url', $question['url'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
