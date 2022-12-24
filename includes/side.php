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
<div class="mt-5">
    <aside class="side p-4 shadow-sm">
        <div class="side__list side__list--1">
            <?php if (empty($articles)) : ?>
                <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
            <?php else : ?>
                <?php foreach ($articles as $article) : ?>
                    <div class="side__list--content">

                        <div class="side__list--text">
                            <h5 class="side__list--heading"><?= substr($article['article_title'], 0, 100); ?></h5>
                            <p class="side__list--paragraph"><?= substr($article['article_content'], 0, 100); ?>...</p>

                            <div>
                                <p>
                                    <?php
                                    $datetime = new DateTime($article['published_at']);
                                    echo $datetime->format("j F, Y");
                                    ?>
                                </p>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </aside>
</div>
<!-- side section | end-->