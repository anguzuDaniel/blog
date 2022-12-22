<?php require_once "./includes/header.php"; ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'vendor/PHPMailer-master/PHPMailer-master/src/Exception.php';
require_once 'vendor/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require_once 'vendor/PHPMailer-master/PHPMailer-master/src/SMTP.php';

$email = "";
$subject = "";
$message = "";
$sent = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $errors = [];


    if ($email == "") {
        $errors[] = "Please enter your an email";
    }

    if ($subject == "") {
        $errors[] = "Please enter an email subject";
    }

    if ($message == "") {
        $errors[] = "Please enter a message";
    }


    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

            $mail->Username   = SMTP_USER;                     //SMTP username
            $mail->Password   = SMTP_PASSWORD;                               //SMTP password

            //Recipients
            $mail->setFrom($email);
            $mail->addReplyTo($email);
            $mail->addAddress(SMTP_USER);             //Name is optional

            //Content
            $mail->isHTML(true);                                //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            if (!$mail->send()) {
                $errors[] = $mail->ErrorInfo;
            } else {
                echo 'Message sent!';
                $sent = true;
            }
        } catch (Exception $e) {
            $errors[] = $mail->ErrorInfo;
        }
    }
}

?>

<?php require_once "./includes/navigation.php"; ?>

<main class="container">
    <div class="container">

        <?php if ($sent) : ?>
            <p>Message is sent</p>
        <?php else : ?>
            <?php if (!empty($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form method="post">
                <h1 class="h1">Contact US</h1>

                <div class="form-row">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" name="email" id="" required value="<?= htmlspecialchars($email); ?>" class="form-control">
                </div>

                <div class="form-row">
                    <label for="name" class="col-form-label">Subject</label>
                    <input type="text" name="subject" id="" required value="<?= htmlspecialchars($subject); ?>" class="form-control">
                </div>

                <div class="form-row">
                    <label for="message" class="col-form-label">Message</label>
                    <textarea name="message" id="" cols="30" rows="10" style="resize: none;" required class="form-control"><?= htmlspecialchars($message); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary mb-2 px-5 mt-3">Send</button>
            </form>
    </div>
<?php endif; ?>
</main>

<?php require_once "./includes/footer.php"; ?>