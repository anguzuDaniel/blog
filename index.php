<?php require "includes/header.php" ?>
<?php

require "includes/database.php";

$sql = "SELECT * FROM articles LIMIT 6 ";

$result = mysqli_query($connection, $sql);

if ($result === false) {
    echo mysqli_error($connection);
} else {
    $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // var_dump($articles);
}


?>


<style>
    .container__articles {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
        gap: 1px;
        margin-top: 10rem;
        height: 450px;
    }

    .article__wrappper {
        height: 100%;
    }

    .article__wrappper--large {
        background-image: url(images/What-Do-Software-Engineers-Do-WOZ-1-min.webp);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-color: linear-gradient(from top left to bottom left, rgba(226, 104, 104, 0.8), rgba(226, 104, 104, 0.8));
        background-color: rgba(0, 0, 0, 0.646);
        background-blend-mode: darken;
        display: flex;
        justify-content: left;
        align-items: flex-end;
    }

    .article__wrappper img {
        /* position: absolute; */
        width: 100%;
        object-fit: cover;
        aspect-ratio: 10 / 5;
        /* height: 100%; */
    }

    .article__text--paragraph {
        padding-bottom: 1rem;
    }

    .article__text {
        padding: 1rem;
        padding-inline: 2rem;
    }

    .article__text h1 {
        color: rgb(209, 81, 45);
        font-size: 3.5rem;
        margin-bottom: .5rem;
    }

    .article__text p {
        color: rgb(245, 232, 228);
        /* font-size: 2rem; */
        opacity: 0.8;
        margin-bottom: .5rem;
    }

    .article__date {
        font-size: 1.25rem;
        font-weight: bold;
    }

    /* .article__paragraph {} */

    .article__wrappper--1 {
        background-image: url(images/swangz.webp);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.646);
        background-blend-mode: darken;
        display: flex;
        justify-content: left;
        align-items: flex-end;
    }

    .article__wrappper--2 {
        background-image: url(images/Secondhand-clothing-on-sale-satisfashionug.jpg);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.646);
        background-blend-mode: darken;
        display: flex;
        justify-content: left;
        align-items: flex-end;
    }

    .article__wrappper--3 {
        background-image: url(images/Programming-Language-Popularity.jpg);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.646);
        background-blend-mode: darken;
        display: flex;
        justify-content: left;
        align-items: flex-end;
    }

    .article__wrappper--4 {
        background-image: url(images/meditation.jpg);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.646);
        background-blend-mode: darken;
        display: flex;
        justify-content: left;
        align-items: flex-end;
    }

    .container__articles--grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
        gap: 1px;
    }

    .article__wrappper--small h1 {
        font-size: 1.8rem;
    }
</style>

<!-- navigation bar -->
<?php require "includes/navigation.php" ?>


