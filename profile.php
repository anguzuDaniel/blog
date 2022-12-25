<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";
$user = new User();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $user = $user->getUserInfo($connection, $_GET['id']);
    $userArticle = Article::getUserArticles($connection, $id, "LIMIT 10");
    $profile = User::getUserProfile($connection, $id);
} else {
    $user = null;
}

$art = new Article();


$count = $user->getUserFollowCount($connection, $id);


?>


<?php require_once "includes/navigation.php"; ?>

<!-- user background imga -->
<div class="">

    <div class="position-relative" style="height: 65vh; overflow: hidden;">
        <?php if (!empty($profile)) : ?>
            <img src="./uploads/profile_imgs/<?php echo $profile['cover_image'] ?>" alt="" class=" w-100 border-4">
        <?php else : ?>
            <img src="./uploads/profile_imgs/cover.png" alt="" class=" w-100 border-4">
        <?php endif; ?>
    </div>


    <div class="container position-absolute profile-intro" style="top: 100px; left: 0; right: 0; z-index: 99999;">
        <div class="card">
            <div class="d-flex shadow-sm" style="background-color: transparent; ">
                <div class="d-flex overflow-hidden top-20 ml-2" style="max-width: 25%;">
                    <?php if (!empty($profile)) : ?>
                        <img src="./uploads/profile_imgs/<?php echo $profile['profile_picture'] ?>" alt="" class=" w-100 border-4" style="object-fit: cover; ">
                    <?php else : ?>
                        <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4">
                    <?php endif; ?>
                </div>

                <div class="w-100 d-flex flex-column p-3">
                    <div>
                        <h1 class="text-primary"><?= $user->username; ?></h1>
                        <p class="text-primary"><?= $user->email; ?></p>
                    </div>


                    <div class="d-flex align-items-baseline">
                        <!-- user can only follow if they are login -->
                        <?php if (Auth::isLoggedIn()) : ?>

                            <!-- gets the if of the article creator and the id of the current user in the session -->
                            <?php if ($_SESSION['user_id']) : ?>
                                <?php
                                $follows = $user->getFollows($connection, $user->id);

                                if ($follows['user_id'] === $_SESSION['user_id'] && $follows['followed_user'] === $id) : ?>
                                    <div >
                                        <a href="follow.php?type=unfollow&id=<?= $id; ?>" class="btn btn-light mb-2 px-4 py-2 text-primary border-primary w-100">
                                            <i class="fa fa-check" aria-hidden="true"></i> Following
                                        </a>

                                        <a href="#" class="btn btn-primary mb-2 px-4 py-2 w-100">
                                            <i class="fa fa-envelope" aria-hidden="true"></i> Email
                                        </a>
                                    </div>
                                <?php
                                elseif ($id  == $_SESSION['user_id']) : ?>
                                    <div class="d-flex">
                                        <a href="update-profile.php?id=<?= $id; ?>" class="btn btn-light mb-2 px-4 py-2 text-primary border-primary">
                                            <i class="fa-solid fa-plus"></i> update profile
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <a href="follow.php?type=user&id=<?= $id; ?>" class="btn btn-primary mb-2 px-4 py-2">
                                        <i class="fa-solid fa-plus"></i> Follow
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php else : ?>
                            <a href="login.php" class="btn btn-primary mb-2 w-100 px-4 py-2">
                                <i class="fa-solid fa-plus"></i> Follow
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="d-flex align-content-center justify-content-between bg-light card-footer d-lg-block">
                <div class="d-flex align-content-center justify-content-between">
                    <div class="d-flex align-items-center gap-4 ml-4 ">
                        <div>
                            <h3 class="text-primary">Followers</h3>
                            <?php if (!empty($count)) : ?>
                                <p>
                                    <?= $count; ?> Followers
                                </p>
                            <?php else : ?>
                                <p>
                                    0 Followers
                                </p>
                            <?php endif; ?>
                        </div>

                        <div class="ml-5">
                            <h3 class="text-primary">Following</h3>
                            <?php if (!empty($count)) : ?>
                                <p>
                                    <?= $count; ?> Following
                                </p>
                            <?php else : ?>
                                <p>
                                    0 Following
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex align-items-center gap-4 ml-4 p-4">
                            <?php if (!empty($profile)) : ?>
                                <div>
                                    <h6>Location</h6>
                                    <p><?php echo $profile['country'] == null ? "Not added" : $profile['country'] . "/" . $profile['city']; ?></p>
                                </div>

                                <div>
                                    <h6>Occupation</h6>
                                    <p><?php echo $profile['occupation']; ?>.</p>
                                </div>
                            <?php else : ?>
                                <div>
                                    <h6>Location</h6>
                                    <p>Un employed</p>
                                </div>

                                <div>
                                    <h6>Occupation</h6>
                                    <p>Not added</p>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<div class="container col-12 d-lg-flex gap-4">
    <section class="timeline col-lg-8">
        <?php
        // var_dump($userArticle);

        if (!empty($userArticle)) : ?>
            <!-- timeline articles | start here -->
            <div>
                <?php foreach ($userArticle as $article) : ?>
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
                                                <a href="profile.php?id=<?= $article['created_by']; ?>" class="text-decoration-none"><?= $article['name']; ?></a>
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
                                <!-- user can only follow if they are login -->
                                <?php if (Auth::isLoggedIn()) : ?>

                                    <!-- gets the if of the article creator and the id of the current user in the session -->
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

                                <?php else : ?>
                                    <a href="login.php" class="btn btn-primary mb-2 w-100 px-4 py-2">
                                        <i class="fa-solid fa-plus"></i> Follow
                                    </a>
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

                                            <!-- lets a user like only if they are logged in -->
                                            <?php if (Auth::isLoggedIn()) : ?>
                                                <a href="like.php?type=article&action=unlike&likeId=<?= $likes['like_id']; ?>&id=<?= $article['id']; ?>"><em class="fa fa-thumbs-up" aria-hidden="true"></em></em></a>
                                                <?= $likes['likes'] > 1 ? $likes['likes'] . " people Liked this" : $likes['likes'] . " person Liked this" ?>
                                            <?php else : ?>
                                                <a href="login.php"><em class="fa fa-thumbs-up" aria-hidden="true"></em></em></a>
                                                <?= $likes['likes'] > 1 ? $likes['likes'] . " people Liked this" : $likes['likes'] . " person Liked this" ?>
                                            <?php endif; ?>

                                        <?php else : ?>

                                            <!-- lets a user like only if they are logged in -->
                                            <?php if (Auth::isLoggedIn()) : ?>
                                                <a href="like.php?type=article&action=like&likeId=<?= $likes['like_id'] = null ? $likes['like_id'] : ""; ?>&id=<?= $article['id']; ?>"><em class="fa-regular fa-thumbs-up"></em></a>
                                                0 Likes
                                            <?php else : ?>
                                                <a href="login.php"><em class="fa-regular fa-thumbs-up"></em></a>
                                                0 Likes
                                            <?php endif; ?>
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
            <?php else : ?>
                <p class="paragraph article--paragraph">No articles found..</p>
            <?php endif ?>
    </section>
    <?php require_once "includes/profile-side.php"; ?>
</div>
</div>

<?php require_once "includes/footer.php"; ?>