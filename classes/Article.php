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
    public $articleImage;

    /**
     * title
     *
     * @var mixed
     */
    public $articleTitle;

    /**
     * content
     *
     * @var mixed
     */
    public $articleContent;

    public static function getTotalArticles($conn)
    {
        return $conn->query("SELECT COUNT(*) FROM articles")->fetchColumn();
    }

    public static function getAll($conn, $num)
    {
        $sql = "SELECT * FROM articles LIMIT $num";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    // get specified number of articles 
    public static function getArticles($conn, $order, $num, $columns = '*')
    {
        $sql = "SELECT $columns FROM articles $order $num";

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

    public static function getPage($conn, $limit, $offset)
    {
        $sql = "SELECT *
                FROM articles 
                ORDER BY article_title
                LIMIT :limit 
                OFFSET :offset ";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($conn)
    {
        $sql = "UPDATE `articles` 
        SET `article_image` = :img, 
            `article_title` = :title, 
            `article_content` = :content 
            WHERE `id` = :id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(
            ':id',
            $this->id,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':img',
            $this->articleImage,
            PDO::PARAM_STR
        );

        $stmt->bindValue(
            ':title',
            $this->articleTitle,
            PDO::PARAM_STR
        );

        $stmt->bindValue(':content', $this->articleContent, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function createArticle($conn, $image, $title, $content)
    {
        $sql = "INSERT INTO articles(article_image, article_title, article_content) VALUES (:img, :title, :content) ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':img', $image, PDO::PARAM_STR);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);

        $stmt->execute(array(':img' => $image, ':title' => $title, ':content' => $content));

        $this->id = $conn->lastInsertId();
    }

    public static function deleteArticle($conn, $id)
    {
        $sql = "DELETE 
            FROM `articles` 
            WHERE `id` = :id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(
            ':id',
            $id,
            PDO::PARAM_INT
        );

        $stmt->execute();
    }

    /**
     * validateArticle
     *
     * @param  mixed $image 
     * @param  mixed $title
     * @param  mixed $content
     * @return void
     */
    public function validateArticle($image, $title, $content)
    {
        // stores the error messages
        $errors = [];

        if ($image == '') {
            $errors[] = 'Please add an image';
        }
        if ($title == '') {
            $errors[] = 'Title is required';
        }
        if ($content == '') {
            $errors[] = 'Content cannot be left empty';
        }

        return $errors;
    }
}