<!-- main content begining -->
<main>

    <div class="container">

        <section class="container__articles">
            <div class="article__wrappper article__wrappper--large">
                <div class="article__text">
                    <p class="article__date article__date--small">OCT 09, 2022</p>
                    <h1 class="heading | article__text--title | article__text--title">What do software Engineers do?</h1>
                    <p class="article__paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam magnam minima adipisci nihil recusandae aut exercitationem,...</p>
                </div>

            </div>

            <div class="container__articles--grid">
                <div class=" article__wrappper | article__wrappper--small | article__wrappper--1">

                    <!-- <img src="images/repository-open-graph-template.png" /> -->
                    <div class="article__text">
                        <h1 class="heading | article__text--title">Swangz</h1>
                        <p class="article__date">Sept 11, 2021</p>
                    </div>
                </div>

                <div class="article__wrappper | article__wrappper--small | article__wrappper--2">
                    <div class="article__text">
                        <h1 class="heading | article__text--title">UG Thrifting..</h1>
                        <p class="article__date">Dec 29, 2021</p>
                    </div>
                </div>



                <div class="article__wrappper | article__wrappper--small | article__wrappper--3">
                    <div class="article__text">
                        <h1 class="heading | article__text--title">UG Thrifting..</h1>
                        <p class="article__date">Dec 29, 2021</p>
                    </div>
                </div>



                <div class="article__wrappper | article__wrappper--small | article__wrappper--4">
                    <div class="article__text">
                        <h1 class="heading | article__text--title">UG Thrifting..</h1>
                        <p class="article__date">Dec 29, 2021</p>
                    </div>
                </div>

            </div>

        </section>
    </div>

    <section>
        <div class="read__article--underline">
            <h1 class="read__article--heading">Must Read</h1>
            <span></span>
        </div>

        <div class="read__article">

            <!-- lastest artciles section start -->
            <div class="lastest__articles">

                <?php if (empty($articles)) : ?>
                    <p class="lastest__articles--paragraph">No articles found, please add articles so as to be displayed!!</p>
                <?php else : ?>
                    <?php foreach ($articles as $article) : ?>
                        <article>
                            <img src="images/<?= $article['article_image']; ?>" />
                            <!-- <img src="images/Programming-Language-Popularity.jpg" alt="" srcset=""> -->
                            <div class="lastest__articles--text">
                                <p class="lastest__articles--date">December 11, 2016</p>
                                <h1 class="lastest__articles--title"><?= $article['article_title']; ?></h1>
                                <p class="lastest__articles--paragraph"><?= $article['article_content']; ?></p>
                                <a href="article.php?id=<?= $article['id']; ?>" name="read_more" class="btn btn--read">read more &rarr;</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif ?>

                <!-- <article>
                    <img src="images/meditation.jpg" alt="" srcset="">
                    <div class="lastest__articles--text">
                        <h1 class="lastest__articles--title">Trendy Clothes</h1>
                        <p class="lastest__articles--paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla corrupti,.</p>
                        <button type="submit" name="read_more" class="btn btn--read">read more &rarr;</button>
                    </div>
                </article>

                <article>
                    <img src="images/trendy.webp" alt="" srcset="">
                    <div class="lastest__articles--text">
                        <h1 class="lastest__articles--title">Trendy Clothes</h1>
                        <p class="lastest__articles--paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla corrupti,.</p>
                        <button type="submit" name="read_more" class="btn btn--read">read more &rarr;</button>
                    </div>
                </article> -->

                <!-- <article>
                    <img src="images/trendy.webp" alt="" srcset="">
                    <div class="lastest__articles--text">
                        <h1 class="lastest__articles--title">Trendy Clothes</h1>
                        <p class="lastest__articles--paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla corrupti,.</p>
                        <button type="submit" name="read_more" class="btn btn--read">read more &rarr;</button>
                    </div>
                </article>
                <article>
                    <img src="images/Programming-Language-Popularity.jpg" alt="" srcset="">
                    <div class="lastest__articles--text">
                        <h1 class="lastest__articles--title">Trendy Clothes</h1>
                        <p class="lastest__articles--paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla corrupti,.</p>
                        <button type="submit" name="read_more" class="btn btn--read">read more &rarr;</button>
                    </div>
                </article>

                <article>
                    <img src="images/meditation.jpg" alt="" srcset="">
                    <div class="lastest__articles--text">
                        <h1 class="lastest__articles--title">Trendy Clothes</h1>
                        <p class="lastest__articles--paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla corrupti,.</p>
                        <button type="submit" name="read_more" class="btn btn--read">read more &rarr;</button>
                    </div>
                </article>

                <article>
                    <img src="images/trendy.webp" alt="" srcset="">
                    <div class="lastest__articles--text">
                        <h1 class="lastest__articles--title">Trendy Clothes</h1>
                        <p class="lastest__articles--paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla corrupti,.</p>
                        <button type="submit" name="read_more" class="btn btn--read">read more &rarr;</button>
                    </div>
                </article> -->

                <!-- <article>
                    <img src="images/trendy.webp" alt="" srcset="">
                    <div class="lastest__articles--text">
                        <h1 class="lastest__articles--title">Trendy Clothes</h1>
                        <p class="lastest__articles--paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla corrupti,.</p>
                        <button type="submit" name="read_more" class="btn btn--read">read more &rarr;</button>
                    </div>
                </article> -->
            </div>
            <!-- lastest artciles section end -->

            <!-- side section | shows the ctegory list -->

            <div>

                <aside>
                    <div class="side__list side__list--1">
                        <h3 class="heading | side__heading">
                            Categories
                        </h3>

                        <nav>
                            <ul class="side__nav">
                                <li class="side__nav--item">
                                    <a href="#">Music</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">Programming</a>
                                </li>
                                <li>
                                    <a href="#">Life</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">Programming</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">LifeStyle</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">LifeStyle</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">Music</a>
                                </li>
                                <li>
                                    <a href="#">Life</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
                <aside>
                    <div class="side__list side__list--1">
                        <h3 class="heading | side__heading">
                            Categories
                        </h3>

                        <nav>
                            <ul class="side__nav">
                                <li class="side__nav--item">
                                    <a href="#">Music</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">Programming</a>
                                </li>
                                <li>
                                    <a href="#">Life</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">Programming</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">LifeStyle</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">LifeStyle</a>
                                </li>
                                <li class="side__nav--item">
                                    <a href="#">Music</a>
                                </li>
                                <li>
                                    <a href="#">Life</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
            </div>
            <!-- side section | end-->
        </div>


    </section>




</main>
<!-- main content end-->

<?php require "includes/footer.php" ?>