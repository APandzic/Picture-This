<?php

require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>
<div class="container-registration">

    <article>
        <h1>Create a new account</h1>
    </article>



    <form class="container-form-registration" action="app/users/registration.php" method="post">
        <div class="registration-div">
            <label for="firstName">First Name</label>
            <input type="firstName" name="firstName" placeholder="andreas" required>
        </div>
        <div class="registration-div">
            <label for="lastName">Laste Name</label>
            <input type="lastName" name="lastName" placeholder="pandzic" required>
        </div>
        <div class="registration-div">
            <label for="username">Username</label>
            <input type="username" name="username" placeholder="puffy" required>
        </div>
        <div class="registration-div">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="andreas@gmail.com" required>
        </div>

        <div class="registration-div">
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <small>Password must be at least 8 characters, include one upper case letter and one number.</small>
        </div>
        <div class="registration-div">
            <label for="confirmPassword">Confirm Password</label>
            <input type="Password" name="confirmPassword" required>
        </div>

        <?php if ($message !== '') : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <div class="container-registration-button">
            <button type="submit">Create</button>
            <a class="nav-link" href="/index.php"><button type="button">back</button></a>
        </div>
    </form>
</div>


<?php require __DIR__ . '/views/footer.php'; ?>
