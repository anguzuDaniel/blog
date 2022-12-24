<?php require_once "./includes/header.php"; ?>
<?php

$connection = require_once "includes/db.php";

if (isset($_GET['type'], $_GET['id'])) {
    $type = $_GET['type'];
    $articleId = $_GET['id'];
    $likeId = $_GET['likeId'];
    $action = $_GET['action'];

    $loggedInUser = $_SESSION['user_id'];

    var_dump($loggedInUser);

    $article = new Article();

    switch ($type) {
        case 'article':

            if ($action === 'like') {
                $article->addLike($connection, $articleId);
                Url::redirect('/blog/index.php');
            }

            if ($action === 'unlike') {
                $article->unLike($connection, $likeId, $articleId);
                // Url::redirect('/blog/index.php');
            }
            break;
        case 'unlike':
            $user->unFollow($connection, $userId);

            // var_dump($user->getFollows($connection, $loggedInUser));
            // Url::redirect('/blog/index.php');
            break;
        default:
            echo "didn't work";
            break;
    }
}
