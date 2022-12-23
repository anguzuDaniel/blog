<?php

require_once "includes/header.php";

$connection = require_once "includes/db.php";

$message = "";
$otp = "";
$email = "";
$otp_code = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otp = $_SESSION['otp'];
    $email = $_SESSION['mail'];
    $otp_code = $_POST['code'];

    if ($otp != $otp_code) {
        $error = "Invalid OTP code. Please enter a valid otp code.";
    } else {
        $verified = User::verifiyUser($connection, $email);

        if ($verified) {
            $message = "Your account has been verified successfully, you can now sign in.";

            Url::redirect('/blog/login.php');
        }
    }
}

?>


<main class="login__page">
    <div class="login__page--container">
        <h1>Confrim Account</h1>
        <?php if ($otp != $otp_code) : ?>
            <div class="alert alert-danger" role="alert"><?= $error; ?></div>
        <?php endif; ?>

        <p>Enter the OTP code sent to your email to verify you account.</p>

        <form action="" method="post" class="login__form">
            <div class="form-row">
                <label class="col-form-label" for="last_name">Enter OTP code</label>
                <input type="text" name="code" id="" class="form-control">
            </div>

            <button class="btn btn-primary mb-2 px-5 mt-3 w-100">Create Account</button>
        </form>

        <p>Back to <a href="./signup.php">Signup</a> </p>
    </div>
</main>