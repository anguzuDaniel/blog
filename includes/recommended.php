<?php

require_once("includes/database.php");

$sql = "SELECT * FROM articles ORDER BY RAND() LIMIT 5";

$result = mysqli_query($connection, $sql);

if ($result === false) {
    echo mysqli_error($connection);
} else {
    $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<section class="recommended__articles">

    <div class="read__article--underline read__article--underline1">
        <h1 class="read__article--heading">Recommended</h1>
        <span></span>
    </div>

    <!-- Recommeded article wrapper start -->
    <div class="recommended__articles--container">
        <div>
            <button class="btn__pagination slider__next">&lsaquo;</button>
        </div>

        <div class="recommended__articles--wrapper slider">


            <?php if (empty($articles)) : ?>
                <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
            <?php else : ?>
                <?php foreach ($articles as $article) : ?>
                    <article>
                        <div class="recommended__articles--images">
                            <img src="images/<?= $article['article_image']; ?>" alt="" srcset="">
                        </div>

                        <div class="recommended__articles--text">
                            <a href="article.php?=<?= $article['id']; ?>">Read Article</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <div>
            <button class="btn__pagination slider__previous">&rsaquo;</button>
        </div>
        <!-- Recommeded article wrapper end -->
    </div>

</section>