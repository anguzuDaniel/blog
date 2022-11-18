<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";
$articles = Article::getAll($connection, 6);
?>

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

            <!-- lastest artciles section start -->
            <?php require_once "includes/latest.php"; ?>
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