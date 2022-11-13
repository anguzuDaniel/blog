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
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $article_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article_title = $_POST['article__title'];
    $article_content = $_POST['article__content'];

    $errors = validateArticle($article_image, $article_title, $article_content);


    if (empty($errors)) {

        $sql = "UPDATE `articles` SET `article_image` = ?, `article_title` = ?, `article_content` = ? WHERE `id` = ? ";


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
                header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/blog/article.php?id=$id");
                exit;
            } else {
                echo mysqli_stmt_error($stmt);
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