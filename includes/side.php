<?php

$sql = "SELECT * FROM articles ORDER BY RAND() LIMIT 5";

$stmt = $connection->prepare($sql);

if ($stmt->fetchAll()) {
    echo $connection->errorInfo();
} else {
    $articles = Article::getAll($connection, 5);
}

$counter = 1;
?>

<!-- side section | shows the ctegory list -->
<section>
    <!-- side navigtion start-->
    <?php include_once "./includes/profile-side.php"; ?>
    <!-- side navigtion end -->

    <div class="shadow-sm bg-white">
        <div class="">
            <?php if (empty($articles)) : ?>
                <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
            <?php else : ?>
                <?php foreach ($articles as $article) : ?>
                    <?php if ($article['article_image'] !== null && $article['article_image'] !== '') : ?>
                        <div class="p-4 d-flex gap-3 border-bottom">


                            <div class="w-100">
                                <a href="article.php?id=<?= $article['id']; ?>" class="text-decoration-none">
                                    <h5 class="side__list--heading"><?= substr($article['article_title'], 0, 100); ?></h5>
                                </a>

                                <p>Author:
                                    <a href="profile.php?id=<?= $article['id']; ?>">
                                        <?= $article['name'] ?>
                                    </a>
                                </p>

                                <time datetime="<?= $article['published_at'] ?>" class="text-muted">
                                    <?php
                                    $datetime = new DateTime($article['published_at']);
                                    echo $datetime->format("j F, Y");
                                    ?>
                                </time>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- side section | end-->