<?php require "includes/header.php" ?>
<?php

require "includes/database.php";

$sql = "SELECT * FROM articles LIMIT 4 ";

$result = mysqli_query($connection, $sql);

if ($result === false) {
    echo mysqli_error($connection);
} else {
    $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // var_dump($articles);
}

?>

<!-- navigation bar -->
<?php require "includes/navigation.php" ?>


<!-- main content begining -->
<main>

    <div class="container">

        <section class="container__articles">
            <div class="article__wrappper article__wrappper--large">
                <div class="article__text">
                    <h1 class="heading | article__text--title | article__text--title">What do software Engineers do?</h1>
                    <p class="article__paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam magnam minima adipisci nihil recusandae aut exercitationem,...</p>
                    <p class="article__date article__date--small">OCT 09, 2022</p>
                </div>

            </div>

            <div class="container__articles--grid">
                <div class=" article__wrappper | article__wrappper--small | article__wrappper--1">

                    <!-- <img src="images/repository-open-graph-template.png" /> -->
                    <div class="article__text">
                        <h1 class="heading | article__text--title">Swangz</h1>
                        <p class="article__date">Sept 11, 2021</p>
                    </div>
                </div>

                <div class="article__wrappper | article__wrappper--small | article__wrappper--2">
                    <div class="article__text">
                        <h1 class="heading | article__text--title">UG Thrifting..</h1>
                        <p class="article__date">Dec 29, 2021</p>
                    </div>
                </div>



                <div class="article__wrappper | article__wrappper--small | article__wrappper--3">
                    <div class="article__text">
                        <h1 class="heading | article__text--title">UG Thrifting..</h1>
                        <p class="article__date">Dec 29, 2021</p>
                    </div>
                </div>



                <div class="article__wrappper | article__wrappper--small | article__wrappper--4">
                    <div class="article__text">
                        <h1 class="heading | article__text--title">UG Thrifting..</h1>
                        <p class="article__date">Dec 29, 2021</p>
                    </div>
                </div>

            </div>

        </section>
    </div>

    <section class="read__article">


        <div>
            <div class="read__article--underline read__article--underline1">
                <h1 class="read__article--heading">Must Read</h1>
                <span></span>
            </div>

            <!-- lastest artciles section start -->
            <div class="lastest__articles">

                <?php if (empty($articles)) : ?>
                    <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
                <?php else : ?>
                    <?php foreach ($articles as $article) : ?>
                        <article>
                            <div class="lastest__articles--image">
                                <img src="images/<?= $article['article_image']; ?>" />
                            </div>
                            <!-- <img src="images/Programming-Language-Popularity.jpg" alt="" srcset=""> -->
                            <div class="lastest__articles--text">
                                <h1 class="lastest__articles--title"><?= $article['article_title']; ?></h1>
                                <p class="lastest__articles--paragraph"><?= substr($article['article_content'], 0, 150); ?>...</p>
                                <p class="lastest__articles--date">December 11, 2016</p>
                                <a href="article.php?id=<?= $article['id']; ?>" class="btn btn--read"> <span>read more</span> </a>
                            </div>

                        </article>
                    <?php endforeach; ?>

                <?php endif ?>
            </div>
            <!-- lastest artciles section end -->
        </div>
        <!-- side section | shows the ctegory list -->

        <div>

            <aside>
                <div class="side__list side__list--1">
                    <div class="side__list--navigation">
                        <button class="side__list--active">This week</button>
                        <button>this month</button>
                        <button>All time</button>
                    </div>

                    <?php if (empty($articles)) : ?>
                        <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
                    <?php else : ?>
                        <?php foreach ($articles as $article) : ?>
                            <div class="side__list--content">
                                <div class="side__list--img">
                                    <img src="images/<?= $article['article_image']; ?>" alt="" srcset="">
                                </div>
                                <div class="side__list--text">
                                    <h1 class="side__list--heading"><?= substr($article['article_title'], 0, 40); ?></h1>
                                    <p class="side__list--paragraph"><?= substr($article['article_content'], 0, 50); ?>...</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
        <!-- side section | end-->

        <a href="includes/" class="more__articles">More &rarr;</a>
    </section>

    <section class="recommended__articles">

        <div class="recommended__articles--underline">
            <h1 class="recommended__articles--heading">Recommended</h1>
            <span></span>
        </div>

        <!-- Recommeded article wrapper start -->
        <div class="recommended__articles--wrapper">

            <?php if (empty($articles)) : ?>
                <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
            <?php else : ?>
                <?php foreach ($articles as $article) : ?>
                    <article>
                        <div class="recommended__articles--images">
                            <img src="images/<?= $article['article_image']; ?>" alt="" srcset="">
                        </div>

                        <div class="recommended__articles--text">
                            <h1><?= substr($article['article_title'], 0, 50); ?>..</h1>
                            <!-- <p><?= substr($article['article_content'], 0, 100); ?>...</p> -->
                            <!-- <p>Jan 02 2022</p> -->
                        </div>

                        <!-- <button class="btn btn--read recommended__articles--btn">
                            <a href="article.php?id=<?= $article['id']; ?>">read more &rarr;</a>
                        </button> -->

                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- Recommeded article wrapper end -->

    </section>
</main>
<!-- main content end-->

<?php require "includes/footer.php" ?>