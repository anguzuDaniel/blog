<?php require_once "./includes/header.php"; ?>

<?php require_once "includes/database.php"; ?>

<?php require_once "../includes/functions.php"; ?>

<?php

require_once "../includes/authentication.php";
require_once "../classes/Database.php";
require_once "../classes/Article.php";

session_start();

if (!isLoggedIn()) {
    die('unathorized user');
}

$db = new Database();
$connection = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getById($connection, $_GET['id']);

    if ($article) {
    } else {
        die("Article not found.");
    }
} else {
    echo "Article doesn't exit";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $article->article_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article->article_title = $_POST['article__title'];
    $article->article_content = $_POST['article__content'];

    $errors = validateArticle($article->article_image, $article->article_title, $article->article_content);


    if (empty($errors)) {

        if ($article->update($connection)) {
            redirect("/blog/article.php?id=$article->id");
        }
    }
}



?>

<!-- main section start -->
<main class="admin__wrapper">
    <?php include_once "./includes/sidebar.php"; ?>

    <div class="admin__container">
        <?php require_once "./includes/navigation.php"; ?>

        <!-- admin section wrapper start -->
        <section class="admin__content">
            <div class="heading | admin__content--heading">
                <h1>Edit Article</h1>
                <hr>
            </div>


            <form action="" method="post" enctype="multipart/form-data">
                <div class="form__row">
                    <label for="image" class="form__row--label">Image</label>
                    <!-- <img src="../images/<?= $article_image;  ?>" alt="" srcset="" class="form__row--imgCurrent"> -->
                    <input type="file" class="form__row--img" name="image" value="<?= $article_image; ?>" />
                </div>

                <div class="form__row">
                    <label for="article__title" class="form__row--label">Title</label>
                    <input type="text" name="article__title" value="<?= htmlspecialchars($article_title); ?>" />
                </div>

                <div class="form__row">
                    <label for="article__content" class="form__row--label">Content</label>
                    <textarea name="article__content" id="" cols="30" rows="10" style="resize: none"><?= htmlspecialchars($article_content); ?></textarea>
                </div>

                <button class="btn btn--submit">Save</button>
            </form>
        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php require_once "./includes/footer.php"; ?>