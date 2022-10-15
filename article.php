<?php require "includes/header.php"; ?>
<?php

require "includes/database.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $sql = "SELECT * FROM articles WHERE id = " . $_GET['id'];

    $result = mysqli_query($connection, $sql);

    if ($result === false) {
        echo mysqli_error($connection);
    } else {
        $article = mysqli_fetch_assoc($result);

        // var_dump($articles);
    }
} else {
    $article = null;
}

?>

<?php require "includes/header.php"; ?>

<?php require "includes/navigation.php"; ?>

<div class="lastest__article">

    <?php if ($article === NULL) : ?>
        <p class="lastest__articles--paragraph">No articles found..</p>
    <?php else : ?>
        <article>
            <img src="images/<?= $article['article_image']; ?>" />
            <!-- <img src="images/Programming-Language-Popularity.jpg" alt="" srcset=""> -->
            <div class="lastest__articles--text">
                <h1 class="lastest__articles--title"><?= $article['article_title']; ?></h1>
                <p class="lastest__articles--paragraph"><?= $article['article_content']; ?></p>
            </div>
        </article>

    <?php endif ?>
</div>

<?php require "includes/footer.php"; ?>