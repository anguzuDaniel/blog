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

    public static function getTotalArticles($conn, $only_published = false)
    {
        $condition = $only_published ? 'WHERE published_at IS NOT NULL' : '';

        return $conn->query("SELECT COUNT(*) FROM articles $condition")->fetchColumn();
    }

    /**
     * @param mixed $conn
     * @param mixed $num
     * 
     * @return [type]
     */
    public static function getAll($conn, $limit)
    {
        $sql = "SELECT a.*, u.username AS name
                FROM articles AS a
                LEFT JOIN `user` AS u
                ON a.created_by = u.id
                LIMIT $limit";

        $stmt = $conn->query($sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        return $stmt->fetchAll();
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


    // get specified number of articles 
    /**
     * @param mixed $conn
     * @param mixed $order
     * @param mixed $num
     * @param string $columns
     * 
     * @return [type]
     */
    public static function getUserArticles($conn, $id, $order = "")
    {
        $sql = "SELECT a.*, u.username AS name
                FROM articles AS a
                LEFT JOIN user AS u ON a.created_by = :id
                INNER JOIN following AS f ON a.created_by = f.user_followed $order";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        return $stmt->fetchAll();
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
    public static function getWithCategories($conn, $id, $only_published = false)
    {
        $sql = "SELECT a.*, c.name AS category_name
                FROM articles AS a 
                LEFT JOIN article_categories AS ac 
                ON a.id = ac.article_id
                LEFT JOIN category AS c
                ON ac.category_id = c.id
                WHERE a.id = :id";

        // Show only published articles
        if ($only_published) {
            $sql .= "WHERE a.published_at IS NOT NULL";
        }

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
    public static function getPage($conn, $limit, $offset, $only_published = false)
    {
        $condition = $only_published ? 'WHERE published_at IS NOT NULL' : '';

        $sql = "SELECT a.*, category.name AS category_name
                FROM (
                    SELECT *
                    FROM articles 
                    $condition
                    ORDER BY article_title
                    LIMIT :limit 
                    OFFSET :offset
                ) AS a
                LEFT JOIN article_categories
                ON a.id = article_categories.article_id
                LEFT JOIN category 
                ON article_categories.category_id = category.id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $previous_id = null;

        foreach ($results as $row) {
            $article_id = $row['id'];

            if ($article_id != $previous_id) {
                $row['category_names'] = [];

                $articles[$article_id] = $row;
            }

            $articles[$article_id]['category_names'][] = $row['category_name'];

            $previous_id = $article_id;
        }

        return $articles;
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

    public function publish($conn)
    {
        $sql = "UPDATE articles 
                SET publish_at = :published_at
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $published_at = date("Y-m-d H:i:s");
        $stmt->bindValue(':published_at', $published_at, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $published_at;
        }
    }

    public function getArticleLikes($conn, $articleId)
    {
        $sql = "SELECT a.id, a.article_title, al.id AS like_id, al.user_id, u.username AS liked_by, COUNT(al.id) AS likes
                
                FROM articles AS a 
                LEFT JOIN article_likes AS al  
                ON :id = al.article_id

                INNER JOIN user AS u  
                ON al.user_id = u.id
                GROUP BY a.id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $articleId, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

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
    public function addLike($conn, $articleId)
    {
        $sql = "INSERT INTO article_likes(article_id, user_id) 
                SELECT :article_id, {$_SESSION['user_id']}  
                FROM articles
                WHERE EXISTS
                (
                    SELECT id FROM articles 
                    WHERE id = :article_id
                ) AND NOT EXISTS (
                    SELECT id FROM article_likes 
                    WHERE user_id = {$_SESSION['user_id']}
                    AND article_id = :article_id
                ) LIMIT 1";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':article_id', $articleId, PDO::PARAM_INT);

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
    public function unLike($conn, $id, $articleId)
    {
        $sql = "DELETE FROM article_likes 
                WHERE id = :id AND article_id = :article_id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':article_id', $articleId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public static function getArticleComments($conn, $articleId)
    {
        $sql = "SELECT c.id AS com_id, c.user_id, 
                c.article_id, c.comment, 
                c.id AS comment_id, 
                u.id, 
                u.username, 
                a.id
                FROM comment AS c

                LEFT JOIN articles AS a
                ON c.article_id = :id

                INNER JOIN user AS u  
                ON c.user_id = u.id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $articleId, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getArticleCommentReply($conn, $articleId, $commentId)
    {
        $sql = "SELECT 
                r.id, 
                r.user_id AS user_replied, 
                r.article_id AS article_replied, 
                r.comment_id, 
                r.reply,
                c.id AS comment_replied,
                u.id, 
                u.username
                FROM comment_reply AS r

                LEFT JOIN comment AS c
                ON r.comment_id = :cid

                LEFT JOIN user AS u  
                ON r.user_id = u.id 
                
                LEFT JOIN articles AS a  
                ON r.article_id = :aid

                WHERE c.id = :cid";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':aid', $articleId, PDO::PARAM_INT);
        $stmt->bindValue(':cid', $commentId, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
