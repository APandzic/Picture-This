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
