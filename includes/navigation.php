<?php require_once "classes/auth.php"; ?>
<header class="header">
    <div class="header__primary">

        <!-- <div class="search">
            <input type="search" name="search__articles" id="" class="search search__articles" placeholder="search">
            <button type="submit" name="search__button" class="search__button">
                <em class="fa-solid fa-magnifying-glass"></em>
            </button>
        </div> -->

        <!-- <button class="admin__link btn">
            <a href="./admin/index.php">Admin</a>
        </button> -->


        <?php if (Auth::isLoggedIn()) : ?>
            <div class="header__cta">
                <a href="logout.php" class="btn--logout">Log out</a>

                <a href="./admin/">New article</a>
            </div>
        <?php else : ?>
            <a href="login.php" class="btn--login">Log In</a>
        <?php endif; ?>

        <h1 class="header--logo">BlogIfy!</h1>

        <div class="header__cta">
            <div>
                <em class="fa-brands fa-twitter"></em>
            </div>
            <div>
                <em class="fa-brands fa-facebook"></em>
            </div>
            <div>
                <em class="fa-brands fa-instagram"></em>
            </div>
            <div>
                <em class="fa-brands fa-github"></em>
            </div>
        </div>

    </div>

    <div class="header__secondary">
        <nav>
            <!--   <ul class="nav__list">
                <li class="nav__list--item">
                    <select name="tech" id="tech">
                        <option value="">
                            <a href="#">Technology</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                    </select>
                </li>

                <li class="nav__list--item">
                    <select name="lifestyle" id="lifestyle">
                        <option value="">
                            <a href="#">LifeStyle</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                    </select>
                </li>

                <li class="nav__list--item">
                    <select name="" id="">
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                        <option value="">
                            <a href="#">Music</a>
                        </option>
                    </select>
                </li>
            </ul> -->

            <ul class="nav__list">
                <li class="nav__list--item"><a href="index.php">Home</a></li>
                <li class="nav__list--item"><a href="#">Pages</a></li>
                <li class="nav__list--item"><a href="#">Blog</a></li>
                <li class="nav__list--item"><a href="#">Shop</a></li>
                <li class="nav__list--item"><a href="timeline.php">Timeline</a></li>
            </ul>
        </nav>
    </div>
</header>