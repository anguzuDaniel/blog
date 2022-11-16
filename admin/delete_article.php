<?php
require_once "./includes/header.php";

require_once "includes/database.php";

require_once "../includes/functions.php";

require_once "includes/function.php";

require_once "../classes/auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die('unathorized user');
}

$connection = getDB();

if (isset($_GET['id'])) {
    $article = getArticle($connection, $_GET['id']);

    if ($article) {
        $id = $article['id'];
    } else {
        die("Article not found.");
    }
} else {
    echo "Valid id not supplied, article doesn't exit.";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sql = "DELETE 
            FROM `articles` 
            WHERE `id` = ? ";


    $stmt = mysqli_prepare($connection, $sql);


    if ($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        move_uploaded_file($image_temp, "../images/$article_image");

        if (mysqli_stmt_execute($stmt)) {

            redirect("/blog/admin/all_articles.php");
        } else {
            echo mysqli_stmt_error($stmt);
        }
    }
}
?>

<?php require_once "includes/header.php"; ?>

<div class="modal">

    <em class=""></em>

    <form method="post" class="modal__form">
        <h3>Are you sure you want to delete this article?</h3>

        <div class="modal__form--row">

            <button class="delete__icon modal__form--btn">
                Delete
            </button>

            <a href="all_articles.php" class="modal__form--btn">Cancel</a>
        </div>
    </form>
</div>

<?php require_once "includes/footer.php"; ?>