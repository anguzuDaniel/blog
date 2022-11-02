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

<!-- side section | shows the ctegory list -->
<div>
    <aside>
        <div class="side__list side__list--1">
            <div class="side__list--navigation">
                <!-- <button class="side__list--active">This week</button>
                <button>this month</button>
                <button>All time</button> -->
                <h1>Trending Articles</h1>
            </div>

            <?php if (empty($articles)) : ?>
                <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
            <?php else : ?>
                <?php foreach ($articles as $article) : ?>
                    <div class="side__list--content">
                        <!-- <div class="side__list--img">
                            <img src="images/<?= $article['article_image']; ?>" alt="" srcset="">
                        </div> -->
                        <div class="side__list--text">
                            <h1 class="side__list--heading"><?= substr($article['article_title'], 0, 100); ?></h1>
                            <p class="side__list--paragraph"><?= substr($article['article_content'], 0, 100); ?>...</p>

                            <div>
                                <p>2022 01 12</p>

                            </div>

                            <a href="article.php?id=<?= $article['id']; ?>" class="btn btn--read">Read more</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </aside>
</div>
<!-- side section | end-->