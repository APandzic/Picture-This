<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we upload a new avatar.

if (isset($_FILES['avatar'])) {

    // validations här så att användaren inte kan lägga in tecken.
    $avatar = $_FILES['avatar'];

    $oldFilename = $_SESSION['user']['profile_avatar'];

    // validates the file and change file name.
    if (count($_FILES) > 1) {
        $_SESSION['message'] = 'You are not allowed to upload multiple files.';
        redirect('/edit-avatar.php');
    }

    if ($avatar['size'] >= 3145728) {
        $_SESSION['message'] = 'The uploaded file '.$avatar['name'].' exceeded the filesize limit.';
        redirect('/edit-avatar.php');
    }

    if ($avatar['type'] === 'image/jpeg' || $avatar['type'] === 'image/jpg' || $avatar['type'] === 'image/png') {
        $destination = __DIR__.'/../../IMG-AVATAR/'.createUniqueFileName($_SESSION['user']['username'], $avatar['name']);
        move_uploaded_file($avatar['tmp_name'], $destination);
    } else {
        $_SESSION['message'] = 'The '.$avatar['name'].' image file type is not allowed.';
        redirect('/edit-avatar.php');
    }

    // update avatar string in DB.

    $pahtArray = explode('/', $destination);
    $avtarStringName = end($pahtArray);

    $statement = $pdo->prepare('UPDATE users SET profile_avatar=:stringPaht WHERE id=:id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':stringPaht' => $avtarStringName,
        ':id'         => $_SESSION['user']['id'],
    ]);

    // delets old avatar file.
    if ($oldFilename !== null && $oldFilename !== 'defaultavatar.png') {
        unlink(__DIR__.'/../../img-avatar/'.$oldFilename);
    }
    $_SESSION['user']['profile_avatar'] = $avtarStringName;
}
redirect('/home.php?id='.$_SESSION['user']['id']);
