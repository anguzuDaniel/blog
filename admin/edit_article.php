<?php require_once "./includes/header.php"; ?>
<?php
require_once "includes/database.php";
require_once "../includes/functions.php";

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

    move_uploaded_file($image_temp, "../images/$article->articleImage");

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


            <form action="" method="post" enctype="multipart/form-data">
                <div class="form__row">
                    <label for="image" class="form__row--label">Image</label>
                    <!-- <img src="../images/<?= $articleImage;  ?>" alt="" srcset="" class="form__row--imgCurrent"> -->
                    <input type="file" class="form__row--img" name="image" value="<?= $article->articleImage; ?>" />
                </div>

                <div class="form__row">
                    <label for="article__title" class="form__row--label">Title</label>
                    <input type="text" name="article__title" value="<?= htmlspecialchars($article->articleTitle); ?>" />
                </div>

                <div class="form__row">
                    <label for="article__content" class="form__row--label">Content</label>
                    <textarea name="article__content" id="" cols="30" rows="10" style="resize: none"><?= htmlspecialchars($article->articleContent); ?></textarea>
                </div>

                <button class="btn btn--submit">Save</button>
            </form>
        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php require_once "./includes/footer.php"; ?>