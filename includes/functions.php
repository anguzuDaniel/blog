<?php

function getArticle($connection, $id)
{
    $sql = "SELECT * 
            FROM articles 
            WHERE id = ?";

    $result = mysqli_prepare($connection, $sql);

    if ($result === false) {
        echo mysqli_error($connection);
    } else {
        $article = mysqli_stmt_bind_param($result, "i", $id);

        if (mysqli_stmt_execute($result)) {
            $article = mysqli_stmt_get_result($result);

            return mysqli_fetch_all($article);
        }
    }
}
