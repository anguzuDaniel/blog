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
<!-- main section start -->
<?php require_once "./includes/navigation.php"; ?>

<main class="col-12 container d-lg-flex gap-4 my-lg-5"">

    <!-- user background imga -->
    <div class=" col-lg-4">

    <div class="mt-5 profile-intro" style="top: 100px; left: 0; right: 0; z-index: 99999;">


        <div class="card  shadow-sm">
            <div class="position-relative">
                <div style="overflow: hidden;">
                    <?php if (!empty($profile)) : ?>
                        <img src="./uploads/profile_imgs/<?php echo $profile['cover_image'] ?>" alt="" class=" w-100 border-4">
                    <?php else : ?>
                        <img src="./uploads/profile_imgs/cover.png" alt="" class=" w-100 border-4">
                    <?php endif; ?>

                </div>

                <div class="position-absolute ms-3" style="bottom: -25px; z-index: 99999; ">
                    <div class="d-flex overflow-hidden top-20 ml-2" style=" width: 100px; height: 100px; border-radius: 50%; border: 2px solid transparent;">
                        <?php if (!empty($profile)) : ?>
                            <img src="./uploads/profile_imgs/<?php echo $profile['profile_picture'] ?>" alt="" class=" w-100 border-4 shadow-sm" style="object-fit: cover; ">
                        <?php else : ?>
                            <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4">
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <div class="align-content-center justify-content-between bg-light card-footer d-lg-block pt-4">
                <div class="w-100 d-flex flex-column">
                    <div>
                        <h1 class="text-primary"><?= $user->username; ?></h1>
                        <p class="text-primary"><?= $user->email; ?></p>
                    </div>
                </div>

                <div>
                    <h3>Life quote</h3>
                    <?php if (!empty($profile)) : ?>
                        <p><?php echo $profile['qoute']; ?></p>
                    <?php else : ?>
                        <p>Add quote</p>
                    <?php endif; ?>
                </div>

                <div class="align-content-center justify-content-between">
                    <div class="d-flex align-items-center gap-4">
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
                        <div class="d-flex align-items-center gap-4 pt-2">
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


    <!-- admin section wrapper start -->
    <section class="col-lg-8">

        <form method="post" class="mt-5">
            <h1 class="h1">Update profile</h1>

            <div class="row">
                <div class="col-lg">
                    <label for="profile-picture" class="col-form-label">Profile Picture</label>
                    <input type="file" name="profile-picture" id="" required value="" class="form-control">
                </div>

                <div class="col-lg">
                    <label for="cover-image" class="col-form-label">Cover image</label>
                    <input type="file" name="cover-image" id="" required value="" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-lg">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" name="email" id="" required value="" class="form-control">
                </div>

                <div class="col-lg">
                    <label for="country" class="col-form-label">Country</label>
                    <input type="text" name="country" id="" required value="" class="form-control">
                </div>
            </div>

            <div class="col">
                <label for="occupation" class="col-form-label">Occupation</label>
                <input type="text" name="occupation" id="" required value="" class="form-control">
            </div>

            <div class="col">
                <label for="qoute" class="col-form-label">Qoute</label>
                <textarea name="qoute" id="" style="resize: none;" required class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mb-2 px-5 mt-3">Save</button>
        </form>
    </section>
    <!-- admin section wrapper end -->
</main>
<!-- main section end -->

</body>

</html>