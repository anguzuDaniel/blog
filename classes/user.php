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
    public static function authenticate($conn, $email, $password)
    {
        $sql = 'SELECT * 
                FROM `user`
                WHERE email = :email ';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        if ($user = $stmt->fetch()) {
            return password_verify($password, $user->password);
        }
    }

    public static function verifiyUser($conn, $email)
    {
        $sql = "UPDATE `user` SET verified = 1 WHERE email = :email";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public static function checkVerification($conn, $email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        return $stmt->fetch();
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

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        if ($user = $stmt->fetch()) {
            return $user;
        }
    }

    /**
     * @param mixed $conn
     * @param string $columns
     * 
     * @return [type]
     */
    public function deleteUser($conn)
    {

        $sql = "DELETE FROM `user` WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        if ($user = $stmt->fetch()) {
            return $user;
        }
    }


    /**
     * @param mixed $conn
     * @param string $columns
     * 
     * @return [type]
     */
    public function getUserByEmail($conn, $email, $columns = '*')
    {

        $sql = "SELECT $columns 
                FROM `user` 
                WHERE email = :email ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        if ($user = $stmt->fetch()) {
            return $user;
        }
    }

    public function addUser($conn, $email, $username, $firstname, $lastname, $password)
    {
        $sql = "INSERT INTO `user`(`email`, `username`, `first_name`, `last_name`, `password`) 
                VALUES (:email, :username, :firstname, :lastname, :password) ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);

        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * updatePassword
     *
     * @param  mixed $conn
     * @param  mixed $email
     * @param  mixed $password
     * @return 
     */
    public function updatePassword($conn, $email, $password)
    {
        $sql = "UPDATE `user` SET password = :password WHERE email = :email";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
