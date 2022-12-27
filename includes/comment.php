                        <form method="post" class="d-flex align-items-center gap-2">
                            <!-- get the current logged in user and show there profile picture 
                                let the be able to add comment form this form -->
                            <div>
                                <?php if (Auth::isLoggedIn() && isset($_SESSION['user_id'])) : ?>
                                    <div class="d-flex">
                                        <?php if (!empty($userLogin)) : ?>
                                            <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                                <img src="./uploads/profile_imgs/<?php echo $userLogin['profile_picture']; ?>" alt="" class=" w-100 border-4 | user-image">
                                            </div>
                                        <?php else : ?>
                                            <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                                <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4 | user-image">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="overflow-hidden top-20 ml-2 border-muted" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid transparent;">
                                        <img src="./uploads/profile_imgs/user.png" alt="" class=" w-100 border-4 | user-image">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="d-flex g-2 flex-column w-100">
                                <!-- <textarea name="post" id="" cols="5" rows="1" placeholder="Add a comment" style="resize: none;" class="form-control"></textarea> -->
                                <!-- <button class="btn btn-primary mb-2 px-4 py-1">Comment</button> -->
                                <input type="text" name="" id="" placeholder="Leave a comment.." class="form-control p-3 comment-input">
                            </div>
                        </form>