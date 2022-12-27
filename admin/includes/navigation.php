<?php require_once "includes/header.php"; ?>
<?php
if (Auth::isLoggedIn()) {
    $loggedInUser = $_SESSION['login_user'];
    $loggedInUserId = $_SESSION['user_id'];
    $userLogin = User::getUserProfile($connection, $_SESSION['user_id']);
}


?>

<header>
    <div class="header px-5 py-3 bg-light border d-flex justify-content-between w-100 align-items-center">

        <h1 class="header--logo  mr-auto"><?php echo APP_NAME; ?>!</h1>

        <div>
            <?php if (Auth::isLoggedIn()) : ?>
                <?php if (isset($_SESSION['login_user'])) : ?>
                    <div class="d-flex align-items-center position-relative" style="cursor: pointer;">


                        <?php if (!empty($userLogin)) : ?>
                            <div id="user-options" class="d-flex align-items-center gap-1">
                                <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                    <img src="../uploads/profile_imgs/<?php echo $userLogin['profile_picture']; ?>" alt="image" class=" w-100 border-4 | user-image">
                                </div>

                                <div class="text-primary">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                        <?php else : ?>
                            <div id="user-options" class="d-flex align-items-center gap-1">
                                <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                    <img src="../uploads/profile_imgs/user.png" alt="" class=" w-100 border-4 | user-image">
                                </div>

                                <div class="text-primary">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="bg-white position-absolute shadow-sm user-option-list card" style="top: 55px; right: 5px; width: 200px; display: none;">
                            <div class="border-bottom p-2 px-4"><a href="./index.php" class="text-decoration-none">Homepage</a></div>

                            <div class="border-bottom px-4">
                                <div class="p-2"><a href="../profile.php?id=<?= $_SESSION['user_id']; ?>" class="text-decoration-none">My profile</a></div>
                                <div class="p-2"><a href="../update-profile.php?id=<?= $_SESSION['user_id']; ?>" class="text-decoration-none">Update profile</a></div>
                            </div>

                            <div class="border-bottom px-4">
                                <div class="p-2"><a href="../index.php" class="text-decoration-none">Homepage</a></div>
                                <div class="p-2"><a href="../admin/index.php" class="text-decoration-none">My Dashboard</a></div>
                            </div>


                            <div class="border-bottom px-4">
                                <div class="p-2"><a href="./admin/create_article.php" class="text-decoration-none">Create article</a></div>
                                <div class="p-2"><a href="./admin/all_articles.php" class="text-decoration-none">All articles</a></div>
                            </div>

                            <div class="border-bottom p-2 px-4"><a href="logout.php" class="text-decoration-none">Log Out</a></div>
                        </div>

                    </div>

                <?php endif; ?>
            <?php else : ?>
                <div class="d-flex gap-3">
                    <a href="login.php" class="btn btn-light px-4 py-2 text-primary border-primary">Log In</a>

                    <a href="signup.php" class="btn btn-primary px-4 py-2">Signup</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="admin-nav bg-primary">

        <?php require_once "includes/sidebar.php"; ?>
    </div>
</header>