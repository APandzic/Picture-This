<?php

require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<?php if (isset($_SESSION["user"])) : ?>
    <?php redirect('/home.php?id=' . $_SESSION['user']['id']); ?>
<?php endif; ?>

<div class="container-login">
    <article>
        <p>Welcome</p>
    </article>

    <h1>Please Login</h1>

    <form class="container-form-login" action="app/users/login.php" method="post">
        <div class="container-form-login-email">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="andreas@gmail.com" required>
        </div>

        <div class="container-form-login-password">
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="container-error-message">
            <?php if ($message !== '') : ?>
                <p class="error-message"><?php echo $message; ?></p>
            <?php endif; ?>
        </div>


        <div class="container-form-login-button">
            <button type="submit" class="button-login">Login</button>
        </div>
    </form>

    <div>
        <a class="nav-link" href="/registration.php"><button class="button-registration">registration</button></a>
    </div>




</div>


<?php require __DIR__ . '/views/footer.php'; ?>
