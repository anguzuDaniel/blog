<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";
$articles = Article::getAll($connection, 10);
?>
<?php include_once "includes/header.php"; ?>

<?php include_once "includes/navigation.php"; ?>

<main class="container">

    <section class="timeline">
        <!-- timeline form | starts here -->
        <form action="article.php" method="post" class="timeline__form">
            <!-- <div class="timeline__creator--image">
                <img src="images/swangz.webp" alt="" srcset="">
            </div> -->

            <div class="timeline__form--input">
                <textarea name="post" id="" cols="30" rows="10" placeholder="Post an article"></textarea>
                <button class="btn btn--submit timeline__btn">Publish</button>
            </div>
        </form>
        <!-- timeline form | ends here -->

        <!-- timeline articles | start here -->
        <div class="timeline__wrapper">
            <?php foreach ($articles as $article) : ?>
                <article>
                    <div class="timeline__creator">
                        <div class="timeline__creator--image">
                            <img src="images/<?= $article['article_image']; ?>" alt="image" />
                        </div>

                        <div class="timeline__creator--name">
                            <h1 class="featured__articles--title"><?= $article['article_title']; ?></h1>
                            <p>3 hours ago</p>
                        </div>
                    </div>

                    <div class="timeline__content">
                        <div class="timeline__image">
                            <img src="images/<?= $article['article_image']; ?>" alt="image" />
                        </div>

                        <div class="timeline__text">
                            <h1 class="timeline__text--title">Lorem ipsum dolor, sit amet</h1>
                            <p class="timeline__text--content"><?= substr($article['article_content'], 0, 150); ?>...</p>

                        </div>

                        <div class="timeline__cta">

                            <div>
                                <a href="#"><em class="fa-regular fa-thumbs-up"></em></a>
                                <span>Like</span>
                            </div>

                            <div>
                                <a href="#comment"><em class="fa-regular fa-comments"></em></a>
                                <span>Comment</span>
                            </div>

                            <div>
                                <a href="#"><em class="fa-regular fa-share-from-square"></em></a>
                                <span>Share</span>
                            </div>
                        </div>

                        <div class="timeline__comments">
                            <div class="timeline__comments--profile">

                                <div class="timeline__comments--commentor">
                                    <div class="timeline__comments--image">
                                        <img src="images/user.jpeg" alt="" srcset="">
                                    </div>

                                    <div class="timeline__creator--name">
                                        <h1>Anguzu Daniel</h1>
                                        <p>3 hours ago</p>
                                    </div>
                                </div>

                                <div class="timeline__comments--content">
                                    <ul>
                                        <li>
                                            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. A facere tenetur nihil. Eos culpa quod labore beatae aliquam non vel quia adipisci eaque molestiae maxime, officiis in, distinctio inventore eligendi!
                                                Dolore aperiam amet ex repellendus asperiores. Beatae omnis iure voluptas quia debitis, nihil voluptatem corporis ea ipsum iusto adipisci porro dolor enim quam natus quos excepturi culpa saepe reprehenderit sint?</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <form action="article.php" method="post" class="timeline__comments--form" id="comment">
                                <div class="timeline__creator--image">
                                    <img src="images/user.jpeg" alt="" srcset="">
                                </div>

                                <div class="timeline__form--input">
                                    <textarea name="post" id="" cols="30" rows="10" placeholder="Add a comment"></textarea>
                                    <!-- <button class="btn btn--submit timeline__btn">Publish</button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </article>

            <?php endforeach; ?>
        </div>
        <!-- timeline articles | end here -->
    </section>

    <!-- side navigtion start-->
    <?php include_once "includes/side.php" ?>
    <!-- side navigtion end -->
</main>

<?php include_once "includes/footer.php" ?>