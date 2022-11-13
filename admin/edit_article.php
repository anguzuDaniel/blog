<?php require_once "./includes/header.php"; ?>

<?php require_once "includes/database.php"; ?>

<?php require_once "../includes/functions.php"; ?>

<?php

$connection = getDB();

if (isset($_GET['id'])) {
    $article = getArticle($connection, $_GET['id']);

    if ($article) {
        $id = $article['id'];
        $article_image = $article['article_image'];
        $article_title = $article['article_title'];
        $article_content = $article['article_content'];
    } else {
        die("Article not found.");
    }
} else {
    echo "Article doesn't exit";

    $errors = validateArticle($article_image, $article_title, $article_content);


    if (empty($errors)) {

        $sql = "UPDATE articles 
                SET article_image = ?, 
                article_title = ?, 
                article_content = ? 
                WHERE id = ? ";

        $stmt = mysqli_prepare($connection, $sql);

        if ($stmt === false) {
            echo mysqli_error($connection);
        } else {
            mysqli_stmt_bind_param($stmt, 'sssi', $article_image, $article_title, $article_content, $id);

            if (mysqli_stmt_execute($stmt)) {

                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                    $protocol = 'https';
                } else {
                    $protocol = 'http';
                }
                move_uploaded_file($image_temp, "../images/$article_image");
                header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/blog/article.php?id=$id ");
                exit;
            } else {
                echo mysqli_stmt_errno($stmt);
            }
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

            <?php require_once "includes/form.php"; ?>
        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php require_once "./includes/footer.php"; ?>