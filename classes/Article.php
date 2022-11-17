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

    public static function getAll($conn, $num)
    {
        $sql = "SELECT * FROM articles LIMIT $num";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    // get specified number of articles 
    public static function getArticles($conn, $sql, $num, $columns = '*')
    {
        $sql = "SELECT $columns FROM articles $sql $num";

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
        SET `articleImage` = :img, 
            `articleTitle` = :title, 
            `articleContent` = :content 
            WHERE `id` = :id ";

        $stmt = $conn->prepare($sql);

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
