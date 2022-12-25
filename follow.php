<?php require_once "./includes/header.php"; ?>
<?php

$connection = require_once "includes/db.php";

if (isset($_GET['type'], $_GET['id'])) {
    $type = $_GET['type'];
    $userId = $_GET['id'];

    $loggedInUser = $_SESSION['user_id'];

    var_dump($loggedInUser);

    $user = new User();

    switch ($type) {
        case 'user':
            $user->addFollow($connection, $userId);


            // var_dump($user->getFollows($connection, $loggedInUser));
            // Url::redirect('/blog/index.php');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
        case 'unfollow':
            $user->unFollow($connection, $userId);

            // var_dump($user->getFollows($connection, $loggedInUser));
            // Url::redirect('/blog/index.php');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
        default:
            echo "didn't work";
            break;
    }
}
