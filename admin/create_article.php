<?php
require_once "../includes/functions.php";

require_once "includes/header.php";

if (!Auth::isLoggedIn()) {
    die('unathorized user');
}

$article_image = '';
$article_title = '';
$article_content = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $article_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article_title = $_POST['article__title'];
    $article_content = $_POST['article__content'];

    $errors = validateArticle($article_image, $article_title, $article_content);

    // if errors arrays is empty
    // we continue to submit the data
    if (empty($errors)) {

        $article = new User();
        $db = new Database();

        $connection = $db->getConn();

        $sql = "INSERT 
                INTO articles(article_image, article_title, article_content) 
                VALUES (':image', ':title', ':content') ";

        $stmt = $connection->prepare($sql);

        if ($stmt->execute()) {
            echo $connection->errorInfo();
        } else {
            $stmt->bindValue(':image', $article->article_title, PDO::PARAM_STR);
            $stmt->bindValue(':title', $article->article_title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $article->article_title, PDO::PARAM_STR);

            move_uploaded_file($image_temp, "../images/$article_image");

            if ($stmt->execute()) {
                // $id = mysqli_insert_id($connection);

                Url::redirect("/blog/article.php?id=$id");
            } else {
                echo $connection->errorInfo($stmt);
            }
        }
    }
}

?>
<!-- main section start -->
<main class="admin__wrapper">
    <?php include_once "includes/sidebar.php" ?>

    <div class="admin__container">


        <?php require_once "./includes/navigation.php"; ?>

        <!-- admin section wrapper start -->
        <section class="admin__content">
            <div class="heading | admin__content--heading">
                <h1>Create an Article</h1>
                <hr>
            </div>

            <?php require_once "./includes/form.php"; ?>

        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php include_once "./includes/footer.php"; ?>