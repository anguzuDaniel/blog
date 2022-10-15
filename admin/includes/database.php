<?php

function getDB()
{
    $db_host = 'localhost';
    $db_user = 'root';
    $db_name = 'blog';
    $db_password = 'password';

    $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $connection;
}
