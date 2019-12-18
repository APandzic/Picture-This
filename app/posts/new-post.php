<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';

// In this file we upload a new post.

if (isset($_FILES['post'], $_POST['description'])) {

    $post = $_FILES['post'];
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING));

    // validates the file and change file name.
    if (count($_FILES) > 1) {
        $_SESSION['message'] = 'You are not allowed to upload multiple files.';
        redirect('/newPost.php');
    }

    if ($post['size'] >= 3145728) {
        $_SESSION['message'] = 'The uploaded file ' . $post['name'] . ' exceeded the filesize limit.';
        redirect('/newPost.php');
    }

    if ($post['type'] === 'image/jpeg' || $post['type'] === 'image/jpg' || $post['type'] === 'image/png') {
        $destination = __DIR__ . '/../../img-posts/' . createUniqueFileName($_SESSION['user']['username'], $post["name"]);
        move_uploaded_file($post['tmp_name'], $destination);
    } else {
        $_SESSION['message'] = 'The ' . $post['name'] . ' image file type is not allowed.';
        redirect('/newPost.php');
    }

    // update post into DB.

    $pahtArray = explode("/", $destination);
    $postStringName = end($pahtArray);

    $sql = 'INSERT INTO posts(user_id, post_img, description, date) VALUES(:user_id,:post_img,:description,:date)';

    $statment = $pdo->prepare($sql);

    if (!$statment) {
        die(var_dump($pdo->errorInfo()));
    }

    $statment->execute([
        ':user_id' => $_SESSION['user']['id'],
        ':post_img' => $postStringName,
        ':description' => $description,
        ':date' => date(DATE_ATOM),
    ]);
}
redirect('/');
