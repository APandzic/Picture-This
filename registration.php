<?php

require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<article>
    <p>This is the registration page.</p>
</article>

<article>
    <h1>Create a new account</h1>

    <form action="app/users/registration.php" method="post">
        <div>
            <label for="firstName">First Name</label>
            <input type="firstName" name="firstName" placeholder="andreas" required>
            <small>Please provide your first name.</small>
        </div>
        <div>
            <label for="lastName">Laste Name</label>
            <input type="lastName" name="lastName" placeholder="pandzic" required>
            <small>Please provide your last name.</small>
        </div>
        <div>
            <label for="username">Username</label>
            <input type="username" name="username" placeholder="puffy" required>
            <small>Please provide your username.</small>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="andreas@gmail.com" required>
            <small>Please provide your email address.</small>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <small>Please provide your password (passphrase).</small>
        </div>
        <div>
            <label for="confirmPassword">Confirm Password</label>
            <input type="Password" name="confirmPassword" required>
            <small>Please provide your password (passphrase).</small>
        </div>

        <?php if ($message !== '') : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <button type="submit">Login</button>
    </form>
</article>


<?php require __DIR__ . '/views/footer.php'; ?>
