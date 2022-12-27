<?php
require_once "includes/header.php";

$connection = require_once "includes/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $article = Article::getWithCategories($connection, $_GET['id']);
} else {
    $article = null;
}

$art = new Article();
$user = new User();

?>


<?php require_once "includes/navigation.php"; ?>


<main class="col-12 container d-lg-flex gap-4">


    <section class="timeline col-lg-8">
        <?php if ($article) : ?>
            <article>
                <h1 class="fw-bold"><?= htmlspecialchars($article[0]['article_title']); ?></h1>

                <p class="mt-4">
                    <time datetime="<?= $article[0]['published_at'] ?>">
                        <?php
                        $datetime = new DateTime($article[0]['published_at']);
                        echo $datetime->format("j F, Y");
                        ?>
                    </time>
                </p>

                <div class="d-flex mr-2 align-items-center justify-content-between">
                    <h6 class="text-muted">Tags/Category: </h6>
                    <div>
                        <?php if ($article[0]['category_name']) : ?>
                            <p class="bg-white py-2 px-4 text-danger" id="comment">
                                <?php foreach ($article as $a) : ?>
                                    <?= htmlspecialchars($a['category_name']); ?>
                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="my-3">
                    <?php if ($article[0]['article_image'] !== null && $article[0]['article_image'] !== '') : ?>
                        <img src="./uploads/images/<?= $article[0]['article_image']; ?>" alt="image" class="w-100" />
                    <?php endif; ?>
                </div>


                <div>
                    <p class="article--paragraph" id="comment"><?= htmlspecialchars($article[0]['article_content']); ?></p>
                </div>


                <!-- like functionality -->
                <?php require_once "./includes/like.php"; ?>
                <!-- like functionality -->

                <div class="d-flex justify-content-between align-content-center">
                    <p>0 comments</p>
                    <p>Write a comment</p>
                </div>

                <hr>

                <?php include_once "includes/comment.php"; ?>
            </article>
        <?php else : ?>
            <p class="paragraph article--paragraph">No articles found..</p>
        <?php endif ?>
    </section>

    <?php require_once "includes/side.php"; ?>
</main>

<?php require_once "includes/footer.php"; ?>