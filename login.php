<?php

require_once "includes/header.php";

$connection = require_once "includes/db.php";

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user = $user->getUserByEmail($connection, $email)) {

        $verified = intval($user['verified']);
        $username = $user['last_name'];

        if (User::authenticate($connection, $email, $password) && $verified === 1) {
            Auth::login();

            $_SESSION['login_user'] = $username;

            Url::redirect('/blog/index.php');
        } else {
            $error = 'Incorrect email/password, Please enter correct details';
        }
    }
}
?>


<main class="login__page">
    <div class="login__page--container">
        <h1>Login</h1>

        <!-- prints out error meassgae for wrong cridentials -->
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger" role="alert"><?= $error; ?>.</div>
        <?php endif; ?>

        <form method="post" class="login__form">
            <div class="form-row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <a href="./recoverAccount.php">Forgot password?</a>

            <button class="btn btn-primary mb-2 px-5 mt-3 w-100">Login</button>
        </form>

        <p>Create an account <a href="./signup.php">Signup</a> </p>
    </div>
</main>