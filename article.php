<?php require_once "includes/header.php"; ?>
<?php require_once "includes/database.php"; ?>
<?php



if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $sql = "SELECT * FROM articles WHERE id = " . $_GET['id'];

    $result = mysqli_query($connection, $sql);

    if ($result === false) {
        echo mysqli_error($connection);
    } else {
        $article = mysqli_fetch_assoc($result);
    }
} else {
    $article = null;
}

?>

<?php require_once "includes/header.php"; ?>

<?php require_once "includes/navigation.php"; ?>


<div class="article">

    <?php if ($article === null) : ?>
        <p class="paragraph article--paragraph">No articles found..</p>
    <?php else : ?>
        <article>
            <div class="article--image">
                <img src="images/<?= $article['article_image']; ?>" alt="article image" />
            </div>

            <div class="article--text">
                <h1 class="article--title"><?= htmlspecialchars($article['article_title']); ?></h1>
                <p class="article--paragraph"><?= htmlspecialchars($article['article_content']); ?></p>
            </div>

            <hr>

            <div class="article__comments">
                <p class="article__comments--no">No comments yet..</p>
            </div>

            <form class="article--comments" action="" method="post">
                <h1 class="article--title">Please leave a comment</h1>
                <!-- <div class="form__row">
                    <label for="username" class="form__row--label">Username</label>
                    <input type="text" name="username" id="">
                </div> -->
                <div class="form__row">
                    <label for="comment" class="form__row--label">Comment</label>
                    <textarea name="comment" id="" cols="30" rows="10" style="resize: none;"></textarea>
                </div>
                <input type="submit" value="comment" class="btn | btn--submit">
            </form>
        </article>

    <?php endif ?>

    <?php require_once "includes/side.php" ?>
</div>

<?php require_once "includes/footer.php"; ?>