<!-- error handler start | checks if inputs are empty and prints message -->
<?php if (!empty($errors)) : ?>
    <ul>
        <?php foreach ($errors as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<!-- error handler end -->

<!-- form start -->
<form method="post" enctype="multipart/form-data">
    <div class="form__row">
        <label for="image" class="form__row--label">Image</label>
        <input type="file" class="form__row--img" name="image" value="<?= $article->articleImage; ?>" />
    </div>

    <div class="form__row">
        <label for="article__title" class="form__row--label">Title</label>
        <input type="text" name="article__title" value="<?= htmlspecialchars($article->articleTitle); ?>" />
    </div>

    <div class="form__row">
        <label for="article__content" class="form__row--label">Content</label>
        <textarea name="article__content" id="" cols="30" rows="10" style="resize: none"><?= htmlspecialchars($article->articleContent); ?></textarea>
    </div>

    <button class="btn btn--submit">Save</button>
</form>
<!-- form end -->