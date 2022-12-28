<?php include_once "includes/header.php"; ?>
<?php if (!empty($comments)) : ?>
    <div class="d-flex flex-column p-3 border-bottom">
        <div>
            <ul style="margin: 0; padding: 0;">

                <?php foreach ($comments as $comment) : ?>
                    <li ">
                        <div class=" d-flex gap-2 w-100 py-3 border-bottom">
                        <?php $profile = User::getUserProfile($connection, $comment['user_id']);
                        // var_dump($comment);
                        ?>
                        <?php if (!empty($profile)) : ?>
                            <div class=" d-flex">
                                <div class="overflow-hidden top-20 ml-2 border-muted | user-image-comment">
                                    <img src="./uploads/profile_imgs/<?php echo $profile['profile_picture']; ?>" alt="" class=" w-100 border-4 | user-image">
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4 | user-image">
                            </div>
                        <?php endif; ?>

                        <div class="w-100">
                            <div class="d-flex">
                                <div>
                                    <h5><a href="profile.php?id=<?= $comment['user_id']; ?>" class="text-decoration-none"><?= $comment['username']; ?></a></h5>
                                    <p><?= $comment['comment'] ?>.</p>
                                </div>

                                <time datetime="<?= $comment['comment_at']; ?>">
                                    <?php
                                    // $datetime = new DateTime($comment['comment_at']);


                                    echo DateFormat::timeElapsedString($comment['comment_at'], true);
                                    ?>
                                </time>

                                <div class="edit-dots ms-auto">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>

                            <div class="d-flex gap-2 w-100">
                                <a href="#" class="text-primary"><em class="fa fa-thumbs-up comment-like" aria-hidden="true"></em></em></a>
                                <a href="#" class="text-primary"><em class="fa fa-thumbs-down comment-like" aria-hidden="true"></em></em></a>
                                <a href="" class="text-decoration-none text-primary">reply</a>
                            </div>
                        </div>
        </div>

        <?php $replies = Article::getArticleCommentReply($connection, intval($comment['article_id']), intval($comment['com_id']), intval($comment['user_id']));
                    // var_dump($replies);
        ?>

        <?php if (!empty($replies)) : ?>
            <!-- reply comment -->
            <ul>
                <?php foreach ($replies as $reply) : ?>
                    <li class="border-bottom">
                        <div class="d-flex gap-2 py-3">
                            <?php $profile = User::getUserProfile($connection, $reply['user_replied']); ?>
                            <?php if (!empty($profile)) : ?>
                                <div class="d-flex">
                                    <div class="overflow-hidden top-20 ml-2 border-muted | user-image-comment">
                                        <img src="./uploads/profile_imgs/<?php echo $profile['profile_picture']; ?>" alt="" class=" w-100 border-4 | user-image">
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                    <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4 | user-image">
                                </div>
                            <?php endif; ?>

                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5><a href="profile.php?id=<?= $reply['user_replied']; ?>" class="text-decoration-none"><?= $reply['username']; ?></a></h5>
                                        <p><?= $reply['reply']; ?></p>
                                    </div>

                                    <div class="edit-dots">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100">
                                    <a href="#" class="text-primary"><em class="fa fa-thumbs-up comment-like" aria-hidden="true"></em></em></a>
                                    <a href="#" class="text-primary"><em class="fa fa-thumbs-down comment-like" aria-hidden="true"></em></em></a>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        </li>
    <?php endforeach; ?>
    </ul>

    </div>
    </div>
<?php endif; ?>