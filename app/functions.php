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
     * @return string
     *
     */
    function getUserBiography(string $userId, PDO $pdo): string
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

        return $biography['biography'];
    }
}

if (!function_exists('json_response')) {
    /**
     * Create and return a JSON response.
     *
     * @param array $data
     * @param int $code
     *
     * @return string
     */
    function json_response(array $data = [], int $code = 200): string
    {
        // First we set the HTTP status code which will default to 200. If you want
        // to read more about status codes, please visit: https://httpstatuses.com/
        http_response_code($code);
        // We should always specify what kind of data is returned, in this case we
        // need to set the content type to JSON.
        header('Content-Type: application/json');
        // Conver the JSON data into a string.
        return json_encode($data);
    }
}

if (!function_exists('getLikes')) {
    /**
     * get all likes
     *
     * @param string $id
     * @param PDO $pde
     *
     * @return string
     */
    function getLikes(String $id, $pdo): array
    {
        $sql = 'SELECT * FROM likes WHERE posts_id=:id';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':id' => $id,
        ]);

        $likes = $statment->fetchAll(PDO::FETCH_ASSOC);

        return $likes;
    }
}

if (!function_exists('getLikesCounter')) {
    /**
     * get like count
     *
     * @param string $posts_id
     * @param PDO $pdo
     *
     * @return string
     */
    function getLikeCount(String $id, $pdo): string
    {
        $sql = 'SELECT * FROM likes WHERE posts_id=:id';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':id' => $id,
        ]);

        $likes = $statment->fetchAll(PDO::FETCH_ASSOC);

        $lenght = strval(count($likes));

        return $lenght;
    }
}

if (!function_exists('checkIfPostIsLiked')) {
    /**
     * Check if user has liked post.
     *
     * @param string $posts_id
     * @param string $user_id
     * @param PDO $pdo
     *
     * @return string
     */
    function checkIfPostIsLiked(String $posts_id, string $user_id, $pdo): string
    {
        $sql = 'SELECT * FROM likes WHERE posts_id=:postId AND users_id=:userId';

        $statement = $pdo->prepare($sql);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':postId' => $posts_id,
            ':userId' => $user_id,
        ]);

        if ($statement->fetch()) {
            $string = "unlike";
            return $string;
        } else {
            $string = "like";
            return $string;
        }
    }
}
