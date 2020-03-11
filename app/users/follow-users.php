<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');

// In this file we edit posts

if (isset($_POST['id'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('SELECT * FROM follows WHERE follows_id=:follows_id and users_id=:user_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id'    => $_SESSION['user']['id'],
        ':follows_id' => $id,
    ]);

    if ($statement->fetch()) {
        $statement = $pdo->prepare('DELETE FROM follows WHERE follows_id=:follows_id and users_id=:user_id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':user_id'    => $_SESSION['user']['id'],
            ':follows_id' => $id,

        ]);

        $followers = getfollowers($id, $pdo);
        $lenght = strval(count($followers));

        echo json_response([
            'id'     => $id,
            'counts' => $lenght,
        ]);
    } else {
        $statement = $pdo->prepare('INSERT INTO follows (follows_id, users_id) VALUES (:follows_id, :user_id)');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':user_id'    => $_SESSION['user']['id'],
            ':follows_id' => $id,
        ]);

        $followers = getfollowers($id, $pdo);
        $lenght = strval(count($followers));

        echo json_response([
            'id'     => $id,
            'counts' => $lenght,
        ]);
    }
}
