<?php

namespace App\Controller;

use App\Model\QuestionManager;

class QuizController extends AbstractController
{
    public function show(int $languageId, int $levelId, int $questionNum): string
    {
        if ($questionNum === 1) {
            $questionManager = new QuestionManager();
            $questions = $questionManager->selectQuizByLevelAndLanguage($levelId, $languageId);
            $_SESSION['questions'] = $questions;
        } else {
            $questions = $_SESSION['questions'];
        }

        //setcookie('level', $levelId);

        $nextQuestion = $questionNum + 1;

        if ($questionNum === 11) {
            header("Location: /congratulation");
            exit();
        }

        return $this->twig->render('quiz.html.twig', [
            'questions' => $questions,
            'numero' => $questionNum,
            'next' => $nextQuestion,
            'languageId' => $languageId,
            'levelId' => $levelId,
        ]);
    }

    public function showCongrat(): string
    {
        return $this->twig->render('congratulation.html.twig');
    }
}
