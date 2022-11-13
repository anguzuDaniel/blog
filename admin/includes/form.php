<!-- error handler start | checks if inputs are empty and prints message -->
<?php if (!empty($errors)) : ?>
    <ul>
        <?php foreach ($errors as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<!-- error hamdler end -->

<!-- form start -->
<form action="create_article.php" method="post" enctype="multipart/form-data">
    <div class="form__row">
        <label for="image" class="form__row--label">Image</label>
        <input type="file" class="form__row--img" name="image" value="<?= $article_image; ?>" />
    </div>

    <div class="form__row">
        <label for="article__title" class="form__row--label">Title</label>
        <input type="text" name="article__title" value="<?= htmlspecialchars($article_title); ?>" />
    </div>

    <div class="form__row">
        <label for="article__content" class="form__row--label">Content</label>
        <textarea name="article__content" id="" cols="30" rows="10" style="resize: none"><?= htmlspecialchars($article_content); ?></textarea>
    </div>

    <button class="btn btn--submit">Save</button>
</form>
<!-- form end -->