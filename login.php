<?php

require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);


?>
<article>
    <p>This is the login page.</p>
</article>

<article>
    <h1>Login</h1>

    <form action="app/users/login.php" method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="andreas@gmail.com" required>
            <small>Please provide the your email address.</small>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <small>Please provide the your password (passphrase).</small>
        </div>

        <?php if ($message !== '') : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <button type="submit">Login</button>
    </form>
</article>


<?php require __DIR__ . '/views/footer.php'; ?>
