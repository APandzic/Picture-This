<?php

declare(strict_types=1);



if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

if (!function_exists('insertUser')) {
    /**
     * Insert new account to db.
     *
     * @param type $firstName
     * @param type $lastName
     * @param type $username
     * @param type $email
     * @param type $password
     * @param type $pdo
     *
     */
    function insertUser(string $firstName, $lastName, $username, $email, $password, $pdo)
    {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users(first_name, last_name, username, email, password) VALUES(:firstName,:lastName,:username,:email,:password)';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':username' => $username,
            ':email' => $email,
            ':password' => $hash,
        ]);
    }
}

if (!function_exists('createUniqueFileName')) {
    /**
     * when user uploads file this function will create a unique file name.
     *
     * @param type $username
     * @param type $filename
     *
     * @return string variable
     *
     */
    function createUniqueFileName(string $username, $filename)
    {
        $temp = explode(".", $filename);
        $newfilename = time() . $username . '.' . end($temp);

        return $newfilename;
    }
}

if (!function_exists('getUserPosts')) {
    /**
     * Get all user posts.
     *
     * @param string $userId
     * @param PDO $pdo
     *
     * @return array
     *
     */
    function getUserPosts(string $userId, PDO $pdo): array
    {

        $sql = 'SELECT * FROM posts WHERE user_id=:id ORDER BY date DESC';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':id' => $userId,
        ]);

        $posts = $statment->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }
}

if (!function_exists('getUserPostById')) {
    /**
     * Get one user post
     *
     * @param string $userId
     * @param PDO $pdo
     *
     * @return array
     *
     */
    function getUserPostbyid(string $postId, PDO $pdo): array
    {

        $sql = 'SELECT * FROM posts WHERE id=:id';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':id' => $postId,
        ]);

        $post = $statment->fetch(PDO::FETCH_ASSOC);

        return $post;
    }
}

if (!function_exists('getAllPosts')) {
    /**
     *
     *
     * @param PDO $pdo
     *
     * @return array
     */
    function getAllPosts(PDO $pdo): array
    {

        $sql = 'SELECT * FROM posts ORDER BY date DESC';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute();

        $posts = $statment->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }
}

if (!function_exists('getUserBiography')) {
    /**
     * Get users Biography
     *
     * @param string $userId
     * @param PDO $pdo
     *
     * @return array
     *
     */
    function getUserBiography(string $userId, PDO $pdo): array
    {

        $sql = 'SELECT * FROM biographys WHERE user_id=:id';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':id' => $userId,
        ]);

        $biography = $statment->fetch(PDO::FETCH_ASSOC);

        return $biography;
    }
}
