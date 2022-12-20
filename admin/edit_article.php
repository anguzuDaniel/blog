<?php require_once "./includes/header.php"; ?>
<?php
Auth::isLoggedIn();

$connection = require_once "../includes/db.php";

if (isset($_GET['id'])) {
    $article = Article::getById($connection, $_GET['id']);

    if (!$article) {
        die("Article not found.");
    }
} else {
    echo "Article doesn't exit";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $article->articleImage = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article->articleTitle = $_POST['article__title'];
    $article->articleContent = $_POST['article__content'];

    $errors = $article->validateArticle($article->articleImage, $article->articleTitle, $article->articleContent);

    move_uploaded_file($image_temp, "../uploads/images/$article->articleImage");

    if (empty($errors) && $article->update($connection)) {
        Url::redirect("/blog/article.php?id=$article->id");
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


            <?php require_once "includes/form.php"; ?>
        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php require_once "./includes/footer.php"; ?>