<?php require_once "./includes/header.php"; ?>

<?php require_once "./includes/navigation.php"; ?>

<main class="container">
    <div class="container">
        <form action="" method="post">
            <h1>Contact US</h1>

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="">
            </div>

            <div>
                <label for="message">Message</label>
                <textarea name="message" id="" cols="30" rows="10" style="resize: none;"></textarea>
            </div>
        </form>
    </div>
</main>

<?php require_once "./includes/footer.php"; ?>