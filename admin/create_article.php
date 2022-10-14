<?php include "./includes/head.php"; ?>

<?php

if (isset($_POST['create_article'])) {
    $article_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article_title = $_POST['article__title'];
    $article_content = $_POST['article__content'];

    $db_host = 'localhost';
    $db_user = 'root';
    $db_name = 'blog';
    $db_password = 'password';

    $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    // '{$article_image}', '{$article_title}', '{$article_content}') "

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

<header class="header">
    <h1>BlogIfy!</h1>

    <div class="admin">
        <a href="../index.php">Home page</a>
    </div>
</header>


<main class="admin__container">
    <?php include "includes/sidebar.php" ?>

    <section class="admin__content">
        <div class="heading | admin__content--heading">
            <h1>Fill in form to create a blog post.</h1>
            <hr>
        </div>

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
    </section>

</main>
<?php include "./includes/footer.php"; ?>