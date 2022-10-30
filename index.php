<?php

require_once("includes/database.php");

$sql = "SELECT * FROM articles LIMIT 4";

$result = mysqli_query($connection, $sql);

if ($result === false) {
    echo mysqli_error($connection);
} else {
    $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>

<?php require_once("includes/header.php") ?>

<!-- navigation bar -->
<?php require_once("includes/navigation.php") ?>


<!-- main content begining -->
<main>

    <div class="container">

        <section class="container__articles">
            <div class="article__wrappper article__wrappper--large">
                <div class="article__text">
                    <p class="article__date article__date--small">OCT 09, 2022</p>
                    <h1 class="heading | article__text--title">
                        What do software Engineers do?
                    </h1>
                    <!-- <p class="article__paragraph">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quibusdam magnam minima adipisci nihil recusandae aut exercitationem,...
                    </p> -->
                </div>

            </div>

            <div class="container__articles--grid">
                <div class=" article__wrappper | article__wrappper--small | article__wrappper--1">
                    <div class="article__text">
                        <p class="article__date">Sept 11, 2021</p>
                        <h1 class="heading | article__text--title">Music & production</h1>
                    </div>
                </div>

                <div class="article__wrappper | article__wrappper--small | article__wrappper--2">
                    <div class="article__text">
                        <p class="article__date">Dec 29, 2021</p>
                        <h1 class="heading | article__text--title">Thrifting the right way</h1>
                    </div>
                </div>



                <div class="article__wrappper | article__wrappper--small | article__wrappper--3">
                    <div class="article__text">
                        <p class="article__date">Dec 29, 2021</p>
                        <h1 class="heading | article__text--title">Programming</h1>
                    </div>
                </div>



                <div class="article__wrappper | article__wrappper--small | article__wrappper--4">
                    <div class="article__text">
                        <p class="article__date">Dec 29, 2021</p>
                        <h1 class="heading | article__text--title">Yoga and Meditation</h1>
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

            <!-- lastest artciles section | start -->
            <div class="lastest__articles">

                <?php if (empty($articles)) : ?>
                    <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
                <?php else : ?>
                    <?php foreach ($articles as $article) : ?>
                        <article>
                            <div class="lastest__articles--image">
                                <img src="images/<?= $article['article_image']; ?>" alt="image" />
                            </div>
                            <div class="lastest__articles--text">
                                <h1 class="lastest__articles--title"><?= $article['article_title']; ?></h1>
                                <p class="lastest__articles--paragraph"><?= substr($article['article_content'], 0, 150); ?>...</p>
                                <p class="lastest__articles--date">December 11, 2016</p>

                                <div class="lastest__articles--cta">
                                    <a href="article.php?id=<?= $article['id']; ?>" class="btn btn--read"> <span>read more</span> </a>
                                    <!-- <em class="fa-regular fa-comments"></em> -->
                                    <!-- <em class="fa-solid fa-comments"></em> -->
                                    <!-- <em class="fa-regular fa-heart"></em> -->
                                    <!-- <em class="fa-solid fa-heart"></em> -->
                                    <!-- <em class="fa-regular fa-thumbs-up"></em> -->
                                    <!-- <em class="fa-solid fa-thumbs-up"></em> -->
                                    <em class="fa-regular fa-bookmark"></em>
                                    <!-- <em class="fa-solid fa-bookmark"></em> -->
                                </div>


                            </div>

                        </article>
                    <?php endforeach; ?>

                <?php endif ?>
            </div>
            <!-- lastest artciles section end -->
        </div>


        <!-- including the side article markup -->
        <?php require_once "includes/side.php" ?>

        <!-- <a href="includes/" class="more__articles">More &rarr;</a> -->
    </section>


    <!-- icluding the article markup -->
    <?php require_once "includes/featured.php"; ?>


    <!-- inculding the Recommended markup -->
    <?php require_once "includes/recommended.php"; ?>
</main>
<!-- main content end-->

<?php require_once("includes/footer.php") ?>