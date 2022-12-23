<?php
if ($connection) {
    $articles = Article::getArticles($connection, 'ORDER BY id DESC LIMIT', 3);
} else {
    echo $connection->errorInfo();
}
?>

<!-- featured articles | start here -->
<section class="featured__articles container">
    <div class="read__article--underline read__article--underline1">
        <h1 class="read__article--heading">Featured Articles</h1>
        <span></span>
    </div>

    <div class="featured__articles--wrapper">
        <?php if (empty($articles)) : ?>
            <p class="featured__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
        <?php else : ?>
            <?php foreach ($articles as $article) : ?>
                <article>
                    <div class="featured__articles--image">
                        <img src="images/<?= $article['article_image']; ?>" alt="image" />
                    </div>
                    <div class="featured__articles--text">

                        <h1 class="featured__articles--title"><?= $article['article_title']; ?></h1>
                        <p class="featured__articles--paragraph"><?= substr($article['article_content'], 0, 150); ?>...</p>
                        <p class="featured__articles--date">
                            <time datetime="<?= $article['published_at'] ?>">
                                <?php
                                $datetime = new DateTime($article['published_at']);
                                echo $datetime->format("j F, Y");
                                ?>
                            </time>
                        </p>

                        <div class="featured__articles--cta">
                            <a href="article.php?id=<?= $article['id']; ?>" class="btn btn--read"> <span>read more</span> </a>
                            <!-- <em class="fa-regular fa-comments"></em> -->
                            <!-- <em class="fa-solid fa-comments"></em> -->
                            <!-- <em class="fa-regular fa-heart"></em> -->
                            <!-- <em class="fa-solid fa-heart"></em> -->
                            <!-- <em class="fa-regular fa-thumbs-up"></em> -->
                            <!-- <em class="fa-solid fa-thumbs-up"></em> -->
                            <em class="fa-regular fa-bookmark"></em>
                            <!-- <em class="fa-solid fa-bookmark"></em> -->
                        </div>
                    </div>

                </article>
            <?php endforeach; ?>
        <?php endif ?>
    </div>

</section>
<!-- featured articles | end here -->