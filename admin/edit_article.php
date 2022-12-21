<?php require_once "./includes/header.php"; ?>
<?php
Auth::isLoggedIn();

$connection = require_once "../includes/db.php";

if (isset($_GET['id'])) {
    $article = Article::getById($connection, $_GET['id']);

    if (!$article) {
        die("Article not found.");
    }
} else {
    echo "Article doesn't exit";
}

$category_ids = array_column($article->getCategories($connection), 'id');

$categories = Category::getAll($connection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $article->articleImage = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article->articleTitle = $_POST['article__title'];
    $article->articleContent = $_POST['article__content'];

    $category_ids = $_POST['category'] ?? [];

    try {
        switch ($_FILES['image']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception("No file uploaded");
                break;
            case UPLOAD_ERR_INI_SIZE:
                throw new Exception("File is to large {From the server settings}");
                break;
            default:
                throw new Exception("An error occured");
                break;
        }

        if ($_FILES['image']['size'] > 1000000) {
            throw new Exception("File is to large");
        }

        $mime_types = ['images/gif', 'image/png', 'image/jpeg'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['image']['tmp_name']);

        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type');
        }

        $pathInfo = pathinfo($_FILES['image']['name']);

        $base = $pathInfo['filename'];

        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

        $base = mb_strstr($base, 0, 200);

        $filename = $base . "." . $pathInfo['extension'];

        $destination = "../uploads/images/$filename";

        $i = 1;

        while (file_exists($destination)) {
            $filename = $base . "-$i." . $pathInfo['extension'];
            $destination = "../uploads/images/$filename";

            $i++;
        }

        $errors = $article->validateArticle($article->articleImage, $article->articleTitle, $article->articleContent);

        if (move_uploaded_file($image_temp, $destination)) {

            $previous_image = $article->articleImage;

            if ($previous_image) {
                unlink("../uploads/images/$previous_image");
            }

            if (empty($errors) && $article->update($connection)) {
                $article->setCategories($connection, $category_ids);

                Url::redirect("/blog/article.php?id=$article->id");

            }
        }
    } catch (Exception $e) {
        $imageError = $e->getMessage();
    }
}
?>


<!-- main section start -->
<main class="admin__wrapper">
    <?php include_once "./includes/sidebar.php"; ?>

    <div class="admin__container">
        <?php require_once "./includes/navigation.php"; ?>

        <!-- admin section wrapper start -->
        <section class="admin__content">
            <div class="heading | admin__content--heading">
                <h1>Edit Article</h1>
                <hr>
            </div>


            <?php require_once "includes/form.php"; ?>
        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php require_once "./includes/footer.php"; ?>