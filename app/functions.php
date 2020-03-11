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
     */
    function insertUser(string $firstName, $lastName, $username, $email, $password, $pdo)
    {
        $avatar = 'defaultavatar.png';
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users(first_name, last_name, username, email, password, profile_avatar) VALUES(:firstName,:lastName,:username,:email,:password,:avatar)';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':firstName' => $firstName,
            ':lastName'  => $lastName,
            ':username'  => $username,
            ':email'     => $email,
            ':password'  => $hash,
            ':avatar'    => $avatar,
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
     */
    function createUniqueFileName(string $username, $filename)
    {
        $temp = explode('.', $filename);
        $newfilename = time().$username.'.'.end($temp);

        return $newfilename;
    }
}

if (!function_exists('getUserPosts')) {
    /**
     * Get all user posts.
     *
     * @param string $userId
     * @param PDO    $pdo
     *
     * @return array
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
     * Get one user post.
     *
     * @param string $userId
     * @param PDO    $pdo
     *
     * @return array
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
     *Get one user post.
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

if (!function_exists('getUsersAvatar')) {
    /**
     *  Get one user avatar.
     *
     *  @param string $userId
     * @param PDO $pdo
     *
     * @return string
     */
    function getUsersAvatar(string $userId, PDO $pdo): string
    {
        $sql = 'SELECT profile_avatar FROM users WHERE id=:id';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':id' => $userId,
        ]);

        $avatar = $statment->fetch(PDO::FETCH_ASSOC);

        return $avatar['profile_avatar'];
    }
}

if (!function_exists('getUsersUsername')) {
    /**
     *  Get one user username.
     *
     *  @param string $userId
     * @param PDO $pdo
     *
     * @return string
     */
    function getUsersUsername(string $userId, PDO $pdo): string
    {
        $sql = 'SELECT username FROM users WHERE id=:id';

        $statement = $pdo->prepare($sql);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':id' => $userId,
        ]);

        $username = $statement->fetch(PDO::FETCH_ASSOC);

        return $username['username'];
    }
}

if (!function_exists('getUsersFirstName')) {
    /**
     *  Get one user first name.
     *
     *  @param string $userId
     * @param PDO $pdo
     *
     * @return string
     */
    function getUsersFirstName(string $userId, PDO $pdo): string
    {
        $sql = 'SELECT first_name FROM users WHERE id=:id';

        $statement = $pdo->prepare($sql);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':id' => $userId,
        ]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user['first_name'];
    }
}

if (!function_exists('getUsersLastName')) {
    /**
     *  Get one user first name.
     *
     *  @param string $userId
     * @param PDO $pdo
     *
     * @return string
     */
    function getUsersLastName(string $userId, PDO $pdo): string
    {
        $sql = 'SELECT last_name FROM users WHERE id=:id';

        $statement = $pdo->prepare($sql);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':id' => $userId,
        ]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user['last_name'];
    }
}

if (!function_exists('getUserBiographyArray')) {
    /**
     * Get users Biography.
     *
     * @param string $userId
     * @param PDO    $pdo
     *
     * @return array
     */
    function getUserBiographyArray(string $userId, PDO $pdo): ?array
    {
        $sql = 'SELECT * FROM biographys WHERE user_id=:id';

        $statement = $pdo->prepare($sql);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':id' => $userId,
        ]);

        $biography = $statement->fetch(PDO::FETCH_ASSOC);

        // if there is a bio in db.
        if ($biography) {
            $rows = explode("\n", $biography['biography']);

            return $rows;
        }

        // if there is no bio in db.
        $emtyArray = [];

        return $emtyArray;
    }
}

if (!function_exists('getUserBiographyString')) {
    /**
     * Get users Biography.
     *
     * @param string $userId
     * @param PDO    $pdo
     *
     * @return array
     */
    function getUserBiographyString(string $userId, PDO $pdo): ?string
    {
        $sql = 'SELECT * FROM biographys WHERE user_id=:id';

        $statement = $pdo->prepare($sql);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':id' => $userId,
        ]);

        $biography = $statement->fetch(PDO::FETCH_ASSOC);

        return $biography['biography'];
    }
}

