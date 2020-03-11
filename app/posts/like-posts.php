<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';

header("Content-Type: application/json");

// In this file we edit posts

if (isset($_POST['id'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
    ;

    $statement = $pdo->prepare('SELECT * FROM likes WHERE posts_id=:post_id and users_id=:user_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':post_id' => $id,
        ':user_id' => $_SESSION['user']['id'],
    ]);

    if ($statement->fetch()) {
        $statement = $pdo->prepare('DELETE FROM likes WHERE posts_id=:post_id and users_id=:user_id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':post_id' => $id,
            ':user_id' => $_SESSION['user']['id'],

        ]);

        $likes = getLikes($id, $pdo);
        $lenght = strval(count($likes));

        echo json_response([
            'id' => $id,
            'counts' => $lenght,
        ]);
    } else {
        $statement = $pdo->prepare('INSERT INTO likes (posts_id, users_id) VALUES (:post_id, :user_id)');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':post_id' => $id,
            ':user_id' => $_SESSION['user']['id'],
        ]);

        $likes = getLikes($id, $pdo);
        $lenght = strval(count($likes));

        echo json_response([
            'id' => $id,
            'counts' => $lenght,
        ]);
    }
}
