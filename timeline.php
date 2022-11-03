<?php include_once "includes/header.php"; ?>


<?php include_once "includes/navigation.php"; ?>

<main class="container">

    <section class="timeline">


        <form action="article.php" method="post" class="timeline__form">
            <div class="timeline__creator--image">
                <img src="images/swangz.webp" alt="" srcset="">
            </div>

            <div class="timeline__form--input">
                <textarea name="post" id="" cols="30" rows="10" class="Add a post"></textarea>
                <button class="btn btn--submit timeline__btn">Post</button>
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

                    </div>
                    <div class="timeline__cta">

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
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. A facere tenetur nihil. Eos culpa quod labore beatae aliquam non vel quia adipisci eaque molestiae maxime, officiis in, distinctio inventore eligendi!
                                        Dolore aperiam amet ex repellendus asperiores. Beatae omnis iure voluptas quia debitis, nihil voluptatem corporis ea ipsum iusto adipisci porro dolor enim quam natus quos excepturi culpa saepe reprehenderit sint?
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <form action="article.php" method="post" class="timeline__comments--form">
                            <textarea name="" id="" cols="30" rows="10" placeholder="Please leave a comment"></textarea>
                        </form>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <?php include_once "includes/side.php" ?>
</main>


<?php include_once "includes/footer.php" ?>