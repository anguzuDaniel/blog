<?php
require_once "includes/header.php";

Auth::isLoggedIn();

$connection = require_once "../includes/db.php";

if ($connection) {
    $articles = Article::getArticles($connection, 'LIMIT', 10);
} else {
    echo $connection->errorInfo();
}


?>
<?php include_once "includes/sidebar.php" ?>
<main class="admin__wrapper">

    <div class="admin__container">
        <?php require_once "./includes/navigation.php"; ?>


        <section class="admin__content">
            <div class="admin__content--intro">

                <div class="admin__all--writters">

                    <div class="admin__all--heading">
                        <h1>All articles you published</h1>

                        <div class="admin__search">
                            <input type="search" name="admin__search--imput" id="" class="admin__search--input" placeholder="search by tags">
                            <button class="admin__search--btn">
                                <em class="fa-solid fa-magnifying-glass"></em>
                            </button>
                        </div>
                    </div>

                    <div class="admin__actions">


                        <div class="admin__sort--performed">
                            <div class="admin__sort--filter">

                                <p>Active filters/tags:</p>
                                <p class="admin__sort--tag"><span> none <a href="#">
                                            <em class="fa-solid fa-circle-xmark"></em></span></a></p>
                                <!-- <a href="#" class="admin__sort--clear">clear all</a> -->
                            </div>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>id</td>
                                <td>Image</td>
                                <td>Title</td>
                                <td>Content</td>
                                <td colspan="2">Operations</td>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (empty($articles)) : ?>
                                <p class="lastest__articles--p">No articles found, please add articles so as to be displayed!!</p>
                            <?php else : ?>
                                <?php foreach ($articles as $article) : ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="select__writer" id="">
                                        </td>
                                        <td><?= $article['id']; ?></td>
                                        <td>
                                            <img src="../images/<?= $article['article_image']; ?>" alt="" srcset="">
                                        </td>
                                        <td>
                                            <p><?= substr($article['article_title'], 0, 25); ?>..</p>
                                        </td>
                                        <td>
                                            <p><?= substr($article['article_content'], 0, 40); ?>..</p>
                                        </td>
                                        <td>
                                            <a href="edit_article.php?id=<?= $article['id']; ?>" class="edit__icon">
                                                <em class="fa-regular fa-pen-to-square"></em>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="delete_article.php?id=<?= $article['id']; ?>" class="delete delete__icon">
                                                <em class="fa-regular fa-trash-can"></em>
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="table__footer">
                        <div class="table__footer--result">
                            <span class="result__num">10</span>
                            <p>Results</p>
                        </div>

                        <div class="table__footer--pages">
                            <div>
                                <label for="per__page">Row per page: </label>
                                <select name="" id="">
                                    <option value="">10</option>
                                    <option value="">15</option>
                                    <option value="">20</option>
                                    <option value="">25</option>
                                </select>
                            </div>

                            <div>
                                <p>1 - 10 of 10</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>
    </div>
    </div>

    <div class="modal modal--show" id="modal-delete">

        <form action="delete_article.php" method="post" class="modal__form">
            <div class="modal__form--close">
                <button>
                    <em class="fa-solid fa-xmark"></em>
                </button>
            </div>

            <h3>Are you sure you want to delete this article?</h3>

            <div class="modal__form--row">

                <button class="delete__icon modal__form--btn">
                    Delete
                </button>

                <a href="all_articles.php" class="modal__form--btn">Cancel</a>
            </div>
        </form>
    </div>
</main>
<?php require_once "./includes/footer.php"; ?>