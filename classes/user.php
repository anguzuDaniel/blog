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


    public function getFollows($conn, $userFollowed)
    {
        $sql = "SELECT u.id, u.username AS follower
                , f.user_followed AS followed_user, 
                f.id AS follow_id
                FROM user AS u 
                LEFT JOIN `following` AS f 
                ON :user_followed = f.user_followed
                GROUP BY u.id";

        $stmt = $conn->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->bindValue(':user_followed', $userFollowed, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * addLike
     *
     * @param  mixed $conn
     * @param  mixed $articleId
     * @param  mixed $userId
     * @return void
     */
    public function addFollow($conn, $userFollowed)
    {
        $sql = "INSERT INTO `following`(user_id, user_followed) 
                SELECT {$_SESSION['user_id']}, :user_followed
                FROM articles
                WHERE EXISTS
                (
                    SELECT id FROM articles 
                    WHERE created_by = :user_followed
                ) AND NOT EXISTS (
                    SELECT id FROM `following` 
                    WHERE user_id = {$_SESSION['user_id']}
                    AND user_followed = :user_followed
                ) LIMIT 1";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':user_followed', $userFollowed, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * addLike
     *
     * @param  mixed $conn
     * @param  mixed $articleId
     * @param  mixed $userId
     * @return void
     */
    public function unFollow($conn, $id)
    {
        $sql = "DELETE FROM `following` 
                WHERE id  = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
