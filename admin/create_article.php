<?php
require_once "includes/header.php";

Auth::isLoggedIn();

$connection = require_once "../includes/db.php";

$article_image = '';
$article_title = '';
$article_content = '';

$article = new Article();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $article_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $article_title = $_POST['article__title'];
    $article_content = $_POST['article__content'];

    if (empty($_FILES)) {
        throw new Exception("invalid upload");
    }

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

        $filename = $base . "." . $pathInfo['extension'];

        $destination = "../uploads/images/$filename";

        $i = 1;

        while (file_exists($destination)) {
            $filename = $base . "-$i." . $pathInfo['extension'];
            $destination = "../uploads/images/$filename";

            $i++;
        }

        $errors = $article->validateArticle($article_image, $article_title, $article_content);

        // if errors arrays is empty
        // we continue to submit the data
        if (empty($errors)) {
            $stmt = $article->createArticle($connection, $article_image, $article_title, $article_content);

            move_uploaded_file($image_temp, $destination);

            if ($stmt) {
                $id = $article->id;

                Url::redirect("/blog/article.php?id=$id");
            } else {
                $connection->errorInfo();
            }
        } else {
            echo "Unable to create article now, Please try again later";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
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
                <h1>Do want to create an article <h1> <?php echo $currentUser->username; ?>?</h1>
                </h1>
                <hr>
            </div>

            <?php require_once "./includes/form.php"; ?>

        </section>
        <!-- admin section wrapper end -->
    </div>
</main>
<!-- main section end -->

<?php include_once "./includes/footer.php"; ?>