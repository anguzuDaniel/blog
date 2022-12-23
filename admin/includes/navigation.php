<?php
$loggedInUser = $_SESSION['login_user'];
?>

<header class="admin__header">
    <div class="admin__primary">
        <h1 class="admin--logo">BlogIfy!</h1>

        <div class="admin__content--heading">
            <?php if (Auth::isLoggedIn()) :  ?>
                <div class="admin__user--cta">



                    <button class="admin__user--btn">
                        <p><?php echo $loggedInUser; ?></p>
                        <div class="admin__content--user">
                            <img src="../images/image-avatar.png" alt="" srcset="">
                        </div>
                        <em class="fa-solid fa-dropdown"></em>
                    </button>

                    <div class="dropdown">
                        <div class="dropdown__item">
                            <a href="../logout.php" class="btn--logout">Log out</a>
                        </div>
                        <div class="dropdown__item"><a href="../logout.php" class="btn--logout">Edit Profile</a></div>
                        <div class="dropdown__item"><a href="../logout.php" class="btn--logout">Edit Profile</a></div>
                        <div class="dropdown__item"><a href="../logout.php" class="btn--logout">Edit Profile</a></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>