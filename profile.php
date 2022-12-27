<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";
$user = new User();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $user = $user->getUserInfo($connection, $_GET['id']);
    $articles = Article::getUserArticles($connection, $id);
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


    <div class="container position-absolute profile-intro " style="top: 100px; left: 0; right: 0; z-index: 99999;">
        <div class="card p-3 shadow-sm column">
            <div class="d-flex align-items-center" style="background-color: transparent; ">
                <div class="d-flex overflow-hidden top-20 ml-2" style="max-width: 25%;">
                    <?php if (!empty($profile)) : ?>
                        <img src="./uploads/profile_imgs/<?php echo $profile['profile_picture'] ?>" alt="" class=" w-100 border-4" style="object-fit: cover; border-radius: 50%;">
                    <?php else : ?>
                        <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4" style="border-radius: 50%;">
                    <?php endif; ?>
                </div>

                <div class="d-flex flex-column p-3 border-primary" style="border-right: 1px solid transparent;">
                    <div>
                        <h1 class="text-primary"><?= $user->username; ?></h1>
                        <p class="text-primary"><?= $user->email; ?></p>
                    </div>

                    <div>
                        <div>
                            <?php if (!empty($profile)) : ?>
                                <div>
                                    <p><?php echo $profile['occupation']; ?>.</p>
                                </div>
                            <?php else : ?>
                                <div>
                                    <p>Unemployed</p>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex align-items-baseline">
                        <!-- user can only follow if they are login -->
                        <?php if (Auth::isLoggedIn()) : ?>

                            <!-- gets the if of the article creator and the id of the current user in the session -->
                            <?php if ($_SESSION['user_id']) : ?>
                                <?php
                                $follows = $user->getFollows($connection, $user->id);

                                if ($follows['user_id'] === $_SESSION['user_id'] && $follows['followed_user'] === $id) : ?>
                                    <div class="d-flex justify-content-between w-100 gap-2">
                                        <a href="follow.php?type=unfollow&id=<?= $id; ?>" class="btn btn-light mb-2 px-4 py-2 text-primary border-primary w-100">
                                            <i class="fa fa-check" aria-hidden="true"></i> Following
                                        </a>

                                        <a href="#" class="btn btn-primary mb-2 px-4 py-2 w-100">
                                            <i class="fa fa-envelope" aria-hidden="true"></i> Email
                                        </a>
                                    </div>
                                <?php
                                elseif ($id  == $_SESSION['user_id']) : ?>
                                    <div class="d-flex w-100">
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

                <div class="d-flex align-content-center justify-content-between d-lg-block">
                    <div class="align-content-center justify-content-between">
                        <div class=" gap-4 ml-4 ">
                            <div class="d-flex">
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

                            <div class="ml-5 d-flex">
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
                            <div class="ml-4 p-4">
                                <?php if (!empty($profile)) : ?>
                                    <div class="d-flex">
                                        <h6>Location</h6>
                                        <p><?php echo $profile['country'] == null ? "Not added" : $profile['country'] . "/" . $profile['city']; ?></p>
                                    </div>

                                    <div class="d-flex">
                                        <h6>Occupation</h6>
                                        <p><?php echo $profile['occupation']; ?>.</p>
                                    </div>
                                <?php else : ?>
                                    <div class="d-flex">
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
</div>

<div class="container col-12 d-lg-flex gap-4">
    <section class="timeline col-lg-8">
        <?php require_once "includes/article.php"; ?>
    </section>
    <?php require_once "includes/profile-side.php"; ?>
</div>
</div>

<?php require_once "includes/footer.php"; ?>