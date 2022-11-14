<?php

class Article
{

    /**
     * id
     *
     * @var mixed
     */
    public $id;

    /**
     * image
     *
     * @var mixed
     */
    public $article_image;

    /**
     * title
     *
     * @var mixed
     */
    public $article_title;

    /**
     * content
     *
     * @var mixed
     */
    public $article_content;

    public static function getAll($conn)
    {
        $sql = "SELECT * FROM articles LIMIT 4";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getById($conn, $id, $columns = '*')
    {
        $sql = "SELECT $columns FROM articles WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');


        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }

    public function update($conn)
    {
        $sql = "UPDATE `articles` 
        SET `article_image` = :img, 
            `article_title` = :title, 
            `article_content` = :content 
        WHERE `id` = :id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':img', $this->article_image, PDO::PARAM_STR);
        $stmt->bindValue(':title', $this->article_title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->article_content, PDO::PARAM_STR);

    }
}
