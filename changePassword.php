<?php require_once "./includes/header.php"; ?>
<?php
$connection = require_once "includes/db.php";

$user = new User();
$sent = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    $token = $_SESSION['token'];
    $email = $_SESSION['email'];

    if ($password === $confirmPassword) {
        $userExist = $user->getUserByEmail($connection, $email);

        if ($userExist) {
            $user = $user->updatePassword($connection, $email, $password);

            if ($user) {
                $message = "Password updated successfuly";
                Url::redirect('/blog/login.php');
            }
        }
    }
}

?>
<main class="login__page ">
    <div class="login__page--container">
        <h1>Enter new password</h1>

        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
            <?php if ($_POST["password"] !== $_POST["confirm_password"]) : ?>
                <div class="alert alert-danger" role="alert">Passwords do not match.</div>
            <?php endif; ?>

            <?php if ($userExist) : ?>
                <div class="alert alert-danger" role="alert"><?= $message; ?></div>
            <?php endif; ?>
        <?php endif; ?>


        <form method="post" class="login__form">
            <div class="form-row">
                <label class="col-form-label" for="email">Create Password</label>
                <input type="password" name="password" id="" class="form-control" required>
            </div>

            <div class="form-row">
                <label class="col-form-label" for="email">Confirm Password</label>
                <input type="password" name="confirm_password" id="" class="form-control" required>
            </div>

            <button class="btn btn-primary mb-2 px-5 mt-3 w-100">Get code</button>
        </form>
    </div>
</main>
</body>

</html>