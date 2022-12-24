<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $article = Article::getWithCategories($connection, $_GET['id']);
} else {
    $article = null;
}

$art = new Article();
$user = new User();

?>


<?php require_once "includes/navigation.php"; ?>


<div class="col-12 container d-lg-flex gap-4">

    <section class="timeline col-lg-8">
        <?php if ($article) : ?>
            <article>
                <h1 class="fw-bold"><?= htmlspecialchars($article[0]['article_title']); ?></h1>

                <time datetime="<?= $article[0]['published_at'] ?>">
                    <?php
                    $datetime = new DateTime($article[0]['published_at']);
                    echo $datetime->format("j F, Y");
                    ?>
                </time>

                <div class="article--tags">
                    <h3>Tags/Category: </h3>
                    <?php if ($article[0]['category_name']) : ?>
                        <p class="article--paragraph" id="comment">
                            <?php foreach ($article as $a) : ?>
                                <?= htmlspecialchars($a['category_name']); ?>
                            <?php endforeach; ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="article--image">
                    <img src="images/<?= $article[0]['article_image']; ?>" alt="article image" />
                </div>
                <div class="article__cta">
                    <?php
                    $likes = $art->getArticleLikes($connection, $id);

                    if (!empty($likes)) : ?>

                        <a href="like.php?type=article&id=<?= $id; ?>"><em class="fa fa-thumbs-up" aria-hidden="true"></em></em></a>
                        <?= $likes['likes'] > 1 ? $likes['likes'] . " people Liked this" : $likes['likes'] . " person Liked this" ?>

                    <?php else : ?>
                        <a href="like.php?type=article&id=<?= $id; ?>"><em class="fa-regular fa-thumbs-up"></em></a>
                        0 Likes
                    <?php endif; ?>
                    <div>
                        <a href="#"><em class="fa-solid fa-paperclip"></em></a>
                        <span>Pin</span>

                    </div>
                    <!-- <em class="fa-solid fa-thumbs-up"></em> -->
                </div>

                <div class="article--text">
                    <p class="article--paragraph" id="comment"><?= htmlspecialchars($article[0]['article_content']); ?></p>
                </div>

                <div class="d-flex justify-content-between align-content-center">
                    <p>0 comments</p>
                    <p>Write a comment</p>
                </div>

                <hr>


                <form class="article--comments" action="" method="post">
                    <div class="form__row d-flex">
                        <div class="form__row--image">
                            <img src="images/image-avatar.png" alt="" srcset="">
                        </div>
                        <!-- <label for="comment" class="form__row--label">Comment</label> -->
                        <textarea name="comment" id="" cols="10" rows="2" style="resize: none;" placeholder="Leave a comment"></textarea>
                    </div>
                    <!-- <input type="submit" value="comment" class="btn | btn--submit"> -->
                </form>
            </article>
        <?php else : ?>
            <p class="paragraph article--paragraph">No articles found..</p>
        <?php endif ?>
    </section>
    <?php require_once "includes/side.php" ?>
</div>

</div>

<?php require_once "includes/footer.php"; ?>