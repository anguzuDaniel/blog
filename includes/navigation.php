<?php require_once "includes/header.php"; ?>
<?php
if (Auth::isLoggedIn()) {
    $loggedInUser = $_SESSION['login_user'];
    $loggedInUserId = $_SESSION['user_id'];
    $userLogin = User::getUserProfile($connection, $loggedInUserId);
}


?>

<header class="header px-5 py-3 bg-light border d-flex justify-content-between w-100 align-items-center" style="z-index: 999999;">
    <h1 class="header--logo  mr-auto"><?php echo APP_NAME; ?>!</h1>

    <?php if (Auth::isLoggedIn()) : ?>
        <?php if (isset($_SESSION['login_user'])) : ?>
            <div class="d-flex">


                <?php if (!empty($userLogin)) : ?>
                    <a href="logout.php" class="px-4 py-2 text-primary text-decoration-none">Logout</a>

                    <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                        <img src="./uploads/profile_imgs/<?php echo $userLogin['profile_picture'] ?>" alt="" class=" w-100 border-4" style="object-fit: cover;">
                    </div>
                <?php else : ?>
                    <a href="logout.php" class="px-4 py-2 text-primary text-decoration-none">Logout</a>

                    <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                        <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4" style="object-fit: cover;">
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>
    <?php else : ?>

        <div class="d-flex gap-3">
            <a href="login.php" class="btn btn-light px-4 py-2 text-primary border-primary">Log In</a>

            <a href="signup.php" class="btn btn-primary px-4 py-2">Signup</a>
        </div>
    <?php endif; ?>


    <!-- <div class="header__secondary">
        <nav> -->
    <!--   <ul class="nav__list">
                <li class="nav__list--item">
                    <select name="tech" id="tech">
                        <option value="">
                            <a href="#">Technology</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                    </select>
                </li>

                <li class="nav__list--item">
                    <select name="lifestyle" id="lifestyle">
                        <option value="">
                            <a href="#">LifeStyle</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                    </select>
                </li>

                <li class="nav__list--item">
                    <select name="" id="">
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                    </select>
                </li>
            </ul> -->

    <!-- <ul class="nav__list">
                <li class="nav__list--item"><a href="index.php">Home</a></li>
                <li class="nav__list--item"><a href="#">Pages</a></li>
                <li class="nav__list--item"><a href="#">Blog</a></li>
                <li class="nav__list--item"><a href="#">Shop</a></li>
                <li class="nav__list--item"><a href="timeline.php">Timeline</a></li>
            </ul>
        </nav> -->
    </div>
</header>