if (!function_exists('json_response')) {
    /**
     * Create and return a JSON response.
     *
     * @param array $data
     * @param int   $code
     *
     * @return string
     */
    function json_response(array $data = [], int $code = 200): string
    {
        http_response_code($code);

        header('Content-Type: application/json');

        return json_encode($data);
    }
}

if (!function_exists('getLikes')) {
    /**
     * get all likes.
     *
     * @param string $id
     * @param PDO    $pde
     *
     * @return string
     */
    function getLikes(string $id, $pdo): array
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

if (!function_exists('getfollowers')) {
    /**
     * get all followers.
     *
     * @param string $id
     * @param PDO    $pde
     *
     * @return string
     */
    function getfollowers(string $id, $pdo): array
    {
        $sql = 'SELECT * FROM follows WHERE follows_id=:id';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':id' => $id,
        ]);

        $followers = $statment->fetchAll(PDO::FETCH_ASSOC);

        return $followers;
    }
}

if (!function_exists('getfollowing')) {
    /**
     * get all user follows.
     *
     * @param string $id
     * @param PDO    $pde
     *
     * @return string
     */
    function getfollowing(string $id, $pdo): array
    {
        $sql = 'SELECT * FROM follows WHERE users_id=:id';

        $statment = $pdo->prepare($sql);

        if (!$statment) {
            die(var_dump($pdo->errorInfo()));
        }

        $statment->execute([
            ':id' => $id,
        ]);

        $following = $statment->fetchAll(PDO::FETCH_ASSOC);

        return $following;
    }
}

if (!function_exists('checkIfPostIsLiked')) {
    /**
     * Check if user has liked post.
     *
     * @param string $posts_id
     * @param string $user_id
     * @param PDO    $pdo
     *
     * @return string
     */
    function checkIfPostIsLiked(string $posts_id, string $user_id, $pdo): string
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
            $string = 'unlike';

            return $string;
        } else {
            $string = 'like';

            return $string;
        }
    }
}

if (!function_exists('checkIfUserFollowsAccount')) {
    /**
     * Check if user follows account.
     *
     * @param string $account_id
     * @param string $user_id
     * @param PDO    $pdo
     *
     * @return string
     */
    function checkIfUserFollowsAccount(string $account_id, string $user_id, $pdo): string
    {
        $sql = 'SELECT * FROM follows WHERE follows_id=:accountId AND users_id=:userId';

        $statement = $pdo->prepare($sql);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':accountId' => $account_id,
            ':userId'    => $user_id,
        ]);

        if ($statement->fetch()) {
            $string = 'unfollow';

            return $string;
        } else {
            $string = 'follow';

            return $string;
        }
    }
}

if (!function_exists('searchData')) {
    /**
     * search after users in db.
     *
     * @param string $search
     * @param PDO    $pdo
     *
     * @return string
     */
    function searchData(string $search, $pdo): array
    {
        $search = trim(filter_var($_POST['search'], FILTER_SANITIZE_STRING));

        $sql = 'SELECT * FROM users WHERE username LIKE :name OR first_name LIKE :name OR last_name LIKE :name';

        $statement = $pdo->prepare($sql);

        $statement->execute([
            'name' => '%'.$search.'%',
        ]);

        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($users as $user) {
            unset($user['password']);
            array_push($result, $user);
        }

        if ($users) {
            return $result;
        } else {
            $_SESSION['message'] = 'sorry, there is no one by this name';
            redirect('/search.php');
        }
    }

    if (!function_exists('getComments')) {
        /**
         * Get all comments from database.
         *
         * @param pdo $pdo
         * @param int $postId
         *
         * @return void
         */
        function getComments($pdo, $postId)
        {
            $sql = 'SELECT users.username, comments.content, comments.id FROM users INNER JOIN comments ON comments.user_id = users.id WHERE comments.post_id = :postid';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':postid' => $postId,
            ]);

            $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $comments;
        }
    }
    /**
     * Fetch all posts and add them to the feed.
     *
     * @param pdo $pdo
     *
     * @return void
     */
    function getFeed($pdo)
    {
        $getFeed = $pdo->query('SELECT posts.id, posts.user_id, posts.post_img, posts.description, users.first_name, users.last_name FROM posts INNER JOIN users ON users.id = posts.user_id ORDER BY posts.id DESC');

        $feedPosts = $getFeed->fetchAll(PDO::FETCH_ASSOC);

        return $feedPosts;
    }
}
