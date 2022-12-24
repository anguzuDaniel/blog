<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";
$articles = Article::getAll($connection, 10);

$art = new Article();
$user = new User();

?>
<?php include_once "includes/header.php"; ?>

<?php include_once "includes/navigation.php"; ?>

<main class="col-12 container d-lg-flex gap-4">

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
                <article class="card mb-3 d-flex">
                    <div class="my-4 mx-4 d-flex g-2 justify-content-between">
                        <div class="d-flex justify-content-between">
                            <!-- checks of the image is null | else shows image -->
                            <?php if ($article['article_image'] !== null) : ?>
                                <div class="timeline__creator--image">
                                    <img src="images/<?= $article['article_image']; ?>" alt="image" />
                                </div>
                            <?php else : ?>
                                <div class="timeline__image rounded-circle">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            <?php endif; ?>

                            <!-- checks of the image is null | else shows image -->
                            <div class="timeline__creator ml-4">
                                <?php if ($article['name'] !== null) : ?>
                                    <div class="timeline__creator--name">
                                        <h3>
                                            <a href="#" class="text-decoration-none"><?= $article['name']; ?></a>
                                        </h3>
                                    </div>
                                <?php else : ?>
                                    <div class="timeline__creator--name">
                                        <h3><a href="#">Anonymous</a></h3>
                                    </div>
                                <?php endif; ?>

                                <!-- checks of the image is null | else shows image -->
                                <time datetime="<?= $article['published_at'] ?>">
                                    <?php
                                    $datetime = new DateTime($article['published_at']);
                                    echo $datetime->format("j F, Y");
                                    ?>
                                </time>
                            </div>
                        </div>

                        <div>
                            <?php if ($article['created_by'] !== $_SESSION['user_id']) : ?>
                                <?php
                                $follows = $user->getFollows($connection, $article['created_by']);

                                if ($follows['followed_user'] !== $article['created_by']) : ?>
                                    <a href="follow.php?type=user&id=<?= $article['created_by']; ?>" class="btn btn-primary mb-2 w-100 px-4 py-2">
                                        <i class="fa-solid fa-plus"></i> Follow
                                    </a>
                                <?php else : ?>
                                    <a href="follow.php?type=unfollow&id=<?= $follows['follow_id']; ?>" class="btn btn-light mb-2 w-100 px-4 py-2 text-primary border-primary">
                                        <i class="fa fa-check" aria-hidden="true"></i> Following
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class=" mx-4">
                        <div class="timeline__creator--name">
                            <h1 class="h1"><?= $article['article_title']; ?></h1>
                        </div>

                        <div>
                            <p class="cut-text"><?= $article['article_content']; ?> </p>
                            <input class="expand-btn" type="checkbox">
                        </div>

                        check out the <a href="article.php?id=<?= $article['id']; ?>">full article</a>
                    </div>

                    <div class="timeline__content">

                        <?php if ($article['article_image'] !== null) : ?>
                            <div class="timeline__image">
                                <img src="images/<?= $article['article_image']; ?>" alt="image" />
                            </div>
                        <?php endif; ?>

                        <div class="timeline__cta">

                            <div>
                                <p>
                                    <?php
                                    $likes = $art->getArticleLikes($connection, $article['id']);

                                    if (!empty($likes)) : ?>

                                        <a href="like.php?type=article&id=<?= $article['id']; ?>"><em class="fa fa-thumbs-up" aria-hidden="true"></em></em></a>
                                        <?= $likes['likes'] > 1 ? $likes['likes'] . " people Liked this" : $likes['likes'] . " person Liked this" ?>

                                    <?php else : ?>
                                        <a href="like.php?type=article&id=<?= $article['id']; ?>"><em class="fa-regular fa-thumbs-up"></em></a>
                                        0 Likes
                                    <?php endif; ?>
                                </p>
                            </div>

                            <div>
                                <a href="#"><em class="fa-regular fa-share-from-square"></em></a>
                                <span>Share</span>
                            </div>
                        </div>

                        <form action="article.php" method="post" class="d-flex g-2 p-2 bg-light" id="comment">
                            <div class="timeline__creator--image">
                                <img src="images/user.jpeg" alt="" srcset="">
                            </div>

                            <div class="d-flex g-2 flex-column w-100">
                                <textarea name="post" id="" placeholder="Add a comment" style="resize: none;" class="form-input"></textarea>
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

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
        <!-- timeline articles | end here -->
    </section>

    <!-- side navigtion start-->
    <?php include_once "./includes/side.php" ?>
    <!-- side navigtion end -->
</main>

<?php include_once "includes/footer.php" ?>