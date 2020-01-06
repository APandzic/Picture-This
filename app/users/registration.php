<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';

// In this file we register new users.

if (isset($_POST['firstName'], $_POST['lastName'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'])) {

    $firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
    $lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_STRING));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];


    // check password
    if ($password !== $confirmPassword) {
        $_SESSION['message'] = 'Your password and confirmation password do not match';
        redirect('/registration.php');
    }

    // check if email or username exist
    $statement = $pdo->prepare('SELECT * FROM users WHERE username=:username OR email=:email');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':username' => $username,
        ':email' => $email,
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {

        if ($user['email'] === $email) {
            $_SESSION['message'] = 'This email is already registered';
            redirect('/registration.php');
        } elseif ($user['username'] === $username) {
            $_SESSION['message'] = 'This username is already taken';
            redirect('/registration.php');
        }
    }

    // insert new user to database
    insertUser($firstName, $lastName, $username, $email, $password, $pdo);

    //login the new user

    $statement = $pdo->prepare('SELECT * FROM users WHERE email=:email');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':email' => $email,
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    unset($user['password']);
    $_SESSION["user"] = $user;
}

redirect('/home.php');
