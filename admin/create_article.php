<?php
require_once "includes/header.php";

Auth::isLoggedIn();

$connection = require_once "../includes/db.php";

$article_image = '';
$article_title = '';
$article_content = '';

$article = new Article();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $article_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article_title = $_POST['article__title'];
    $article_content = $_POST['article__content'];

    $errors = $article->validateArticle($article_image, $article_title, $article_content);

    // if errors arrays is empty
    // we continue to submit the data
    if (empty($errors)) {
        $stmt = $article->createArticle($connection, $article_image, $article_title, $article_content);

        move_uploaded_file($image_temp, "../images/$article_image");

        if ($stmt) {
            $id = $article->id;

            Url::redirect("/blog/article.php?id=$id");
        } else {
            $connection->errorInfo();
        }
    } else {
        echo "Unable to create article now, Please try again later";
    }
}


?>
<!-- main section start -->
<main class="admin__wrapper">
    <?php include_once "includes/sidebar.php" ?>

    <div class="admin__container">


        <?php require_once "./includes/navigation.php"; ?>

        <!-- admin section wrapper start -->
        <section class="admin__content">
            <div class="heading | admin__content--heading">
                <h1>Do want to create an article <h1> <?php echo $currentUser->username; ?>?</h1>
                </h1>
                <hr>
            </div>

            <?php require_once "./includes/form.php"; ?>

        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php include_once "./includes/footer.php"; ?>