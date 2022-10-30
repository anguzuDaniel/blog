<?php require_once "./includes/header.php"; ?>

<?php include_once "includes/sidebar.php" ?>
<main class="admin__wrapper">

    <div class="admin__container">
        <?php require_once "./includes/navigation.php"; ?>


        <section class="admin__content">
            <div class="admin__content--intro">

                <div class="admin__cards">

                    <div class="admin__card admin__card--count">
                        <div class="admin__card--icon">
                            <i class="fa-regular fa-folder-open"></i>
                        </div>
                        <p class="admin__card--num">356</p>
                        <h3 class="admin__card--heading">Arctiles</h1>
                    </div>

                    <div class="admin__card admin__card--count">
                        <div class="admin__card--icon">
                            <i class="fa-solid fa-diagram-project"></i>
                        </div>
                        <p class="admin__card--num">10</p>
                        <h3 class="admin__card--heading">Categories</h1>
                    </div>

                    <div class="admin__card admin__card--count">
                        <div class="admin__card--icon">
                            <i class="fa-solid fa-file-pen"></i>
                        </div>
                        <p class="admin__card--num">6</p>
                        <h3 class="admin__card--heading">Writers</h1>
                    </div>

                    <div class="admin__card admin__card--count">
                        <div class="admin__card--icon">
                            <i class="fa-solid fa-users-line"></i>
                        </div>
                        <p class="admin__card--num">39</p>
                        <h3 class="admin__card--heading">Vistors</h1>
                    </div>
                </div>

                <div class="admin__all--writters">

                    <div class="admin__all--heading">
                        <h1>All Writers</h1>

                        <div class="admin__search">
                            <input type="search" name="admin__search--imput" id="" class="admin__search--input" placeholder="search by tags">
                            <button class="admin__search--btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>

                    <div class="admin__actions">
                        <div class="admin__sort">
                            <!-- <label for="sort">sort by</label> -->
                            <select name="sort-by">
                                <option value="date">
                                    <span>latest</span>
                                </option>
                                <option value="date">oldest</option>
                                <option value="date">height views</option>
                                <option value="date">lowest views</option>
                                <option value="date">id</option>
                            </select>

                            <select name="sort-by">
                                <option value="date">
                                    <span>latest</span>
                                </option>
                                <option value="date">oldest</option>
                                <option value="date">height views</option>
                                <option value="date">lowest views</option>
                                <option value="date">id</option>
                            </select>

                            <select name="sort-by">
                                <option value="date">
                                    <span>latest</span>
                                </option>
                                <option value="date">oldest</option>
                                <option value="date">height views</option>
                                <option value="date">lowest views</option>
                                <option value="date">id</option>
                            </select>

                        </div>

                        <div class="admin__sort--performed">
                            <div class="admin__sort--filter">

                                <p>Active filters/tags:</p>
                                <p class="admin__sort--tag"><span> none <a href="#">
                                            <i class="fa-solid fa-circle-xmark"></i></span></a></p>
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
                                <td>Name</td>
                                <td>Number post</td>
                                <td colspan="2">Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>1</td>
                                <td>Chima Titilayo</td>
                                <td>40</td>
                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>2</td>
                                <td>Kehinde Mandlenkosi</td>
                                <td>50</td>
                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>3</td>
                                <td>Kossi Adenike</td>
                                <td>30</td>
                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>4</td>
                                <td>Kelly Opan</td>
                                <td>500</td>
                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>5</td>
                                <td>Aishatu Amara</td>
                                <td>200</td>
                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>6</td>
                                <td>Chidiebere Neema</td>
                                <td>200</td>
                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>7</td>
                                <td>Itai Ayanda</td>
                                <td>200</td>
                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>8</td>
                                <td>Wambui Siyabonga</td>
                                <td>200</td>
                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>9</td>
                                <td>Opit obop</td>
                                <td>150</td>

                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="select__writer" id="">
                                </td>
                                <td>10</td>
                                <td>Wanyonyi Chifuniro</td>
                                <td>100</td>
                                <td>
                                    <a href="#" class="edit__icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
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
</main>
<?php require_once "./includes/footer.php"; ?>