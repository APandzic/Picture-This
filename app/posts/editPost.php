<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';

// In this file we edit posts


if (isset($_FILES['post'], $_POST['description'], $_GET['id'])) {

    $id = trim(filter_var($_GET['id'], FILTER_SANITIZE_STRING));
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
    $post = $_FILES['post'];

    if ($post['name'] === "") {
        $statement = $pdo->prepare('UPDATE posts SET description=:description WHERE id=:id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':description' => $description,
            ':id' => $id,
        ]);
    }

    if ($post['name'] !== "") {

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
            $destination = __DIR__ . '/../../imgPosts/' . createUniqueFileName($_SESSION['user']['username'], $post["name"]);
            move_uploaded_file($post['tmp_name'], $destination);
        } else {
            $_SESSION['message'] = 'The ' . $post['name'] . ' image file type is not allowed.';
            redirect('/newPost.php');
        }

        // gets old filename and saves into variable
        $statement = $pdo->prepare('SELECT * FROM POSTS WHERE id=:id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':id' => $id,
        ]);

        $oldpost = $statement->fetch(PDO::FETCH_ASSOC);

        $oldFilename = $oldpost['post_img'];

        //update to new filename in db

        $pahtArray = explode("/", $destination);
        $postStringName = end($pahtArray);

        $statement = $pdo->prepare('UPDATE posts SET description=:description, post_img=:post_img WHERE id=:id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':description' => $description,
            ':post_img' => $postStringName,
            ':id' => $id,
        ]);

        // delets old avatar file.
        if ($oldFilename !== NULL) {
            unlink(__DIR__ . '/../../imgPosts/' . $oldFilename);
        }
    }
}

redirect('/');
