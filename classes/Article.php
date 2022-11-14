<?php

class Article
{

    public static function getAll($conn)
    {
        $sql = "SELECT * FROM articles LIMIT 4";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getArticle
     *
     * @param  mixed $conn
     * @param  mixed $id
     * @return void
     */
    public static function getById($conn, $id, $columns = '*')
    {
        $sql = "SELECT $columns FROM articles WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);


        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }
}
