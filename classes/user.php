<?php

class User
{
    public $id;
    public $username;
    public $password;

    public static function authenticate($conn, $username, $password)
    {
        $sql = 'SELECT * 
                FROM user
                WHERE username = :username ';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        if ($user = $stmt->fetch()) {
            return password_verify($password, $user->password);
        }
    }

    public function getUserInfo($conn, $columns = '*')
    {

        $sql = "SELECT $columns FROM user WHERE id = :id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', 2, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        if ($user = $stmt->fetch()) {
            return $user;
        }
    }
}
