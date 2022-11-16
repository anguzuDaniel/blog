<?php

/**
 * getArticle
 *
 * @param  mixed $conn
 * @param  mixed $id
 * @return void
 */
function getArticle($conn, $id)
{
    $sql = "SELECT * FROM articles WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return $stmt->fetch();
    }
}


/**
 * validateArticle
 *
 * @param  mixed $image 
 * @param  mixed $title
 * @param  mixed $content
 * @return void
 */
function validateArticle($image, $title, $content)
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

/**
 * deletArticle
 *
 * @return void
 */
function deletArticle()
{
    // DELETE FROM `articles` WHERE `articles`.`id` = 37
}

function redirect($path)
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        $protocol = 'https';
    } else {
        $protocol = 'http';
    }
    header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . $path);
    exit;
}
