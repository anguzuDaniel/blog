<?php require_once "./includes/header.php"; ?>
<?php

$connection = require_once "includes/db.php";

if (isset($_GET['type'], $_GET['id'])) {
    $type = $_GET['type'];
    $articleId = $_GET['id'];

    $loggedInUser = $_SESSION['user_id'];

    var_dump($loggedInUser);

    $article = new Article();

    switch ($type) {
        case 'article':
            $article->addLike($connection, $articleId);
            Url::redirect('/blog/index.php');
            break;
        default:
            echo "didn't work";
            break;
    }
}
