<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";
$articles = Article::getAll($connection, 10);
?>
<?php include_once "includes/header.php"; ?>

<?php include_once "includes/navigation.php"; ?>

<main class="col-12 container d-lg-flex">

    <section class="timeline col-lg-8">
        <!-- timeline form | starts here -->
        <form action="article.php" method="post" class="card mb-3">
            <!-- <p>Create post</p> -->

            <div class="form-row">
                <textarea name="post" id="" placeholder="Post an article" class="form-control w-100" style="resize: none; border: none;"></textarea>

                <div class="bg-light py-2 px-2">
                    <button class="btn btn-primary mb-2 px-4 py-1">Publish</button>
                </div>
            </div>
        </form>
        <!-- timeline form | ends here -->

        <!-- timeline articles | start here -->
        <div>
            <?php foreach ($articles as $article) : ?>
                <article class="card mb-3">
                    <div class="my-4 mx-4 d-flex g-2">
                        <?php if ($article['article_image'] !== null) : ?>
                            <div class="timeline__creator--image">
                                <img src="images/<?= $article['article_image']; ?>" alt="image" />
                            </div>
                        <?php else : ?>
                            <div class="timeline__image rounded-circle">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        <?php endif; ?>

                        <div class="timeline__creator">

                            <div class="timeline__creator--name">
                                <h1 class="featured__articles--title"><?= $article['article_title']; ?></h1>
                            </div>

                            <time datetime="<?= $article['published_at'] ?>">
                                <?php
                                $datetime = new DateTime($article['published_at']);
                                echo $datetime->format("j F, Y");
                                ?>
                            </time>
                        </div>

                    </div>

                    <div class="mx-4">
                        <p class="timeline__text--content"><?= substr($article['article_content'], 0, 150); ?>... <a href="">more</a></p>
                    </div>

                    <div class="timeline__content">

                        <?php if ($article['article_image'] !== null) : ?>
                            <div class="timeline__image">
                                <img src="images/<?= $article['article_image']; ?>" alt="image" />
                            </div>
                        <?php endif; ?>

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

                        <form action="article.php" method="post" class="d-flex g-2" id="comment">
                            <div class="timeline__creator--image">
                                <img src="images/user.jpeg" alt="" srcset="">
                            </div>

                            <div class="d-flex g-2 flex-column w-100">
                                <textarea name="post" id="" placeholder="Add a comment" style="resize: none;"></textarea>
                                <!-- <button class="btn btn-primary mb-2 px-4 py-1">Comment</button> -->
                            </div>
                        </form>

                        <div class="timeline__comments">
                            <!-- <div class="timeline__comments--profile">

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
                            </div> -->

                        </div>
                    </div>
                </article>

            <?php endforeach; ?>
        </div>
        <!-- timeline articles | end here -->
    </section>

    <!-- side navigtion start-->
    <?php include_once "./includes/side.php" ?>
    <!-- side navigtion end -->
</main>

<?php include_once "includes/footer.php" ?>