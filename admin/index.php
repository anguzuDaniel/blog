<?php
require_once "./includes/header.php";
Auth::isLoggedIn();

$connection = require_once "../includes/db.php";
?>

<?php
$user = new User();

$currentUser = $user->getUserInfo($connection);

?>

<?php include_once "includes/sidebar.php" ?>

<main class="admin__wrapper">

    <div class="admin__container">
        <?php require_once "./includes/navigation.php"; ?>
        <section class="admin__content">
            <div class="admin__content--intro">


                <div class="row mb-5 mt-5 g-3">

                    <div class="col-md-3">
                        <div class="col-sm row-cols-2 card-counter text-center py-4 bg-danger admin-card">
                            <div class="display-3 text-light">
                                <em class="fa-regular fa-folder-open"></em>
                            </div>
                            <div class="col-sm">
                                <p class="display-6 count-name text-light">356</p>
                                <h3 class="display-6 count-numbers text-light">Arctiles</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="col-sm card-counter text-center py-4 bg-success admin-card">
                            <div class="display-3 text-light">
                                <em class="fa-solid fa-diagram-project"></em>
                            </div>
                            <p class="display-6 count-name text-light">10</p>
                            <h3 class="display-6 count-numbers text-light">Categories</h1>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="col-sm card-counter text-center py-4 bg-primary admin-card">
                            <div class="display-3 text-light">
                                <em class="fa-solid fa-file-pen"></em>
                            </div>
                            <p class="display-6 count-name text-light">6</p>
                            <h3 class="display-6 count-numbers text-light">Writers</h1>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="col-sm card-counter text-center py-4 bg-warning admin-card">
                            <div class="display-3 text-light">
                                <em class="fa-solid fa-users-line"></em>
                            </div>
                            <p class="display-6 count-name text-light">39</p>
                            <h3 class="display-6 count-numbers text-light">Vistors</h1>
                        </div>
                    </div>
                </div>

                <div class="admin__all--writters">

                    <div class="admin__all--heading">
                        <h1>All Writers</h1>

                        <div class="admin__search">
                            <input type="search" name="admin__search--imput" id="" class="admin__search--input" placeholder="search by tags">
                            <button class="admin__search--btn">
                                <em class="fa-solid fa-magnifying-glass"></em>
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
                                        <em class="fa-regular fa-pen-to-square"></em>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <em class="fa-regular fa-trash-can"></em>
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
                                        <em class="fa-regular fa-pen-to-square"></em>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <em class="fa-regular fa-trash-can"></em>
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
                                        <em class="fa-regular fa-pen-to-square"></em>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <em class="fa-regular fa-trash-can"></em>
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
                                        <em class="fa-regular fa-pen-to-square"></em>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="delete__icon">
                                        <em class="fa-regular fa-trash-can"></em>
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