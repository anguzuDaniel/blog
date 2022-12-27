<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";
$articles = Article::getAll($connection, 10);

$art = new Article();
$user = new User();

?>

<?php include_once "includes/navigation.php"; ?>

<main class="col-12 container d-lg-flex gap-4">

    <section class="timeline col-lg-8">
        <div class="card mb-3">
            <h3 class="card-header">Post</h3>

            <div class="d-flex px-2 align-items-center">

                <!-- get the current logged in user and show there profile picture 
                let the be able to add post form this form -->

                <?php if (Auth::isLoggedIn()) : ?>
                    <?php if (isset($_SESSION['login_user'])) : ?>
                        <div class="d-flex">
                            <?php
                            // var_dump($userLogin);
                            if (!empty($userLogin)) : ?>
                                <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                    <img src="./uploads/profile_imgs/<?php echo $userLogin['profile_picture'] ?>" alt="" class=" w-100 border-4 | user-image">
                                </div>
                            <?php else : ?>

                                <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                    <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4 | user-image">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                        <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4 | user-image">
                    </div>
                <?php endif; ?>

                <!-- timeline form | starts here -->
                <form action="article.php" method="post" class="w-100 d-flex align-items-center">
                    <!-- <p>Create post</p> -->
                    <div class="form-row w-100">
                        <textarea name="post" id="" placeholder="Post an article" class="form-control flex-1" style="resize: none; border: none; outline: none;"></textarea>
                    </div>

                    <div class="py-2 px-2">
                        <button class="btn btn-primary mb-2 px-4 py-1">Publish</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- timeline form | ends here -->

        <!-- timeline articles | start here -->
        <div>
            <?php require_once "includes/article.php"; ?>

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