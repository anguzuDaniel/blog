<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";

if (isset($_GET['id'])) {
    $article = Article::getWithCategories($connection, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require_once "includes/navigation.php"; ?>


<div class="article">

    <div>
        <?php if ($article) : ?>
            <article>
                <h1 class="article--title"><?= htmlspecialchars($article[0]['article_title']); ?></h1>

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
                    <div>
                        <a href="#comment"><em class="fa-regular fa-comments"></em></a>
                        <span>Comment</span>
                    </div>


                    <!-- <em class="fa-solid fa-heart"></em> -->
                    <div>
                        <a href="#"><em class="fa-regular fa-thumbs-up"></em></a>
                        <span>Like</span>
                    </div>


                    <!-- <em class="fa-solid fa-comments"></em>
                    <div>
                        <a href="#"><em class="fa-regular fa-heart"></em></a>
                        <span>like</span>
                    </div> -->

                    <div>
                        <a href="#"><em class="fa-regular fa-share-from-square"></em></a>
                        <span>Share</span>
                    </div>

                    <div>
                        <a href="#"><em class="fa-solid fa-paperclip"></em></a>
                        <span>Pin</span>

                    </div>
                    <!-- <em class="fa-solid fa-thumbs-up"></em> -->
                </div>

                <div class="article--text">
                    <p class="article--paragraph" id="comment"><?= htmlspecialchars($article[0]['article_content']); ?></p>
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
    </div>

    <?php require_once "includes/side.php" ?>
</div>

<?php require_once "includes/footer.php"; ?>