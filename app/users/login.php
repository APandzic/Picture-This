<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we login users.

if (isset($_POST['email'], $_POST['password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

    $statement = $pdo->prepare('SELECT * FROM users WHERE email=:email');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':email', $email);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // checks users email
    if ($email !== $user['email']) {
        $_SESSION['message'] = 'Whoops! Looks like you missed something. Please try again.';
        redirect('/index.php');
    }

    // checks users password
    if (password_verify($_POST['password'], $user['password'])) {
        unset($user['password']);

        $_SESSION['user'] = $user;
    } else {
        $_SESSION['message'] = 'Whoops! Looks like you missed something. Please try again.';
        redirect('/index.php');
    }
}

redirect('/home.php?id='.$_SESSION['user']['id']);
