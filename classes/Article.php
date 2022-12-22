<?php

/**
 * [Description Article]
 */
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

    /**
     * @param mixed $conn
     * @param mixed $num
     * 
     * @return [type]
     */
    public static function getAll($conn, $limit)
    {
        $sql = "SELECT * FROM articles LIMIT $limit";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    // get specified number of articles 
    /**
     * @param mixed $conn
     * @param mixed $order
     * @param mixed $num
     * @param string $columns
     * 
     * @return [type]
     */
    public static function getArticles($conn, $order, $num, $columns = '*')
    {
        $sql = "SELECT $columns FROM articles $order $num";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @param mixed $conn
     * @param mixed $id
     * @param string $columns
     * 
     * @return [type]
     */
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

    /**
     * getWithCategories
     *
     * @param  mixed $conn
     * @param  mixed $id
     * @return array
     */
    public static function getWithCategories($conn, $id)
    {
        $sql = "SELECT a.*, c.name  
                FROM articles AS a 
                LEFT JOIN article_categories AS ac 
                ON a.id = ac.article_id
                LEFT JOIN category AS c
                ON ac.category_id = c.id
                WHERE a.id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getCategories
     *
     * @param  mixed $conn
     * @return array
     */
    public function getCategories($conn)
    {
        $sql = "SELECT c.* 
                FROM category AS c 
                LEFT JOIN article_categories AS ac 
                ON c.id = ac.article_id
                WHERE c.id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * setCategories
     *
     * @param  mixed $conn
     * @param  mixed $ids
     * @return void
     */
    public function setCategories($conn, $ids)
    {
        if ($ids) {
            $sql = "INSERT INTO `article_categories` (`article_id`, `category_id`) VALUES ";


            $values = [];

            foreach ($ids as $id) {
                $values[] = "({$this->id}, ?)";
            }

            $sql .= implode(", ", $values);

            $stmt = $conn->prepare($sql);

            foreach ($ids as $i => $id) {
                $stmt->bindValue($i + 1, $id, PDO::PARAM_INT);
            }

            $stmt->execute();
        }

        $sql = "DELETE FROM article_categories
                WHERE article_id = {$this->id}";

        if ($ids) {
            $placeholders = array_fill(0, count($ids), '?');

            $sql .= " AND category_id NOT IN (" . implode(", ", $placeholders) . ")";
        }

        foreach ($ids as $i => $id) {
            $stmt->bindValue($i + 1, $id, PDO::PARAM_INT);
        }

        $stmt = $conn->prepare($sql);

        $stmt->execute();
    }

    /**
     * @param mixed $conn
     * @param mixed $limit
     * @param mixed $offset
     * 
     * @return [type]
     */
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

    /**
     * @param mixed $conn
     * 
     * @return [type]
     */
    public function update($conn)
    {
        $sql = "UPDATE articles 
        SET article_image = :img, 
            article_title = :title, 
            article_content = :content 
            WHERE id = :id ";

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

    /**
     * @param mixed $conn
     * @param mixed $image
     * @param mixed $title
     * @param mixed $content
     * 
     * @return [type]
     */
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

    /**
     * @param mixed $conn
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function deleteArticle($conn, $id)
    {
        $sql = "DELETE 
            FROM articles 
            WHERE id = :id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(
            ':id',
            $id,
            PDO::PARAM_INT
        );

        $stmt->execute();
    }

    /**
     * @param mixed $image
     * @param mixed $title
     * @param mixed $content
     * 
     * @return [type]
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
