<!-- loops through the articles array and prints out the values -->
<!-- this page is used in the index page and profile page -->
<!--  -->
<?php foreach ($articles as $article) : ?>
    <article class="mb-3 bg-white shadow-sm">
        <div class=" d-flex justify-content-between p-4 align-items-top">

            <div class="d-flex justify-content-between gap-4 ">
                <!-- get the user profile of the currently logged in user -->
                <?php $profile = User::getUserProfile($connection, $article['created_by']); ?>
                <!-- checks of the image is null | else shows image -->
                <?php if (!empty($profile)) : ?>
                    <div class="overflow-hidden top-20 ml-2 border-muted | user-image-comment">
                        <img src="./uploads/profile_imgs/<?= $profile['profile_picture']; ?>" alt="image" class=" w-100 border-4 | user-image" />
                    </div>
                <?php else : ?>
                    <div class="overflow-hidden top-20 ml-2 border-muted | user-image-comment">
                        <img src="./uploads/profile_imgs/user.png" alt="image" class=" w-100 border-4 | user-image" />
                    </div>
                <?php endif; ?>


                <!-- checks of the image is null | else shows image -->
                <div>
                    <?php if ($article['name'] !== null) : ?>
                        <div>
                            <p>
                                <a href="profile.php?id=<?= $article['created_by']; ?>" class="text-decoration-none"><?= $article['name']; ?></a>
                            </p>
                        </div>
                    <?php else : ?>
                        <div>
                            <p>
                                <a href="#">Anonymous</a>
                            </p>
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
                <!-- user can only follow if they are logged in -->
                <?php if (Auth::isLoggedIn()) : ?>

                    <!-- if article creator and the is not equals the current active session -->
                    <?php if ($article['created_by'] !== $_SESSION['user_id']) : ?>

                        <?php $follows = $user->getFollows($connection, $article['created_by']); ?>


                        <!-- if the article create not aready followed how follow button else show following
                        Follow button directs to the follow page.
                        Following button directs to thw unfollow page. -->

                        <?php if ($follows['followed_user'] !== $article['created_by']) : ?>
                            <a href="follow.php?type=user&id=<?= $article['created_by']; ?>" class="btn btn-primary mb-2 w-100 shadow-sm">
                                <i class="fa fa-user-plus"></i> Follow
                            </a>
                        <?php else : ?>
                            <a href="follow.php?type=unfollow&id=<?= $follows['follow_id']; ?>" class="btn btn-light mb-2 w-100 text-primary border-primary shadow-sm">
                                <i class="fa fa-user-check" aria-hidden="true"></i> Following
                            </a>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="article-options">
                            <div class="edit-dots article-options-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                            <div class="bg-white shadow-sm article-option-list card " p-2">
                                <div class="p-2 border-bottom"><a href="./admin/edit_article.php?id=<?= $article['id'] ?>" class="text-decoration-none">Edit</a></div>
                                <div class="p-2"><a href="profile.php?id=<?= $_SESSION['user_id']; ?>" class="text-decoration-none">delete</a></div>
                            </div>
                        </div>



                    <?php endif; ?>

                    <!-- if user is not logged in then they will be tranfered to the login page -->
                <?php else : ?>
                    <a href="login.php" class="btn btn-primary mb-2 w-100 px-4 py-2">
                        <i class="fa-solid fa-plus"></i> Follow
                    </a>
                <?php endif; ?>
            </div>
        </div>



        <div class="px-4">
            <div>
                <h1><?= $article['article_title']; ?></h1>
            </div>

            <div>
                <p class="cut-text"><?= $article['article_content']; ?> </p>
                <input class="excomment-pand" type="checkbox">
            </div>

            check out the <a href="article.php?id=<?= $article['id']; ?>">full article</a>
        </div>




        <div class="p-4">
            <div>
                <!-- checks if the image is not null and not a empty string 
                    if true then ot will just be a regular post 
                    else an image will be shown
                -->
                <?php if ($article['article_image'] !== null && $article['article_image'] !== '') : ?>
                    <img src="./uploads/images/<?= $article['article_image']; ?>" alt="image" class="w-100" />
                <?php endif; ?>
            </div>

        </div>

        <?php $id = $article['id']; ?>
        <!-- like functionality -->
        <?php require_once "./includes/like.php"; ?>
        <!-- like functionality -->

        <div class="p-4 border-bottom">
            <!-- comment form -->
            <?php require_once "./includes/comment.php"; ?>
            <!-- comment form -->
        </div>

        <?php require_once "./includes/comment-display.php"; ?>


    </article>

<?php endforeach; ?>