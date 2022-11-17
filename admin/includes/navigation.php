<?php
$user = new User();

$currentUser = $user->getUserInfo($connection);
?>
<header class="admin__header">
    <div class="admin__primary">
        <h1 class="admin--logo">BlogIfy!</h1>

        <div class="admin__content--heading">
            <?php if (Auth::isLoggedIn()) :  ?>
                <h1><?php  echo $currentUser->username; ?></h1>
            <?php endif; ?>
            <div class="admin__content--user">
                <img src="../images/image-avatar.png" alt="" srcset="">
            </div>
        </div>
    </div>
</header>