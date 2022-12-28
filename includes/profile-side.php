<?php

$users = User::getAllUsers($connection);

$user = new User();
?>

<!-- side section | shows the ctegory list -->
<div class="mb-4 timeline">
    <div class="w-100">
        <div class="d-flex gap-4 flex-column">
            <?php if (empty($users)) : ?>
                <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
            <?php else : ?>
                <?php foreach ($users as $u) : ?>

                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <?php if ($u['id'] !== $_SESSION['user_id']) : ?>
                            <div class="d-flex justify-content-between bg-white p-4 shadow-sm">
                                <div class="w-25">
                                    <?php
                                    $profile = User::getUserProfile($connection, $u['id']);
                                    if (!empty($profile)) : ?>
                                        <div class="overflow-hidden top-20 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                            <img src="./uploads/profile_imgs/<?php echo $profile['profile_picture']; ?>" alt="" class=" w-100 border-4 | user-image">
                                        </div>
                                    <?php else : ?>
                                        <div class="overflow-hidden top-20border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                            <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4 | user-image">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="w-100">
                                    <a href="profile.php?id=<?= $u['id'] ?>" class="text-decoration-none">
                                        <h5><?= $u['username']; ?></h5>
                                    </a>

                                    <p><?= $u['email']; ?></p>

                                    <div class="d-flex gap-2">


                                        <!-- user can only follow if they are login -->
                                        <?php if (Auth::isLoggedIn()) : ?>


                                            <!-- gets the if of the article creator and the id of the current user in the session -->
                                            <?php if ($u['id'] !== $_SESSION['user_id']) : ?>

                                                <?php $follows = $user->getFollows($connection, $u['id']); ?>

                                                <?php if ($follows['user_id'] === $_SESSION['user_id'] && $follows['followed_user'] === $u['id']) : ?>
                                                    <a href="follow.php?type=unfollow&id=<?= $u['id']; ?>" class="btn btn-light mb-2 text-primary border-primary w-100">
                                                        <i class="fa fa-user-check" aria-hidden="true"></i> Following
                                                    </a>
                                                    <a href="profile.php?id=<?= $u['id']; ?>" class="btn btn-primary mb-2 w-100">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> profile
                                                    </a>
                                                <?php else : ?>
                                                    <a href="follow.php?type=user&id=<?= $u['id']; ?>" class="btn btn-primary mb-2 w-100">
                                                        <i class="fa fa-user-plus"></i> Follow
                                                    </a>

                                                    <a href="profile.php?id=<?= $u['id']; ?>" class="btn btn-primary mb-2 w-100">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> profile
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        <?php else : ?>
                                            <a href="login.php" class="btn btn-primary mb-2 w-100 px-4 py-2">
                                                <i class="fa fa-user-plus"></i> Follow
                                            </a>
                                        <?php endif; ?>


                                    </div>
                                </div>

                            <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
        </div>
    </div>
</div>
<!-- side section | end-->