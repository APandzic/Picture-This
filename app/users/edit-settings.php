<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';

// In this file we change settings.


if (isset($_POST['username'])) {

    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare('SELECT * FROM users WHERE username=:username');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':username' => $username,
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user['username'] === $username) {
        $_SESSION['message'] = 'This username is already taken';
        redirect('/edit-settings.php');
    }

    $statement = $pdo->prepare('UPDATE users SET username=:username WHERE id=:id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':username' => $username,
        ':id' => $_SESSION['user']['id'],
    ]);

    $_SESSION['user']['username'] = $username;
}

if (isset($_POST['password'], $_POST['newPassword'], $_POST['confirmNewPassword'])) {
    $oldPassword = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // check new password
    if ($newPassword !== $confirmNewPassword) {
        $_SESSION['message'] = 'Your password and confirmation password do not match';
        redirect('/registration.php');
    }

    // retrieves user from db
    $statement = $pdo->prepare('SELECT * FROM users WHERE id=:id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $_SESSION['user']['id'],
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);


    // check if users password is correct
    if (password_verify($oldPassword, $user['password'])) {

        // change old password to new password in db.
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);

        $statement = $pdo->prepare('UPDATE users SET password=:password WHERE id=:id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':password' => $hash,
            ':id' => $_SESSION['user']['id'],
        ]);

        unset($user['password']); // not sure this is needed.
    } else {
        $_SESSION['message'] = 'Whoops! Looks like your password was incorrect. Please try again.';
        redirect('/login.php');
    }
}

if (isset($_POST['email'])) {

    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

    $statement = $pdo->prepare('SELECT * FROM users WHERE email=:email');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':email' => $email,
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user['email'] === $email) {
        $_SESSION['message'] = 'This email is already taken';
        redirect('/edit-settings.php');
    }

    $statement = $pdo->prepare('UPDATE users SET email=:email WHERE id=:id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':email' => $email,
        ':id' => $_SESSION['user']['id'],
    ]);

    $_SESSION['user']['email'] = $email;
}


redirect('/');
