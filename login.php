<?php

require_once "includes/header.php";

$connection = require_once "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (User::authenticate($connection, $_POST['username'], $_POST['password'])) {

        Auth::login();

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

        <form method="post" class="login__form">
            <div class="form-row">
                <label for="name">Name</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <!-- <div class="login__row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div> -->

            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <a href="./resetPassword.php">Forgot password?</a>

            <button class="btn btn-primary mb-2 px-5 mt-3 w-100">Login</button>
        </form>

        <p>Create an account <a href="./signup.php">Signup</a> </p>
    </div>
</main>