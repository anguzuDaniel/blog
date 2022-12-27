                <div class="d-flex gap-3 align-items-center justify-content-between border-bottom border-top p-4">
                    <div>
                        <div>
                            <div class="d-flex  justify-content-between gap-3 align-items-center">
                                <?php $likes = $art->getArticleLikes($connection, $id); ?>
                                <?php if (!empty($likes)) : ?>
                                    <?php $profiles = User::getUserProfile($connection, $likes['user_id']); ?>
                                    <!-- lets a user like only if they are logged in -->
                                    <?php if (Auth::isLoggedIn()) : ?>
                                        <a href="like.php?type=article&action=like&likeId=<?= $likes['like_id']; ?>&id=<?= $id; ?>"><em class="fa fa-heart like-btn" aria-hidden="true"></em></em></a>
                                        <?php if (!empty($profiles)) :
                                            // var_dump($profiles);
                                        ?>
                                            <div class="d-flex">
                                                <!-- 
                                                    if the array size is 0 then print the image out
                                                    else loops through array and print out the images
                                                 -->

                                                <div class="comment-img-wrapper">
                                                    <?php if ($profiles['profile_picture'] !== null && $profiles['profile_picture'] !== '') : ?>
                                                        <div>
                                                            <img src="./uploads/profile_imgs/<?= $profiles['profile_picture']; ?>" alt="image of " class="w-100 | user-image comment-img" />
                                                        </div>

                                                        <div>
                                                            <img src="./uploads/profile_imgs/<?= $profiles['profile_picture']; ?>" alt="image of " class="w-100 | user-image comment-img" />
                                                        </div>
                                                    <?php else : ?>
                                                        <img src="./uploads/profile_imgs/user.png" alt="image test | user-image comment-img" class="w-100" />
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="d-flex" style=" width: 20px; border-radius: 50%;">
                                                <div>
                                                    <img src="./uploads/profile_imgs/user.png" alt="image test" class="w-100" style="border-radius: 50%;" />
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <span class="text-muted">
                                            <?= $likes['likes'] > 1 ? $likes['likes'] . " Likes" : $likes['likes'] . " person Liked this" ?>
                                        </span>
                                    <?php else : ?>
                                        <a href="login.php"><em class="fa fa-heart like-btn" aria-hidden="true"></em></em></a>
                                        <?= $likes['likes'] > 1 ? $likes['likes'] . " people Liked this" : $likes['likes'] . " person Liked this" ?>
                                    <?php endif; ?>

                                <?php else : ?>

                                    <!-- lets a user like only if they are logged in -->
                                    <?php if (Auth::isLoggedIn()) : ?>
                                        <a href="like.php?type=article&action=like&likeId=<?= $likes['like_id'] = null ? $likes['like_id'] : ""; ?>&id=<?= $id; ?>"><em class="fa-regular fa-heart like-btn"></em></a>
                                        0 Likes
                                    <?php else : ?>
                                        <a href="login.php"><em class="fa-regular fa-heart like-btn"></em></a>
                                        0 Likes
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>