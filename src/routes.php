<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'level' => ['LevelController', 'index', ['language']],
    'quiz' => ['QuizController', 'show', ['language', 'level', 'q']],
    'congratulation' => ['QuizController', 'showCongrat',],
    'about' => ['AboutController', 'index',],
    'login' => ['AuthController', 'login',],
    'logout' => ['AuthController', 'logout'],
    'admin' => ['AdminController', 'index',],
    'admin/add' => ['AdminController', 'createQuiz',],
    'admin/content' => ['AdminController', 'showContent',],
    'admin/edit' => ['AdminController', 'edit', ['id']],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
];
