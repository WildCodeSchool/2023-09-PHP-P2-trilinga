<?php

namespace App\Controller;

use App\Model\AuthManager;

class AuthController extends AbstractController
{
    /**
     * List level
     */
    public function login(): string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $data = array_map('trim', $_POST);
            $data = array_map('htmlentities', $data);

            if (empty($data['email'])) {
                $errors[] = 'Veuillez renseigner le champ email';
            }

            if (empty($data['password'])) {
                $errors[] = 'Veuillez renseigner le champ mot de passe';
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Adresse email au mauvais format';
            }
            if (empty($errors)) {
                $authManager = new AuthManager();
                $user = $authManager->selectOneByEmail($data['email']);

                if ($user && password_verify($data['password'], $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: /admin');
                    exit();
                } else {
                    $errors[] = 'Mot de passe ou Email incorect';
                }
            }
        }
        return $this->twig->render('login.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        header('Location: /');
        exit();
    }
}
