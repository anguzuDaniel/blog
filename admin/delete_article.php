<?php

require_once "includes/header.php";

Auth::isLoggedIn();
$connection = require_once "../includes/db.php";

if (isset($_GET['id'])) {
    $article = new Article();

    if ($article) {
        $id = $article->getById($connection, $_GET['id']);
    } else {
        die("Article not found.");
    }
} else {
    echo "Valid id not supplied, article doesn't exit.";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!$id) {
        echo $connection->errorInfo();
    } else {
        Article::deleteArticle($connection, $_GET['id']);

        Url::redirect("/blog/admin/all_articles.php");
    }
}
?>


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