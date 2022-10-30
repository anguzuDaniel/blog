<?php

function getArticle($connection, $id) {
    $sql = "SELECT * 
            FROM articles 
            WHERE id = ?";

    $result = mysqli_prepare($connection, $sql);

    if ($result === false) {
        echo mysqli_error($connection);
    } else {
        $article = mysqli_stmt_bind_param($result, "i", $id);
    }
}