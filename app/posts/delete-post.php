<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';

// In this file we delete posts
if (isset($_GET['id'])) {

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

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

    // deletes coloum in db
    $statement = $pdo->prepare('DELETE FROM posts WHERE id=:id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $id,
    ]);

    if ($oldFilename !== NULL) {
        unlink(__DIR__ . '/../../imgPosts/' . $oldFilename);
    }
}
redirect('/');
