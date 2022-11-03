<?php include_once "includes/header.php"; ?>


<?php include_once "includes/navigation.php"; ?>

<main class="container">

    <section class="timeline">
        <form action="article.php" method="post" class="timeline__form">
            <!-- <div class="timeline__creator--image">
                <img src="images/swangz.webp" alt="" srcset="">
            </div> -->

            <div class="timeline__form--input">
                <textarea name="post" id="" cols="30" rows="10" placeholder="Post an article"></textarea>
                <button class="btn btn--submit timeline__btn">Publish</button>
            </div>
        </form>

        <div class="timeline__wrapper">
            <article>
                <div class="timeline__creator">
                    <div class="timeline__creator--image">
                        <img src="images/swangz.webp" alt="" srcset="">
                    </div>

                    <div class="timeline__creator--name">
                        <h1>Anguzu Daniel</h1>
                        <p>3 hours ago</p>
                    </div>
                </div>

                <div class="timeline__content">
                    <div class="timeline__image">
                        <img src="images/Programming-Language-Popularity.jpg" alt="" srcset="">
                    </div>

                    <div class="timeline__text">
                        <h1 class="timeline__text--title">Lorem ipsum dolor, sit amet</h1>
                        <p class="timeline__text--content">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore officiis nobis impedit pariatur similique ea corrupti fugiat saepe placeat. Nemo, quos. Ea esse quo enim hic autem distinctio ullam consequatur.
                            Fuga laborum magnam obcaecati, maxime a ratione, vitae repudiandae voluptas nulla quos aut alias? Eius consectetur dolorum rerum facilis debitis aperiam eaque. Temporibus voluptatum ab itaque, mollitia magnam eveniet perspiciatis?
                            Quae voluptatem dolorum illo consequatur sed vitae similique, accusamus nostrum eos? Sunt ratione, omnis totam soluta esse dolore iure, quos voluptates eum alias cumque, reprehenderit ducimus ullam expedita cum tempore!
                            Voluptas, exercitationem expedita. Blanditiis tempore ab ut? Magnam eligendi quidem voluptatem, quaerat reprehenderit hic officia, dolores suscipit, itaque reiciendis fugit dignissimos ea quasi iure nobis perspiciatis doloremque corrupti quam voluptatibus?
                        </p>

                    </div>

                    <div class="timeline__cta">

                        <div>
                            <a href="#"><em class="fa-regular fa-thumbs-up"></em></a>
                            <span>Like</span>
                        </div>

                        <div>
                            <a href="#comment"><em class="fa-regular fa-comments"></em></a>
                            <span>Comment</span>
                        </div>

                        <div>
                            <a href="#"><em class="fa-regular fa-share-from-square"></em></a>
                            <span>Share</span>
                        </div>
                    </div>

                    <div class="timeline__comments">
                        <div class="timeline__comments--profile">

                            <div class="timeline__comments--commentor">
                                <div class="timeline__comments--image">
                                    <img src="images/swangz.webp" alt="" srcset="">
                                </div>

                                <div class="timeline__creator--name">
                                    <h1>Anguzu Daniel</h1>
                                    <p>3 hours ago</p>
                                </div>
                            </div>

                            <div class="timeline__comments--content">
                                <ul>
                                    <li>
                                        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. A facere tenetur nihil. Eos culpa quod labore beatae aliquam non vel quia adipisci eaque molestiae maxime, officiis in, distinctio inventore eligendi!
                                            Dolore aperiam amet ex repellendus asperiores. Beatae omnis iure voluptas quia debitis, nihil voluptatem corporis ea ipsum iusto adipisci porro dolor enim quam natus quos excepturi culpa saepe reprehenderit sint?</p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <form action="article.php" method="post" class="timeline__comments--form" id="comment">
                            <div class="timeline__creator--image">
                                <img src="images/swangz.webp" alt="" srcset="">
                            </div>

                            <div class="timeline__form--input">
                                <textarea name="post" id="" cols="30" rows="10" placeholder="Add a comment"></textarea>
                                <!-- <button class="btn btn--submit timeline__btn">Publish</button> -->
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <?php include_once "includes/side.php" ?>
</main>


<?php include_once "includes/footer.php" ?>