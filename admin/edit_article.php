<?php require_once "includes/database.php"; ?>

<?php

require_once "includes/article.php";

$connection = getDB();

if (isset($_GET['id'])) {
    $article = getArticle($connection, $_GET['id']);

    if ($article) {
        $article_image = $article['article_image'];
        $article_title = $article['article_title'];
        $article_content = $article['article_content'];
    }
} else {
    echo "Artcile doesnt exit";

    $sql = "INSERT INTO articles(article_image, article_title, article_content) VALUES (?, ?, ?) ";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, 'sss', $article_image, $article_title, $article_content);


        if (mysqli_stmt_execute($stmt)) {

            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                $protocol = 'https';
            } else {
                $protocol = 'http';
            }
            header("Location: $protocol://" . $_SERVER['HTTP'] . "../article.php?id=$id");
            move_uploaded_file($image_temp, "../images/$article_image");
            exit;
        } else {
            echo mysqli_stmt_errno($stmt);
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
                <h1>Edit Article</h1>
                <hr>
            </div>

            <?php require_once "./includes/form.php"; ?>
        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php include "./includes/footer.php"; ?>