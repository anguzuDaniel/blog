<?php require_once "../classes/auth.php"; ?>
<?php require_once "../classes/user.php"; ?>

<?php
$user = new User();
?>
<header class="admin__header">
    <div class="admin__primary">
        <h1 class="admin--logo">BlogIfy!</h1>

        <div class="admin__content--heading">
            <?php if (Auth::isLoggedIn()) :  ?>
                <h1><?= $user->username; ?></h1>
            <?php endif; ?>
            <div class="admin__content--user">
                <img src="../images/image-avatar.png" alt="" srcset="">
            </div>
        </div>
    </div>
</header>