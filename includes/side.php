<?php

$db = new Database();
$connection = $db->getConn();

$sql = "SELECT * FROM articles ORDER BY RAND() LIMIT 5";

$stmt = $connection->prepare($sql);

if ($stmt->fetchAll()) {
    echo $connection->errorInfo();
} else {
    $articles = Article::getAll($connection, 5);
}
?>

<!-- side section | shows the ctegory list -->
<div>
    <aside class="side">
        <div class="side__list side__list--1">
            <div class="side__list--underline side__list--underline1">
                <h1 class="side__list--head">Trending</h1>
                <span></span>
            </div>

            <?php if (empty($articles)) : ?>
                <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
            <?php else : ?>
                <?php foreach ($articles as $article) : ?>
                    <div class="side__list--content">
                        <span>
                            <p class="side__list--num">
                                <?=
                                $i = 0;

                                echo "0" . $i;


                                ?>
                            </p>
                        </span>
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