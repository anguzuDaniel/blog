            <!-- lastest artciles section | start -->
            <div class="lastest__articles">

                <?php if (empty($articles)) : ?>
                    <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
                <?php else : ?>
                    <?php foreach ($articles as $article) : ?>
                        <article>
                            <div class="lastest__articles--image">
                                <img src="images/<?= $article['article_image']; ?>" alt="image" />
                            </div>
                            <div class="lastest__articles--text">
                                <h1 class="lastest__articles--title"><?= $article['article_title']; ?></h1>
                                <p class="lastest__articles--paragraph"><?= substr($article['article_content'], 0, 150); ?>...</p>
                                <p class="lastest__articles--date">
                                    <time datetime="<?= $article['published_at'] ?>">
                                        <?php
                                        $datetime = new DateTime($article['published_at']);
                                        echo $datetime->format("j F, Y");
                                        ?>
                                    </time>
                                </p>

                                <div class="lastest__articles--cta">
                                    <a href="article.php?id=<?= $article['id']; ?>" class="btn btn--read">Read more</a>
                                    <!-- <em class="fa-regular fa-comments"></em> -->
                                    <!-- <em class="fa-solid fa-comments"></em> -->
                                    <!-- <em class="fa-regular fa-heart"></em> -->
                                    <!-- <em class="fa-solid fa-heart"></em> -->
                                    <!-- <em class="fa-regular fa-thumbs-up"></em> -->
                                    <!-- <em class="fa-solid fa-thumbs-up"></em> -->
                                    <!-- <em class="fa-regular fa-bookmark"></em> -->
                                    <!-- <em class="fa-solid fa-bookmark"></em> -->

                                    <div class="article__cta">

                                        <!-- <em class="fa-solid fa-thumbs-up"></em> -->
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>
            <!-- lastest artciles section end -->