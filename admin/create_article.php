<?php
require_once "includes/database.php";
require_once "../includes/functions.php";
require_once "../classes/auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die('unathorized user');
}

$article_image = '';
$article_title = '';
$article_content = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $article_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article_title = $_POST['article__title'];
    $article_content = $_POST['article__content'];

    $errors = validateArticle($article_image, $article_title, $article_content);

    // if errors arrays is empty
    // we continue to submit the data
    if (empty($errors)) {
        $connection = getDB();

        $sql = "INSERT INTO articles(article_image, article_title, article_content) VALUES (?, ?, ?) ";

        $stmt = mysqli_prepare($connection, $sql);

        if ($stmt === false) {
            echo mysqli_error($connection);
        } else {
            mysqli_stmt_bind_param($stmt, 'sss', $article_image, $article_title, $article_content);

            move_uploaded_file($image_temp, "../images/$article_image");
            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($connection);

                redirect("/blog/article.php?id=$id");
            } else {
                echo mysqli_stmt_errno($stmt);
            }
        }
    }
}

?>

<?php require_once "./includes/header.php"; ?>

<!-- main section start -->
<main class="admin__wrapper">
    <?php include_once "includes/sidebar.php" ?>

    <div class="admin__container">


        <?php require_once "./includes/navigation.php"; ?>

        <!-- admin section wrapper start -->
        <section class="admin__content">
            <div class="heading | admin__content--heading">
                <h1>Create an Article</h1>
                <hr>
            </div>

            <?php require_once "./includes/form.php"; ?>

        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php include_once "./includes/footer.php"; ?>