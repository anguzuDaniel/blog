<?php require_once "./includes/header.php"; ?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'vendor/PHPMailer-master/PHPMailer-master/src/Exception.php';
require_once 'vendor/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require_once 'vendor/PHPMailer-master/PHPMailer-master/src/SMTP.php';

$connection = require_once "includes/db.php";

$user = new User();
$sent = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];

    $userExist = $user->getUserByEmail($connection, $email);

    if (!$userExist) {
        $user = $user->addUser($connection, $email, $username, $firstname, $lastname, $password);

        if ($user) {
            $mail = new PHPMailer(true);

            var_dump($user);

            try {
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;

                $subject = "Your verify code";
                $body = "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>";

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';

                $mail->Username   = SMTP_USER;                     //SMTP username
                $mail->Password   = SMTP_PASSWORD;                               //SMTP password

                //Recipients
                $mail->setFrom($email, 'OTP Verification');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $body;

                if (!$mail->send()) {
                    $errors[] = $mail->ErrorInfo;
                } else {
                    echo 'Message sent!';
                    $sent = true;

                    Url::redirect('/blog/verification.php');
                }
            } catch (Exception $e) {
                $errors[] = $mail->ErrorInfo;
            }
        }
    }
}


?>


<main class="login__page ">
    <div class="login__page--container">
        <h1>Login</h1>

        <?php if ($sent) : ?>
            <div class="alert alert-success" role="alert">Verification code sent to your email.</div>
        <?php else : ?>
            <?php if (!empty($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li class="alert alert-danger" role="alert"><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form method="post" class="login__form">

                <div class="form-row">
                    <label class="col-form-label" for="email">Email</label>
                    <input type="email" name="email" id="" class="form-control" required>
                </div>

                <button class="btn btn-primary mb-2 px-5 mt-3 w-100">Create Account</button>
            </form>

            <p>Back to <a href="./login.php">Login</a> </p>
        <?php endif; ?>
    </div>
</main>
</body>

</html>