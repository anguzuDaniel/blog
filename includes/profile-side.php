<?php

$users = User::getAllUsers($connection);

$user = new User();
?>

<!-- side section | shows the ctegory list -->
<div class="mt-5">
    <aside class="side p-4 shadow-sm">
        <div class="side__list side__list--1">
            <?php if (empty($users)) : ?>
                <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
            <?php else : ?>
                <?php foreach ($users as $u) : ?>

                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <?php if ($u['id'] !== $_SESSION['user_id']) : ?>
                            <div class="side__list--content">

                                <div class="side__list--text">
                                    <h5><?= $u['username']; ?></h5>
                                    <p><?= $u['email']; ?></p>

                                    <div class="d-flex justify-content-between">
                                        <!-- user can only follow if they are login -->
                                        <?php if (Auth::isLoggedIn()) : ?>


                                            <!-- gets the if of the article creator and the id of the current user in the session -->
                                            <?php if ($u['id'] !== $_SESSION['user_id']) : ?>
                                                <?php
                                                $follows = $user->getFollows($connection, $u['id']);

                                                // var_dump($follows);

                                                if ($follows['user_id'] === $_SESSION['user_id'] && $follows['followed_user'] === $u['id']) : ?>
                                                    <a href="follow.php?type=unfollow&id=<?= $u['id']; ?>" class="btn btn-light mb-2 px-4 py-2 text-primary border-primary">
                                                        <i class="fa fa-check" aria-hidden="true"></i> Following
                                                    </a>

                                                    <a href="profile.php?id=<?= $u['id']; ?>" class="btn btn-primary mb-2 px-4 py-2">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> View profile
                                                    </a>
                                                <?php elseif ($follows['user_id'] === $_SESSION['user_id'] && $follows['followed_user'] !== $u['id']) : ?>
                                                    <a href="follow.php?type=user&id=<?= $u['id']; ?>" class="btn btn-primary mb-2 px-4 py-2">
                                                        <i class="fa-solid fa-plus"></i> Follow
                                                    </a>

                                                    <a href="profile.php?id=<?= $u['id']; ?>" class="btn btn-primary mb-2 px-4 py-2">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> View profile
                                                    </a>

                                                <?php else : ?>

                                                    <a href="profile.php?id=<?= $u['id']; ?>" class="btn btn-primary mb-2 px-4 py-2">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> View profile
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

                            <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
        </div>
    </aside>
</div>
<!-- side section | end-->