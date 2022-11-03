<?php include_once "includes/header.php" ?>

<body>
    <?php include_once "includes/navigation.php" ?>

    <main>
        <form action="article.php" method="post" class="timelime__form">
            <textarea name="post" id="" cols="30" rows="10"></textarea>
            <button>Post</button>
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
                            <div class="timeline__creator--image">
                                <img src="images/swangz.webp" alt="" srcset="">
                            </div>

                            <div class="timeline__creator--name">
                                <h1>Anguzu Daniel</h1>
                                <p>3 hours ago</p>
                            </div>

                            <form action="article.php" method="post">
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </main>
</body>

</html>