<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['commentid'])) {

    $statement = $pdo->prepare('SELECT * FROM comments WHERE id = :userId');
    $statement->execute([
        ':userId' => $_SESSION['user']['id']
    ]);

    if ($_SESSION['user']['id'] === false) {
        $_SESSION['message'] = 'Not your comment.';
    };

    $statement = $pdo->prepare('DELETE FROM comments WHERE id = :commentId');
    $statement->execute([
        ':commentId' => $_POST['commentid']
    ]);


    $_SESSION['message'] = 'Comment deleted!';

    redirect('/feed.php');
}
