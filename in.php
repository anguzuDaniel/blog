<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";
$articles = Article::getAll($connection, 6);
?>

<!-- navigation bar -->
<?php require_once("includes/navigation.php") ?>

<!-- main content begining -->
<main>
    <section class="read__article container">
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