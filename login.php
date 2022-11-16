<?php

require_once "includes/header.php";
include_once "./init.php";

$connection = require_once "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (User::authenticate($connection, $_POST['username'], $_POST['password'])) {

        // helps to prevent session fixation attack | stops hackers from stealing session data
        session_regenerate_id(true);

        $_SESSION['is_logged_in'] = true;

        Url::redirect('/blog/index.php');
    } else {
        $error = 'Incorrect username/password, Please enter correct details';
    }
}
?>


<main class="login__page">
    <div class="login__page--container">
        <h1>Login</h1>

        <!-- prints out error meassgae for wrong cridentials -->
        <?php if (!empty($error)) : ?>
            <span class="error-message"><?= $error; ?></span>
        <?php endif; ?>

        <form action="" method="post" class="login__form">
            <div class="login__row">
                <label for="name">Name</label>
                <input type="text" name="username" id="username" class="login__row--input">
            </div>
            <!-- <div class="login__row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="login__row--input">
            </div> -->
            <div class="login__row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="login__row--input">
            </div>

            <button class="btn--login">Login</button>
        </form>
    </div>
</main>