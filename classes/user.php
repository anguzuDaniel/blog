<?php

/**
 * [creates a user in the database]
 */
class User
{
    /**
     * @var [type]
     */
    public $id;
    /**
     * @var [type]
     */
    public $username;
    /**
     * @var [type]
     */
    public $password;

    /**
     * @param mixed $conn
     * @param mixed $username
     * @param mixed $password
     * 
     * @return [type]
     */
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

    /**
     * @param mixed $conn
     * @param string $columns
     * 
     * @return [type]
     */
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
