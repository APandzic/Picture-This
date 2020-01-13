<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['search'])) {

    $search = trim(filter_var($_POST['search'], FILTER_SANITIZE_STRING));

    if (empty($search)) {

        echo json_response([
            'users' => 'no users',
        ]);
        exit;
    }

    $sql = "SELECT username, (first_name || \" \" || last_name) AS name, profile_avatar FROM users WHERE username LIKE :name OR name LIKE :name";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        'name' => "%" . $search . "%",
    ]);

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);


    echo json_response([
        'users' => $users,
    ]);
}
