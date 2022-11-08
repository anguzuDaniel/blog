<?php

function getArticle($conn, $id)
{
    $sql = "SELECT * FROM articles WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}


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

function deletArticle() {
    // DELETE FROM `articles` WHERE `articles`.`id` = 37
}
