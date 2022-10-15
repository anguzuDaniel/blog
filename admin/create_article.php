<?php require "includes/database.php"; ?>

<?php

if (isset($_POST['create_article'])) {
    // creates a conection to the database
    $connection = getDB();

    $article_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article_title = $_POST['article__title'];
    $article_content = $_POST['article__content'];

    // stores the error messages
    $errors = [];

    if ($article_image == '') {
        $errors[] = 'Please add an image description';
    }
    if ($article_title == '') {
        $errors[] = 'Title cannot be left empty';
    }
    if ($article_content == '') {
        $errors[] = 'Content cannot be left empty';
    }

    $sql = "INSERT INTO articles(article_image, article_title, article_content) VALUES (?, ?, ?) ";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, 'sss', $article_image, $_POST['article__title'], $_POST['article__content']);

        if (mysqli_stmt_execute($stmt)) {
            $id = mysqli_insert_id($connection);
            echo 'Inserted record with ID: $id';
        } else {
            echo mysqli_stmt_errno($stmt);
        }
    }

    move_uploaded_file($image_temp, "../images/$article_image");
}

?>

<?php require "./includes/header.php"; ?>
<?php require "./includes/navigation.php"; ?>

<!-- main section start -->
<main class="admin__container">
    <?php include "includes/sidebar.php" ?>

    <!-- admin section wrapper start -->
    <section class="admin__content">
        <div class="heading | admin__content--heading">
            <h1>Fill in form to create a blog post.</h1>
            <hr>
        </div>

        <!-- error handler start | checks if inputs are empty and prints message -->
        <?php if (!empty($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
        <!-- error hamdler end -->

        <!-- form start -->
        <form action="create_article.php" method="post" enctype="multipart/form-data">
            <div class="form__row">
                <label for="image" class="form__row--label">Image</label>
                <input type="file" class="form__row--image" name="image" />
            </div>

            <div class="form__row">
                <label for="article__title" class="form__row--label">Title</label>
                <input type="text" name="article__title" />
            </div>

            <div class="form__row">
                <label for="article__content" class="form__row--label">Content</label>
                <textarea name="article__content" id="" cols="30" rows="10" style="resize: none"></textarea>
            </div>

            <input type="submit" value="Publish" name="create_article" class="btn | btn--submit" />
        </form>
        <!-- form end -->
    </section>
    <!-- admin section wrapper end -->

</main>
<!-- main section end -->

<?php include "./includes/footer.php"; ?>