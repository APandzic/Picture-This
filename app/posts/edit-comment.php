<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['postid'])) {
    $statement = $pdo->prepare('SELECT * FROM comments WHERE id = :userId');
    $statement->execute([
        ':userId' => $_SESSION['user']['id']
    ]);

    if ($_SESSION['user']['id'] === false) {
        $_SESSION['message'] = 'Not your comment.';
    };


    $newcontent = trim(filter_var($_POST['editcomment'], FILTER_SANITIZE_STRING));



    $statement = $pdo->prepare('UPDATE comments SET content = :editcontent WHERE id = :id');
    $statement->execute([
        ':id' => $_POST['commentid'],
        ':editcontent' => $newcontent
    ]);


    redirect('/feed.php');
}
