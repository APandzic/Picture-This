<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';

// In this file we upload a new avatar.


if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];

    if (count($_FILES) > 1) {
        $_SESSION['message'] = 'You are not allowed to upload multiple files.';
        redirect('/editavatar.php');
    }

    if ($avatar['size'] >= 3145728) {
        $_SESSION['message'] = 'The uploaded file ' . $avatar['name'] . ' exceeded the filesize limit.';
        redirect('/editavatar.php');
    }

    if ($avatar['type'] === 'image/jpeg' || $avatar['type'] === 'image/jpg' || $avatar['type'] === 'image/png') {


        // die(var_dump($avatar['name']));
        $destination = __DIR__ . '/../../IMG/' . $avatar['name'];
        move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);
        // die(var_dump($destination));
    } else {
        $_SESSION['message'] = 'The ' . $avatar['name'] . ' image file type is not allowed.';
        redirect('/editavatar.php');
    }
}
redirect('/editavatar');
