<?php

require_once 'includes/functions.php';

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['username'] == 'anguzu daniel' && $_POST['password'] == 'password') {

        // helps to prevent session fixation attack | stops hackers from stealing session data
        session_regenerate_id(true);

        $_SESSION['is_logged_in'] = true;

        redirect('/blog/index.php');
    } else {
        die('Login Incorrect');
    }
}
?>

<?php include_once "includes/header.php" ?>

<main class="login__page">
    <div class="login__page--container">
        <h1>Login</h1>
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